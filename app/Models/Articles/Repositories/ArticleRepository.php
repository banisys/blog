<?php

namespace App\Models\Articles\Repositories;




use App\Models\Articles\Article;
use Jsdecena\Baserepo\BaseRepository;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{

    protected $model;

    public function __construct(Article $article)
    {
        parent::__construct($article);
        $this->model = $article;
    }



}
