<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <!-- banner  -->

    <div id="banner">
        <div class="p-0 container-fluid">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol> -->
                <div class="carousel-inner ">
                    @foreach($all_pres as $pre)
                    @if($pre->price == 1340)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{URL('storage/uploads/products/'. $pre->folder.'/'. $pre->header)}}" alt="" style="max-height: 93vh;">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="info">
                                <a class="btn btn-lg" href="{{route('web.product', $pre->id)}}">搶先預購</a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{URL('storage/uploads/products/'. $pre->folder.'/'. $pre->header)}}" alt="" style="max-height: 93vh;">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="info">
                                <a class="btn btn-lg" href="{{route('web.product', $pre->id)}}">搶先預購</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- banner End -->

            <!-- new flickity -->
            <div class="main mx-auto">
                @foreach($all_news as $new)
                <div class="cell bg-light">
                    <a href="{{route('web.product', $new->id)}}"> <img src="{{URL('storage/uploads/products/' . $new->folder .'/'. $new->header)}}" alt="" style="max-width: 15rem"></a>
                    <div>{{$new->name}}</div>
                    <div>NT$ {{$new->price}}</div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- new flickity end -->
    <!-- special -->
    <div id="special">
        <div class="container">

            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h3>特惠</h3>
                    <div class="col-md-12 d-flex justify-content-end "><a class="btn btn-sm btn-outline-dark" href="{{route('web.store.discount')}}">More</a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center d-flex flex-wrap">

                @foreach($all_specials as $special)
                <div class="card m-2 p-2 col-10 col-md-5 col-lg-3 col-xl-3">
                    <a href="{{route('web.product', $special->id)}}"><img class="card-img-top" src="{{URL('storage/uploads/products/'. $special->folder .'/',$special->header)}}" alt="Card image cap"></a>
                    <div class="row card-body justify-content-center">
                        <h5 class="card-text my-3 col-md-12">{{$special->name}}</h5>
                        <p class="text-right col-md-12"><del>NT$ {{ceil($special->price*1.5)}}</del></p>
                        <p class="text-right col-md-12">NT$ {{$special->price}}</p>
                        <a href="{{route('web.product', $special->id)}}"><button class="btn btn-dark btn-sm col-12 align-self-end">立即購買</button></a>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
    <!-- special End -->

    <!-- news -->
    <div id="news" class="py-3">
        <div class="container">
            <div class="row">

                <div class="col-md-12 my-3 text-center">
                    <h3>最新消息</h3>
                    <div class="col-md-12 d-flex justify-content-end d-inline"><a class="btn btn-sm btn-outline-dark" href="{{route('web.news_list')}}">More</a>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">

                    @foreach($All_news as $news)
                    <div class="row justify-content-between shadow my-3">

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
                                    <a href="{{route('web.news' , $news->id)}}" class="btn btn-sm btn-dark" style="font-size: 14px;">繼續閱讀</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div>

    <!-- news End -->

    <!-- partner -->
    <div id="partner" class="text-center py-3 my-4">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-md-8">
                    <h5 class=""><b>合作夥伴</b></h5>
                    <div class="row text-muted my-4 d-flex align-items-center justify-content-center flex-grow-1">
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-amazon fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-cc-paypal fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-github-alt fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-paypal fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-github fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-steam fa-2x"></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partner end -->

    <!-- feature -->
    <div id="feature" class="py-3 my-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5 class="text-center"><b>選擇我們的理由</b></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 p-3 col-6 col-md-6 col-sm-6"> <i class="d-block fa text-muted fa-cc-visa fa-3x"></i>
                    <h5 class="my-3"><b>付款</b></h5>
                    <small>超過10種以上付款方式</small>
                </div>
                <div class="col-lg-3 col-6 p-3 col-sm-6 col-md-6"> <i class="d-block fa fa-3x mb-2 text-muted fa-gamepad"></i>
                    <h5 class="my-3"> <b>遊戲</b></h5>
                    <small>大量遊戲正在等著你</small>
                </div>
                <div class="col-lg-3 col-6 p-3 col-sm-6 col-md-6"> <i class="d-block fa mb-2 text-muted fa-money fa-3x"></i>
                    <h5 class="my-3"> <b>便宜</b></h5>
                    <small>更便宜的價格</small>
                </div>
                <div class="col-lg-3 col-6 p-3 col-sm-6 col-md-6"> <i class="d-block fa fa-3x mb-2 text-muted fa-users"></i>
                    <h5 class="my-3"><b>社群</b></h5>
                    <small>和你一起遊玩的廣大玩家</small>
                </div>
            </div>
        </div>
    </div>
    <!-- feature end -->


    <!-- follow -->
    <div id="follow" class="text-center py-3 my-4">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-md-6">
                    <h5 class="mb-4"><b>追隨我們</b></h5>
                    <div class="row">
                        <div class="d-flex col-md-12 flex-grow-1 justify-content-between col-12 col-sm-12 col-lg-12 icon">
                            <a href="https://twitch.com/" target="blank">
                                <i class="d-block fa fa-twitch text-muted fa-3x"></i>
                            </a>
                            <a href="https://www.youtube.com/" target="blank">
                                <i class="d-block fa fa-youtube-play text-muted fa-3x"></i>
                            </a>
                            <a href="https://www.facebook.com/" target="blank">
                                <i class="d-block fa fa-facebook-official text-muted fa-3x"></i>
                            </a>
                            <a href="https://www.instagram.com/" target="blank">
                                <i class="d-block fa fa-instagram text-muted fa-3x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- follow end -->

    <!-- 登入視窗 -->
    <div class="modal fade" id="login_info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title ">登入成功!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="text-center text-muted">前往<a href="web/store.php">遊戲商店</a>或<a href="web/customer_orders.php">會員專區</a></p>
                    <button id="login_success_btn" class="btn btn-dark" style="font-size: 18px;">確定</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 登出視窗 -->
    <div class="modal fade" id="logout_info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title ">登出成功!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <button id="logout_success_btn" class="btn btn-dark" style="font-size: 18px;">確定</button>
                </div>
            </div>
        </div>
    </div>

    @include('web.layouts.footer')

    <script>
        $(window).on("load", function() {
            // init flickity
            $(".main").flickity({
                "wrapAround": true,
                "autoPlay": true,
                "pageDots": false
            });

        });
    </script>
</body>


</html>