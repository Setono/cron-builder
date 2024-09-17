<?php

declare(strict_types=1);

namespace Setono\CronBuilder;

use Cron\CronExpression;
use PHPUnit\Framework\TestCase;

final class CronJobTest extends TestCase
{
    /**
     * @test
     */
    public function it_constructs(): void
    {
        $cronJob = new CronJob('0 0 * * *', '/usr/bin/php /home/johndoe/public_html/send-report.php', 'Run every day at midnight');

        self::assertSame('0 0 * * *', (string) $cronJob->schedule);
        self::assertSame('/usr/bin/php /home/johndoe/public_html/send-report.php', $cronJob->command);
        self::assertSame('Run every day at midnight', $cronJob->description);

        self::assertSame('0 0 * * * /usr/bin/php /home/johndoe/public_html/send-report.php # Run every day at midnight', (string) $cronJob);
    }

    /**
     * @test
     */
    public function it_constructs_with_expression(): void
    {
        $cronJob = new CronJob(new CronExpression('0 0 * * *'), '/usr/bin/php /home/johndoe/public_html/send-report.php', 'Run every day at midnight');

        self::assertSame('0 0 * * *', (string) $cronJob->schedule);
        self::assertSame('/usr/bin/php /home/johndoe/public_html/send-report.php', $cronJob->command);
        self::assertSame('Run every day at midnight', $cronJob->description);
    }
}
