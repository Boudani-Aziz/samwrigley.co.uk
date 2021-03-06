<?php

use App\Article;
use App\ArticleCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ArticleCategory::class, function (Faker $faker) {
    $name = $faker->unique()->words(2, true);

    return [
        'slug' => Str::slug($name),
        'name' => ucfirst($name),
        'description' => $faker->paragraph,
    ];
});

$factory->afterCreatingState(ArticleCategory::class, 'withArticle', function (ArticleCategory $category): void {
    $category->articles()->save(
        factory(Article::class)->state('published')->make()
    );
});
