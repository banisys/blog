<?php

namespace App\Models\Videos\Repositories;

use App\Models\Videos\Video;
use Jsdecena\Baserepo\BaseRepository;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{

    protected $model;

    public function __construct(Video $video)
    {
        parent::__construct($video);
        $this->model = $video;
    }



}
