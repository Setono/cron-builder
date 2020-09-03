<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

trait ExpressionLanguageAwareTrait
{
    protected ?ExpressionLanguage $expressionLanguage = null;

    protected array $expressionLanguageValues = [];

    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage, array $values = []): void
    {
        $this->expressionLanguage = $expressionLanguage;
        $this->expressionLanguageValues = $values;
    }
}
