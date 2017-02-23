<?php

namespace Speicher210\Estimote\Resource;

use GuzzleHttp\Exception\ClientException;
use Speicher210\Estimote\AbstractResource;
use Speicher210\Estimote\Model\Beacon as BeaconModel;
use Speicher210\Estimote\Model\Beacon\Update as BeaconUpdate;

class Device extends AbstractResource
{
    /**
     * Get one beacon.
     *
     * @param string $mac
     * @return BeaconModel
     */
    public function getBeacon($mac)
    {
        try {
            $response = $this->client->get('beacons/' . $mac);

            return $this->serializer->deserialize(
                $response->getBody(),
                BeaconModel::class,
                'json'
            );
        } catch (ClientException $e) {
            throw $this->createApiException($e);
        }
    }

    /**
     * Get the list of beacons.
     *
     * @return BeaconModel[]
     */
    public function getBeacons()
    {
        try {
            $response = $this->client->get('beacons');

            return $this->serializer->deserialize(
                $response->getBody(),
                'array<Speicher210\Estimote\Model\Beacon>',
                'json'
            );
        } catch (ClientException $e) {
            throw $this->createApiException($e);
        }
    }

    /**
     * Update one beacon.
     *
     * @param string $beaconMac The beacon MAC address.
     * @param BeaconUpdate $data The data to send.
     * @return boolean
     */
    public function updateBeacon($beaconMac, BeaconUpdate $data)
    {
        try {
            $response = $this->client->post(
                'beacons/' . $beaconMac . '/pending_settings',
                [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' => $this->serializer->serialize($data, 'json')
                ]
            );

            $json = \GuzzleHttp\json_decode($response->getBody(), true);

            return isset($json['status']) ? ($json['status'] === 'ok') : false;
        } catch (ClientException $e) {
            throw $this->createApiException($e);
        }
    }
}
