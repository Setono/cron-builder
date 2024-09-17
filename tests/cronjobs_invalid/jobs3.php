<?php

declare(strict_types=1);

use Setono\CronBuilder\Context;
use Setono\CronBuilder\CronJob;

return static function (Context $context): iterable {
    yield 'not an object';
};
