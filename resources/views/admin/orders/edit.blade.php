<!DOCTYPE html>
<html>

@include('admin.layouts.head')

<body>

  @include('admin.layouts.navbar')

  <div class="container py-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('orders.index')}}">訂單管理</a></li>
            <li class="breadcrumb-item active">訂單編輯</li>
          </ul>


          <form class="mt-4" method="post" action="{{route('orders.update',$order->id)}}">

            @csrf
            @method('put')

            @if ($errors->any())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach
            </div>
            @endif

            <div class="form-group row">
              <label for="order_no" class="col-3 col-form-label text-right">訂單號碼</label>
              <div class="col-8 col-md-5">
                <input type="text" class="form-control" id="order_no" name="order_no" value="{{$order->order_no}}" disabled>
              </div>
            </div>

            <div class="form-group row"> <label for="total" class="col-3 col-form-label text-right">商品總額</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="total" name="total" value="{{$order->total}}">
              </div>
            </div>

            <div class="form-group row"> <label for="shipping" class="col-3 col-form-label text-right">運費</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="shipping" name="shipping" value="{{$order->shipping}}">
              </div>
            </div>

            <div class="form-group row"> <label for="status" class="col-3 col-form-label text-right">訂單狀態</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="status" name="status" value="{{$order->status}}">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-3 col-form-label text-right">姓名</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="name" name="name" value="{{$order->name}}"> </div>
            </div>

            <div class="form-group row"> <label for="mobile" class="col-3 col-form-label text-right">手機</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{$order->mobile}}"></div>
            </div>

            <div id="twzipcode" class="form-group row justify-content-center">
              <div class="form-group col-3 col-md-2">
                <label for="zipcode">郵遞區號</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode">
              </div>
              <div class="form-group col-4 col-md-3">
                <label for="county">縣市</label>
                <select id="county" class="form-control" name="county">
                  <option selected></option>

                </select>
              </div>
              <div class="form-group col-4 col-md-3">
                <label for="district">區域</label>
                <select type="text" class="form-control" id="district" name="district"></select>
              </div>

            </div>

            <div class="form-group row"> <label for="address" class="col-3 col-form-label text-right">地址</label>
              <div class="col-8 col-md-6">
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $order['address']; ?>">
              </div>
            </div>

            <div class="row p-3 justify-content-between">

              <a class="btn btn-dark col-4 col-md-2" href="{{route('orders.index')}}">返回</a>

              <button type="submit" class="btn btn-dark col-4 col-md-2">確定送出</button>

            </div>

          </form>

        </div>
      </div>

    </div>
  </div>

  @include('admin.layouts.footer')

  <script>
    $(function() {
      $("#twzipcode").twzipcode({
        'zipcodeSel': '<?php echo $order['zip']; ?>',
        'countySel': '<?php echo $order['county']; ?>',
        'districtSel': '<?php echo $order['district']; ?>'
      });

      $('#twzipcode').find('select[name="county"]').eq(1).remove();
      $('#twzipcode').find('select[name="district"]').eq(1).remove();
      $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();

    });
  </script>

</body>

</html>