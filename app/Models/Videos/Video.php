<?php

namespace App\Models\Videos;

use App\Models\Categories\Category;
use App\Models\Comments\Comment;
use App\Models\Users\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use Sluggable;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCreatedAtAttribute($value)
    {
        return Verta::instance($value)->format(' %d %B ، %Y ');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_video');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
