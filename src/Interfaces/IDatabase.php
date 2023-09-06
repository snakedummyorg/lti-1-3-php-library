<?php

namespace Packback\Lti1p3\Interfaces;

use Packback\Lti1p3\LtiDepoyment;
use Packback\Lti1p3\LtiRegistration;

interface IDatabase
{
    public function findRegistrationByIssuer($iss, $clientId = null): ?LtiRegistration;

    public function findDeployment($iss, $deploymentId, $clientId = null): ?LtiDepoyment;

    public function hasMatchingLti11Key(string $oauthConsumerKeySign): bool;

    public function migrateFromLti11(array $launchData);
}
