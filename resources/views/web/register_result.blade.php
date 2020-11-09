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


            <div class="row m-4 p-4 col-md-6 col-lg-5 justify-content-center bg-light">

                <div class="form-row justify-content-center my-4">
                    @if (session()->has('register_success'))
                    <h3 class="mb-4">{{session()->get('register_success')}}</h3>
                    <p class="text-center">您可前往產品頁面瀏覽商品。</p>
                    <p><a href="{{route('web.store')}}">前往購物</a></p>
                    @elseif (session()->has('email_exist'))
                    <h3 class="mb-4">註冊失敗</h3>
                    <p class="text-center">{{session()->get('email_exist')}}</p>
                    <p><a href="{{route('web.user.register_page')}}">回註冊頁面</a></p>
                    @elseif (session()->has('register_error'))
                    <h3 class="mb-4">註冊失敗</h3>
                    <p class="text-center">{{session()->get('register_error')}}</p>
                    <p><a href="{{route('web.user.register_page')}}">回註冊頁面</a></p>
                    @else
                    <p class="text-center">您可前往產品頁面瀏覽商品。</p>
                    <p><a href="{{route('web.store')}}">前往購物</a></p>
                    @endif
                </div>

            </div>

        </div>

    </div>

    @include('web.layouts.footer')

</body>

</html>