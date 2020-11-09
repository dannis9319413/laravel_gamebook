<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <!-- content -->
    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">完成訂單</li>
                    </ol>

                </nav>
            </div>

            <div class="my-4 col-md-10 col-lg-6">
                <div class="card text-center">
                    <div class="card-body row justify-content-center">
                        <img class="col-md-6" src="{{URL('img/gamebook.png')}}" alt="">

                        <small class="card-text my-3 col-md-8">您已成功完成購物，您可前往我的<a href="{{route('web.user.orders', session('user.id'))}}">訂單查詢</a>出貨進度或<a href="{{route('web.store')}}"> 繼續購物</a></small>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('web.layouts.footer')

</body>

</html>