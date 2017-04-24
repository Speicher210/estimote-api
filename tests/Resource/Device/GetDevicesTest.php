<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Test\Resource\Device;

use Speicher210\Estimote\Resource\Device;
use Speicher210\Estimote\Test\Resource\AbstractResourceTest;

class GetDevicesTest extends AbstractResourceTest
{
    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest(): string
    {
        return Device::class;
    }

    public function testGetDevices(): void
    {
        $clientMock = $this->getClientMock(['get']);
        $responseMock = $this->getClientResponseMock($this->getTestFixture('.json'), 200);

        $clientMock
            ->expects(self::once())
            ->method('get')
            ->with('/v2/devices')
            ->willReturn($responseMock);

        /** @var Device $resource */
        $resource = $this->getResourceToTest($clientMock);
        $actualDevices = $resource->getDevices();

        self::assertCount(1, $actualDevices);
        $actual = $actualDevices[0];

        self::assertSame('48947e17d20c44cfcc0174618fa06337', $actual->identifier());
        self::assertSame('lemon', $actual->color());
        self::assertFalse($actual->settings()->general()->isMotionDetectionEnabled());
        self::assertCount(1, $actual->settings()->general()->ndcRecords());
        self::assertNotNull($actual->settings()->advertisers()->ibeacon());
        self::assertSame('iBeacon', $actual->settings()->advertisers()->ibeacon()->name());
        self::assertTrue($actual->settings()->advertisers()->ibeacon()->isEnabled());
        self::assertSame('B9407F30-F5F8-466E-AFF9-25556B57FE6D', $actual->settings()->advertisers()->ibeacon()->uuid());
        self::assertSame(7244, $actual->settings()->advertisers()->ibeacon()->major());
        self::assertSame(16283, $actual->settings()->advertisers()->ibeacon()->minor());
        self::assertSame(-12, $actual->settings()->advertisers()->ibeacon()->power());
        self::assertSame(950, $actual->settings()->advertisers()->ibeacon()->interval());

        self::assertNotNull($actual->settings()->advertisers()->eddystoneUrl());
        self::assertSame('Eddystone URL', $actual->settings()->advertisers()->eddystoneUrl()->name());
        self::assertTrue($actual->settings()->advertisers()->eddystoneUrl()->isEnabled());
        self::assertSame(-16, $actual->settings()->advertisers()->eddystoneUrl()->power());
        self::assertSame('http://example.com/', $actual->settings()->advertisers()->eddystoneUrl()->url());
    }
}
