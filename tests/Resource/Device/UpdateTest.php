<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Test\Resource\Device;

use Speicher210\Estimote\Model\Beacon\Update;
use Speicher210\Estimote\Resource\Device;
use Speicher210\Estimote\Test\Resource\AbstractResourceTest;

class BeaconsTest extends AbstractResourceTest
{
    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest()
    {
        return Device::class;
    }

    public function testUpdateDevice()
    {
        $deviceMac = 'abcdef123';

        $clientMock = $this->getClientMock(['post']);
        $responseMock = $this->getClientResponseMock('{"status":"ok"}', 200);
        $clientMock
            ->expects(self::once())
            ->method('post')
            ->with(
                'beacons/' . $deviceMac . '/pending_settings',
                self::callback(
                    function ($values) use ($deviceMac) {
                        self::assertArrayHasKey('headers', $values);
                        self::assertArrayHasKey('Content-Type', $values['headers']);
                        self::assertSame('application/json', $values['headers']['Content-Type']);

                        self::assertArrayHasKey('body', $values);

                        $expected = [
                            'uuid' => '',
                            'major' => 123,
                            'minor' => 456,
                            'interval' => 150,
                            'power' => 0,
                            'basic_power_mode' => true,
                            'smart_power_mode' => false,
                            'security' => false
                        ];

                        self::assertJsonStringEqualsJsonString(\json_encode($expected), $values['body']);

                        return true;
                    }
                )
            )
            ->willReturn($responseMock);

        $updateData = new Update();
        $updateData->uuid = '';
        $updateData->major = 123;
        $updateData->minor = 456;
        $updateData->interval = 150;
        $updateData->power = 0;
        $updateData->basicPowerMode = true;
        $updateData->smartPowerMode = false;
        $updateData->security = false;

        /** @var Device $resource */
        $resource = $this->getResourceToTest($clientMock);
        $actual = $resource->updateBeacon($deviceMac, $updateData);

        self::assertTrue($actual);
    }
}
