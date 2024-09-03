<?php

declare(strict_types=1);

namespace Setono\CronBuilder;

use Cron\CronExpression;

final class CronJob implements \Stringable
{
    public readonly CronExpression $schedule;

    public function __construct(
        CronExpression|string $schedule,
        public readonly string $command,
        public readonly ?string $description = null,
    ) {
        if (is_string($schedule)) {
            $schedule = new CronExpression($schedule);
        }

        $this->schedule = $schedule;
    }

    public function toString(): string
    {
        return sprintf(
            '%s %s%s',
            (string) $this->schedule,
            $this->command,
            $this->description === null ? '' : (' # ' . $this->description),
        );
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
