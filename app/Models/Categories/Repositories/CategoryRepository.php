<?php

namespace App\Models\Categories\Repositories;



use App\Models\Categories\Category;
use Jsdecena\Baserepo\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    protected $model;

    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->model = $category;
    }


}