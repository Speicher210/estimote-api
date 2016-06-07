<?php

namespace Speicher210\Estimote;

use GuzzleHttp\Client;
use Speicher210\Estimote\Auth\Application;
use function GuzzleHttp\default_user_agent;

class ClientAppAuth extends Client
{
    /**
     * Constructor.
     *
     * @param Application $authorization The application authorization.
     */
    public function __construct(Application $authorization)
    {
        parent::__construct(
            [
                'base_uri' => 'https://cloud.estimote.com/v1/',
                'auth' => [$authorization->getId(), $authorization->getToken()],
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'Speicher210/Estimote '.default_user_agent(),
                ],
            ]
        );
    }
}
