<?php

namespace ByTIC\Workflow\Base;

use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\Workflow;

/**
 * Class ObjectWorkflow
 * @package ByTIC\Workflow\Base
 */
abstract class ObjectWorkflow
{
    /**
     * @var null
     */
    protected $workflow = null;

    /**
     * @var null|Place[]
     */
    protected $places = null;

    /**
     * @var null|Transition[]
     */
    protected $transitions = null;

    abstract protected function generatePlaces(): array;

    abstract protected function generateTransitions(): array;

    public static function places(): array
    {
        return self::instance()->getPlaces();
    }

    public static function transitions(): array
    {
        return self::instance()->getTransitions();
    }

    public static function workflow(): Workflow
    {
        return self::instance()->getWorkflow();
    }

    /**
     * @return Place[]
     */
    public function getPlaces(): array
    {
        if ($this->places === null) {
            $this->places = $this->generatePlaces();
        }
        return $this->places;
    }

    /**
     * @return Transition[]|null
     */
    public function getTransitions(): array
    {
        if ($this->transitions === null) {
            $this->transitions = $this->generateTransitions();
        }
        return $this->transitions;
    }


    /**
     * @return Workflow
     */
    protected function getWorkflow(): Workflow
    {
        if ($this->workflow === null) {
            $this->workflow = $this->generateWorkflow();
        }
        return $this->workflow;
    }

    protected function generateWorkflow(): Workflow
    {
        $places = $this->getPlaces();
        $transitions = $this->getTransitions();

        $definitionBuilder = new DefinitionBuilder($places,$transitions);

        $definition = $definitionBuilder->build();

        $marking = new MethodMarkingStore(true, 'state');
        return new Workflow($definition, $marking);
    }

    /**
     * Singleton
     *
     * @return static
     */
    public static function instance(): self
    {
        static $instance;
        if (!($instance instanceof static)) {
            $instance = new static();
        }
        return $instance;
    }
}
