<?php

namespace Tests;

use Packback\Lti1p3\ServiceRequest;

class ServiceRequestTest extends TestCase
{
    private $method = ServiceRequest::METHOD_GET;
    private $url = 'https://example.com';
    private $type = ServiceRequest::TYPE_AUTH;
    private $request;

    public function setUp(): void
    {
        $this->request = new ServiceRequest($this->method, $this->url, $this->type);
    }

    public function testItInstantiates()
    {
        $this->assertInstanceOf(ServiceRequest::class, $this->request);
    }

    public function testItGetsUrl()
    {
        $result = $this->request->getUrl();

        $this->assertEquals($this->url, $result);
    }

    public function testItSetsUrl()
    {
        $expected = 'http://example.com/foo/bar';

        $this->request->setUrl($expected);

        $this->assertEquals($expected, $this->request->getUrl());
    }

    public function testItGetsPayload()
    {
        $expected = [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        $this->assertEquals($expected, $this->request->getPayload());
    }

    public function testItSetsAccessToken()
    {
        $expected = [
            'headers' => [
                'Authorization' => 'Bearer foo-bar',
                'Accept' => 'application/json',
            ],
        ];

        $this->request->setAccessToken('foo-bar');

        $this->assertEquals($expected, $this->request->getPayload());
    }

    public function testItSetsContentType()
    {
        $expected = [
            'headers' => [
                'Content-Type' => 'foo-bar',
                'Accept' => 'application/json',
            ],
        ];

        $request = new ServiceRequest(ServiceRequest::METHOD_POST, $this->url, $this->type);
        $request->setContentType('foo-bar');

        $this->assertEquals($expected, $request->getPayload());
    }

    public function testItSetsBody()
    {
        $expected = [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'body' => 'foo-bar',
        ];

        $this->request->setBody('foo-bar');

        $this->assertEquals($expected, $this->request->getPayload());
    }

    public function testItGetsMaskResponseLogs()
    {
        $this->assertFalse($this->request->getMaskResponseLogs());
    }

    public function testItSetsMaskResponseLogs()
    {
        $this->request->setMaskResponseLogs(true);

        $this->assertTrue($this->request->getMaskResponseLogs());
    }

    public function testItGetsErrorPrefix()
    {
        $this->assertEquals('Authenticating:', $this->request->getErrorPrefix());
    }
}
