<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Article::published()->latest('published_at');

        // Filter by search term
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'like', "%{$searchTerm}%");
            });
        }

        $articles = $query->paginate(12);

        // Get categories for filter
        $categories = Article::published()
                            ->distinct()
                            ->pluck('category')
                            ->filter()
                            ->sort();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // Check if article is published
        if (!$article->is_published ||
            !$article->published_at ||
            $article->published_at->isFuture()) {
            abort(404);
        }

        // Get related articles
        $relatedArticles = Article::published()
                                 ->where('id', '!=', $article->id)
                                 ->where('category', $article->category)
                                 ->latest('published_at')
                                 ->take(3)
                                 ->get();

        // If no related articles in same category, get latest articles
        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::published()
                                     ->where('id', '!=', $article->id)
                                     ->latest('published_at')
                                     ->take(3)
                                     ->get();
        }

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Display articles by category.
     *
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function category($category)
    {
        $articles = Article::published()
                          ->where('category', $category)
                          ->latest('published_at')
                          ->paginate(12);

        return view('articles.category', compact('articles', 'category'));
    }

    /**
     * Display articles by tag.
     *
     * @param  string  $tag
     * @return \Illuminate\Http\Response
     */
    public function tag($tag)
    {
        $articles = Article::published()
                          ->whereJsonContains('tags', $tag)
                          ->latest('published_at')
                          ->paginate(12);

        return view('articles.tag', compact('articles', 'tag'));
    }

    /**
     * Search articles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q');

        $articles = Article::published()
                          ->where(function ($query) use ($searchTerm) {
                              $query->where('title', 'like', "%{$searchTerm}%")
                                    ->orWhere('content', 'like', "%{$searchTerm}%")
                                    ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                                    ->orWhere('category', 'like', "%{$searchTerm}%");
                          })
                          ->latest('published_at')
                          ->paginate(12);

        return view('articles.search', compact('articles', 'searchTerm'));
    }
}
