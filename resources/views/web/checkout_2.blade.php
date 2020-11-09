<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<body>

    @include('web.layouts.navbar')

    <!-- content -->
    <div class="container my-4">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('web.cart.checkout_1')}}">結帳 - 填寫收件者資料</a></li>
                        <li class="breadcrumb-item active" aria-current="page">結帳 - 選擇運送方式</li>
                    </ol>

                </nav>
            </div>

            <form class="my-3 col-lg-12" method="post" action="{{route('web.cart.checkout_3')}}">
                <div class="row">
                    @csrf
                    <h4 class="text-center mb-4 col-lg-8"><i class="fa fa-truck mr-2" aria-hidden="true"></i>選擇運送方式</h4>

                    <div class="p-0 col-lg-8 text-center">
                        <div class="row justify-content-center">

                            <div class="card col-10 col-md-8 col-lg-6" style="width: 15rem;">
                                <img src="{{URL('img/payment/shop.jpg')}}" class="card-img-top mx-auto my-4" alt="" style="max-width: 13rem;">
                                <div class="card-body">
                                    @if (session('total') >= 3000)
                                    <input id="shop" type="radio" name="shipping" value="0" checked>超商取貨 運費: NT$ 0</input>
                                    @else
                                    <input id="shop" type="radio" name="shipping" value="80" checked>超商取貨 運費: NT$80</input>
                                    @endif
                                </div>
                            </div>

                            <div class="card col-10 col-md-8 col-lg-6" style="width: 15rem;">
                                <div class="row justify-content-center">
                                    <img src="{{URL('img/payment/black_cat.jpg')}}" class="card-img-top" alt="" style="max-width: 13rem;">
                                    <div class="card-body">
                                        @if (session('total') >= 3000)
                                        <input id="cat" type="radio" name="shipping" value="0">黑貓宅配 運費: NT$ 0</input>
                                        @else
                                        <input id="cat" type="radio" name="shipping" value="150">黑貓宅配 運費: NT$150</input>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 p-3 col-md-12">
                                <p>*購物滿3000免運費，只限台灣本島，離島需加上稅金與運費</p>
                            </div>

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
                                @if (session('total') >= 3000)
                                <td id="shipping">NT$ 0</td>
                                @else
                                <td id="shipping">NT$ 80</td>
                                @endif
                            </tr>
                            <tr>
                                <td>總金額</td>
                                @if (session('total') >= 3000)
                                <td id="final_total">NT$ {{session('total')}}</td>
                                @else
                                <td id="final_total">NT$ {{session('total') + 80}}</td>
                                @endif

                            </tr>
                        </table>
                    </div>

                    <div class="px-4 col-md-12">
                        <div class="row justify-content-between">
                            <a href="{{route('web.cart.checkout_1')}}" class="btn btn-light col-4 col-md-3 col-lg-2"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>上一頁</a>
                            <button type="submit" class="btn btn-dark col-4 col-md-3 col-lg-2">下一步<i class="fa fa-chevron-right ml-1" aria-hidden="true"></i></button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    @include('web.layouts.footer')

    <script>
        $(function() {

            var total = parseInt(<?php echo session('total'); ?>)

            $('input[name="shipping"]').change(function() {

                var shipping = parseInt($(this).val());
                $('#shipping').html('NT$ ' + shipping);
                var final_total = total + shipping;
                $('#final_total').html('NT$ ' + final_total);

            });

        })
    </script>
</body>

</html>