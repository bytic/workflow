<?php

namespace ByTIC\Workflow\Tests\Base;

use ByTIC\Workflow\Base\Place;
use ByTIC\Workflow\Base\Transition;
use ByTIC\Workflow\Tests\AbstractTest;
use ByTIC\Workflow\Tests\Fixtures\Workflows\OrderWorkflow;
use Symfony\Component\Workflow\Workflow;

/**
 * Class WorkflowTest
 * @package ByTIC\Workflow\Tests\Base
 */
class WorkflowTest extends AbstractTest
{
    public function test_workflow()
    {
        $workflow = OrderWorkflow::workflow();
        self::assertInstanceOf(Workflow::class, $workflow);

        $definition = $workflow->getDefinition();

        $places = $definition->getPlaces();
        self::assertSame(
            [
                'open' => 'open',
                'confirmed' => 'confirmed',
                'canceled' => 'canceled',
            ],
            $places
        );

        $transitions = $definition->getTransitions();
        $transition = $transitions[1];
        self::assertInstanceOf(Transition::class, $transition);
        self::assertSame(['open', 'confirmed'], $transition->getFroms());
    }

    public function test_places()
    {
        $places = OrderWorkflow::places();

        self::assertIsArray($places);
        self::assertCount(3, $places);

        self::assertInstanceOf(Place::class, $places[0]);
        self::assertEquals(['open', 'confirmed', 'canceled'], $places);
    }

    public function test_transitions()
    {
        $transitions = OrderWorkflow::transitions();

        self::assertIsArray($transitions);
        self::assertCount(2, $transitions);

        self::assertInstanceOf(Transition::class, $transitions[0]);
    }
}
