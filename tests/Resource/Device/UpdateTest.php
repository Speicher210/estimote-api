<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Test\Resource\Device;

use Speicher210\Estimote\Model\Device\PendingSettings;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\EddystoneUrl;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\IBeacon;
use Speicher210\Estimote\Model\Device\Update;
use Speicher210\Estimote\Resource\Device;
use Speicher210\Estimote\Test\Resource\AbstractResourceTest;

class UpdateTest extends AbstractResourceTest
{
    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest(): string
    {
        return Device::class;
    }

    public function testUpdateDevice(): void
    {
        $deviceIdentifier = 'abcdef123';

        $clientMock = $this->getClientMock(['post']);
        $responseMock = $this->getClientResponseMock('{"success": true}', 200);
        $clientMock
            ->expects(self::once())
            ->method('post')
            ->with(
                'v2/devices/' . $deviceIdentifier,
                self::callback(
                    function ($values) {
                        self::assertArrayHasKey('headers', $values);
                        self::assertArrayHasKey('Content-Type', $values['headers']);
                        self::assertSame('application/json', $values['headers']['Content-Type']);

                        self::assertArrayHasKey('body', $values);

                        $expected = [
                            'pending_settings' => [
                                'advertisers' => [
                                    'ibeacon' => [
                                        [
                                            'index' => 1,
                                            'enabled' => true,
                                            'uuid' => 'B36C37A3-875F-4E56-9905-1F8BDC815E03',
                                            'major' => 123,
                                            'minor' => 456,
                                            'power' => 0,
                                            'interval' => 150,
                                            'non_strict_mode_enabled' => true
                                        ]
                                    ],
                                    'eddystone_url' => []
                                ]
                            ]
                        ];

                        self::assertJsonStringEqualsJsonString(\json_encode($expected), $values['body']);

                        return true;
                    }
                )
            )
            ->willReturn($responseMock);

        $iBeacon = new IBeacon(1, true, 'B36C37A3-875F-4E56-9905-1F8BDC815E03', 123, 456, 0, 150, true);
        $advertisers = new Advertisers($iBeacon, null);
        $pendingSettings = new PendingSettings($advertisers);
        $updateData = new Update($pendingSettings);

        /** @var Device $resource */
        $resource = $this->getResourceToTest($clientMock);
        $actual = $resource->updateDevice($deviceIdentifier, $updateData);

        self::assertTrue($actual);
    }

    public function testUpdateDevicePartial(): void
    {
        $deviceIdentifier = 'abcdef123';

        $clientMock = $this->getClientMock(['post']);
        $responseMock = $this->getClientResponseMock('{"success": true}', 200);
        $clientMock
            ->expects(self::once())
            ->method('post')
            ->with(
                'v2/devices/' . $deviceIdentifier,
                self::callback(
                    function ($values) {
                        self::assertArrayHasKey('headers', $values);
                        self::assertArrayHasKey('Content-Type', $values['headers']);
                        self::assertSame('application/json', $values['headers']['Content-Type']);

                        self::assertArrayHasKey('body', $values);

                        $expected = [
                            'pending_settings' => [
                                'advertisers' => [
                                    'ibeacon' => [
                                        [
                                            'index' => 1,
                                            'enabled' => true,
                                            'major' => 123
                                        ]
                                    ],
                                    'eddystone_url' => [
                                        [
                                            'index' => 1,
                                            'url' => 'https://example.com/abcdef123'
                                        ]
                                    ]
                                ]
                            ]
                        ];

                        self::assertJsonStringEqualsJsonString(\json_encode($expected), $values['body']);

                        return true;
                    }
                )
            )
            ->willReturn($responseMock);

        $iBeacon = new IBeacon(1, true, null, 123, null, null, null, null);
        $eddystoneUrl = new EddystoneUrl(1, null, null, null, 'https://example.com/abcdef123');
        $advertisers = new Advertisers($iBeacon, $eddystoneUrl);
        $pendingSettings = new PendingSettings($advertisers);
        $updateData = new Update($pendingSettings);

        /** @var Device $resource */
        $resource = $this->getResourceToTest($clientMock);
        $actual = $resource->updateDevice($deviceIdentifier, $updateData);

        self::assertTrue($actual);
    }
}
