<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Models\Articles\Article;
use App\Models\Comments\Comment;
use App\Models\Users\User;
use App\Models\Videos\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store_article(Article $article ,Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);

        $article->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $request['body'],
            'parent_id'=>$request['parent_id'],
        ]);

        return response()->json(['success'=>'Done!']);
    }

    public function store_video(Video $video)
    {
        $this->validate(request() , [
            'body' => 'required|min:5'
        ]);

        $video->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => request('body')
        ]);

        return back();
    }

    public function index($article)
    {
        $comments = Comment::where('commentable_id', $article)->whereNull('parent_id')->get();

        $commentsData = [];
        foreach ($comments as $key) {
            $user = User::find($key->user_id);
            $name = $user->name;
            $replies = $this->replies($key->id);

            array_push($commentsData, [
                "replies" => $replies,
                "name" => $name,
                "commentid" => $key->id,
                "comment" => $key->body,
                "date" => $key->created_at
            ]);
        }

        return collect($commentsData);
    }

    protected function replies($commentId)
    {
        $comments = Comment::where('parent_id', $commentId)->get();
        $replies = [];
        foreach ($comments as $key) {
            $user = User::find($key->user_id);
            $name = $user->name;

            array_push($replies, [
                "name" => $name,
                "commentid" => $key->id,
                "comment" => $key->body,
                "date" => $key->created_at
            ]);
        }
        return collect($replies);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',

        ]);
        $comment = Comment::create($request->all());
        $comment = Comment::where('id', $comment->id)->with('user')->first();
        broadcast(new NewComment($comment))->toOthers();
        return ["status" => "true", "commentId" => $comment->id,"date" => $comment->created_at];
    }

    public function destroy(Comment $comment)
    {
        Comment::where('parent_id',$comment->id)->delete();
        $comment->delete();

        return response( null,204);
    }

}
