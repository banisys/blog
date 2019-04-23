<style>
    li{padding-left:35px}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 1px solid #d6d6d6 ">
                <a href="/">
                    <i class="fas fa-home" style="font-size:21px;vertical-align: bottom;color: grey"></i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav" >
                        <li class="nav-item" style="margin-top: 10px">
                            <a class="nav-link" href="{{route('articles')}}">مقالات آموزشی</a>
                        </li>

                    </ul>

                </div>
                @if(Auth::check())
                    <div class="nav navbar-left" style="margin-top: 15px">
                        <form action="{{ route('logout') }}" method="post">
                            {!! csrf_field() !!}
                            <button class="btn btn-primary">خروج</button>
                        </form>
                    </div>
                @else
                    <ul class="nav navbar-left">
                        <li>
                            <a class="btn btn-primary" href="/login">ورود</a>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="/register">عضویت</a>
                        </li>
                    </ul>
                @endif
            </nav>
        </div>
    </div>
</div>
