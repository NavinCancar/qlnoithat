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
          echo '<span class="text-alert text-warning">'.$message.'</span></br>';
          Session::put('message',null);
      }
    ?>
    <?php
				$count= Session::get('count_employee');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
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
          <small class="text-muted inline m-t-sm m-b-sm">
            {{ "Showing ". $all_employee->firstItem() ."-". $all_employee->lastItem() ." of ". $all_employee->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_employee->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_employee->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_employee->lastPage(); $key++)
                @if ($all_employee->currentPage() === $key + 1)
                  <li><a href="{{ $all_employee->url($key + 1) }}" style="color:#fff; background-color: #8b5c7e">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_employee->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_employee->hasMorePages())
                <li><a href="{{ $all_employee->nextPageUrl() }}">Next</a></li>
              @else
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Next</a></li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
    </footer>
  </div>
</div>
@endsection
            