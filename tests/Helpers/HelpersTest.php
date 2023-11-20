<?php

namespace Tests\Helpers;

use Packback\Lti1p3\Helpers\Helpers;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function testItBuildsAUrlWithNoParams()
    {
        $expected = 'https://www.example.com';
        $actual = Helpers::buildUrlWithQueryParams($expected);

        $this->assertEquals($expected, $actual);
    }

    public function testItBuildsAUrlWithParams()
    {
        $baseUrl = 'https://www.example.com';
        $actual = Helpers::buildUrlWithQueryParams($baseUrl, ['foo' => 'bar']);

        $this->assertEquals('https://www.example.com?foo=bar', $actual);
    }

    public function testItBuildsAUrlWithExistingParams()
    {
        $baseUrl = 'https://www.example.com?baz=bat';
        $actual = Helpers::buildUrlWithQueryParams($baseUrl, ['foo' => 'bar']);

        $this->assertEquals('https://www.example.com?baz=bat&foo=bar', $actual);
    }
}
