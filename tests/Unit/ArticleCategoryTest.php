<?php

namespace Tests\Unit;

use App\Article;
use App\ArticleCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleCategoryTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_many_articles(): void
    {
        $articleCount = 2;
        $articles = factory(Article::class, $articleCount)->create();

        $articleCategory = factory(ArticleCategory::class)->create();
        $articleCategory->addArticles($articles);

        $this->assertCount($articleCount, $articleCategory->articles);
    }
}
