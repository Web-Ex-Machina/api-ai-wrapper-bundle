<?php

declare(strict_types=1);

/*
 * WebEx Api Ai Wrapper Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/api-ai-wrapper-bundle/
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WebExMachina\ApiAiWrapperBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ApiAiWrapperBundle extends AbstractBundle
{

    public function configure(DefinitionConfigurator $definition): void
    {
//        $definition->rootNode()
//            ->children()
//            ->arrayNode('api')
//            ->children()
//            ->arrayNode('credentials')
//            ->children()
//            ->integerNode('username')->end()
//            ->scalarNode('password')->end()
//            ->end()
//            ->end() // credentials
//            ->end() // api
//            ->end()
//        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->import('../config/services.yaml');
    }
}
