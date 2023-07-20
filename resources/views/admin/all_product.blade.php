@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sách
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <?php
          $message = Session::get('message');
          if($message){
              echo '<span class="text-alert">'.$message.'</span></br>';
              Session::put('message',null);
          }
        ?>
        <?php
            $count= Session::get('count_product');
                  if ($count) {
                    echo "Tổng số dòng dữ liệu: ".$count;
                  }
        ?>
      </div>
      <div class="col-sm-4">
        <p style="text-align: right;">Tìm sách:</p>
      </div>
      <div class="col-sm-3">
        <div class="input-group">
        <form class="d-flex" action="{{ URL::to('/search-product') }}" method="POST">
          {{ csrf_field() }}
            <input type="text" class="input-sm form-control" name="keywords_submit" style="width: 70%; margin: 0 10px" placeholder="Nhập sách cần tìm...">
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search icon-white"></i></a></button>
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Mã sách</th>
            <th>Tên sách</th>
            <th>Mô tả sách</th>
            <th>Giá sách</th>
            <th>Chiết khấu</th>
            <th>Ngày cập nhật</th>
            <th>Ngày tạo</th>
            <th>Số trang</th>
            <th>Mã ISBN</th>
            <th>Nhà xuất bản</th>
            <th>Ngôn ngữ</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$pro->SACH_MA }}</td>
            <td>{{$pro->SACH_TEN}}</td>
            <td>{{$pro->SACH_MOTA}}</td>
            <td>{{$pro->SACH_GIA}}</td>
            <td>{{$pro->SACH_CHIETKHAU}}</td>
            <td>{{$pro->SACH_NGAYCAPNHAT}}</td>
            <td>{{$pro->SACH_NGAYTAO}}</td>
            <td>{{$pro->SACH_SOTRANG}}</td>
            <td>{{$pro->SACH_ISBN}}</td>
            <td>{{$pro->NXB_TEN }}</td>
            <td>{{$pro->NN_TEN }}</td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro -> SACH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-product/'.$pro -> SACH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
            