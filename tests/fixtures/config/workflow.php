<?php

use ByTIC\Workflow\Tests\Fixtures\Models\Books\Book;

return [
    'workflows' => [
        'straight' => [
            'type' => 'state_machine',
            'marking_store' => [
                'type' => 'single_state',
            ],
            'supports' => ['stdClass'],
            'places' => ['a', 'b', 'c'],
            'transitions' => [
                't1' => [
                    'from' => 'a',
                    'to' => 'b',
                ],
                't2' => [
                    'from' => 'b',
                    'to' => 'c',
                ]
            ],
        ],
        'multiple' => [
            'type' => 'state_machine',
            'marking_store' => [
                'type' => 'single_state',
            ],
            'supports' => [Book::class, 'stdClass'],
            'places' => ['a', 'b', 'c'],
            'transitions' => [
                't1' => [
                    'from' => 'a',
                    'to' => 'b',
                ],
                't2' => [
                    'from' => 'b',
                    'to' => 'c',
                ]
            ],
        ]
    ]
];
