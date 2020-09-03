<?php

declare(strict_types=1);

namespace Setono\CronBuilder\ExpressionLanguage;

use function Safe\sprintf;

final class Context
{
    private array $context;

    public function __construct(array $context)
    {
        $this->context = $context;
    }

    public function has(string $key): bool
    {
        return isset($this->context[$key]);
    }

    /**
     * @return mixed
     */
    public function get(string $key)
    {
        if (!$this->has($key)) {
            throw new \InvalidArgumentException(sprintf('The key, "%s", is not defined in the context. Defined keys are: %s', $key, '[' . implode(', ', array_keys($this->context)) . ']')); // todo create exception class for this
        }

        return $this->context[$key];
    }

    /**
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->get($key);
    }
}
