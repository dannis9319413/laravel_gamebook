<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

    @include('web.layouts.navbar')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <nav class="my-3" aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">商店</li>
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

                <form class="card mt-3" style="font-size: 18px;" method="post" action="{{route('web.store.search')}}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-header p-1 bg-warning text-center">
                        <p class="my-auto">依標籤縮小範圍</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-1 pl-3">
                            @foreach($all_categories as $category)
                            <div class="form-check filter">
                                <input id="{{$category->id}}" name="action" type="checkbox" class="form-check-input" value="{{$category->id}}">
                                <label class="form-check-label" for="{{$category->id}}">{{$category->category}}</label>
                            </div>
                            @endforeach

                            <div class="form-check filter">
                                <input id="pre" name="pre" type="checkbox" class="form-check-input" value="pre">
                                <label class="form-check-label" for="pre">預購</label>
                            </div>
                            <div class="form-check filter">
                                <input id="new" name="new" type="checkbox" class="form-check-input" value="new">
                                <label class="form-check-label" for="new">新品</label>
                            </div>
                            <div class="form-check filter">
                                <input id="special" name="special" type="checkbox" class="form-check-input" value="special">
                                <label class="form-check-label" for="special">特惠</label>
                            </div>
                        </li>

                    </ul>
                </form>
            </div>

            <div class="col-lg-10">
                <div id="products" class="row justify-content-center ">
                    @foreach ($all_products as $product)
                    <div class="card m-1 p-1 col-10 col-md-5 col-lg-5 col-xl-3" style="max-width: 18rem;">
                        <a href="{{route('web.product', $product->id)}}"><img class="card-img-top" src="{{URL('storage/uploads/products/' . $product->folder . '/' . $product->header)}}" alt="" style="max-height: 7rem"></a>
                        <div class="row card-body justify-content-center">
                            <h6 class="card-text my-3 col-md-12">{{$product->name}}</h6>
                            <p class="text-right col-md-12">NT$ {{$product->price}}</p>
                            <a href="{{route('web.product', $product->id)}}"><button class="btn btn-dark btn-sm col-12 align-self-end">立即購買</button></a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div id="links" class="row justify-content-center mt-5">
                    {{$all_products->links()}}
                </div>
            </div>

        </div>
    </div>

    @include('web.layouts.footer')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            var filters = [0];
            $('input:checkbox').change(function() {
                if ($(this).is(':checked')) {
                    filters.push($(this).val());
                } else {
                    filters.splice($.inArray($(this).val(), filters), 1);
                }
                $.ajax({
                    url: '<?php echo route('web.store.search'); ?>',
                    method: 'POST',
                    data: {
                        filters: filters,
                    },
                    success: function(data) {
                        $('#products').html(data);
                        $('#links').hide();
                    }
                });
            })
        });
    </script>
</body>

</html>