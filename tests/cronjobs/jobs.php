<?php

declare(strict_types=1);

use Setono\CronBuilder\CronJob;

return static function (array $context): iterable {
    yield new CronJob('0 0 * * *', '/usr/bin/php %release_path%/send-report.php', 'Run every day at midnight');

    if ($context['env'] ?? '' === 'prod') {
        yield new CronJob('0 0 * * *', '/usr/bin/php %release_path%/process.php');
    }
};
