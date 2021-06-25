<?php

declare(strict_types=1);

namespace LaminasTest\Hydrator\TestAsset;

use function get_object_vars;

class HydratorStrategyEntityA
{
    /** @var HydratorStrategyEntityB[] */
    public $entities; // public to make testing easier!

    public function __construct()
    {
        $this->entities = [];
    }

    public function addEntity(HydratorStrategyEntityB $entity): void
    {
        $this->entities[] = $entity;
    }

    /**
     * @return HydratorStrategyEntityB[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param HydratorStrategyEntityB[] $entities
     */
    public function setEntities($entities): void
    {
        $this->entities = $entities;
    }

    /**
     * Add the getArrayCopy method so we can test the ArraySerializable hydrator:
     *
     * @return array
     * @psalm-return array<string, mixed>
     */
    public function getArrayCopy(): array
    {
        return get_object_vars($this);
    }

    /**
     * Add the populate method so we can test the ArraySerializable hydrator:
     *
     * @param array $data
     * @psalm-param array<string, mixed> $data
     */
    public function populate($data): void
    {
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
    }
}
