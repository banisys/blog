<?php

namespace App\Models\Comments;

use App\Models\Users\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'body','commentable_type','commentable_id','parent_id',
        'comment','reply_id','page_id','users_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

//    public function replies()
//    {
//        return $this->hasMany(Comment::class, 'parent_id');
//    }

    public function getCreatedAtAttribute($value)
    {
        return Verta::instance($value)->format(' %d %B ، %Y ');
    }
}
