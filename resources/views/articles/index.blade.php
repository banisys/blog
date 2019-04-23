@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
        @foreach( $articles as $article )
                <div class="col-md-4" style="margin-bottom:25px">
                    <div class="card">
                        <img class="card-img-top" src="/1.jfif" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a
                                        href="{{ route('article.show' , ['article' => $article->slug ]) }}">{{ $article->title }}</a>
                            </h5>
                            <p class="card-text" style="line-height:25px;color: #5c5c5c">{!! Str::limit($article->body,90) !!}</p>
                            <a href="{{ route('article.show' , ['article' => $article->slug ]) }}" style="display: block"
                               class="btn btn-primary btn-sm">ادامه
                                مطلب </a>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
    <div style="text-align:center;">
        {!! $articles->render() !!}
    </div>
@endsection