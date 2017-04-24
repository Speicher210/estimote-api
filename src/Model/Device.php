<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Estimote\Model\Device\PendingSettings;
use Speicher210\Estimote\Model\Device\Settings;

/**
 * Model representing a device.
 */
class Device
{
    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("identifier")
     */
    private $identifier;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("color")
     */
    private $color;

    /**
     * @var Settings
     *
     * @JMS\Type("Speicher210\Estimote\Model\Device\Settings")
     * @JMS\SerializedName("settings")
     */
    private $settings;

    /**
     * @var PendingSettings
     *
     * @JMS\Type("Speicher210\Estimote\Model\Device\PendingSettings")
     * @JMS\SerializedName("pending_settings")
     */
    private $pendingSettings;

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function color(): string
    {
        return $this->color;
    }

    public function settings(): Settings
    {
        return $this->settings;
    }

    public function pendingSettings(): ?PendingSettings
    {
        return $this->pendingSettings;
    }
}
