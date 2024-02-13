<?php

namespace Tests;

use Mockery;
use Packback\Lti1p3\Interfaces\ILtiRegistration;
use Packback\Lti1p3\Interfaces\ILtiServiceConnector;
use Packback\Lti1p3\LtiCourseGroupsService;

class LtiCourseGroupsServiceTest extends TestCase
{
    private $connector;
    private $registration;
    public function setUp(): void
    {
        $this->connector = Mockery::mock(ILtiServiceConnector::class);
        $this->registration = Mockery::mock(ILtiRegistration::class);
    }

    public function testItInstantiates()
    {
        $service = new LtiCourseGroupsService($this->connector, $this->registration, []);

        $this->assertInstanceOf(LtiCourseGroupsService::class, $service);
    }

    public function testItGetsScope()
    {
        $serviceData = [
            'scope' => ['asdf'],
        ];

        $service = new LtiCourseGroupsService($this->connector, $this->registration, $serviceData);

        $result = $service->getScope();

        $this->assertEquals($serviceData['scope'], $result);
    }

    public function testItGetsGroups()
    {
        $serviceData = [
            'context_groups_url' => 'https://example.com',
            'scope' => ['asdf'],
        ];

        $service = new LtiCourseGroupsService($this->connector, $this->registration, $serviceData);

        $expected = [
            'id' => 'testId',
        ];

        $this->connector->shouldReceive('getAll')
            ->once()->andReturn($expected);

        $result = $service->getGroups();

        $this->assertEquals($expected, $result);
    }

    public function testItGetsSets()
    {
        $serviceData = [
            'context_group_sets_url' => 'https://example.com',
            'scope' => ['asdf'],
        ];

        $service = new LtiCourseGroupsService($this->connector, $this->registration, $serviceData);

        $expected = [
            'id' => 'testId',
        ];

        $this->connector->shouldReceive('getAll')
            ->once()->andReturn($expected);

        $result = $service->getSets();

        $this->assertEquals($expected, $result);
    }

    public function testItGetGroupsBySet()
    {
        $serviceData = [
            'context_groups_url' => 'https://example.com',
            'context_group_sets_url' => 'https://example.com',
            'scope' => ['asdf'],
        ];

        $service = new LtiCourseGroupsService($this->connector, $this->registration, $serviceData);

        $groups = [
            [
                'id' => 'testId',
                'set_id' => 'testSetId',
            ],
            [
                'id' => 'testId2',
                'set_id' => 'testSetId',
            ],
            [
                'id' => 'testId3',
                'set_id' => 'testSetId2',
            ],
            [
                'id' => 'noSetId',
            ],
        ];
        $sets = [
            [
                'id' => 'testSetId',
            ],
            [
                'id' => 'testSetId2',
            ],
        ];

        $expected = [
            'testSetId' => [
                'id' => 'testSetId',
                'groups' => [
                    'testId' => [
                        'id' => 'testId',
                        'set_id' => 'testSetId',
                    ],
                    'testId2' => [
                        'id' => 'testId2',
                        'set_id' => 'testSetId',
                    ],
                ],
            ],
            'testSetId2' => [
                'id' => 'testSetId2',
                'groups' => [
                    'testId3' => [
                        'id' => 'testId3',
                        'set_id' => 'testSetId2',
                    ],
                ],
            ],
            'none' => [
                'name' => 'None',
                'id' => 'none',
                'groups' => [
                    'noSetId' => [
                        'id' => 'noSetId',
                    ],
                ],
            ],
        ];

        $this->connector->shouldReceive('getAll')
            ->once()->andReturn($groups);
        $this->connector->shouldReceive('getAll')
            ->once()->andReturn($sets);

        $result = $service->getGroupsBySet();

        $this->assertEquals($expected, $result);
    }

    public function testItGetsNoSetsForNoUrl()
    {
        $service = new LtiCourseGroupsService($this->connector, $this->registration, []);

        $result = $service->getSets();

        $this->assertEquals([], $result);
    }
}
