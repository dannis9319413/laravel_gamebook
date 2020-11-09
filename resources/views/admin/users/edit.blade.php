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
            <li class="breadcrumb-item"> <a href="{{route('users.index')}}">會員管理</a></li>
            <li class="breadcrumb-item active">會員編輯</li>
          </ul>

          @if(session()->has('password_success'))
          <div class="alert alert-success">
            <p>{{session()->get('password_success')}}</p>
          </div>
          @elseif(session()->has('password_error'))
          <div class="alert alert-danger">
            <p>{{session()->get('password_error')}}</p>
          </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
          </div>
          @endif

          @if($user->third_id == null)
          <form class="mt-4" method="post" action="{{route('users.update_password', $user->id)}}">

            @csrf
            @method('put')

            <div class="form-group row">
              <label for="password" class="col-3 col-form-label text-right">目前密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="password" name="password" value="{{$user->password}}"> </div>
            </div>

            <div class="form-group row">
              <label for="new_password" class="col-3 col-form-label text-right">新密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="new_password" name="new_password"> </div>
            </div>

            <div class="form-group row">
              <label for="confirm_password" class="col-3 col-form-label text-right">確認新密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="confirm_password" name="confirm_password">
              </div>

              <div class="col-md-5">
                <div class="row justify-content-center my-3">
                  <button type="submit" class="btn btn-dark col-6 ">更新密碼</button>
                </div>
              </div>
            </div>

          </form>
          @endif

          <form class="mt-4" method="post" action="{{route('users.update', $user->id)}}">

            @csrf
            @method('put')

            <div class="form-group row">
              <label for="email" class="col-3 col-form-label text-right">Email</label>
              <div class="col-8 col-md-5">
                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-3 col-form-label text-right">姓名</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"> </div>
            </div>

            <div class="form-group row"> <label for="gender" class="col-3 col-form-label text-right">性別</label>
              <div class="col-8 col-md-6">
                <label><input id="man" type="radio" name="gender" value="1">男</label>
                <label><input id="woman" type="radio" name="gender" value="0">女</label>
              </div>
            </div>

            <div class="form-group row"> <label for="phone" class="col-3 col-form-label text-right">電話</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
              </div>
            </div>

            <div class="form-group row"> <label for="mobile" class="col-3 col-form-label text-right">手機</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{$user->mobile}}"></div>
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
                <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
              </div>
            </div>

            <div class="row p-3 justify-content-between">
              <a class="btn btn-dark col-4 col-md-2" href="{{route('users.index')}}">返回</a>
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
        'zipcodeSel': '<?php echo $user['zipcode']; ?>',
        'countySel': '<?php echo $user['county']; ?>',
        'districtSel': '<?php echo $user['district']; ?>'
      });

      $('#twzipcode').find('select[name="county"]').eq(1).remove();
      $('#twzipcode').find('select[name="district"]').eq(1).remove();
      $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();


      var gender = <?php echo $user['gender']; ?>;
      if (gender == 1) {
        $("#man").attr('checked', 'checked');
      } else {
        $("#woman").attr('checked', 'checked');
      }
    });
  </script>

</body>

</html>