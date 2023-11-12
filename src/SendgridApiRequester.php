<?php

declare(strict_types=1);

namespace Linkage\SendgridMarketingCampaignApiClient;

use GuzzleHttp\ClientInterface as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Symfony\Component\Serializer\SerializerInterface;

readonly class SendgridApiRequester
{
    private SerializerInterface $serializer;

    public function __construct(
        private HttpClient $httpClient,
        SerializerInterface|null $serializer = null,
    ) {
        $this->serializer = $serializer ?? (new SerializerFactory())->create();
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $responseClass
     *
     * @return T
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function post(string $path, object $request, string $responseClass)
    {
        return $this->mutate('POST', $path, $request, $responseClass);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $responseClass
     *
     * @return T
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    public function put(string $path, object $request, string $responseClass)
    {
        return $this->mutate('PUT', $path, $request, $responseClass);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $responseClass
     *
     * @return T
     *
     * @throws SendgridApiClientException
     * @throws SendgridApiServerException
     */
    private function mutate(string $method, string $path, object $request, string $responseClass)
    {
        $json = $this->serializer->serialize($request, 'json');

        try {
            $response = $this->httpClient->request($method, $path, [
                'body' => $json,
            ]);
        } catch (ClientException $e) {
            throw new SendgridApiClientException($e->getResponse()->getBody()->getContents(), previous: $e);
        } catch (ServerException|GuzzleException $e) {
            throw new SendgridApiServerException($e->getMessage(), code: $e->getCode(), previous: $e);
        }

        $result = $this->serializer->deserialize($response->getBody()->getContents(), $responseClass, 'json');
        \assert(\is_object($result) && $result instanceof $responseClass);

        return $result;
    }
}
