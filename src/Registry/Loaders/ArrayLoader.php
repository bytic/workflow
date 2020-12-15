<?php

namespace ByTIC\Workflow\Registry\Loaders;

use ByTIC\Workflow\Registry;
use ByTIC\Workflow\SupportStrategy\MultipleInstanceOfSupportStrategy;
use ByTIC\Workflow\Workflow\WorkflowFactory;
use Symfony\Component\Workflow\SupportStrategy\WorkflowSupportStrategyInterface;

/**
 * Class ArrayLoader
 * @package ByTIC\Workflow\Loader
 */
class ArrayLoader
{
    /**
     * @param Registry $registry
     * @param array $data
     */
    public static function load(Registry $registry, array $data)
    {
        if (!isset($data['workflows']) || !is_array($data['workflows'])) {
            return;
        }

        foreach ($data['workflows'] as $name => $workflowData) {
            static::addWorkflow($registry, $name, $workflowData);
        }
    }

    /**
     * @param $registry
     * @param $name
     * @param $workflowData
     */
    protected static function addWorkflow($registry, $name, $workflowData)
    {
        if (!isset($workflowData['supports']) || !is_array($workflowData['supports'])) {
            throw new \InvalidArgumentException(
                "Workflow definition for {$name} must define the supports attribute as a valid array"
            );
        }
        $workflowData['name'] = $name;

        $registry->addWorkflow(
            WorkflowFactory::from($workflowData),
            static::buildStrategy($workflowData['supports'])
        );
    }

    /**
     * @param $data
     * @return WorkflowSupportStrategyInterface
     */
    protected static function buildStrategy($data): WorkflowSupportStrategyInterface
    {
        return new MultipleInstanceOfSupportStrategy($data);
    }
}
