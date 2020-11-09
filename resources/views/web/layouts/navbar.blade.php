<!-- navbar -->
<?php

use Illuminate\Support\Facades\DB;

$all_categories = DB::table('categories')->get();

?>

<nav class="navbar navbar-expand-xl navbar-light bg-light ">
    <div class="container">

        <a class="navbar-brand" href="{{route('index')}}">
            <img src="{{URL::asset('img/logo.png')}}" alt="GAMEBOOK" style="max-width: 10rem; position:relative; top: 7px;">
        </a>

        <button class="navbar-toggler navbar-toggler-right " data-toggle="collapse" data-target="#collapse1">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapse1">

            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item"> <a class="nav-link" href="{{route('web.about')}}">關於我們</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{route('web.news_list')}}">最新消息</a> </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">遊戲商店</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('web.store')}}" style="font-size: 16px;">全部</a>
                        <a class="dropdown-item" href="{{route('web.store.discount')}}" style="font-size: 16px;">特惠</a>

                        @foreach($all_categories as $category)
                        <a class="dropdown-item" href="{{route('web.store.category', $category->id)}}" style="font-size: 16px;">{{$category->category}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{route('web.contact')}}">聯絡我們</a> </li>
            </ul>

            <ul class="navbar-nav ">
                @if (session()->has('user'))
                <li class="nav-item dropdown">
                    @if(session('user.picture'))
                    <img src="{{session('user.picture')}}" style="max-width:2rem; border-radius: 30px;" alt="">
                    <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="w" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 14px; display:inline;">{{session('user.name')}}您好</a>
                    @else
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">{{session('user.email')}}您好</a>
                    @endif
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('web.user.orders')}}" style="font-size: 16px;">會員專區</a>
                        <a class="dropdown-item" href="{{route('web.user.logout')}}" style="font-size: 16px;">登出</a>
                    </div>
                </li>
                @else
                <li class="nav-item"> <a class="nav-link" href="{{route('web.user.login_page')}}"><i class="fa fa-user mr-1 fa-lg"></i>登入/註冊</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.cart')}}">
                        <i class="fa fa-shopping-cart fa-lg mr-1"></i>(
                        @if(session()->has('cart'))
                        {{count(session('cart'))}}
                        @else
                        {{0}}
                        @endif)
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<!-- navbar end-->