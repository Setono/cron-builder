<?php

declare(strict_types=1);

namespace Setono\CronBuilder\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Definition implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('cronjobs');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->arrayPrototype()
                ->children()
                    ->scalarNode('schedule') // todo validate this
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('command')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('condition') // todo validate this
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('description')
                        ->cannotBeEmpty()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
