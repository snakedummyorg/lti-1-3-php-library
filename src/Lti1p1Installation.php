<?php

namespace Packback\Lti1p3;

class Lti1p1Installation
{
    private ?array $oauth_consumer_keys;
    private ?array $oauth_consumer_secrets;

    public static function new()
    {
        return new Lti1p1Installation();
    }

    public function compareOauthConsumerKeySign(array $lti1p3LaunchData, string $signature): bool
    {
        $clientId = is_array($lti1p3LaunchData['aud']) ? $lti1p3LaunchData['aud'][0] : $lti1p3LaunchData['aud'];
        $issuerUrl = $lti1p3LaunchData['iss'];
        $exp = $lti1p3LaunchData['exp'];
        $nonce = $lti1p3LaunchData['nonce'];

        $keys = $this->getOauthConsumerKeys();
        $secrets = $this->getOauthConsumerSecrets();

        for ($i = 0; $i < count($keys); $i++) {

            $key = $keys[$i];
            $secret = $secrets[$i];

            // Create signature
            $baseString = "{$key}&" .
                "{$lti1p3LaunchData[LtiConstants::DEPLOYMENT_ID]}&" .
                "{$issuerUrl}&" .
                "{$clientId}&" .
                "{$exp}&" .
                "{$nonce}";
    
            if (base64_encode(hash_hmac('sha256', mb_convert_encoding($baseString, 'utf8', mb_detect_encoding($baseString)), $secret, true)) === $signature) {
                return true;
            }
        }

        return false;
    }

    public function getOauthConsumerKeys()
    {
        return $this->oauth_consumer_keys;
    }

    public function setOauthConsumerKeys(array $oauth_consumer_keys)
    {
        $this->oauth_consumer_keys = $oauth_consumer_keys;

        return $this;
    }

    public function getOauthConsumerSecrets()
    {
        return $this->oauth_consumer_secrets;
    }

    public function setOauthConsumerSecrets(array $oauth_consumer_secrets)
    {
        $this->oauth_consumer_secrets = $oauth_consumer_secrets;

        return $this;
    }
}
