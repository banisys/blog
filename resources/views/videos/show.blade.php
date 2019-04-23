@extends('layout')
@section('content')
    <h2 style="margin-bottom: 20px">{{ $video->title }}</h2>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-bottom:25px">
                <div class="card">
                    <img class="card-img-top" src="https://placeimg.com/1100/400/tech/grayscale" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><a
                                    href="{{ route('article.show' , ['article' => $video->slug ]) }}">{{ $video->title }}</a>
                        </h5>
                        <p class="card-text" style="line-height:30px;color: #5c5c5c">{!! $video->body !!}</p>
                        <hr>
                        <p class="lead" style="margin-right:10px">
                            <span style="font-size: 16px">ارسال شده توسط :</span>
                            <a href="index.php " style="display: inline-block;font-size: 16px">{{ $video->user->name }}</a>
                            <span style="font-size: 13px;color: grey">-{{  $video->created_at }}</span>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="well">
        @include('layouts.errors')

        @if(auth()->check())
            <h5 style="color: #636363">نظر خود را ارسال کنید :</h5>
            <hr>
            <form role="form" action="{{ route('comment.video.store' , ['video' => $video->slug ]) }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <textarea placeholder="متن پیام" class="form-control" name="body" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="float: left">ارسال</button>
            </form>
        @else
            <a href="/register">برای ارسال کامنت حتما باید عضو وبسایت باشید</a>
        @endif
    </div>
    <br>
    <br>


    <hr>
    @foreach($comments as $comment)
        <div class="media" style="margin-bottom: 50px">
            <div class="media-body">
                <h4 class="media-heading" style="display: inline-block">{{ $comment->user->name }}

                </h4><br>
                <small style="display: inline-block">{{ $comment->created_at}}</small><br>
                {{ $comment->body }}
            </div>
        </div>
    @endforeach
@endsection