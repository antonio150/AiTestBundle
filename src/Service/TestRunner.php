<?php 

namespace AiTestBundle\Service;

class TestRunner
{
    public function run(): string
    {
        return shell_exec('php bin/phpunit') ?? 'Erreur lors de l’exécution des tests';
    }
}
