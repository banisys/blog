<?php

namespace App\Exceptions;

use Exception;
use http\Env\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class my extends Exception
{
    public function render($request)
    {
        return new JsonResource(['a'=>'b']);
    }
}
