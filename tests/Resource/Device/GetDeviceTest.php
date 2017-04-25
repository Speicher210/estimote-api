<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Test\Resource\Device;

use Speicher210\Estimote\Model\Device\Settings\Advertisers;
use Speicher210\Estimote\Model\Device\Settings\Advertisers\EddystoneUrl;
use Speicher210\Estimote\Model\Device\Settings\Advertisers\IBeacon;
use Speicher210\Estimote\Resource\Device;
use Speicher210\Estimote\Test\Resource\AbstractResourceTest;

class GetDeviceTest extends AbstractResourceTest
{
    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest(): string
    {
        return Device::class;
    }

    public function testGetDevice(): void
    {
        $deviceIdentifier = '40b53f0f65a40b6f18c91e6f16ff802d';

        $clientMock = $this->getClientMock(['get']);
        $responseMock = $this->getClientResponseMock($this->getTestFixture('.json'), 200);

        $clientMock
            ->expects(self::once())
            ->method('get')
            ->with('/v2/devices/' . $deviceIdentifier)
            ->willReturn($responseMock);

        /** @var Device $resource */
        $resource = $this->getResourceToTest($clientMock);
        $actual = $resource->getDevice($deviceIdentifier);

        self::assertInstanceOf(\Speicher210\Estimote\Model\Device::class, $actual);
        self::assertSame($deviceIdentifier, $actual->identifier());
        self::assertTrue($actual->settings()->general()->isMotionDetectionEnabled());
        self::assertCount(0, $actual->settings()->general()->ndcRecords());
        self::assertInstanceOf(Advertisers::class, $actual->settings()->advertisers());

        self::assertNotNull($actual->settings()->advertisers()->ibeacon());
        self::assertInstanceOf(IBeacon::class, $actual->settings()->advertisers()->ibeacon());
        self::assertSame('iBeacon', $actual->settings()->advertisers()->ibeacon()->name());
        self::assertTrue($actual->settings()->advertisers()->ibeacon()->isEnabled());
        self::assertSame('B36C37A3-875F-4E56-9905-1F8BDC815E03', $actual->settings()->advertisers()->ibeacon()->uuid());
        self::assertSame(45581, $actual->settings()->advertisers()->ibeacon()->major());
        self::assertSame(23491, $actual->settings()->advertisers()->ibeacon()->minor());
        self::assertSame(-4, $actual->settings()->advertisers()->ibeacon()->power());
        self::assertSame(645, $actual->settings()->advertisers()->ibeacon()->interval());
        self::assertTrue($actual->settings()->advertisers()->ibeacon()->nonStrictModeEnabled());

        self::assertNotNull($actual->settings()->advertisers()->eddystoneUrl());
        self::assertInstanceOf(EddystoneUrl::class, $actual->settings()->advertisers()->eddystoneUrl());
        self::assertSame('Eddystone URL', $actual->settings()->advertisers()->eddystoneUrl()->name());
        self::assertTrue($actual->settings()->advertisers()->eddystoneUrl()->isEnabled());
        self::assertSame(-20, $actual->settings()->advertisers()->eddystoneUrl()->power());
        self::assertSame('http://e4a90fb1a9c8.com', $actual->settings()->advertisers()->eddystoneUrl()->url());
    }
}
