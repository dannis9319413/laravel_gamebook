<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

    <style>
        .list-group>a {
            padding: 15px 0;
        }
    </style>

</head>

<body>

    @include('web.layouts.navbar')

    <!-- content -->
    <div class="container">

        <div class="row">

            <div class="my-3 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">我的訂單</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-4 col-md-12 col-lg-2 text-center" style="font-size: 18px;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action disabled bg-light">
                        <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i>會員專區
                    </a>
                    <a href="{{route('web.user.orders')}}" class="list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-list mr-1" aria-hidden="true"></i>我的訂單</a>
                    <a href="{{route('web.user.account')}}" class="list-group-item list-group-item-action"><i class="fa fa-user mr-1" aria-hidden="true"></i>會員資料</a>
                    <a href="{{route('web.user.logout')}}" class="list-group-item list-group-item-action"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>登出</a>
                </div>
            </div>

            @if (count($all_orders) > 0)
            <div class="table-resposive col-md-12 col-lg-10" style="font-size: 16px;">
                <table class="table bg-light">

                    <h5>以下是您的訂單</h5>
                    <p>如有任何問題請至<a href="{{route('web.contact')}}">聯絡我們</a>聯繫我們</p>

                    <tr>
                        <td>訂單編號</td>
                        <td>購買日期</td>
                        <td>總金額</td>
                        <td>訂單狀態</td>
                        <td>訂單明細</td>
                    </tr>

                    @foreach ($all_orders as $order)
                    <tr class="my-3">

                        <td>{{$order->order_no}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>NT$ {{$order->total + $order->shipping}}</td>

                        <td>
                            @if ($order->status == 1)
                            <span class="badge badge-success" style="font-size: 17px;">
                                @else
                                <span class="badge badge-primary" style="font-size: 17px;">
                                    @endif
                                    @switch($order->status)
                                    @case (0)
                                    未付款
                                    @break
                                    @case (1)
                                    已付款
                                    @break
                                    @case (2)
                                    已出貨
                                    @break
                                    @case (3)
                                    交易完成
                                    @break
                                    @case (99)
                                    取消訂單
                                    @break
                                    @endswitch

                                </span></td>
                        <td><a href="{{route('web.user.order', $order->id)}}" class="badge badge-info" style="font-size: 17px;">查看明細</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <div class="col-md-12 col-lg-9 pt-5 text-center">
                <h5>目前沒有任何訂單，請至<a href="{{route('web.store')}}">遊戲商店</a>選購您的商品。</h5>
            </div>
            @endif

            @if(session()->has('delete_success'))
            <div class="alert alert-success col-md-12" role="alert">
                {{session()->get('delete_success')}}
            </div>
            @endif

            @if(session()->has('payment_success'))
            <div class="alert alert-success col-md-12" role="alert">
                {{session()->get('payment_success')}}
            </div>
            @elseif(session()->has('update_password_error'))
            <div class="alert alert-danger col-md-12" role="alert">
                {{session()->get('payment_error')}}
            </div>
            @endif

        </div>

    </div>

    @include('web.layouts.footer')

</body>

</html>