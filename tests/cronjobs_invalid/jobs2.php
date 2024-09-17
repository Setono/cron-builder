<?php

declare(strict_types=1);

use Setono\CronBuilder\Context;

return static function (Context $context): string {
    return 'not an iterable';
};
