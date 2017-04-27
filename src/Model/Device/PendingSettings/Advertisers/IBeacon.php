<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device\PendingSettings\Advertisers;

use JMS\Serializer\Annotation as JMS;

final class IBeacon
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("index")
     */
    private $index;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("enabled")
     */
    private $enabled;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("uuid")
     */
    private $uuid;

    /**
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("major")
     */
    private $major;

    /**
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("minor")
     */
    private $minor;

    /**
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("power")
     */
    private $power;

    /**
     * Broadcasting interval.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("interval")
     */
    private $interval;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("non_strict_mode_enabled")
     */
    private $nonStrictModeEnabled;

    public function __construct(
        int $index,
        ?bool $enabled,
        ?string $uuid,
        ?int $major,
        ?int $minor,
        ?int $power,
        ?int $interval,
        ?bool $nonStrictModeEnabled
    ) {
        $this->index = $index;
        $this->enabled = $enabled;
        $this->uuid = $uuid;
        $this->major = $major;
        $this->minor = $minor;
        $this->power = $power;
        $this->interval = $interval;
        $this->nonStrictModeEnabled = $nonStrictModeEnabled;
    }

    public function index(): int
    {
        return $this->index;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function uuid(): ?string
    {
        return $this->uuid;
    }

    public function major(): ?int
    {
        return $this->major;
    }

    public function minor(): ?int
    {
        return $this->minor;
    }

    public function power(): ?int
    {
        return $this->power;
    }

    public function interval(): ?int
    {
        return $this->interval;
    }

    public function nonStrictModeEnabled(): ?bool
    {
        return $this->nonStrictModeEnabled;
    }
}
