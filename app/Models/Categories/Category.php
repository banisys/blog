<?php

namespace App\Models\Categories;

use App\Models\Articles\Article;
use App\Models\Videos\Video;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = ['id' , 'name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class,'category_video');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
