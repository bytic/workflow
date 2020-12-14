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
}
