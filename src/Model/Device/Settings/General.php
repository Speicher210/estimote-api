<?php

declare(strict_types = 1);


namespace Speicher210\Estimote\Model\Device\Settings;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Estimote\Model\Device\Settings\General\NfcRecords;

final class General
{
    /**
     * @var boolean
     *
     * @JMS\Type("boolean")
     * @JMS\SerializedName("motion_detection_enabled")
     */
    private $motionDetectionEnabled;

    /**
     * @var NfcRecords[]
     *
     * @JMS\Type("array<Speicher210\Estimote\Model\Device\Settings\General\NfcRecords>")
     * @JMS\SerializedName("nfc_records")
     */
    private $nfcRecords;

    public function isMotionDetectionEnabled(): bool
    {
        return $this->motionDetectionEnabled;
    }

    /**
     * @return NfcRecords[]
     */
    public function ndcRecords(): array
    {
        return $this->nfcRecords;
    }
}
