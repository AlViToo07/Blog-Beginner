<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function posts()
    {
        $search = request('search');
        $articles = Article::with('tags', 'category')
            ->latest()
            ->filter($search)
            ->take(10)
            ->get();

        return response()->json($articles);
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function categoryArticle(Category $category)
    {
        $articles = $category->articles()->with('tags')->take(10)->get();
        return response()->json($articles);
    }
}