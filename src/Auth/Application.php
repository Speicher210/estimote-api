<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Auth;

class Application
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $token;

    /**
     * @param string $id The application ID.
     * @param string $token The application token.
     */
    public function __construct($id, $token)
    {
        $this->id = $id;
        $this->token = $token;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function token(): string
    {
        return $this->token;
    }
}
