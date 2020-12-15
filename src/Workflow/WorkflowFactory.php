<?php

namespace ByTIC\Workflow\Workflow;

use ByTIC\Workflow\Base\Place;
use ByTIC\Workflow\Base\Transition;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\Workflow;

/**
 * Class WorkflowFactory
 * @package ByTIC\Workflow\Workflow
 */
class WorkflowFactory
{
    /**
     * @param array $data
     * @return Workflow
     */
    public static function from(array $data): Workflow
    {
        $definitionBuilder = new DefinitionBuilder(
            static::buildPlaces($data),
            static::buildTransitions($data)
        );

        $definition = $definitionBuilder->build();

        return new Workflow(
            $definition,
            static::buildStore($data),
            null,
            (isset($data['name']) ? $data['name'] : '')
        );
    }

    /**
     * @param array $data
     * @return Place[]
     */
    protected static function buildPlaces(array $data): array
    {
        if (!isset($data['places'])) {
            return [];
        }
        $return = [];
        foreach ($data['places'] as $place) {
            $return[] = Place::make($place);
        }
        return $return;
    }

    /**
     * @param array $data
     * @return array
     */
    protected static function buildTransitions(array $data): array
    {
        if (!isset($data['transitions'])) {
            return [];
        }

        $return = [];
        foreach ($data['transitions'] as $name => $info) {
            $info['name'] = $name;
            $return[] = Transition::fromArray($info);
        }
        return $return;
    }

    protected static function buildStore(array $data): MethodMarkingStore
    {
        $marking = new MethodMarkingStore(true, 'state');
        return $marking;
    }
}
