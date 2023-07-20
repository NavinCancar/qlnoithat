@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê khách hàng
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert">'.$message.'</span>';
          Session::put('message',null);
      }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Mã khách hàng</th>
            <th>Mã giỏ hàng</th>
            <th>Họ tên</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Đường dẫn ảnh</th>

          </tr>
        </thead>
        <tbody>
        @foreach($all_khachhang as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$pro->KH_MA }}</td>
            <td>{{$pro->GH_MA}}</td>
            <td>{{$pro->KH_HOTEN}}</td> 
            <td>{{$pro->KH_SODIENTHOAI}}</td>
            <td>{{$pro->KH_DIACHI}}</td>
            <td>{{$pro->KH_NGAYSINH}}</td>
            <td>{{$pro->KH_GIOITINH}}</td>
            <td>{{$pro->KH_EMAIL}}</td>
            <td>{{$pro->KH_DUONGDANANHDAIDIEN}}</td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 lô</small>
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
            