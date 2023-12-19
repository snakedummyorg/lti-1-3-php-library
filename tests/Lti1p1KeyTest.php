<?php

namespace Tests;

use Packback\Lti1p3\Lti1p1Key;

class Lti1p1KeyTest extends TestCase
{
    public function setUp(): void
    {
        $this->key = new Lti1p1Key();
    }

    public function testItInstantiates()
    {
        $this->assertInstanceOf(Lti1p1Key::class, $this->key);
    }

    public function testItGetsKey()
    {
        $result = $this->key->getKey();

        $this->assertNull($result);
    }

    public function testItSetsKey()
    {
        $expected = 'expected';

        $this->key->setKey($expected);

        $this->assertEquals($expected, $this->key->getKey());
    }

    public function testItGetsSecret()
    {
        $result = $this->key->getSecret();

        $this->assertNull($result);
    }

    public function testItSetsSecret()
    {
        $expected = 'expected';

        $this->key->setSecret($expected);

        $this->assertEquals($expected, $this->key->getSecret());
    }
}
