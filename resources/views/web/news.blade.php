<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

    <style>
        img {
            width: 100%;
        }
    </style>
</head>

<body>

    @include('web.layouts.navbar')

    <div class="container my-3">
        <div class="row justify-content-center ">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item"><a href="{{route('web.news_list')}}">新聞列表</a></li>
                        <li class="breadcrumb-item active" aria-current="page">新聞</li>
                    </ol>

                </nav>
            </div>

            <div class="m-3 p-3 pt-0 col-md-12 col-lg-12 bg-light" style="max-width:1110px;">
                <div class="row p-3">

                    <small class="mb-3"><i class="fa fa-calendar-check-o mr-1" aria-hidden="true"></i>{{$news[0]->created_at}}</small>
                    <h5 class="col-lg-10">{{$news[0]->title}}</h5>
                    <hr class="col-lg-11">
                    <p class="col-lg-10"><?php echo $news[0]->content; ?></p>

                </div>

                <div class="row justify-content-start">
                    <a href="{{route('web.news_list')}}" class="btn btn-dark btn-sm ml-3">返回</a>
                </div>

                <hr class="col-lg-11">

            </div>

        </div>

    </div>

    @include('web.layouts.footer')

</body>

</html>