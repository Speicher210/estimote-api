<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Estimote\Model\Beacon\Settings;

/**
 * Model representing a device.
 */
class Beacon
{
    const DEVICE_TYPE_BEACON = 'BEACON';
    const DEVICE_TYPE_CLOUD_BEACON = 'CLOUD_BEACON';

    /**
     * Beacon ID.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("id")
     */
    protected $id;

    /**
     * UUID.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("uuid")
     */
    protected $uuid;

    /**
     * Major.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("major")
     */
    protected $major;

    /**
     * Minor.
     *
     * @var integer
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("minor")
     */
    protected $minor;

    /**
     * MAC address of the beacon.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("mac")
     */
    protected $mac;

    /**
     * Device name.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    protected $name;

    /**
     * Beacon settings.
     *
     * @var Settings
     *
     * @JMS\Type("Speicher210\Estimote\Model\Beacon\Settings")
     * @JMS\SerializedName("settings")
     */
    protected $settings;

    /**
     * Get the ID.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID.
     *
     * @param string $id The ID.
     * @return Beacon
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the UUID.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the UUID.
     *
     * @param string $uuid The UUID to set.
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Get the major.
     *
     * @return integer
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * Set the major.
     *
     * @param integer $major The major.
     * @return Beacon
     */
    public function setMajor($major)
    {
        $this->major = $major;

        return $this;
    }

    /**
     * Get the minor.
     *
     * @return integer
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * Set the minor.
     *
     * @param integer $minor The minor.
     * @return Beacon
     */
    public function setMinor($minor)
    {
        $this->minor = $minor;

        return $this;
    }

    /**
     * Get the MAC.
     *
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set the MAC.
     *
     * @param string $mac The mac.
     * @return Beacon
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name.
     *
     * @param string $name The name.
     * @return Beacon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the beacon settings.
     *
     * @return Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set the beacon settings.
     *
     * @param Settings $settings The settings.
     */
    public function setSettings(Settings $settings)
    {
        $this->settings = $settings;
    }
}
