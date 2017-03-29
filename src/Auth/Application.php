<?php

declare(strict_types = 1);

namespace Speicher210\Estimote\Auth;

class Application
{
    /**
     * The application ID.
     *
     * @var string
     */
    protected $id;

    /**
     * The application token.
     *
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

    /**
     * Get the application ID.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the application token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
