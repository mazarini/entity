<?php

/*
 * Copyright (C) 2024 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/entity.
 *
 * mazarini/entity is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/entity is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Tests\Entity;

use App\Entity\Article;
use Mazarini\Entity\Entity\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    private \ReflectionProperty $idProperty;
    private Entity $entity;

    protected function setup(): void
    {
        $reflectionClass = new \ReflectionClass(Entity::class);
        $this->idProperty = $reflectionClass->getProperty('id');
        $this->entity = new Entity();
    }

    public function testNew(): void
    {
        $this->assertTrue($this->entity->isNew());
        $this->assertSame(0, $this->entity->getId());
        $this->assertSame('entity-0', $this->entity->getEntityId());
    }

    public function testExisting(): void
    {
        $id = 1;
        $this->setId($id);
        $this->assertFalse($this->entity->isNew());
        $this->assertSame($id, $this->entity->getId());
    }

    public function testEntityId(): void
    {
        $id = 1;
        $this->setId($id);
        $this->assertSame('entity-'.$id, $this->entity->getEntityId());
    }

    public function testAddChild(): void
    {
        $this->assertSame($this->entity, $this->entity->addChild(null));
    }

    public function testAddChildException(): void
    {
        $this->expectException(\LogicException::class);
        $this->entity->addChild(new Article());
    }

    private function setId(int $id): void
    {
        $this->idProperty->setValue($this->entity, $id);
    }
}
