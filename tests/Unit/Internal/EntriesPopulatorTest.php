<?php

/**
 * @noinspection PhpRedundantVariableDocTypeInspection
 */

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit\Internal;

use Eclipxe\Enum\Internal\Entries;
use Eclipxe\Enum\Internal\EntriesPopulator;
use PHPUnit\Framework\TestCase;

class EntriesPopulatorTest extends TestCase
{
    /** @return array<string, array> */
    public function providerResolveNamesFromDocComment(): array
    {
        return [
            'basic' => ["/**\n * @method static self foo()\n */", ['foo']],
            'trail comments' => ["/**\n * @method static self foo() this is an extra comment\n */", ['foo']],
            'lead empty' => ["/**\n@method static self foo()\n */", ['foo']],
            'lead spaces' => ["/**\n  @method static self foo()\n */", ['foo']],
            'lead asterisks' => ["/**\n**@method static self foo()\n */", ['foo']],
            'lead tab' => ["/**\n\t@method static self foo()\n */", ['foo']],
            'lead multi' => ["/**\n\t*  @method static self foo()\n */", ['foo']],
            'emoji on comment' => ["/**\n * @method static self foo() this is a 😒 comment\n */", ['foo']],
            'multi' => ["/**\n * @method static self foo()\n * @method static self bar()\n */", ['foo', 'bar']],
            'no @' => ["/**\n * method static self foo()\n */", []],
            'no @method' => ["/**\n * static self foo()\n */", []],
            'no static' => ["/**\n * method self foo()\n */", []],
            'no self' => ["/**\n * method static foo()\n */", []],
            'change self' => ["/**\n * method FooBar foo()\n */", []],
            'no name' => ["/**\n * method static ()\n */", []],
            'invalid name' => ["/**\n * method static foo-bar()\n */", []],
            'no ()' => ["/**\n * method static foo\n */", []],
            'no (' => ["/**\n * method static foo)\n */", []],
            'no )' => ["/**\n * method static foo(\n */", []],
            'inner space m-s' => ["/**\n * @method  static self foo()\n */", []],
            'inner space s-s' => ["/**\n * @method static  self foo()\n */", []],
            'inner space s-n' => ["/**\n * @method static self  foo()\n */", []],
            'inner space n-p' => ["/**\n * @method static self foo ()\n */", []],
            'inner space p-p' => ["/**\n * @method static self foo( )\n */", []],
            'lead @@' => ["/**\n * @@method static self foo()\n */", []],
            'lead text' => ["/**\n * x @method static self foo()\n */", []],
            'non word character on name' => ["/**\n * @method static self eñe()\n */", []],
        ];
    }

    /**
     * @param string $specimen
     * @param array<string, array> $expected
     * @dataProvider providerResolveNamesFromDocComment
     */
    public function testResolveNamesFromDocCommentSelf(string $specimen, array $expected): void
    {
        /** @var class-string $className */
        $className = 'foo';
        $helper = new EntriesPopulator($className, [], [], new Entries());
        $resolved = $helper->resolveNamesFromDocComment($specimen);
        $this->assertSame($expected, $resolved);
    }

    /**
     * @param string $specimen
     * @param array<string, array> $expected
     * @dataProvider providerResolveNamesFromDocComment
     */
    public function testResolveNamesFromDocCommentStatic(string $specimen, array $expected): void
    {
        /** @var class-string $className */
        $className = 'foo';
        $specimen = str_replace('self', 'static', $specimen);
        $helper = new EntriesPopulator($className, [], [], new Entries());
        $resolved = $helper->resolveNamesFromDocComment($specimen);
        $this->assertSame($expected, $resolved);
    }
}
