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
				echo "Tổng số dòng dữ liệu: ".$count;
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
				<td>{{$dg->DG_THOIGIAN}}</td>
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
                    echo '<i class="fa fa-star"></i>';
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
