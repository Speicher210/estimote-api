<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Resource;

use GuzzleHttp\Exception\ClientException;
use Speicher210\Estimote\AbstractResource;
use Speicher210\Estimote\Model\Device as DeviceModel;
use Speicher210\Estimote\Model\Device\Update as BeaconUpdate;

class Device extends AbstractResource
{
    /**
     * @param string $identifier
     * @return DeviceModel
     */
    public function getDevice(string $identifier): DeviceModel
    {
        try {
            $response = $this->client->get('/v2/devices/' . $identifier);

            return $this->serializer->deserialize(
                (string)$response->getBody(),
                DeviceModel::class,
                'json'
            );
        } catch (ClientException $e) {
            throw $this->createApiException($e);
        }
    }

    /**
     * @return DeviceModel[]
     */
    public function getDevices(): array
    {
        try {
            $response = $this->client->get('/v2/devices');

            return $this->serializer->deserialize(
                (string)$response->getBody(),
                'array<Speicher210\Estimote\Model\Device>',
                'json'
            );
        } catch (ClientException $e) {
            throw $this->createApiException($e);
        }
    }

    /**
     * @param string $identifier The device identifier.
     * @param BeaconUpdate $data The data to send.
     * @return boolean
     */
    public function updateDevice(string $identifier, BeaconUpdate $data): bool
    {
        $updatePayload = $this->serializer->serialize($data, 'json');

        try {
            $response = $this->client->post(
                'v2/devices/' . $identifier,
                [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' => $updatePayload
                ]
            );

            $json = \GuzzleHttp\json_decode($response->getBody(), true);

            return isset($json['success']) ? ($json['success'] === true) : false;
        } catch (ClientException $e) {
            throw $this->createApiException($e);
        }
    }
}
