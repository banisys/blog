<?php

namespace App\Http\Controllers;

use App\Models\Categories\Category;

class CategoryController extends Controller
{
    public function index1(Category $category)
    {
        $articles = $category->articles()->paginate(10);

        return view('articles.index' , compact('articles'));
    }

    public function all()
    {
        $categories = Category::all();
        $categories = $categories->chunk(round($categories->count() / 2));
        return $categories;
    }

    public function index()
    {
        $data = Category::paginate(1);
        return response()->json($data);
    }
}
