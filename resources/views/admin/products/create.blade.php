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
            <li class="breadcrumb-item"> <a href="{{route('products.index')}}">商品管理</a></li>
            <li class="breadcrumb-item active">新增商品</li>
          </ul>

          @if($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
          </div>
          @endif

          <form id="AddForm" class="mt-4" method="post" action="{{route('products.store')}}" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
              <label for="folder" class="col-2 col-form-label text-right">*資料夾名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="folder" name="folder" placeholder="*請勿輸入英數以外和特殊字元">
              </div>
            </div>

            <div class="form-group row">
              <label for="product_category_id" class="col-2 col-form-label text-right">*商品類別</label>
              <div class="col-10">
                <select class="form-control" id="product_category_id" name="product_category_id">
                  @foreach($all_categories as $category)
                  <option value="{{$category->id}}">{{$category->category}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row"> <label for="header" class="col-2 col-form-label text-right">圖片</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="header" name="header" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_1" class="col-2 col-form-label text-right">圖片1</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_1" name="picture_1" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_2" class="col-2 col-form-label text-right">圖片2</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_2" name="picture_2" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_3" class="col-2 col-form-label text-right">圖片3</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_3" name="picture_3" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_4" class="col-2 col-form-label text-right">圖片4</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_4" name="picture_4" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-2 col-form-label text-right">*遊戲名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name"> </div>
            </div>

            <div class="form-group row"> <label for="description" class="col-2 col-form-label text-right">*遊戲描述</label>
              <div class="col-10">
                <textarea id="description" rows="5" class="form-control" name="description"></textarea>
              </div>
            </div>

            <div class="form-group row"> <label for="price" class="col-2 col-form-label text-right">*價格</label>
              <div class="col-10">
                <input type="text" class="form-control" id="price" name="price"></div>
            </div>


            <div class="form-group row"> <label for="pre" class="col-2 col-form-label text-right">預購</label>
              <div class="col-10">
                <select class="form-control" id="pre" name="pre">
                  <option value="0">否</option>
                  <option value="1">是</option>
                </select>
              </div>
            </div>

            <div class="form-group row"> <label for="new" class="col-2 col-form-label text-right">新品</label>
              <div class="col-10">
                <select class="form-control" id="new" name="new">
                  <option value="0">否</option>
                  <option value="1">是</option>
                </select>
              </div>
            </div>

            <div class="form-group row"> <label for="special" class="col-2 col-form-label text-right">特惠</label>
              <div class="col-10">
                <select class="form-control" id="special" name="special">
                  <option value="0">否</option>
                  <option value="1">是</option>
                </select>
              </div>
            </div>

            <div class="row p-3 justify-content-between">

              <a class="btn btn-dark col-4 col-md-2" href="{{route('products.index')}}">返回</a>

              <button type="submit" class="btn btn-dark col-4 col-md-2">確定送出</button>

            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

  @include('admin.layouts.footer')

  <script>
    CKEDITOR.replace('description');
  </script>

</body>

</html>