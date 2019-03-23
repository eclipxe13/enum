<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Enums\DocumentStatus;
use Eclipxe\Enum\Tests\Enums\Size;
use PHPUnit\Framework\TestCase;

class StringEnumBasicUsageTest extends TestCase
{
    public function testCreateAnInstanceUsingOnlyDefinedInformationInDocblock(): void
    {
        $first = DocumentStatus::archive();
        $this->assertSame('archive', $first->value());

        $second = DocumentStatus::archive();
        $this->assertEquals($first, $second, 'Two instances created were not equal (weak comparison)');
    }

    public function testTwoDifferentObjectsAreNotEquals(): void
    {
        $first = DocumentStatus::archive();
        $second = DocumentStatus::draft();

        $this->assertNotEquals($first, $second, 'Two different object should not be equal');
    }

    public function testTwoEqualObjectsAreEqualButNotTheSame(): void
    {
        $first = DocumentStatus::archive();
        $second = DocumentStatus::archive();

        $this->assertEquals($first, $second, 'Two instances of the same enum should be equal (weak)');
        $this->assertNotSame($first, $second, 'Two instances of the same enum should not be the same (strict)');
    }

    public function testMagicCallIsFoo(): void
    {
        $status = DocumentStatus::archive();
        $this->assertTrue($status->isArchive());
        $this->assertFalse($status->isDraft());
        $this->assertFalse($status->{'isFoo'}(), 'Compare to a non existent name must just return false');
    }

    public function testConstructUsingValue(): void
    {
        // 'archive' is defined in magic method
        $status = new DocumentStatus('archive');
        $this->assertTrue($status->isArchive());
        $this->assertSame('archive', $status->value());
    }

    public function testConstructUsingCaseWithDifferentCase(): void
    {
        // 'draft' is defined in magic method
        $status = new DocumentStatus('DrAfT');
        $this->assertTrue($status->isDraft());
        $this->assertSame('draft', $status->value());
    }

    public function testCreateWithDifferentCase(): void
    {
        /** @var DocumentStatus $status */
        $status = DocumentStatus::{'DrAfT'}();
        $this->assertTrue($status->isDraft());
        $this->assertSame('draft', $status->value());
    }

    public function testObtainCurrentEnums(): void
    {
        $this->assertEquals([
            'DRAFT' => 'draft',
            'ARCHIVE' => 'archive',
            'REVIEW' => 'review',
        ], DocumentStatus::currentEnums());
    }

    /**
     * @param string $name
     * @testWith ["draft"]
     *           ["DRAFT"]
     *           ["DrAfT"]
     */
    public function testCreateUsingName(string $name): void
    {
        /** @var DocumentStatus $expectedDraft */
        $expectedDraft = DocumentStatus::createFromName($name);
        $this->assertTrue($expectedDraft->isDraft());
    }

    public function testCreatingWithInvalidValueThrowsException(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        new DocumentStatus('foo');
    }

    public function testTwoDifferentEnumsDoesNotCollide(): void
    {
        // these two enums does not share any key
        $statuses = DocumentStatus::currentEnums();
        $sizes = Size::currentEnums();

        foreach (array_keys($statuses) as $key) {
            $this->assertArrayNotHasKey($key, $sizes);
        }

        foreach (array_keys($sizes) as $key) {
            $this->assertArrayNotHasKey($key, $statuses);
        }
    }
}
