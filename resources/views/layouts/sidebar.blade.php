<br>
@inject('categories', 'App\Http\Controllers\ArticleController')
<div class="well">
    <h4 style="margin-bottom:15px">دسته بندی بلاگ</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled"  style="margin-right:15px">
                @foreach( $categories->cat() as $category )
                    <li style="margin-bottom: 10px">
                        <a href="{{ route('categories' , ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
