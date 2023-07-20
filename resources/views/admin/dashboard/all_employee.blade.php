@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nhân viên
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert">'.$message.'</span></br>';
          Session::put('message',null);
      }
    ?>
        <?php
				$count= Session::get('count_employee');
							if ($count) {
								echo "Tổng số dòng dữ liệu: ".$count;
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
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Chức vụ</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Ảnh đại diện</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_employee as $key => $emp)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$emp->NV_MA }}</td>
            <td>{{$emp->NV_HOTEN}}</td>
            <td>{{$emp->CV_TEN }}</td>
            <td>{{$emp->NV_SODIENTHOAI}}</td>
            <td>{{$emp->NV_DIACHI}}</td>
            <td>{{$emp->NV_NGAYSINH}}</td>
            <td>{{$emp->NV_GIOITINH}}</td>
            <td>{{$emp->NV_EMAIL}}</td>
            <td><img src="public/backend/images/nhanvien/{{$emp->NV_DUONGDANANHDAIDIEN}}" height="100" width="100"></td>
            <td>
              <a href="{{URL::to('/edit-employee/'.$emp -> NV_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-employee/'.$emp -> NV_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            