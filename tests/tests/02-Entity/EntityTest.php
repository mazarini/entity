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
use Mazarini\Test\Test\ReflectionTestCase;

class EntityTest extends ReflectionTestCase
{
    private Entity $entity;

    protected function setup(): void
    {
        $this->entity = new Entity();
    }

    public function testNew(): void
    {
        $this->assertTrue($this->entity->isNew());
        $this->assertSame(0, $this->entity->getId());
    }

    public function testExisting(): void
    {
        $id = 1;
        $this->setProperty($this->entity, 'id', $id);
        $this->assertFalse($this->entity->isNew());
        $this->assertSame($id, $this->entity->getId());
    }

    public function testEntityId(): void
    {
        $this->assertSame('entity-0', $this->entity->getEntityId());
        $id = 1;
        $this->setProperty($this->entity, 'id', $id);
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
}
