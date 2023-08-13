@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nội thất tồn kho
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-7 m-b-xs">
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
              echo "<p>Tổng số dòng dữ liệu: ".$count.'</p>';
            }

            $ktra=0;
            $ktrasl = Session::get('ktrasl');
            Session::put('ktrasl',0);
            if($ktrasl) $ktra=$ktrasl;
        ?>
      </div>
      <div class="col-sm-5">
        <div class="input-group d-flex">
          <form class="d-flex" action="{{ URL::to('/kiem-tra-ton-kho') }}" method="POST">
            {{ csrf_field() }}
            <span>Tìm nội thất ít hơn:</span>
            <input type="number" class="input-sm form-control" name="soluong" style="width: auto; float:none" min="0">
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
          @if ($slton<=$ktra) <tr style="background-color:#FCDAD5" >
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
                  <li><a href="{{ $all_product->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
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
            