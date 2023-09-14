<?php

namespace Packback\Lti1p3;

class Lti1p1Key
{
    private $key;
    private $secret;

    public function __construct(array $key = null)
    {
        $this->key = $key['key'] ?? null;
        $this->secret = $key['secret'] ?? null;
    }

    public static function new()
    {
        return new Lti1p1Key();
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey(array $key)
    {
        $this->key = $key;

        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret(array $secret)
    {
        $this->secret = $secret;

        return $this;
    }
}
