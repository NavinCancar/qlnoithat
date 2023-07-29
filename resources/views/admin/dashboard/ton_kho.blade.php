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
          ->join('don_dat_hang','chi_tiet_don_dat_hang.DDH_MA','=','don_dat_hang.DDH_MA')
          ->where('TT_MA', '!=', 5)
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
          <small class="text-muted inline m-t-sm m-b-sm">
            {{ "Showing ". $all_product->firstItem() ."-". $all_product->lastItem() ." of ". $all_product->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_product->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_product->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_product->lastPage(); $key++)
                @if ($all_product->currentPage() === $key + 1)
                  <li><a href="{{ $all_product->url($key + 1) }}" style="color:#fff; background-color: #8b5c7e">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_product->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_product->hasMorePages())
                <li><a href="{{ $all_product->nextPageUrl() }}">Next</a></li>
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
            