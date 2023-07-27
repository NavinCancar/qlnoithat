@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nội thất tồn kho
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <?php
          $message = Session::get('message');
          if($message){
              echo '<span class="text-alert text-warning">'.$message.'</span></br>';
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
        <p style="text-align: right;">Tìm nội thất:</p>
      </div>
      <div class="col-sm-3">
        <div class="input-group">
        <form class="d-flex" action="{{ URL::to('/search-product') }}" method="POST">
          {{ csrf_field() }}
            <input type="text" class="input-sm form-control" name="keywords_submit" style="width: 70%; margin: 0 10px" placeholder="Nhập nội thất cần tìm...">
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search icon-white"></i></a></button>
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã nội thất</th>
            <th>Tên nội thất</th>
            <th>Nhà cung cấp</th>
            <th>Loại nội thất</th>
            <th>Số lượng tồn</th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product as $key => $pro)
        <?php
          //Số lượng tồn
          $ddh = DB::table('chi_tiet_don_dat_hang')
          ->where('NT_MA', $pro->NT_MA)->sum('CTDDH_SOLUONG');
          $nhap = DB::table('chi_tiet_lo_nhap')
          ->where('NT_MA', $pro->NT_MA)->sum('CTLN_SOLUONG');
          $xuat = DB::table('chi_tiet_lo_xuat')
          ->where('NT_MA', $pro->NT_MA)->sum('CTLX_SOLUONG');
          $slton=$nhap-$xuat-$ddh;
        ?>
          @if ($slton<=50) <tr style="background-color:#FCDAD5" >
            @else <tr>
            @endif
            <td>{{$pro->NT_MA }}</td>
            <td>{{$pro->NT_TEN}}</td>
            <td>{{$pro->NCC_TEN }}</td>
            <td>{{$pro->LNT_TEN }}</td>
            <td>
                  <?php
                    echo($slton);
                  ?>
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
            