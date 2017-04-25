<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device\PendingSettings;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\EddystoneUrl;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\IBeacon;

final class Advertisers
{
    /**
     * @var IBeacon[]
     *
     * @JMS\Type("array<Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\IBeacon>")
     * @JMS\SerializedName("ibeacon")
     */
    private $ibeacon = [];

    /**
     * @var EddystoneUrl[]
     *
     * @JMS\Type("array<Speicher210\Estimote\Model\Device\PendingSettings\Advertisers\EddystoneUrl>")
     * @JMS\SerializedName("eddystone_url")
     */
    private $eddystoneUrl = [];

    public function __construct(?IBeacon $ibeacon, ?EddystoneUrl $eddystoneUrl)
    {
        if ($ibeacon !== null) {
            $this->ibeacon = [$ibeacon];
        }

        if ($eddystoneUrl !== null) {
            $this->eddystoneUrl = [$eddystoneUrl];
        }
    }

    public function ibeacon(): ?IBeacon
    {
        return $this->ibeacon[0] ?? null;
    }

    public function eddystoneUrl(): ?EddystoneUrl
    {
        return $this->eddystoneUrl[0] ?? null;
    }
}
