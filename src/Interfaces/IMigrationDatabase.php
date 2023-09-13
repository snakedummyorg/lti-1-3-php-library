<?php

namespace Packback\Lti1p3\Interfaces;

use Packback\Lti1p3\Lti1p1Installation;
use Packback\Lti1p3\LtiDeployment;

/**
 * This is an optional interface if an LTI 1.3 tool supports migrations
 * from LTI 1.1 compatible installations.
 *
 * To use this, just have whatever class you create that implements IDatabase
 * also implement this interface.
 */
interface IMigrationDatabase
{
    /**
     * Using the $launchData from
     * a 1.3 launch attempt, determine if you have a matching 1.1 install and return
     * it from this method.
     */
    public function getMatchingLti1p1Install(array $launchData): ?Lti1p1Installation;

    /**
     * This method should create a 1.3 deployment in your DB based on the $launchData.
     * Previous to this, we validated the oauth_consumer_key_sign to ensure this migration
     * can safely occur.
     */
    public function migrateFromLti1p1(array $launchData): LtiDeployment;
}
