@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê loại nội thất nội thất
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert text-warning">'.$message.'</span></br>';
          Session::put('message',null);
      }
    ?>
        <?php
				$count= Session::get('count_category_product');
							if ($count) {
								echo "Tổng số dòng dữ liệu: ".$count;
							}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã loại nội thất</th>
            <th>Tên loại nội thất</th>
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_category_product as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->LNT_MA}}</td>
            <td>{{$cate_pro->LNT_TEN}}</td>
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro -> LNT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-category-product/'.$cate_pro -> LNT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            {{ "Showing ". $all_category_product->firstItem() ."-". $all_category_product->lastItem() ." of ". $all_category_product->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_category_product->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_category_product->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_category_product->lastPage(); $key++)
                @if ($all_category_product->currentPage() === $key + 1)
                  <li><a href="{{ $all_category_product->url($key + 1) }}" style="color:#fff; background-color: #8b5c7e">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_category_product->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_category_product->hasMorePages())
                <li><a href="{{ $all_category_product->nextPageUrl() }}">Next</a></li>
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
            