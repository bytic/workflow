<?php

namespace ByTIC\Workflow\SupportStrategy;

use Symfony\Component\Workflow\SupportStrategy\WorkflowSupportStrategyInterface;
use Symfony\Component\Workflow\WorkflowInterface;

/**
 * Class MultipleInstanceOfSupportStrategy
 * @package ByTIC\Workflow\SupportStrategy
 */
class MultipleInstanceOfSupportStrategy implements WorkflowSupportStrategyInterface
{
    protected $classNames;

    /**
     * MultipleInstanceOfSupportStrategy constructor.
     * @param $classNames
     */
    public function __construct($classNames)
    {
        $this->classNames = (array) $classNames;
    }

    public function supports(WorkflowInterface $workflow, object $subject): bool
    {
        foreach ($this->classNames as $className) {
            if ($subject instanceof $className) {
                return true;
            }
        }
        return false;
    }
}
