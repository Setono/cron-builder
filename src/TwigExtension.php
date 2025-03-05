<?php

declare(strict_types=1);

namespace Setono\CronBuilder;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TwigExtension extends AbstractExtension
{
    public function __construct(private readonly Context $context)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('c', $this->context(...)),
            new TwigFunction('context', $this->context(...)),
        ];
    }

    public function context(string $key, mixed $default = null): mixed
    {
        return $this->context->get($key, $default);
    }
}
