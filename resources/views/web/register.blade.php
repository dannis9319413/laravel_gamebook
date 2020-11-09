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


            <form class="row m-4 p-4 col-md-6 col-lg-5 justify-content-center bg-light" method="post" action="{{route('web.user.register')}}">
                @csrf

                <div class="form-row justify-content-center mb-4">

                    <h3 class="mb-4">會員註冊</h3>

                    @if($errors->any())
                    <div class="alert alert-danger col-12">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <div class="form-group col-12 ">
                        <input type="email" class="form-control" name="email" placeholder="請輸入Eamil">
                    </div>

                    <div class="form-group col-12">
                        <input type="password" class="form-control" name="password" placeholder="請輸入密碼">
                    </div>

                    <div class="form-group col-12">
                        <input type="password" class="form-control" name="confirm_password" placeholder="再次輸入密碼">
                    </div>

                    <button type="submit" class="btn btn-dark col-12">註冊</button>

                </div>

                <p><a class="text-info" href="{{route('web.user.login_page')}}">已經註冊了?</a></p>

            </form>

        </div>

    </div>

    @include('web.layouts.footer')

</body>

</html>