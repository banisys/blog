@extends('layout')

@section('content')
    <div class="container">
        <h4 style="padding-bottom:10px;border-bottom: 2px solid rgba(115,115,115,0.31);margin-bottom: 20px;color: grey">جدیدترین مقالات</h4>
        <div class="row">

            @for ($x = 0; $x < 3; $x++)
                <div class="col-md-4" style="margin-bottom:25px">
                    <div class="card">
                        <img class="card-img-top" src="https://placeimg.com/640/480/tech/grayscale"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a
                                        href="{{ route('article.show' , ['article' => $articles[$x]->slug ]) }}">{{ $articles[$x]->title }}</a>
                            </h5>
                            <p class="card-text"
                               style="line-height:25px;color: #5c5c5c">{!! Str::limit($articles[$x]->body,90) !!}</p>
                            <a href="{{ route('article.show' , ['article' => $articles[$x]->slug ]) }}"
                               style="display: block"
                               class="btn btn-primary btn-sm">ادامه
                                مطلب </a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="container">
        <h4 style="padding-bottom:10px;border-bottom: 2px solid rgba(115,115,115,0.31);margin-bottom:20px;margin-top: 30px;color: grey">جدیدترین فیلم های آموزشی</h4>
        <div class="row">
            @for ($x = 0; $x < 3; $x++)
                <div class="col-md-4" style="margin-bottom:25px">
                    <div class="card">
                        <img class="card-img-top" src="https://placeimg.com/640/480/tech/grayscale"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a
                                        href="{{ route('video.show' , ['article' => $videos[$x]->slug ]) }}">{{ $videos[$x]->title }}</a>
                            </h5>
                            <p class="card-text"
                               style="line-height:25px;color: #5c5c5c">{!! Str::limit($videos[$x]->body,90) !!}</p>
                            <a href="{{ route('video.show' , ['video' => $videos[$x]->slug ]) }}"
                               style="display: block"
                               class="btn btn-primary btn-sm">ادامه
                                مطلب </a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

@endsection