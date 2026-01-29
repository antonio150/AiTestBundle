<?php

namespace AiTestBundle\Service;

use Symfony\Component\Routing\Attribute\Route as RouteAttribute;

class TestGenerator
{
    public function generate(string $controller, array $methods): void
    {
        $refClass = new \ReflectionClass($controller);
        $short = $refClass->getShortName();
        $testClass = $short . 'Test';
        $path = 'tests/Controller/' . $testClass . '.php';

        $code = "<?php\n\n";
        $code .= "use Symfony\\Bundle\\FrameworkBundle\\Test\\WebTestCase;\n\n";
        $code .= "class $testClass extends WebTestCase\n{\n";

        foreach ($refClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes(RouteAttribute::class) as $attr) {
                $route = $attr->newInstance();

                $url = $route->getPath();
                $httpMethods = $route->getMethods() ?: ['GET'];
                $httpMethod = $httpMethods[0];

                $testName = 'test' . ucfirst($method->getName());

                $code .= "    public function $testName()\n    {\n";
                $code .= "        \$client = static::createClient();\n";
                $code .= "        \$client->request('$httpMethod', '$url');\n";
                $code .= "        \$this->assertResponseIsSuccessful();\n";
                $code .= "    }\n\n";
            }
        }

        $code .= "}\n";

        if (!is_dir('tests/Controller')) {
            mkdir('tests/Controller', 0777, true);
        }

        file_put_contents($path, $code);
    }
}
