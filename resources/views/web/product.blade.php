<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

    <style>
        #content img {
            width: 100%;
        }
    </style>

</head>

<body>

    @include('web.layouts.navbar')


    <!-- content -->
    <div class="container my-3 ">
        <div class="row">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item"><a href="{{route('web.store')}}">商店</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product[0]->name}}</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-3 col-md-12 col-lg-2">
                <div class="list-group text-center" style="font-size: 18px;">
                    <div class="card-header p-1 bg-dark text-light">
                        <p class="my-auto">依類型瀏覽</p>
                    </div>
                    <a href="{{route('web.store')}}" class="list-group-item list-group-item-action p-2">全部</a>
                    <a href="{{route('web.store.discount')}}" class="list-group-item list-group-item-action p-2">特惠</a>
                    @foreach ($all_categories as $category)
                    <a href="{{route('web.store.category', $category->id)}}" class="list-group-item list-group-item-action p-2">{{$category->category}}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-10">

                <div class="row">
                    <img class="col-md-12" src="{{URL('storage/uploads/products/' . $product[0]->folder . '/' . $product[0]->header)}}" alt="">
                </div>

                <div class="row">
                    <div class="main col-md-12">
                        @for ($i = 1; $i <= 4; $i++) <div class="cell bg-light">
                            <img src="{{URL('storage/uploads/products/' . $product[0]->folder . '/' . $i . '.jpg')}}" alt="" style="max-width:22rem;">
                    </div>
                    @endfor
                </div>

            </div>

        </div>
    </div>

    <div class="col-lg-12">

        <div class="row justify-content-end">

            <div class="col-lg-10">

                @if(session()->has('add_success'))
                <div class="alert alert-success row" role="alert">
                    {{session()->get('add_success')}}
                </div>
                @elseif(session()->has('add_error'))
                <div class="alert alert-danger row" role="alert">
                    {{session()->get('add_error')}}
                </div>
                @endif

            </div>

            <div class="col-lg-10">

                <form class="alert alert-secondary row justify-content-end" role="alert" method="post" action="{{route('web.cart.add')}}">
                    @csrf
                    <div class="row justify-content-end">

                        <input class="form-control col-3 col-lg-2" type="number" name="quantity" min=1 value="1">
                        <h6 class="px-3 col-4 col-lg-4 align-self-center">NT$ {{$product[0]->price}}</h6>

                        <?php if (isset($_GET['Existed']) && $_GET['Existed'] != null) { ?>
                            <a href="basket.php" class="btn btn-dark">於購物車內</a>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-dark"><i class="fa fa-plus mr-1" aria-hidden="true"></i>加入購物車</button>
                        <?php } ?>
                        <!-- 隱藏取得資訊input -->
                        <input type="hidden" name="product_id" value="{{$product[0]->id}}">
                        <input type="hidden" name="folder" value="{{$product[0]->folder}}">
                        <input type="hidden" name="header" value="{{$product[0]->header}}">
                        <input type="hidden" name="name" value="{{$product[0]->name}}">
                        <input type="hidden" name="price" value="{{$product[0]->price}}">

                    </div>
                </form>
            </div>



            <div id="content" class="col-lg-10 bg-light">
                <div class="row p-3">
                    <h2>{{$product[0]->name}}</h2>
                    <p><?php echo $product[0]->description; ?></p>
                </div>
            </div>

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