<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Beacon;

use JMS\Serializer\Annotation as JMS;

/**
 * Update data for a beacon.
 */
class Update
{
    /**
     * UUID.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("uuid")
     */
    public $uuid;

    /**
     * Major.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("major")
     */
    public $major;

    /**
     * Minor.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("minor")
     */
    public $minor;

    /**
     * Advertising interval in ms (100 - 2000).
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("interval")
     */
    public $interval;

    /**
     * Beacon's transmitted output power (one of: -30, -20, -16, -12, -8, -4, 0, 4).
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("power")
     */
    public $power;

    /**
     * True if Basic Power mode should be enabled, false otherwise.
     *
     * @var boolean
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("basic_power_mode")
     */
    public $basicPowerMode;

    /**
     * True if Smart Power mode should be enabled, false otherwise.
     *
     * @var boolean
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("smart_power_mode")
     */
    public $smartPowerMode;

    /**
     * True if rotating ID should be enabled.
     *
     * @var boolean
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("security")
     */
    public $security;
}
