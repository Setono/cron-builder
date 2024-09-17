<?php

declare(strict_types=1);

namespace Setono\CronBuilder;

/**
 * @implements \ArrayAccess<string, mixed>
 * @implements \IteratorAggregate<string, mixed>
 */
final class Context implements \ArrayAccess, \IteratorAggregate, \Countable
{
    public function __construct(
        /** @var array<string, mixed> $context */
        private array $context = [],
    ) {
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->context);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->context[$key];
    }

    public function set(string $key, mixed $value): void
    {
        $this->context[$key] = $value;
    }

    public function remove(string $key): void
    {
        unset($this->context[$key]);
    }

    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    public function offsetGet($offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if (null === $offset) {
            throw new \InvalidArgumentException('The offset cannot be null');
        }

        $this->set($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        $this->remove($offset);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->context);
    }

    public function count(): int
    {
        return count($this->context);
    }

    public function toArray(): array
    {
        return $this->context;
    }

    public function isEmpty(): bool
    {
        return [] === $this->context;
    }
}
