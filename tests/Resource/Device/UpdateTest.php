<?php

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

        $clientMock = $this->getClientMock(array('post'));
        $responseMock = $this->getClientResponseMock('{"status":"ok"}', 200);
        $clientMock
            ->expects($this->once())
            ->method('post')
            ->with(
                'beacons/'.$deviceMac.'/pending_settings',
                $this->callback(
                    function ($values) use ($deviceMac) {
                        $this->assertArrayHasKey('headers', $values);
                        $this->assertArrayHasKey('Content-Type', $values['headers']);
                        $this->assertSame('application/json', $values['headers']['Content-Type']);

                        $this->assertArrayHasKey('body', $values);

                        $expected = array(
                            'uuid' => '',
                            'major' => 123,
                            'minor' => 456,
                            'interval' => 150,
                            'power' => 0,
                            'basic_power_mode' => true,
                            'smart_power_mode' => false,
                            'security' => false,
                        );

                        $this->assertJsonStringEqualsJsonString(json_encode($expected), $values['body']);

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

        $this->assertTrue($actual);
    }
}
