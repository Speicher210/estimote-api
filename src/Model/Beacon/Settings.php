<?php

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
    protected $broadcasting_scheme;

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
}
