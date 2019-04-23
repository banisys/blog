@extends('layout')

@section('content')
<style>
    .filter-option{text-align: right !important;}
</style>

    @include('layouts.errors')

    <form action="{{ route('video.store') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">عنوان فیلم آموزشی : </label>
            <input type="text" name="title" class="form-control" id="title" placeholder="لطفا عنوان را وارد کنید ..." value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="category">دسته بندی ها : </label>
            <select name="category[]" class="form-control" id="category" title=" دسته بندی مورد نظر خود را انتخاب کنید..." multiple>
                @foreach( $categories as $id => $name )
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">متن مقاله :</label>
            <textarea class="form-control" name="body" id="body" placeholder="متن را وارد کنید" rows="7">{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="float: left">ارسال مقاله</button>
    </form>

@endsection

@section('styles')
    <link href="/css/bootstrap-select.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="/js/bootstrap-select.min.js"></script>

    <script>
        $('#category').selectpicker();
    </script>
@endsection