<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

interface VariableResolverInterface
{
    public function resolve(string $str): string;
}
