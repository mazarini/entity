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
use App\Repository\ArticleRepository;
use Mazarini\Test\Test\DoctrineTestCase;

/**
 * EntityRepositoryTest.
 */
class EntityRepositoryTest extends DoctrineTestCase
{
    protected ArticleRepository $articleRepository;

    protected function setup(): void
    {
        $articleRepository = $this->getRepository(Article::class);
        if ($articleRepository instanceof ArticleRepository) {
            $this->articleRepository = $articleRepository;
            $this->removeEntities($this->articleRepository);
        }
    }

    public function testSetup(): void
    {
        $this->assertTrue(isset($this->articleRepository));
    }

    public function testGetNew(): void
    {
        $article = $this->articleRepository->getNew();
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testCount(): void
    {
        $this->assertCount(0, $this->articleRepository);
        $this->createEntities($this->articleRepository, 1);
        $this->assertCount(1, $this->articleRepository);
        $this->removeEntities($this->articleRepository);
        $this->assertCount(0, $this->articleRepository);
    }

    /**
     * createEntity.
     *
     * @param ArticleRepository $objectRepository
     *
     * @return Article
     */
    protected function createEntity(\Doctrine\Persistence\ObjectRepository $objectRepository, int $i): object
    {
        return $objectRepository->getNew()->setLabel(sprintf('Label %s', $i));
    }
}
