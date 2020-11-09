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
            <li class="breadcrumb-item active">訂單管理</li>
          </ul>

          @if(session()->has('update_success'))
          <div class="alert alert-success">
            <p>{{session()->get('update_success')}}</p>
          </div>
          @elseif(session()->has('delete_success'))
          <div class="alert alert-success">
            <p>{{session()->get('delete_success')}}</p>
          </div>
          @endif

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th>產生日期</th>
                    <th>訂單編號</th>
                    <th>訂單狀態</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($all_orders as $order)
                  <tr>
                    <td><small>{{$order->created_at}}</small></td>
                    <td>{{$order->id}}</td>
                    <td>@if ($order->status == 1)
                      {{'完成交易'}}
                      @else
                      {{'未付款'}}
                      @endif</td>
                    <td><a class="btn btn-dark btn-sm " href="{{route('orders.edit', $order->id)}}"><i class="fa fa-fw fa-pencil-square-o"></i>&nbsp;編輯</a><a class="btn btn-dark btn-sm" href="" onclick="event.preventDefault();if(confirm('是否確定刪除此筆資料?刪除後無法回復')){document.getElementById('delete_{{$order->id}}').submit();}"><i class="fa fa-fw fa-trash"></i>&nbsp;刪除</a></td>
                  </tr>

                  <form id="{{'delete_'. $order->id}}" style="display:none;" action="{{route('orders.destroy', $order->id)}}" method="post">
                    @csrf
                    @method('delete')
                  </form>

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    {{$all_orders->links()}}
  </div>

  @include('admin.layouts.footer')

</body>

</html>