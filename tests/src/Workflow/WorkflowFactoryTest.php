<?php

namespace ByTIC\Workflow\Tests\Workflow;

use ByTIC\Workflow\Tests\AbstractTest;
use ByTIC\Workflow\Workflow\WorkflowFactory;
use Symfony\Component\Workflow\Workflow;

/**
 * Class WorkflowFactoryTest
 * @package ByTIC\Workflow\Tests\Loader
 */
class WorkflowFactoryTest extends AbstractTest
{
    public function test_from()
    {
        $data = require TEST_FIXTURE_PATH . '/config/workflow.php';
        $workflow = WorkflowFactory::from($data['workflows']['straight']);
        self::assertInstanceOf(Workflow::class, $workflow);

        $places = $workflow->getDefinition()->getPlaces();
        self::assertCount(3, $places);

        $transitions = $workflow->getDefinition()->getTransitions();
        self::assertCount(2, $transitions);
    }
}
