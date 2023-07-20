@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    @foreach($status_name as $key => $name)
    <div class="panel-heading">
        {{ $name->TT_TEN }}
    </div>
    @endforeach

    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      <div class="btn-group">
        <a data-toggle="dropdown" href="#" class="btn mini blue">
            XEM THEO TRẠNG THÁI
            <i class="fa fa-angle-down "></i>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item  text-center" href="{{ URL::to('/trang-thai/tat-ca')}}">- - Tất cả trạng thái - -</a></li>

            @foreach($all_status as $key => $status)
            <li><a class="dropdown-item text-center" href="{{ URL::to('/danh-muc-trang-thai/'. $status->TT_MA) }}">{{ $status->TT_TEN }}</a></li>
            @endforeach
        </ul>
        </div>             
      </div>
      <div class="col-sm-4">
      <p style="text-align: right;">Tìm trong đơn đặt hàng:</p>
      </div>
      <div class="col-sm-3">
      <div class="input-group">
            <form class="d-flex" action="{{ URL::to('/search-all-order') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" class="input-sm form-control" name="keywords_submit" style="width: 70%; margin: 0 10px" placeholder="Nhập mã đơn cần tìm...">
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search icon-white"></i></a></button>
          </form>
        </div>
      </div>
    </div>
    <?php
		$count= Session::get('status_count'); 
		if ($count) {
			echo "Tổng số dòng dữ liệu: ".$count;
        }
	?>
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
                    <td>Mã</td>
                    <td>Ngày đặt</td>
                    <td>Sách</td>
                    <td>Số lượng</td>
                    <td>Tổng tiền</td>
                    <td> </td>
                </tr>
        </thead>
        <tbody>
        @foreach($id_status as $key => $all_DDH)
              <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                  <td>{{$all_DDH->DDH_MA}}</td>
                  <td>{{$all_DDH->DDH_NGAYDAT}}</td>
                  <td>
                      @foreach($group_DDH as $key => $nhom_DDH)
                          @if($nhom_DDH->DDH_MA==$all_DDH->DDH_MA)
                              <p style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$nhom_DDH->SACH_TEN}}</p>
                          @endif
                      @endforeach
                  </td>
                  <td>
                      @foreach($group_DDH as $key => $nhom_DDH)
                          @if($nhom_DDH->DDH_MA==$all_DDH->DDH_MA)
                              <p style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$nhom_DDH->CTDDH_SOLUONG}}</p>
                          @endif
                      @endforeach
                  </td>
                  <td>{{number_format($all_DDH->DDH_TONGTIEN)}} đ</td>

                  <td >
                    <a href="{{URL::to('/show-detail/'.$all_DDH->DDH_MA)}}"><button style= {width:100%} type = "submit" class="btn btn-outline-dark btn-success btn-sm ">Xem chi tiết</button></a>
                    <a href="{{URL::to('/update-status-order/'.$all_DDH->DDH_MA)}}"><button style= {width:100%} type = "submit" class="btn btn-outline-dark btn-warning btn-sm">Cập nhật trạng thái</button></a>
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



