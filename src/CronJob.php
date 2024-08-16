<?php

declare(strict_types=1);

namespace Setono\CronBuilder;

final class CronJob implements \Stringable
{
    public function __construct(
        public readonly string $schedule,
        public readonly string $command,
        public readonly ?string $description = null,
    ) {
    }

    public function toString(): string
    {
        return sprintf(
            '%s %s%s',
            $this->schedule,
            $this->command,
            $this->description === null ? '' : (' # ' . $this->description),
        );
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
