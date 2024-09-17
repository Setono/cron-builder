<?php

declare(strict_types=1);

use Setono\CronBuilder\CronJob;

return [
    new CronJob('0 0 * * *', '/usr/bin/php {{ release_path }}/{{ release_number }}/send-report.php {{ args|join(" ") }}', 'Run every day at midnight'),
];
