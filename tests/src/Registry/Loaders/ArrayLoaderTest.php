<?php

namespace ByTIC\Workflow\Tests\Registry\Loaders;

use ByTIC\Workflow\Registry;
use ByTIC\Workflow\Tests\AbstractTest;
use ByTIC\Workflow\Tests\Fixtures\Models\Books\Book;
use stdClass;

/**
 * Class ArrayLoaderTest
 * @package ByTIC\Workflow\Tests\Registry\Loaders
 */
class ArrayLoaderTest extends AbstractTest
{
    public function test_load()
    {
        $data = require TEST_FIXTURE_PATH . '/config/workflow.php';
        $registry = new Registry();
        Registry\Loaders\ArrayLoader::load($registry, $data);

        $subject = new stdClass();
        $workflows = $registry->all($subject);
        self::assertCount(2, $workflows);

        $subject = new Book();
        $workflows = $registry->all($subject);
        self::assertCount(1, $workflows);
    }
}
