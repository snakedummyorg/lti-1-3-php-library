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

    public function computeOauthConsumerKeySign(array $lti1p3LaunchData): string
    {
        $clientId = is_array($lti1p3LaunchData['aud']) ? $lti1p3LaunchData['aud'][0] : $lti1p3LaunchData['aud'];
        $issuerUrl = $lti1p3LaunchData['iss'];
        $exp = $lti1p3LaunchData['exp'];
        $nonce = $lti1p3LaunchData['nonce'];

        // Create signature
        $baseString = "{$this->getOauthConsumerKey()}&\
            {$lti1p3LaunchData[LtiConstants::DEPLOYMENT_ID]}&\
            {$issuerUrl}&\
            {$clientId}&\
            {$exp}&\
            {$nonce}";

        return base64_encode(hash_hmac('sha256', $baseString, $this->getOauthConsumerSecret(), true));
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
