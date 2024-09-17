<?php

declare(strict_types=1);

namespace Setono\CronBuilder;

use PHPUnit\Framework\TestCase;

final class ContextTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets(): void
    {
        $context = new Context();
        $context->set('env', 'prod');

        self::assertSame('prod', $context->get('env'));
    }

    /**
     * @test
     */
    public function it_removes(): void
    {
        $context = new Context();
        $context->set('env', 'prod');
        $context->remove('env');

        self::assertNull($context->get('env'));
    }

    /**
     * @test
     */
    public function it_has(): void
    {
        $context = new Context();
        $context->set('env', 'prod');

        self::assertTrue($context->has('env'));
        self::assertFalse($context->has('foo'));
    }

    /**
     * @test
     */
    public function it_gets_default(): void
    {
        $context = new Context();
        self::assertNull($context->get('env'));
        self::assertSame('default', $context->get('env', 'default'));
    }

    /**
     * @test
     */
    public function it_iterates(): void
    {
        $context = new Context(['env' => 'prod', 'foo' => 'bar']);
        $values = [];

        /** @var mixed $value */
        foreach ($context as $key => $value) {
            /** @psalm-suppress MixedAssignment */
            $values[$key] = $value;
        }

        self::assertSame(['env' => 'prod', 'foo' => 'bar'], $values);
    }

    /**
     * @test
     */
    public function it_counts(): void
    {
        $context = new Context(['env' => 'prod', 'foo' => 'bar']);
        self::assertCount(2, $context);
    }

    /**
     * @test
     */
    public function it_offset_exists(): void
    {
        $context = new Context(['env' => 'prod', 'foo' => 'bar']);
        self::assertTrue(isset($context['env']));
        self::assertFalse(isset($context['baz']));
    }

    /**
     * @test
     */
    public function it_offset_get(): void
    {
        $context = new Context(['env' => 'prod', 'foo' => 'bar']);
        self::assertSame('prod', $context['env']);
    }

    /**
     * @test
     */
    public function it_offset_set(): void
    {
        $context = new Context();
        $context['env'] = 'prod';
        self::assertSame('prod', $context['env']);
    }

    /**
     * @test
     */
    public function it_offset_unset(): void
    {
        $context = new Context(['env' => 'prod', 'foo' => 'bar']);
        unset($context['env']);
        self::assertNull($context['env']);
    }

    /**
     * @test
     */
    public function it_throws_exception_on_null_offset(): void
    {
        $context = new Context();
        $this->expectException(\InvalidArgumentException::class);
        $context[] = 'foo';
    }
}
