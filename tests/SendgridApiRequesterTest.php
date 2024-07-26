<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient\Tests;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListRequest;
use Linkage\SendgridMarketingCampaignApiClient\ContactList\CreateContactListResponse;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsRequest;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsResponse;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\CreateRecipientsResponseError;
use Linkage\SendgridMarketingCampaignApiClient\Recipients\RecipientRequest;
use Linkage\SendgridMarketingCampaignApiClient\SendgridApiClientException;
use Linkage\SendgridMarketingCampaignApiClient\SendgridApiRequester;
use Linkage\SendgridMarketingCampaignApiClient\SendgridApiServerException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SendgridApiRequesterTest extends TestCase
{
    private MockObject&ClientInterface $guzzleClientMock;

    protected function setUp(): void
    {
        $this->guzzleClientMock = $this->createMock(ClientInterface::class);
    }

    public function testPostContactList(): void
    {
        $this->guzzleClientMock->expects($this->once())
            ->method('request')
            ->with('POST', '/dummy/path', [
                'body' => '{"name":"dummy-name"}',
            ])
            ->willReturn(new Response(body: (string) json_encode(['id' => 1, 'name' => 'dummy-name', 'recipient_count' => 0])))
        ;

        /** @var CreateContactListResponse $actual */
        $actual = $this->getSUT()->post(
            '/dummy/path',
            new CreateContactListRequest('dummy-name'),
            CreateContactListResponse::class,
        );

        $this->assertInstanceOf(CreateContactListResponse::class, $actual);
        $this->assertSame(1, $actual->id);
        $this->assertSame('dummy-name', $actual->name);
        $this->assertSame(0, $actual->recipientCount);
    }

    public function testPostMultipleRecipients(): void
    {
        $json = <<<'EOJ'
                {
                  "error_count": 1,
                  "error_indices": [
                    2
                  ],
                  "unmodified_indices": [
                    3
                  ],
                  "new_count": 2,
                  "persisted_recipients": [
                    "YUBh",
                    "bWlsbGVyQG1pbGxlci50ZXN0"
                  ],
                  "updated_count": 0,
                  "errors": [
                    {
                      "message": "Invalid email.",
                      "error_indices": [
                        2
                      ]
                    }
                  ]
                }
            EOJ;
        $this->guzzleClientMock->expects($this->once())
            ->method('request')
            ->with('POST', '/dummy/path', [
                'body' => '[{"email":"example@example.com"},{"email":"eexampexample@example.com"},{"email":"invalid_email"}]',
            ])
            ->willReturn(new Response(body: $json))
        ;

        /** @var CreateRecipientsResponse $actual */
        $actual = $this->getSUT()->post(
            '/dummy/path',
            new CreateRecipientsRequest([
                new RecipientRequest(email: 'example@example.com'),
                new RecipientRequest(email: 'eexampexample@example.com'),
                new RecipientRequest(email: 'invalid_email'),
            ]),
            CreateRecipientsResponse::class,
        );

        $this->assertInstanceOf(CreateRecipientsResponse::class, $actual);
        $this->assertIsArray($actual->errors);
        $this->assertCount(1, $actual->errors);
        $this->assertInstanceOf(CreateRecipientsResponseError::class, $actual->errors[0]);
        $this->assertSame('Invalid email.', $actual->errors[0]->message);
        $this->assertSame([2], $actual->errors[0]->errorIndices);
    }

    public function testPostClientError(): void
    {
        $this->expectException(SendgridApiClientException::class);

        $this->guzzleClientMock->expects($this->once())
            ->method('request')
            ->willThrowException(new ClientException('dummy', $this->createMock(Request::class), $this->createMock(Response::class)))
        ;

        $this->getSUT()->post(
            '/dummy/path',
            new CreateContactListRequest('dummy-name'),
            CreateContactListResponse::class,
        );
    }

    public function testPostServerError(): void
    {
        $this->expectException(SendgridApiServerException::class);

        $this->guzzleClientMock->expects($this->once())
            ->method('request')
            ->willThrowException(new ServerException('dummy', $this->createMock(Request::class), $this->createMock(Response::class)))
        ;

        $this->getSUT()->post(
            '/dummy/path',
            new CreateContactListRequest('dummy-name'),
            CreateContactListResponse::class,
        );
    }

    private function getSUT(): SendgridApiRequester
    {
        return new SendgridApiRequester(
            'test',
            $this->guzzleClientMock,
        );
    }
}
