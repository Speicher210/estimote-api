<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device\PendingSettings\Advertisers;

use JMS\Serializer\Annotation as JMS;

final class EddystoneUrl
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("index")
     */
    private $index;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    private $name;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("enabled")
     */
    private $enabled;

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
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("url")
     */
    private $url;

    public function __construct(int $index, ?string $name, ?bool $enabled, ?int $power, ?int $interval, ?string $url)
    {
        $this->index = $index;
        $this->name = $name;
        $this->enabled = $enabled;
        $this->power = $power;
        $this->interval = $interval;
        $this->url = $url;
    }

    public function index(): int
    {
        return $this->index;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function power(): ?int
    {
        return $this->power;
    }

    public function interval(): ?int
    {
        return $this->interval;
    }

    public function url(): ?string
    {
        return $this->url;
    }
}
