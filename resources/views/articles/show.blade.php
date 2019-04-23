@extends('layout')
@section('content')
    <link href="/css/comment.css" rel="stylesheet" type="text/css">

    <div id="app">
        <a class="btn btn-sm btn-success" href="{{ route('article.edit' , ['article' => $article->slug ]) }}"
           style="float: left;margin-top: 10px">ویرایش</a>
        <h2 style="margin-bottom: 20px">{{ $article->title }}</h2>

        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-bottom:25px">
                    <div class="card">
                        <img class="card-img-top" src="/2.jfif"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('article.show' , ['article' => $article->slug ]) }}">{{ $article->title }}</a>
                            </h5>
                            <p class="card-text" style="line-height:30px;color: #5c5c5c">{!! $article->body !!}</p>
                            <hr>
                            <p class="lead" style="margin-right:10px">
                                <span style="font-size: 16px">ارسال شده توسط :</span>
                                <a href="index.php "
                                   style="display: inline-block;font-size: 16px">{{ $article->user->name }}</a>
                                <span style="font-size: 13px;color: grey">-{{  $article->created_at }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
        <comment article="{{ $article->id}}"></comment>

    </div>
@endsection
