@extends('layouts.default')

@section('content')
    <article class="pt-20">
        <header class="relative mx-auto max-w-4xl mb-16">
            @include('partials.articles.outOfDate')

            @if ($article->categories && $article->categories->count())
                <ul class="mb-4 text-sm uppercase tracking-widest">
                    @foreach ($article->categories as $category)
                        <li class="leading-none">
                            <a href="{{ $category->showPath() }}"
                                title="@lang("Read all articles in $category->name")"
                                aria-label="@lang("Read all articles in $category->name")"
                                class="block text-gray-600 hover:text-gray-900"
                            >
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <h1 class="mb-4 text-6xl font-black leading-tight">
                <a href="{{ $article->showPath() }}"
                    aria-label="@lang("Read: $article->title")"
                    title="@lang("Read: $article->title")"
                >
                    {{ $article->title }}
                </a>
            </h1>

            @if ($article->published_at)
                <time datetime="{{ $article->published_at }}"
                    aria-label="@lang('Posted On')"
                    class="block mb-10 text-xl text-gray-600 leading-none"
                    title="{{ $article->published_at }}"
                >
                    @date($article->published_at)
                </time>
            @endif

            @include('partials.articles.author')
            @include('partials.articles.inSeries')
        </header>

        <div class="mx-auto max-w-4xl mb-32">
            @yield('body')
        </div>

        <footer class="flex border border-black">
            @include('partials.articles.info')
            @include('partials.articles.newsletter')
        </footer>
    </article>
@endsection
