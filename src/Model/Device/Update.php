<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device;

use JMS\Serializer\Annotation as JMS;

/**
 * Update data for a device.
 */
class Update
{
    /**
     * @var PendingSettings
     *
     * @JMS\Type("Speicher210\Estimote\Model\Device\PendingSettings")
     * @JMS\SerializedName("pending_settings")
     */
    private $pendingSettings;

    public function __construct(?PendingSettings $pendingSettings)
    {
        $this->pendingSettings = $pendingSettings;
    }

    public function pendingSettings(): ?PendingSettings
    {
        return $this->pendingSettings;
    }
}
