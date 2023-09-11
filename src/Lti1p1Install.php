<?php

namespace Packback\Lti1p3;

class Lti1p1Installation
{
    private string $oauth_consumer_key;
    private string $oauth_consumer_secret;

    public static function new()
    {
        return new Lti1p1Installation();
    }

    public function computeOauthConsumerKeySign (array $lti1p3LaunchData): string
    {
        
    }

    public function getOauthConsumerKey()
    {
        return $this->oauth_consumer_key;
    }

    public function setOauthConsumerKey($oauth_consumer_key)
    {
        $this->oauth_consumer_key = $oauth_consumer_key;
        return $this;
    }

    public function getOauthConsumerSecret()
    {
        return $this->oauth_consumer_secret;
    }
    
    public function setOauthConsumerSecret($oauth_consumer_secret)
    {
        $this->oauth_consumer_secret = $oauth_consumer_secret;
        return $this;
    }
}