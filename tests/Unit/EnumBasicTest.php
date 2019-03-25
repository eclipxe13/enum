<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Exceptions\BadMethodCallException;
use Eclipxe\Enum\Exceptions\EnumConstructTypeError;
use Eclipxe\Enum\Exceptions\IndexNotFoundException;
use Eclipxe\Enum\Exceptions\ValueNotFoundException;
use Eclipxe\Enum\Tests\Fixtures\Stages;
use PHPUnit\Framework\TestCase;

/**
 * This tests are based on Eclipxe\Enum\Tests\Enums\Stages
 *
 * @see Stages
 */
class EnumBasicTest extends TestCase
{
    public function testCreateEnumByValue(): void
    {
        $stage = new Stages('reviewed');
        $this->assertSame('reviewed', $stage->value());
        $this->assertSame(2, $stage->index());
    }

    public function testCreateEnumByIndex(): void
    {
        $stage = new Stages(0);
        $this->assertSame(0, $stage->index());
        $this->assertSame('created', $stage->value());
    }

    public function testCreateEnumCallingStaticMethod(): void
    {
        $stage = Stages::published();
        $this->assertSame('published', $stage->value());
        $this->assertSame(1, $stage->index());
    }

    public function testCreateEnumCallingStaticMethodWithDifferentCase(): void
    {
        /** @var Stages $stage */
        $stage = Stages::{'PUBLISHED'}();
        $this->assertSame('published', $stage->value());
        $this->assertSame(1, $stage->index());
    }

    public function testConstructConvertObjectToString(): void
    {
        $published = Stages::published();
        $other = new Stages($published);
        $this->assertTrue($other->isPublished());
    }

    public function testEqualInstancesAreEqualButNotIdentical(): void
    {
        $first = Stages::reviewed();
        $second = Stages::reviewed();
        $this->assertEquals($first, $second);
        $this->assertNotSame($first, $second);
    }

    public function testMagicMethodIs(): void
    {
        $stage = Stages::published();
        $this->assertTrue($stage->isPublished());
        $this->assertFalse($stage->isReviewed());
    }

    public function testMagicMethodIsWithNonDeclaredName(): void
    {
        $stage = Stages::published();
        $this->assertFalse($stage->{'isNotDeclaredName'}());
    }

    public function testMagicMethodToString(): void
    {
        $stage = Stages::purged();
        $this->assertSame('purged', strval($stage));
    }

    public function testToArrayExport(): void
    {
        $expected = [
            0 => 'created',
            1 => 'published',
            2 => 'reviewed',
            3 => 'purged',
        ];
        $this->assertSame($expected, Stages::toArray());
    }

    public function testThrowsValueNotFoundException(): void
    {
        $notExistent = 'not-defined';
        $this->expectException(ValueNotFoundException::class);
        $this->expectExceptionMessage(sprintf('%s value %s was not found', Stages::class, $notExistent));
        new Stages($notExistent);
    }

    public function testThrowsIndexNotFoundException(): void
    {
        $notExistent = 10;
        $this->expectException(IndexNotFoundException::class);
        $this->expectExceptionMessage(sprintf('%s index %d was not found', Stages::class, $notExistent));
        new Stages($notExistent);
    }

    public function testThrowsTypeError(): void
    {
        $this->expectException(EnumConstructTypeError::class);
        $this->expectExceptionMessage(
            sprintf('Argument passed to %s must be integer for index or string for value', Stages::class)
        );
        new Stages(false);
    }

    public function testThrowsInvalidMethodCallOnStatic(): void
    {
        $notDeclaredName = 'notDeclaredName';
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage(sprintf('Call to undefined method %s::%s', Stages::class, $notDeclaredName));
        Stages::{$notDeclaredName}();
    }

    public function testThrowsInvalidMethodCallOnInstantiated(): void
    {
        $stage = Stages::purged();
        $notDeclaredName = 'notDeclaredName';
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage(sprintf('Call to undefined method %s::%s', Stages::class, $notDeclaredName));
        $stage->{$notDeclaredName}();
    }

    public function testThrowTypeErrorWhenConstructCannotConvertObjectsToString(): void
    {
        $this->expectException(EnumConstructTypeError::class);
        new Stages(new \stdClass());
    }
}
