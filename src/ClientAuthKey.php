<?php

namespace Speicher210\Estimote;

use GuzzleHttp\Client;
use function GuzzleHttp\default_user_agent;

class ClientAuthKey extends Client
{
    /**
     * Constructor.
     *
     * @param string $authKey The API key.
     */
    public function __construct($authKey)
    {
        parent::__construct(
            [
                'base_uri' => 'https://cloud.estimote.com/v1/',
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$authKey,
                    'User-Agent' => 'Speicher210/Estimote '.default_user_agent(),
                ],
            ]
        );
    }
}
