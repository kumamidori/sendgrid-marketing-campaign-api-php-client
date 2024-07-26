<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Tests;

use Linkage\SendgridMarketingCampaignApiClient\CreateRecipientsResponseErrorNormalizer;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsResponseError;
use PHPUnit\Framework\TestCase;

class CreateRecipientsResponseErrorNormalizerTest extends TestCase
{
    private CreateRecipientsResponseErrorNormalizer $SUT;

    protected function setUp(): void
    {
        $this->SUT = new CreateRecipientsResponseErrorNormalizer();
    }

    public function testSupportsNormalization(): void
    {
        $this->assertTrue($this->SUT->supportsNormalization(new CreateRecipientsResponseError('foo', [1])));
        $this->assertFalse($this->SUT->supportsNormalization('string-value'));
        $this->assertFalse($this->SUT->supportsNormalization(new \stdClass()));
    }

    public function testNormalize(): void
    {
        $actual = $this->SUT->normalize(new CreateRecipientsResponseError('foo', [1, 3]));

        $this->assertIsArray($actual);
        $this->assertArrayHasKey('message', $actual);
        $this->assertArrayHasKey('message', $actual);
        $this->assertSame('foo', $actual['message']);
        $this->assertIsArray($actual['error_indices']);
        $this->assertCount(2, $actual['error_indices']);
        $this->assertSame(1, $actual['error_indices'][0]);
        $this->assertSame(3, $actual['error_indices'][1]);
    }

    public function testDenormalize(): void
    {
        $actual = $this->SUT->denormalize([
            'message' => 'foo',
            'error_indices' => [1, 3],
        ], CreateRecipientsResponseError::class);

        $this->assertInstanceOf(CreateRecipientsResponseError::class, $actual);
        $this->assertSame('foo', $actual->message);
        $this->assertIsArray($actual->errorIndices);
        $this->assertCount(2, $actual->errorIndices);
        $this->assertSame(1, $actual->errorIndices[0]);
        $this->assertSame(3, $actual->errorIndices[1]);
    }
}
