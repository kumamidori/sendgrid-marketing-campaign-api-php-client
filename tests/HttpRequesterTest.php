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
use Linkage\SendgridMarketingCampaignApiClient\HttpRequester;
use Linkage\SendgridMarketingCampaignApiClient\SendgridApiClientException;
use Linkage\SendgridMarketingCampaignApiClient\SendgridApiServerException;
use Linkage\SendgridMarketingCampaignApiClient\SerializerFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class HttpRequesterTest extends TestCase
{
    private MockObject&ClientInterface $guzzleClientMock;
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->guzzleClientMock = $this->createMock(ClientInterface::class);
        $this->serializer = (new SerializerFactory())->create();
    }

    public function test_post(): void
    {
        $this->guzzleClientMock->expects($this->once())
            ->method('request')
            ->with('POST', '/dummy/path', [
                'body' => '{"name":"dummy-name"}',
            ])
            ->willReturn(new Response(body: json_encode(['id' => 1, 'name' => 'dummy-name', 'recipient_count' => 0])))
        ;

        /** @var CreateContactListResponse $actual */
        $actual = $this->getSUT()->post(
            '/dummy/path',
            new CreateContactListRequest('dummy-name'),
            CreateContactListResponse::class,
        );

        $this->assertTrue($actual instanceof CreateContactListResponse);
        $this->assertEquals(1, $actual->id);
        $this->assertEquals('dummy-name', $actual->name);
        $this->assertEquals(0, $actual->recipientCount);
    }

    public function test_post_clientError(): void
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

    public function test_post_serverError(): void
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

    private function getSUT(): HttpRequester
    {
        return new HttpRequester(
            $this->guzzleClientMock,
            $this->serializer,
        );
    }
}