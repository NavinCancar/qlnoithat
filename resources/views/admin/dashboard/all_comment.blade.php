@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    BÌNH LUẬN
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert text-warning">'.$message.'</span></br>';
          Session::put('message',null);
      }
    ?>
    <?php
		$count= Session::get('countdg');
    if ($count) {
      echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
    }
	?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th>Thời gian đánh giá</th>
                <th>Khách hàng</th>
                <th>Nội dung</th>
                <th>Điểm</th>
                <th style="width:60px;"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($danh_gia as $key => $dg)
            <tr class="">
				        <td>{{date('d/m/Y H:i:s', strtotime($dg->DG_THOIGIAN))}}</td>
                <td>{{$dg->KH_HOTEN}}</td>
                <td>{{$dg->DG_NOIDUNG}}</td>
                <td>
				          <?php
                    // Create connection
                    $conn = new mysqli('localhost', 'root', '', 'qlnoithat');
                    // Check connection
                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }
                    $madg=$dg->DG_MA;
                    $mant=$dg->NT_MA;
                    $point = "select DG_DIEM dg from Danh_gia where DG_MA ='".$madg."'";
                    $result = $conn->query($point);
                    while ($row = $result->fetch_assoc()) {
                        $dg= $row['dg']."<br>";
                    }
                    $x = 1;
                    for ($x = 1; $x <= $dg; $x++) {
                    echo '<i class="fa fa-star" style="color: goldenrod;"></i>';
                    }
                  ?>
				        </td>
                <td>
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$mant)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-google text-warning text-active"></i></a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-danhgia/'.$madg)}}" class="active styling-edit" ui-toggle-class="">
                        <i class="fa fa-times text-danger text"></i></a>
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
            {{ "Showing ". $danh_gia->firstItem() ."-". $danh_gia->lastItem() ." of ". $danh_gia->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($danh_gia->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $danh_gia->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$danh_gia->lastPage(); $key++)
                @if ($danh_gia->currentPage() === $key + 1)
                  <li><a href="{{ $danh_gia->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $danh_gia->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($danh_gia->hasMorePages())
                <li><a href="{{ $danh_gia->nextPageUrl() }}">Next</a></li>
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
