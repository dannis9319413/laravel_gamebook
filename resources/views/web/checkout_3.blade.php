<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <!-- content -->
    <div class="container my-4">
        <div class="row">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <!-- <a href="{{route('web.cart.checkout_1')}}">結帳 - 填寫收件者資料</a> -->
                            結帳 - 填寫收件者資料
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <!-- <a href="{{route('web.cart.checkout_2')}}">結帳 - 選擇運送方式</a> -->
                            結帳 - 選擇運送方式
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">結帳 - 確認訂單</li>
                    </ol>

                </nav>
            </div>


            <form class="my-3 col-md-12" method="post" action="{{route('web.cart.order_success')}}">
                @csrf
                <div class="row">

                    <div class="col-md-12 col-lg-12">

                        <h4>確認訂單</h4>

                        <div class="table-responsive">
                            <table class="table bg-light table-sm" style="font-size: 18px;">

                                <thead>
                                    <tr>
                                        <td>圖片</td>
                                        <td>產品名稱</td>
                                        <td>數量</td>
                                        <td>單價</td>
                                        <td>金額</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @for ($i = 0; $i < count(session('cart')); $i++) <tr>
                                        <td>
                                            <a href="{{route('web.product', session('cart.' .$i. '.product_id'))}}">
                                                <img src="{{URL('storage/uploads/products/' . session('cart.' .$i. '.folder') . '/' . session('cart.' .$i. '.header'))}}" style="max-width: 8rem;">
                                            </a>
                                        </td>
                                        <td style="vertical-align:middle;">{{session('cart.'.$i.'.name')}}</td>
                                        <td style="vertical-align:middle;">
                                            {{session('cart.'.$i.'.quantity')}}
                                        </td>
                                        <td style="vertical-align:middle;">NT$ {{session('cart.'.$i.'.price')}}</td>
                                        <td style="vertical-align:middle;">NT$ {{session('cart.'.$i.'.quantity') * session('cart.'.$i.'.price')}} </td>
                                        </tr>
                                        @endfor
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-right">商品總額</h5>
                                            <h6 class="text-right">NT$ {{session('total')}}</h6>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-12 col-lg-8">
                                <h4>運送方式:</h4>
                                @if (session('shipping') == 80)
                                <h5>超商取貨 NT$ 80</h5>
                                @else
                                <h5>黑貓宅配 NT$ 150</h5>
                                @endif
                                <div class="mt-3">
                                    <p>*購物滿3000免運費，只限台灣本島，離島需加上稅金與運費</p>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <table class="table table-sm text-center bg-light">
                                    <tr>
                                        <td>
                                            商品總額
                                        </td>
                                        <td>
                                            NT$ {{session('total')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>運費</td>
                                        <td>NT$ {{session('shipping')}}</td>
                                    </tr>
                                    <tr>
                                        <td>總金額</td>
                                        <td>NT$ {{session('total') + session('shipping')}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 col-md-12">
                        <div class="row justify-content-between">
                            <!-- <a href="{{route('web.cart.checkout_2')}}" class="btn btn-light col-5 col-md-3 col-lg-3"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>上一頁</a> -->
                            <button type="submit" class="btn btn-dark col-5 col-md-3 col-lg-3 ml-auto">確定結帳<i class="fa fa-chevron-right ml-1" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <!-- 產生訂單編號 -->
                    <input type="hidden" name="order_no" value="<?php echo "GB" . date("YmdHis"); ?>">

                </div>
            </form>

        </div>
    </div>

    @include('web.layouts.footer')

</body>

</html>