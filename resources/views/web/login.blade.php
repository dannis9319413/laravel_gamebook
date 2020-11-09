<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav class="my-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">登入&註冊</li>
                    </ol>
                </nav>
            </div>

            <form class="row m-4 p-4 col-md-7 col-lg-5 justify-content-center bg-light" method="post" action="{{route('web.user.login')}}">
                @csrf
                <div class="form-row justify-content-center mb-3">

                    <h3 class="mb-4">會員登入</h3>
                    <div class="form-group col-12 ">
                        <input type="email" class="form-control" name="email" placeholder="請輸入Eamil">
                    </div>
                    <div class="form-group col-12">
                        <input type="password" class="form-control" name="password" placeholder="請輸入密碼">
                    </div>
                    @if (session()->has('login_error'))
                    <div class="alert alert-danger col-12" role="alert">
                        {{session()->get('login_error')}}
                    </div>
                    @endif
                    <button type="submit" class="btn btn-dark col-12">登入</button>

                </div>

                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div><a class="text-info col-md-12" href="{{route('web.user.register_page')}}">還沒註冊嗎?</a>
                        </div>
                        <div><a class="text-info col-md-12" href="{{route('admin.index')}}">管理員登入</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3 text-center">
                    <p>或者使用以下方法登入</p>
                    <a href="{{route('web.line_login')}}" style="text-decoration:none;">
                        <img class="mx-2" src="{{URL::asset('img/login/LINE.png')}}" alt="" style="max-width: 3rem;">
                    </a>
                    <a href="{{route('web.facebook_login')}}" style="text-decoration:none;">
                        <img class="" src="{{URL::asset('img/login/Facebook.png')}}" alt="" style="max-width: 4rem;">
                    </a>
                    <a href="{{route('web.google_login')}}" style="text-decoration:none;">
                        <img class="mx-1" src="{{URL::asset('img/login/Google.png')}}" alt="" style="max-width: 3.3rem;">
                    </a>
                </div>

            </form>



        </div>

    </div>
    @include('web.layouts.footer')

</body>

</html>