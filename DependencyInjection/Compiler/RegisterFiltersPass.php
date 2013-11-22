<?php

namespace Iteo\Bundle\FormFilterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterFiltersPass  implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('iteo.form_filter.registry.filter')) {
            return;
        }

        $registry = $container->getDefinition('iteo.form_filter.registry.filter');

        foreach ($container->findTaggedServiceIds('iteo.form_filter.filter') as $id => $attributes) {
            $registry->addMethodCall('registerFilter', array($attributes[0]['type'], new Reference($id)));
        }
    }
}
