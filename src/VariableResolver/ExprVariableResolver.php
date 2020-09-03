<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

use function Safe\preg_match_all;
use Webmozart\Assert\Assert;

final class ExprVariableResolver implements VariableResolverInterface, ExpressionLanguageAwareInterface
{
    use ExpressionLanguageAwareTrait;

    public function resolve(string $cronStr, array $options): string
    {
        Assert::notNull($this->expressionLanguage);

        if (mb_strpos($cronStr, '%expr:') === false) {
            return $cronStr;
        }

        preg_match_all('/%expr:(.*)%/', $cronStr, $matches);

        if (!isset($matches[0], $matches[1]) || !is_array($matches[0]) || !is_array($matches[1]) || count($matches[0]) !== count($matches[1])) {
            throw new \InvalidArgumentException('Wrong match format'); // todo better exception
        }

        foreach ($matches[1] as $key => $expr) {
            $exprValue = $this->expressionLanguage->evaluate($expr, $this->expressionLanguageValues);

            $cronStr = str_replace($matches[0][$key], $exprValue, $cronStr);
        }

        return $cronStr;
    }
}
