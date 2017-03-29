<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Beacon;

use JMS\Serializer\Annotation as JMS;

/**
 * Beacon settings.
 */
class Settings
{
    const BROADCASTING_SCHEME_IBEACON = 'ibeacon';
    const BROADCASTING_SCHEME_ESTIMOTE = 'estimote';

    /**
     * Broadcasting interval.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("interval")
     */
    protected $interval;

    /**
     * Broadcasting scheme.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("broadcasting_scheme")
     */
    protected $broadcastingScheme;

    /**
     * Range.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("range")
     */
    protected $range;

    /**
     * Power.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("power")
     */
    protected $power;

    /**
     * Get broadcasting the interval.
     *
     * @return integer
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set the broadcasting interval
     *
     * @param integer $interval The interval.
     * @return Settings
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get the broadcasting scheme.
     *
     * @return string
     */
    public function getBroadcastingScheme()
    {
        return $this->broadcastingScheme;
    }

    /**
     * Set the broadcasting scheme.
     *
     * @param string $broadcastingScheme The scheme.
     * @return Settings
     */
    public function setBroadcastingScheme($broadcastingScheme)
    {
        $this->broadcastingScheme = $broadcastingScheme;

        return $this;
    }

    /**
     * Get the range.
     *
     * @return integer
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Set the range.
     *
     * @param integer $range The range to set.
     * @return Settings
     */
    public function setRange($range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * Get the power.
     *
     * @return integer
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set the power.
     *
     * @param integer $power The power.
     * @return Settings
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }
}
