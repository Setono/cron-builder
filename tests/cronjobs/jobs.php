<?php

declare(strict_types=1);

use Setono\CronBuilder\Context;
use Setono\CronBuilder\CronJob;

return static function (Context $context): iterable {
    yield new CronJob('0 0 * * *', '/usr/bin/php {{ release_path }}/send-report.php {{ args|join(" ") }}', 'Run every day at midnight');

    if ($context->get('env') === 'prod') {
        yield new CronJob('0 0 * * *', '/usr/bin/php {{ release_path }}/process.php {{ args|join(" ") }}');
    }
};
