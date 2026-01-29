<?php 

namespace AiTestBundle\Service;

class ControllerAnalyzer
{
    public function analyze(string $controllerClass): array
    {
        $ref = new \ReflectionClass($controllerClass);
        $methods = [];

        foreach ($ref->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() === $controllerClass) {
                $methods[] = $method->getName();
            }
        }

        return $methods;
    }
}
