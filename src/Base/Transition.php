<?php

namespace ByTIC\Workflow\Base;

/**
 * Class Transition
 * @package ByTIC\Workflow\Base
 */
class Transition extends \Symfony\Component\Workflow\Transition
{
    /**
     * @param string $name
     * @param $froms
     * @param $tos
     * @return Transition
     */
    public static function make(string $name, $froms, $tos): Transition
    {
        return new static( $name, $froms, $tos);
    }

    /**
     * @param array $data
     * @return Transition
     */
    public static function fromArray(array $data): Transition
    {
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException("Transition needs a name attribute defined");
        }
        $name = $data['name'];

        foreach (['from','to'] as $key) {
            if (!isset($data[$key])) {
                throw new \InvalidArgumentException("Transition {$name} needs {$key} attribute defined");
            }
        }
        return new static( $name, $data['from'], $data['to']);
    }
}
