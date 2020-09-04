<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

final class ReplacingVariableResolver implements VariableResolverInterface
{
    private array $replacements;

    /**
     * Inject a key value array like
     *
     * [
     *     'search_for' => 'replace_with'
     * ]
     *
     * When searching they will be wrapped in %% if you don't add % yourself
     */
    public function __construct(array $replacements)
    {
        $this->replacements = $replacements;
    }

    public function resolve(string $str): string
    {
        $search = array_map(static function (string $str): string {
            return '%' . trim($str, '%') . '%';
        }, array_keys($this->replacements));

        return str_replace($search, array_values($this->replacements), $str);
    }
}
