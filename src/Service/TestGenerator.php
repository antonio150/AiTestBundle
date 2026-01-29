<?php 

namespace AiTestBundle\Service;

class TestGenerator
{
    public function generate(string $controller, array $methods): void
    {
        $short = (new \ReflectionClass($controller))->getShortName();
        $testClass = $short . 'Test';
        $path = 'tests/Controller/' . $testClass . '.php';

        $code = "<?php\n\nuse Symfony\\Bundle\\FrameworkBundle\\Test\\WebTestCase;\n\n";
        $code .= "class $testClass extends WebTestCase\n{\n";

        foreach ($methods as $method) {
            $code .= "    public function test" . ucfirst($method) . "()\n    {\n";
            $code .= "        \$client = static::createClient();\n";
            $code .= "        \$client->request('GET', '/');\n";
            $code .= "        \$this->assertResponseIsSuccessful();\n";
            $code .= "    }\n\n";
        }

        $code .= "}\n";

        if (!is_dir('tests/Controller')) {
            mkdir('tests/Controller', 0777, true);
        }

        file_put_contents($path, $code);
    }
}
