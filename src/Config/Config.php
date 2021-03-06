<?php

declare(strict_types=1);

namespace Setono\CronBuilder\Config;

use Cron\CronExpression;
use function Safe\sprintf;

final class Config
{
    public CronExpression $schedule;

    public string $command;

    public ?string $condition;

    public ?string $description;

    public function __construct(CronExpression $schedule, string $command, string $condition = null, string $description = null)
    {
        $this->schedule = $schedule;
        $this->command = $command;
        $this->condition = $condition;
        $this->description = $description;
    }

    public static function fromArray(array $config): self
    {
        return new self(
            CronExpression::factory($config['schedule']),
            $config['command'],
            $config['condition'] ?? null,
            $config['description'] ?? null
        );
    }

    public function getCrontabLine(): string
    {
        return sprintf(
            '%s %s%s',
            $this->schedule->getExpression(), $this->command, $this->description === null ? '' : (' # ' . $this->description)
        );
    }

    public function __toString(): string
    {
        return $this->getCrontabLine();
    }
}
