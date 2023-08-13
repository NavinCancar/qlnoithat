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
          echo '<span class="text-alert text-warning">'.$message.'</span>';
          Session::put('message',null);
      }
    ?>
    <?php
				$count= Session::get('count_khachhang');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã khách hàng</th>
            <th>Họ tên</th>
            <th>Số điện thoại</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Đường dẫn ảnh</th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_khachhang as $key => $pro)
          <tr>
            <td>{{$pro->KH_MA }}</td>
            <td>{{$pro->KH_HOTEN}}</td> 
            <td>{{$pro->KH_SODIENTHOAI}}</td>
            <td>{{date('d/m/Y', strtotime($pro->KH_NGAYSINH))}}</td>
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
          <small class="text-muted inline m-t-sm m-b-sm">
            {{ "Showing ". $all_khachhang->firstItem() ."-". $all_khachhang->lastItem() ." of ". $all_khachhang->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_khachhang->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_khachhang->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_khachhang->lastPage(); $key++)
                @if ($all_khachhang->currentPage() === $key + 1)
                  <li><a href="{{ $all_khachhang->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_khachhang->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_khachhang->hasMorePages())
                <li><a href="{{ $all_khachhang->nextPageUrl() }}">Next</a></li>
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
            