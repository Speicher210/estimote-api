<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Test\Resource\Device;

use Speicher210\Estimote\Model\Beacon;
use Speicher210\Estimote\Resource\Device;
use Speicher210\Estimote\Test\Resource\AbstractResourceTest;

class GetBeaconTest extends AbstractResourceTest
{
    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest()
    {
        return Device::class;
    }

    public function testGetBeacon()
    {
        $deviceMac = 'abcdef1234';

        $clientMock = $this->getClientMock(['get']);
        $responseMock = $this->getClientResponseMock(\file_get_contents(__DIR__ . '/Fixtures/testGetBeacon.json'), 200);

        $clientMock
            ->expects(self::once())
            ->method('get')
            ->with('beacons/' . $deviceMac)
            ->willReturn($responseMock);

        /** @var Device $resource */
        $resource = $this->getResourceToTest($clientMock);
        $actual = $resource->getBeacon($deviceMac);

        $expected = new Beacon();
        $expected->setUuid('56c94a8d-9424-4d9c-9a2f-54fc81995f86');
        $expected->setId('56c94a8d-9424-4d9c-9a2f-54fc81995f86:123:456');
        $expected->setMac($deviceMac);
        $expected->setMajor(123);
        $expected->setMinor(456);
        $expected->setName('testing');
        $expectedSettings = new Beacon\Settings();
        $expectedSettings->setBroadcastingScheme(Beacon\Settings::BROADCASTING_SCHEME_ESTIMOTE);
        $expectedSettings->setInterval(200);
        $expectedSettings->setRange(4);
        $expectedSettings->setPower(4);
        $expected->setSettings($expectedSettings);

        self::assertEquals($expected, $actual);
    }
}
