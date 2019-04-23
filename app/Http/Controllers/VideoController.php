<?php

namespace App\Http\Controllers;


use App\Models\Categories\Category;
use App\Models\Categories\Repositories\CategoryRepositoryInterface;

use App\Models\Videos\Repositories\VideoRepositoryInterface;
use App\Models\Videos\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private $categoryRepo;
    private $videoRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        VideoRepositoryInterface $articleRepoRepository
    ) {
        $this->categoryRepo = $categoryRepository;
        $this->videoRepo = $articleRepoRepository;

    }

    public function index()
    {
        $videos = Video::latest()->paginate(10);

        return view('videos.index' , compact('videos'));
    }

    public function cat()
    {
        $categories = Category::all();
//        $categories = $categories->chunk(round($categories->count() / 2));
        return $categories;
    }

    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        ]);

        $video = auth()->user()->videos()->create(request(['title', 'body']));

        $video->categories()->attach(request('category'));

        session()->flash('message', 'مقاله شما با موفقیت ایجاد شد');

        return redirect('/');
    }

    public function show(Video $video)
    {
        $comments = $video->comments()->get();
        return view('videos.show', compact('video', 'comments'));
    }

    public function edit(Video $article)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Video $article)
    {
        $article->update(request(['title', 'body']));
        $article->categories()->sync(request('category'));

        return redirect('/');
    }

    public function articles()
    {
        return Video::with(['user','categories'])->latest()->get();
    }
}
