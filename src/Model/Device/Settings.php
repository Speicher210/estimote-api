<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Estimote\Model\Device\Settings\Advertisers;
use Speicher210\Estimote\Model\Device\Settings\General;

/**
 * Device settings.
 */
final class Settings
{
    /**
     * @var Advertisers
     *
     * @JMS\Type("Speicher210\Estimote\Model\Device\Settings\Advertisers")
     * @JMS\SerializedName("advertisers")
     */
    private $advertisers;

    /**
     * @var General
     *
     * @JMS\Type("Speicher210\Estimote\Model\Device\Settings\General")
     * @JMS\SerializedName("general")
     */
    private $general;

    public function advertisers(): Advertisers
    {
        return $this->advertisers;
    }

    public function general(): General
    {
        return $this->general;
    }
}
