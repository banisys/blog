@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
        @foreach( $videos as $video )
                <div class="col-md-4" style="margin-bottom:25px">
                    <div class="card">
                        <img class="card-img-top" src="https://placeimg.com/640/480/tech/grayscale" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a
                                        href="{{ route('video.show' , ['video' => $video->slug ]) }}">{{ $video->title }}</a>
                            </h5>
                            <p class="card-text" style="line-height:25px;color: #5c5c5c">{!! Str::limit($video->body,90) !!}</p>
                            <a href="{{ route('video.show' , ['video' => $video->slug ]) }}" style="display: block"
                               class="btn btn-primary btn-sm">ادامه
                                مطلب </a>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
    <div style="text-align:center;">
        {!! $videos->render() !!}
    </div>
@endsection