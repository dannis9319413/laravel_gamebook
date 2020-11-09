<!DOCTYPE html>
<html>

@include('admin.layouts.head')

<body>

  @include('admin.layouts.navbar')

  <div class="container my-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('news.index')}}">最新消息管理</a></li>
            <li class="breadcrumb-item active">新增最新消息</li>
          </ul>

          @if($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
          </div>
          @endif

          <form id="AddForm" class="mt-4" method="post" action="{{route('news.store')}}" enctype="multipart/form-data">

            @csrf

            <div class="form-group row"> <label for="picture" class="col-2 col-form-label text-right">圖片</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture" name="picture" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label for="title" class="col-2 col-form-label text-right">*標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title"> </div>
            </div>

            <div class="form-group row"> <label for="content" class="col-2 col-form-label text-right">*內容</label>
              <div class="col-10">
                <textarea id="content" rows="5" class="form-control" name="content"></textarea>
              </div>
            </div>

            <div class="row p-3 justify-content-between">

              <a class="btn btn-dark col-4 col-md-2" href="{{route('news.index')}}">返回</a>

              <button type="submit" class="btn btn-dark col-4 col-md-2">確定送出</button>

            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  @include('admin.layouts.footer')

  <script>
    CKEDITOR.replace('content');
  </script>

</body>

</html>