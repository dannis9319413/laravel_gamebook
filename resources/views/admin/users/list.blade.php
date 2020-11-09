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
            <li class="breadcrumb-item active">會員管理</li>
          </ul>

          @if(session()->has('create_success'))
          <div class="alert alert-success" role="alert">
            {{session()->get('create_success')}}
          </div>
          @elseif(session()->has('update_success'))
          <div class="alert alert-success" role="alert">
            {{session()->get('update_success')}}
          </div>
          @elseif(session()->has('delete_success'))
          <div class="alert alert-success" role="alert">
            {{session()->get('delete_success')}}
          </div>
          @endif

          <div class="row">
            <div class="col-md-7"><a class="btn btn-dark w-25 ml-3" href="{{route('users.create')}}">新增一筆</a></div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th>註冊日期</th>
                    <th>會員編號</th>
                    <th>Email</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($all_users as $user)
                  <tr>
                    <td><small>{{$user->created_at}}</small></td>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td><a class="btn btn-dark btn-sm " href="{{route('users.edit', $user->id)}}"><i class="fa fa-fw fa-pencil-square-o"></i>&nbsp;編輯</a><a class="btn btn-dark btn-sm" href="" onclick="event.preventDefault();if(confirm('是否確定刪除此筆資料?刪除後無法回復')){document.getElementById('delete_{{$user->id}}').submit();}"><i class="fa fa-fw fa-trash"></i>&nbsp;刪除</a></td>
                  </tr>

                  <form id="{{'delete_'. $user->id}}" style="display:none;" action="{{route('users.destroy', $user->id)}}" method="post">
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
    {{$all_users->links()}}
  </div>

  @include('admin.layouts.footer')

</body>

</html>