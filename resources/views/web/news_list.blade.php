<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">新聞列表</li>
                    </ol>

                </nav>
            </div>


            <div class="col-md-12 col-lg-12 p-4">

                @foreach ($All_news as $news)
                <div class="row justify-content-between shadow">

                    <div class="col-sm-12 col-md-12 col-lg-3 pt-2">
                        <div class="row justify-content-center">
                            <a href="{{route('web.news', $news->id)}}" class="m-3"><img class="img-fluid mx-auto " src="{{URL('storage/uploads/news/' . $news->picture)}}" style="width: 200px;"></a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-9">
                        <div class="row justify-content-center px-3">
                            <h5 class="mt-4">{{$news->title}}</h5>
                            <small class="col-md-12"><?php echo substr($news->content, 0, 130); ?></small>

                        </div>
                        <div class="col-lg-12">
                            <div class="row justify-content-end m-3">
                                <a href="{{route('web.news', $news->id)}}" class="btn btn-sm btn-dark" style="font-size: 14px;">繼續閱讀</a>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>

            <div class="row justify-content-center mt-3">
                {{$All_news->links()}}
            </div>


        </div>

    </div>


    @include('web.layouts.footer')

</body>

</html>