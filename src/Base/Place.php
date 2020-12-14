<?php

namespace ByTIC\Workflow\Base;

/**
 * Class Place
 * @package ByTIC\Workflow\Base
 */
class Place implements \Stringable
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name): Place
    {
        return new static($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            $this->name => [
                'metadata' => $this->metadata()
            ]
        ];
    }

    public function metadata(): array
    {
        return [
            'title' => $this->label,
            'color' => $this->color,
            'dueIn' => $this->dueIn
        ];
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
