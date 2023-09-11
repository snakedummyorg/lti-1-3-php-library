<?php

namespace Packback\Lti1p3\Interfaces;

use Packback\Lti1p3\Lti1p1Installation;
use Packback\Lti1p3\LtiDeployment;
use Packback\Lti1p3\LtiRegistration;

interface IDatabase
{
    public function findRegistrationByIssuer($iss, $clientId = null): ?LtiRegistration;

    public function findDeployment($iss, $deploymentId, $clientId = null): ?LtiDeployment;

    /**
     * A method to assist with 1.1 -> 1.3 migrations. If you don't support migrations
     * simply have this method return false.
     *
     * Otherwise, using the $launchData from
     * a 1.3 launch attempt, determine if you have a matching 1.1 install and return
     * it from this method.
     */
    public function getMatchingLti1p1Install(array $launchData): ?Lti1p1Installation;

    /**
     * Another method to assist with 1.1 -> 1.3 migrations. Simply have this method do nothing
     * if you don't support migrations.
     *
     * Otherwise, this method create a 1.3 deployment in your DB based on the $launchData.
     * Previous to this, we validated the oauth_consumer_key_sign to ensure this migration
     * can safely occur.
     */
    public function migrateFromLti1p1(array $launchData): void;
}
