<?php

namespace Packback\Lti1p3\Interfaces;

/** @internal */
interface ILtiRegistration
{
    public function getIssuer();

    public function setIssuer(string $issuer): self;

    public function getClientId();

    public function setClientId(string $clientId): self;

    public function getKeySetUrl();

    public function setKeySetUrl(string $keySetUrl): self;

    public function getAuthTokenUrl();

    public function setAuthTokenUrl(string $authTokenUrl): self;

    public function getAuthLoginUrl();

    public function setAuthLoginUrl(string $authLoginUrl): self;

    public function getAuthServer();

    public function setAuthServer(string $authServer): self;

    public function getToolPrivateKey();

    public function setToolPrivateKey(string $toolPrivateKey): self;

    public function getKid();

    public function setKid(string $kid): self;
}
