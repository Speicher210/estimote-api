<?php

declare(strict_types = 1);

namespace Speicher210\Estimote;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Speicher210\Estimote\Exception\ApiException;
use Speicher210\Estimote\Exception\ApiKeyInvalidException;

/**
 * Abstract resource.
 */
abstract class AbstractResource
{
    /**
     * The API client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Serializer interface to serialize / deserialize the request / responses.
     *
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @param Client $client The API client.
     * @param SerializerInterface $serializer Serializer interface to serialize / deserialize the request / responses.
     */
    public function __construct(Client $client, SerializerInterface $serializer = null)
    {
        $this->client = $client;
        $this->serializer = $serializer ?? $this->buildSerializer();
    }

    private function buildSerializer(): SerializerInterface
    {
        return SerializerBuilder::create()
            ->setSerializationContextFactory(
                function () {
                    return SerializationContext::create()->setSerializeNull(false);
                }
            )
            ->build();
    }

    /**
     * Create an ApiException from a client exception.
     *
     * @param ClientException $e The client exception.
     * @return ApiException
     */
    protected function createApiException(ClientException $e): ApiException
    {
        $response = $e->getResponse();

        if (\in_array($response->getStatusCode(), [401, 403], true)) {
            return new ApiKeyInvalidException();
        }

        return new ApiException((string)$response->getBody());
    }
}
