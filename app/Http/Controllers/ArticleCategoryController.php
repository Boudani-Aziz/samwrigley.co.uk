<?php

namespace App\Http\Controllers;

use App\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ArticleCategoryController extends Controller
{
    /**
     * The route namespace.
     *
     * @var string
     */
    protected $namespace = 'categories.';

    public function index(): View
    {
        $categories = ArticleCategory::has('articles')->get();

        return view($this->namespace . 'index')
            ->with('categories', $categories);
    }

    public function show(string $slug): View
    {
        $category = ArticleCategory::has('articles')
            ->whereSlug($slug)
            ->withArticles()
            ->firstOrFail();

        $categories = ArticleCategory::has('articles')->get();

        $articles = $category->articles()
            ->published()
            ->paginate(10);

        return view($this->namespace . 'show')
            ->with([
                'category' => $category,
                'categories' => $categories,
                'articles' => $articles,
            ]);
    }
}
