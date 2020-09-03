<?php

declare(strict_types=1);

namespace Setono\CronBuilder\Config;

use Symfony\Component\Config\Definition\Processor as DefinitionProcessor;

final class Processor
{
    /**
     * @return Config[]
     */
    public function process(array $configs): iterable
    {
        $processor = new DefinitionProcessor();
        $cronjobConfigs = $processor->processConfiguration(new Definition(), $configs);

        foreach ($cronjobConfigs as $cronjobConfig) {
            yield Config::fromArray($cronjobConfig);
        }
    }
}
