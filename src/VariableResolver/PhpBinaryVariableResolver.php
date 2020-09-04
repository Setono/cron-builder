<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

use RuntimeException;
use Symfony\Component\Process\PhpExecutableFinder;

final class PhpBinaryVariableResolver implements VariableResolverInterface
{
    public function resolve(string $str): string
    {
        $phpExecutableFinder = new PhpExecutableFinder();
        $phpBinary = $phpExecutableFinder->find();

        if (false === $phpBinary) {
            throw new RuntimeException('Could not find a php binary');
        }

        return str_replace('%php_bin%', $phpBinary, $str);
    }
}
