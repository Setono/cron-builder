<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

interface ExpressionLanguageAwareInterface
{
    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage, array $values = []): void;
}
