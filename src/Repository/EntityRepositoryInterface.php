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

namespace Mazarini\Entity\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Persistence\ObjectRepository;
use Mazarini\Entity\Entity\EntityInterface;

/**
 * EntityRepositoryInterface.
 *
 * @extends ObjectRepository <EntityInterface>
 */
interface EntityRepositoryInterface extends ObjectRepository, ServiceEntityRepositoryInterface, \Countable
{
    public function getNew(): EntityInterface;

    /**
     * count.
     *
     * @param array<string,mixed> $criterias
     */
    public function count(array $criterias = []): int;
}
