<?php

declare(strict_types=1);

use Setono\CronBuilder\Context;
use Setono\CronBuilder\CronJob;

return static function (Context $context): iterable {
    yield new CronJob('0 0 * * *', '/usr/bin/php {{ release_path }}/{{ release_number }}/send-report.php {{ args|join(" ") }}', 'Run every day at midnight');
    yield new CronJob('0 0 * * *', '{{ context("bin/php") }} {{ release_path }}/{{ release_number }}/flush.php');

    if ($context->get('env') === 'prod') {
        yield new CronJob('0 0 * * *', '/usr/bin/php {{ release_path }}/{{ release_number }}/process.php {{ args|join(" ") }}');
    }
};
