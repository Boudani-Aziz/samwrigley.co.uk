<?php

namespace App;

use App\Article;
use App\Model;
use App\Traits\BelongsToManyArticles;
use App\Traits\HasPublishableRelationship;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticleCategory extends Model
{
    use BelongsToManyArticles;
    use HasPublishableRelationship;

    public array $routeNamespaces = [
        'web' => 'blog.categories.',
        'admin' => 'admin.blog.categories.',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 9;

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class)
            ->withTimestamps()
            ->latest('published_at');
    }
}
