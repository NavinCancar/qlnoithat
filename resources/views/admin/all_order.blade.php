@extends('admin-layout-detail')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    TẤT CẢ ĐƠN ĐẶT HÀNG
    </div>

    <div class="row w3-res-tb">
      <div class="col-sm-4">
        <?php
          $message = Session::get('message');
          if($message){
              echo '<span class="text-alert text-warning">'.$message.'</span>';
              Session::put('message',null);
          }
        ?>
        <?php
          $count= Session::get('count_order'); 
          if ($count) {
            echo "<p style='padding-top:2px'>Tổng số dòng dữ liệu: ".$count.'</p>';
          }
        ?>
      </div>
      <div class="col-sm-5">
        <div class="input-group d-flex">
            <form class="d-flex" action="{{ URL::to('/search-all-order') }}" method="POST">
            {{ csrf_field() }}
            <span>Mã đơn hàng cần tìm:</span>
            <input type="number" class="input-sm form-control" name="keywords_submit" style="width: auto; float:none" placeholder="Nhập mã đơn cần tìm...">
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search icon-white"></i></a></button>
          </form>
        </div>
      </div>
      <div class="col-sm-3 m-b-xs text-right">
        <div class="btn-group" style="width: 100%;">
          <a data-toggle="dropdown" href="#" class="btn btn-default btn-block">
            <p style="white-space: normal ;">XEM THEO TRẠNG THÁI <i class="fa fa-angle-down "></i></p>
          </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item  text-center" href="{{ URL::to('/trang-thai/tat-ca')}}">- - Tất cả trạng thái - -</a></li>
              @foreach($all_status as $key => $status)
              <li><a class="dropdown-item text-center" href="{{ URL::to('/danh-muc-trang-thai/'. $status->TT_MA) }}">{{ $status->TT_TEN }}</a></li>
              @endforeach
          </ul>
        </div>             
      </div>
    </div>
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
         @foreach($all_DDH as $key => $all_don)
            @if ($all_don->TT_TEN == "Đã đặt hàng nhưng chưa xử lý") <tr style="background-color:#FCDAD5" >
            @elseif ($all_don->TT_TEN == "Đã nhận hàng") <tr style="background-color:#C9E4D6" >
            @else <tr>
            @endif
                  <td>{{$all_don->DDH_MA}}</td>
                  <td>{{date('d/m/Y H:i:s', strtotime($all_don->DDH_NGAYDAT))}}</td>
                  <td>
                      @foreach($group_DDH as $key => $nhom_DDH)
                          @if($nhom_DDH->DDH_MA==$all_don->DDH_MA)
                              <p style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$nhom_DDH->NT_TEN}}</p>
                          @endif
                      @endforeach
                  </td>
                  <td>
                      @foreach($group_DDH as $key => $nhom_DDH)
                          @if($nhom_DDH->DDH_MA==$all_don->DDH_MA)
                              <p style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$nhom_DDH->CTDDH_SOLUONG}}</p>
                          @endif
                      @endforeach
                  </td>
                  <td>{{number_format($all_don->DDH_TONGTIEN)}} VNĐ</td>
                  <td>{{$all_don->TT_TEN}}</td>

                  <td>
                    <a href="{{URL::to('/show-detail/'.$all_don->DDH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-info-circle text-primary text-active"></i></a>
                    <a href="{{URL::to('/update-status-order/'.$all_don->DDH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-caret-square-o-up  text-success text-active"></i></a>
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
            {{ "Showing ". $all_DDH->firstItem() ."-". $all_DDH->lastItem() ." of ". $all_DDH->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_DDH->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_DDH->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_DDH->lastPage(); $key++)
                @if ($all_DDH->currentPage() === $key + 1)
                  <li><a href="{{ $all_DDH->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_DDH->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_DDH->hasMorePages())
                <li><a href="{{ $all_DDH->nextPageUrl() }}">Next</a></li>
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
