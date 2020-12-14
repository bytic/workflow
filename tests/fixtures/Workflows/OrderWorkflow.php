<?php

namespace ByTIC\Workflow\Tests\Fixtures\Workflows;

use ByTIC\Workflow\Base\ObjectWorkflow;
use ByTIC\Workflow\Base\Place;
use ByTIC\Workflow\Base\Transition;

/**
 * Class OrderWorkflow
 * @package ByTIC\Workflow\Tests\Fixtures\Workflows
 */
class OrderWorkflow extends ObjectWorkflow
{
    public const STATE_OPEN = 'open';
    public const STATE_CONFIRMED = 'confirmed';
    public const STATE_CANCELED = 'canceled';

    public const TRANSITION_CONFIRM_ORDER = 'confirmOrder';
    public const TRANSITION_CANCEL_ORDER = 'cancelOrder';

    protected function generatePlaces(): array
    {
        return [
            Place::make(self::STATE_OPEN),
            Place::make(self::STATE_CONFIRMED),
            Place::make(self::STATE_CANCELED),
        ];
    }

    protected function generateTransitions(): array
    {
        return [
            Transition::make(
                self::TRANSITION_CONFIRM_ORDER,
                self::STATE_OPEN,
                self::STATE_CONFIRMED
            ),

            Transition::make(
                self::TRANSITION_CANCEL_ORDER,
                [self::STATE_OPEN, self::STATE_CONFIRMED],
                self::STATE_CANCELED
            )
        ];
    }
}
