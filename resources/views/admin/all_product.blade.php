@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nội thất
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
        ?>
      </div>
      <div class="col-sm-2">
        <p>Tìm nội thất:</p>
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
            <th>Mã</th>
            <th>Tên nội thất</th>
            <th>Ảnh nội thất</th>
            <th>Loại nội thất</th>
            <th>Nhà cung cấp</th>
            <th>Giá nội thất</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product as $key => $pro)
          <tr>
            <td>{{$pro->NT_MA }}</td>
            <td>{{$pro->NT_TEN}}</td>
            <td>
              @foreach($img_product as $key => $img)
                @if ($pro->NT_MA == $img->NT_MA)
                  <img src="public/frontend/img/noithat/{{$img->HANT_DUONGDAN}}" width="100">
                @endif
              @endforeach
            </td>
            <td>{{$pro->LNT_TEN }}</td>
            <td>{{$pro->NCC_TEN }}</td>
            <td>{{number_format($pro->NT_GIA)}} VNĐ</td>
            <td>{{$pro->NT_NGAYTAO}}</td>
            <td>{{$pro->NT_NGAYCAPNHAT}}</td>
            <td>
              <a href="{{URL::to('/product-detail/'.$pro -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-info-circle text-primary text-active"></i></a>
              <a href="{{URL::to('/chi-tiet-san-pham/'.$pro -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-google text-warning text-active"></i></a>
              <a href="{{URL::to('/edit-product/'.$pro -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-product/'.$pro -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            