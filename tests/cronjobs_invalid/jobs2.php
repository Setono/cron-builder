<?php

declare(strict_types=1);

use Setono\CronBuilder\Context;
use Setono\CronBuilder\CronJob;

return static function (Context $context): string {
    return 'not an iterable';
};
