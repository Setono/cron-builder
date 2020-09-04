<?php

declare(strict_types=1);

namespace Setono\CronBuilder\VariableResolver;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Setono\CronBuilder\VariableResolver\ReplacingVariableResolver
 */
final class ReplacingVariableResolverTest extends TestCase
{
    /**
     * @test
     * @dataProvider getReplacements
     */
    public function it_replaces(string $str, string $expected, array $replacements): void
    {
        $resolver = new ReplacingVariableResolver($replacements);
        self::assertSame($expected, $resolver->resolve($str));
    }

    public function getReplacements(): array
    {
        return [
            ['string to be resolved %var%', 'string to be resolved by code', ['var' => 'by code']],
            ['string to be resolved %var%', 'string to be resolved by code', ['%var%' => 'by code']],
            ['string with two vars: %var1%, %var2%', 'string with two vars: coca, cola', ['%var1%' => 'coca', '%var2%' => 'cola']],
            ['string with two vars, repeated: %var1%, %var2%, %var1%', 'string with two vars, repeated: coca, cola, coca', ['%var1%' => 'coca', '%var2%' => 'cola']],
        ];
    }
}
