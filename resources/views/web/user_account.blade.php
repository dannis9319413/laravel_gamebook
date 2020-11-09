<!DOCTYPE html>
<html lang="en">

<head>

    @include('web.layouts.head')

</head>

<style>
    .list-group>a {
        padding: 15px 0;
    }
</style>

<body>

    @include('web.layouts.navbar')

    <!-- content -->
    <div class="container">

        <div class="row">

            <div class="my-3 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">會員資料</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-4 col-md-12 col-lg-2 text-center" style="font-size:18px;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action disabled bg-light">
                        <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i>會員專區
                    </a>
                    <a href="{{route('web.user.orders')}}" class="list-group-item list-group-item-action"><i class="fa fa-list mr-1" aria-hidden="true"></i>我的訂單</a>
                    <a href="{{route('web.user.account')}}" class="list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-user mr-1" aria-hidden="true"></i>會員資料</a>
                    <a href="{{route('web.user.logout')}}" class="list-group-item list-group-item-action"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>登出</a>
                </div>
            </div>

            <div class="col-lg-10" style="font-size: 20px;">

                <h4>會員資本資料</h4>
                <small>編輯您的會員資料</small>
                <br>
                <small>此資料提供我們寄送商品資訊，請務必填寫真實資料</small>
                <p></p>


                @if(session()->has('update_password_success'))
                <div class="alert alert-success col-md-12" role="alert">
                    {{session()->get('update_password_success')}}
                </div>
                @elseif(session()->has('update_password_error'))
                <div class="alert alert-danger col-md-12" role="alert">
                    {{session()->get('update_password_error')}}
                </div>
                @endif

                @if(!$user[0]->third_id)
                <h5>變更密碼</h5>
                <form method="post" action="{{route('web.user.update_password')}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="old_password">舊密碼</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="new_password">新密碼</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="confirm_password">再次輸入新密碼</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">更改密碼</button>

                </form>
                @endif

                <h5 class="my-4">個人資料</h5>
                @if(session()->has('update_success'))
                <div class="alert alert-success col-md-12" role="alert">
                    {{session()->get('update_success')}}
                </div>
                @endif

                <form method="post" action="{{route('web.user.update_info')}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="email">Email</label>
                            @if($user[0]->third_id)
                            <input type="email" class="form-control" id="email" name="email" value="{{$user[0]->email}}">
                            @else
                            <input type="email" class="form-control" id="email" name="email" value="{{$user[0]->email}}" disabled>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="name">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user[0]->name}}">
                        </div>
                        <div class="form-group ml-3 col-md-4">
                            <label>性別</label>
                            <div>
                                <label><input id="man" type="radio" name="gender" name="1" value="1" checked>男</label>
                                <label><input id="woman" type="radio" name="gender" name="0" value="0">女</label>
                            </div>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="phone">家用電話</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user[0]->phone}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile">行動電話</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{$user[0]->mobile}}">
                        </div>
                    </div>

                    <div id="twzipcode" class="form-row">

                        <div class="form-group col-md-2">
                            <label for="zipcode">郵遞區號</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="county">縣市</label>
                            <select id="county" class="form-control" name="county">
                                <option selected></option>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="district">區域</label>
                            <select type="text" class="form-control" id="district" name="district"></select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$user[0]->address}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">更新資料</button>


                </form>

            </div>

        </div>

    </div>

    @include('web.layouts.footer')

    <!-- twzipcode -->
    <script src="{{URL::asset('js/jquery.twzipcode.min.js')}}"></script>
    <script>
        $(function() {
            $("#twzipcode").twzipcode({
                'zipcodeSel': '<?php echo $user[0]->zipcode; ?>',
                'countySel': '<?php echo $user[0]->county; ?>',
                'districtSel': '<?php echo $user[0]->district; ?>'
            });

            $('#twzipcode').find('select[name="county"]').eq(1).remove();
            $('#twzipcode').find('select[name="district"]').eq(1).remove();
            $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();

            var gender = <?php echo $user[0]->gender; ?>;
            if (gender == 1) {
                $("#man").attr('checked', 'checked');
            } else {
                $("#woman").attr('checked', 'checked');
            }

        })
    </script>


</body>

</html>