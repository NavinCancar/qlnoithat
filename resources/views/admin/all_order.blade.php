@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    TẤT CẢ ĐƠN ĐẶT HÀNG
    </div>

    <div class="row w3-res-tb">
      <div class="col-sm-6 m-b-xs">
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
      <div class="col-sm-3">
      <p>Mã đơn đặt hàng cần tìm:</p>
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
		$count= Session::get('count_order'); 
		if ($count) {
			echo "Tổng số dòng dữ liệu: ".$count;
        }
	?>
      <?php
      $message = Session::get('message');
      if($message){
          echo '<br><span class="text-alert text-warning">'.$message.'</span>';
          Session::put('message',null);
      }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
                    <td>Mã</td>
                    <td>Ngày đặt</td>
                    <td>Nội thất</td>
                    <td>Số lượng</td>
                    <td>Tổng tiền</td>
                    <td>Trạng thái</td>
                    <th style="width:60px;"></th>
                </tr>
        </thead>
        <tbody>
         @foreach($all_DDH as $key => $all_DDH)
            @if ($all_DDH->TT_TEN == "Đã đặt hàng nhưng chưa xử lý") <tr style="background-color:#FCDAD5" >
            @elseif ($all_DDH->TT_TEN == "Đã nhận hàng") <tr style="background-color:#C9E4D6" >
            @else <tr>
            @endif
                  <td>{{$all_DDH->DDH_MA}}</td>
                  <td>{{$all_DDH->DDH_NGAYDAT}}</td>
                  <td>
                      @foreach($group_DDH as $key => $nhom_DDH)
                          @if($nhom_DDH->DDH_MA==$all_DDH->DDH_MA)
                              <p style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$nhom_DDH->NT_TEN}}</p>
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
                  <td>{{$all_DDH->TT_TEN}}</td>

                  <td>
                    <a href="{{URL::to('/show-detail/'.$all_DDH->DDH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-info-circle text-primary text-active"></i></a>
                    <a href="{{URL::to('/update-status-order/'.$all_DDH->DDH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-caret-square-o-up  text-success text-active"></i></a>
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
