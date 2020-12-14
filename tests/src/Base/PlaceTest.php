<?php

namespace ByTIC\Workflow\Tests\Base;

use ByTIC\Workflow\Base\Place;
use ByTIC\Workflow\Tests\AbstractTest;

/**
 * Class PlaceTest
 * @package ByTIC\Workflow\Tests\Base
 */
class PlaceTest extends AbstractTest
{
    public function test_make()
    {
        $place = Place::make('open');

        self::assertInstanceOf(Place::class, $place);
        self::assertSame('open', $place->getName());
    }

    public function test_toString()
    {
        $place = Place::make('open');
        self::assertEquals('open', $place);
    }
}
