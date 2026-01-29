<?php

namespace AiTestBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AiTestBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        // Ici tu peux ajouter des compiler passes si besoin
    }

    public function getContainerExtensionClass(): string
    {
        // Nom exact de ta classe d’extension avec namespace
        return 'AiTestBundle\DependencyInjection\AiTestExtension';
    }
}
