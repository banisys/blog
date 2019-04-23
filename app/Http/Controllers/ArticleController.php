<?php

namespace App\Http\Controllers;

use App\Exceptions\my;
use App\Models\Articles\Article;
use App\Models\Articles\Repositories\ArticleRepositoryInterface;
use App\Models\Categories\Category;
use App\Models\Categories\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $categoryRepo;
    private $articleRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ArticleRepositoryInterface $articleRepoRepository
    ) {
        $this->categoryRepo = $categoryRepository;
        $this->articleRepo = $articleRepoRepository;

    }

    public function index()
    {
        $articles = Article::latest()->paginate(10);

        return view('articles.index' , compact('articles'));
    }

    public function cat()
    {
        $categories = Category::all();
//        $categories = $categories->chunk(round($categories->count() / 2));
        return $categories;
    }

    public function create()
    {
        $categories = $this->categoryRepo->all()->pluck('name', 'id');
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        ]);

        $article = auth()->user()->articles()->create(request(['title', 'body']));

        $article->categories()->attach(request('category'));

        session()->flash('message', 'مقاله شما با موفقیت ایجاد شد');

        return redirect('/');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Article $article)
    {
        $article->update(request(['title', 'body']));
        $article->categories()->sync(request('category'));

        return redirect('/');
    }

    public function articles()
    {
        return Article::with(['user','categories'])->latest()->get();
    }


}
