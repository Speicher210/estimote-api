<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Model\Device\Settings\General;

use JMS\Serializer\Annotation as JMS;

final class NfcRecords
{
    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("data")
     */
    private $data;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("type")
     */
    private $type;

    public function data(): string
    {
        return $this->data;
    }

    public function type(): string
    {
        return $this->type;
    }
}
