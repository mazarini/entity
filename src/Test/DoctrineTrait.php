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

namespace Mazarini\Entity\Test;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ObjectManager;
use Mazarini\Entity\Repository\EntityRepositoryInterface;

trait DoctrineTrait
{
    private ObjectManager $entityManager;

    protected function getEntityManager(): ObjectManager
    {
        if (!isset($this->entityManager)) {
            $doctrine = $this->getContainer()->get('doctrine');
            if ($doctrine instanceof Registry) {
                $this->entityManager = $doctrine->getManager();
            }
        }
        if (isset($this->entityManager)) {
            return $this->entityManager;
        }
        throw new \LogicException('Doctrine not found in container');
    }

    protected function removeEntities(EntityRepositoryInterface $repository): void
    {
        foreach ($repository->findAll() as $entity) {
            //           $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->remove($entity);
        }
        $this->getEntityManager()->flush();
    }

    protected function countEntities(EntityRepositoryInterface $repository): int
    {
        return $repository->count([]);
    }
}
