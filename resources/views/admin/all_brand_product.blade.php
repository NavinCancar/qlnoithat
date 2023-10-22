@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê xưởng chế tác
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<div class="text-notice mb-3">'.$message.'</div>';
          Session::put('message',null);
      }
    ?>
    <?php
				$count= Session::get('count_brand_product');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã</th>
            <th>Tên xưởng chế tác</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Email</th>
            
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_brand_product as $key => $brand_pro)
          <tr>
            <td>{{$brand_pro->XCT_MA}}</td>
            <td>{{$brand_pro->XCT_TEN}}</td>
            <td>{{$brand_pro->XCT_SODIENTHOAI}}</td>
            <td>{{$brand_pro->XCT_DIACHI}}</td>
            <td>{{$brand_pro->XCT_EMAIL}}</td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro -> XCT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-brand-product/'.$brand_pro -> XCT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            {{ "Showing ". $all_brand_product->firstItem() ."-". $all_brand_product->lastItem() ." of ". $all_brand_product->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_brand_product->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_brand_product->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_brand_product->lastPage(); $key++)
                @if ($all_brand_product->currentPage() === $key + 1)
                  <li><a href="{{ $all_brand_product->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_brand_product->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_brand_product->hasMorePages())
                <li><a href="{{ $all_brand_product->nextPageUrl() }}">Next</a></li>
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
            