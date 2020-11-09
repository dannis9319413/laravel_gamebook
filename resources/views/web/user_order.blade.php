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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('web.user.orders')}}">我的訂單</a></li>
                        <li class="breadcrumb-item active" aria-current="page">訂單明細</li>
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

            <div class="table-resposive col-md-12 col-lg-10" style="font-size: 18px;">

                <h5>訂單#{{$order[0]->order_no}}</h5>

                <p>如有任何問題請至<a href="{{route('web.contact')}}">聯絡我們</a>聯繫我們</p>

                <table class="table bg-light">

                    <tr>
                        <td>圖片</td>
                        <td>商品名稱</td>
                        <td>數量</td>
                        <td>單價</td>
                        <td>商品總額</td>
                    </tr>
                    @foreach ($all_details as $detail)
                    <tr>
                        <td><img src="{{URL('storage/uploads/products/' . $detail->folder . '/' . $detail->header)}}" alt="" style="max-width: 6rem;"></td>
                        <td style="vertical-align: middle;">{{$detail->name}}</td>
                        <td style="vertical-align: middle;">{{$detail->quantity}}</td>
                        <td style="vertical-align: middle;">NT$ {{$detail->price}}</td>
                        <td style="vertical-align: middle;">{{$detail->quantity * $detail->price}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="5" class="text-right pr-5">運費 NT$ {{$order[0]->shipping}}</td>
                    </tr>

                    <tr>
                        <td colspan="5" class="text-right pl-4 pr-5">
                            <div class="ml-auto">
                                總金額 NT$ {{$order[0]->total + $order[0]->shipping}}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <a href="{{route('web.user.orders')}}" class="btn btn-dark" style="font-size: 18px;"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>返回</a>
                            @if($order[0]->status == 0)
                            <a href="{{route('web.line_pay.reserve', $order[0]->id)}}" class="ml-2" style="font-size: 18px; text-decoration:none;">
                                <!-- <i class="fa fa-credit-card-alt mr-1" aria-hidden="true"></i>LINE Pay付款 -->
                                <img src="{{URL::asset('img/payment/Line_Pay.png')}}" alt="Line Pay付款" style="max-height: 1.9rem;">
                            </a>
                            <a href="{{route('web.opay.request', $order[0]->id)}}" class="ml-2" style="font-size: 18px; text-decoration:none;" target="_blank">
                                <img src="{{URL::asset('img/payment/Opay.png')}}" alt="OPay付款" style="max-height: 1.9rem;">
                            </a>
                            <button id="delete_btn" class="btn btn-danger ml-2" style="font-size: 18px;"><i class="fa fa-times mr-1" aria-hidden="true"></i>取消訂單</button>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

        </div>

    </div>

    @include('web.layouts.footer')

    <!-- 訊息視窗 -->
    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title ">訊息</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="text-center text-muted">是否要刪除訂單?</p>
                    <a href="{{route('web.user.order.delete', $order[0]->id)}}" class="btn btn-dark">確定</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#delete_btn').click(function() {
                $('#info-modal').modal('show');
            });

        });
    </script>
</body>

</html>