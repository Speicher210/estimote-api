<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Estimote\Model\Device\PendingSettings\Advertisers;

final class PendingSettings
{
    /**
     * @var Advertisers
     *
     * @JMS\Type("Speicher210\Estimote\Model\Device\PendingSettings\Advertisers")
     * @JMS\SerializedName("advertisers")
     */
    private $advertisers;

    public function __construct(?Advertisers $advertisers)
    {
        $this->advertisers = $advertisers;
    }

    public function advertisers(): ?Advertisers
    {
        return $this->advertisers;
    }
}
