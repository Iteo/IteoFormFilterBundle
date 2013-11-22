<?php

namespace Iteo\Bundle\FormFilterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterConditionTypesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('iteo.form_filter.registry.condition_type')) {
            return;
        }

        $registry = $container->getDefinition('iteo.form_filter.registry.condition_type');
        $checkers = array();

        foreach ($container->findTaggedServiceIds('iteo.form_filter.condition_type') as $id => $attributes) {
            $checkers[$attributes[0]['type']] = $attributes[0]['label'];

            $registry->addMethodCall('registerType', array($attributes[0]['type'], new Reference($id)));
        }

        $container->setParameter('iteo.form_filter.condition_types', $checkers);
    }
}
