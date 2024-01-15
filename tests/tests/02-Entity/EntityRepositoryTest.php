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
use Mazarini\Entity\Test\DoctrineTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * EntityRepositoryTest.
 */
class EntityRepositoryTest extends KernelTestCase
{
    use DoctrineTrait;
    protected ArticleRepository $articleRepository;

    protected function setup(): void
    {
        $articleRepository = static::getEntityManager()->getRepository(Article::class);
        if ($articleRepository instanceof ArticleRepository) {
            $this->articleRepository = $articleRepository;
        }
        $this->removeEntities($this->articleRepository);
    }

    public function testGetNew(): void
    {
        $article = $this->articleRepository->getNew();
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testCount(): void
    {
        $this->assertSame(0, $this->countEntities($this->articleRepository));
        $article = $this->articleRepository->getNew()->setLabel('label article');
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
        $this->assertSame(1, $this->countEntities($this->articleRepository));
        $this->removeEntities($this->articleRepository);
        $this->assertSame(0, $this->countEntities($this->articleRepository));
    }
}
