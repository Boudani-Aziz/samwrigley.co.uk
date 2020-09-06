<?php

namespace App\Http\Requests;

use App\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ArticleRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'article';

    public function rules(): array
    {
        $article = $this->route('article');
        $articleId = optional($article)->id;
        $maxTitleLength = Article::MAX_TITLE_LENGTH;
        $maxSlugLength = Article::MAX_SLUG_LENGTH;
        $maxExcerptLength = Article::MAX_EXCERPT_LENGTH;
        $publishedDateFormat = Article::$PUBLISHED_DATE_FORMAT;
        $publishedTimeFormat = Article::$PUBLISHED_TIME_FORMAT;

        return [
            'title' => [
                'required',
                'string',
                "max:{$maxTitleLength}",
                Rule::unique('articles')->ignore($articleId),
            ],
            'slug' => [
                'required',
                'alpha_dash',
                "max:{$maxSlugLength}",
                Rule::unique('articles')->ignore($articleId),
            ],
            'excerpt' => [
                'nullable',
                'string',
                "max:{$maxExcerptLength}",
            ],
            'body' => [
                'required',
                'string',
            ],
            'date' => [
                'nullable',
                "date_format:{$publishedDateFormat}",
                'required_with:time',
            ],
            'time' => [
                'nullable',
                "date_format:{$publishedTimeFormat}",
                'required_with:date',
            ],
            'categories' => [
                'nullable',
                'array',
            ],
            'series' => [
                'nullable',
                'string',
                'exists:article_series,id',
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if ($validator->passes()) {
            $this->addPublishedAt();
            $this->removeEmptyCategories();
        }
    }

    protected function addPublishedAt(): void
    {
        $publishedAt = $this->filled(['date', 'time'])
            ? Carbon::parse("{$this->date} {$this->time}")
            : null;

        $this->request->add(['published_at' => $publishedAt]);
    }

    protected function removeEmptyCategories(): void
    {
        $categories = $this->categories ?: [];

        foreach ($categories as $key => $value) {
            if (empty($value)) {
                unset($categories[$key]);
            }
        }

        $this->categories = $categories;
    }
}
