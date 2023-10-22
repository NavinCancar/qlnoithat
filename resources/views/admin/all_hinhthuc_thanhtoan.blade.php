@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê hình thức thanh toán đơn đặt hàng
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<div class="text-notice mb-3">'.$message.'</div>';
          Session::put('message',null);
      }
    ?>
    <?php
				$count= Session::get('count_hinhthuc_thanhtoan');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã hình thức</th>
            <th>Tên hình thức</th>
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_hinhthuc_thanhtoan as $key => $httt_pro)
          <tr>
            <td>{{$httt_pro->HTTT_MA}}</td>
            <td>{{$httt_pro->HTTT_TEN}}</td>
            <td>
              <a href="{{URL::to('/edit-hinhthuc-thanhtoan/'.$httt_pro -> HTTT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-hinhthuc-thanhtoan/'.$httt_pro -> HTTT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            {{ "Showing ". $all_hinhthuc_thanhtoan->firstItem() ."-". $all_hinhthuc_thanhtoan->lastItem() ." of ". $all_hinhthuc_thanhtoan->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_hinhthuc_thanhtoan->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_hinhthuc_thanhtoan->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_hinhthuc_thanhtoan->lastPage(); $key++)
                @if ($all_hinhthuc_thanhtoan->currentPage() === $key + 1)
                  <li><a href="{{ $all_hinhthuc_thanhtoan->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_hinhthuc_thanhtoan->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_hinhthuc_thanhtoan->hasMorePages())
                <li><a href="{{ $all_hinhthuc_thanhtoan->nextPageUrl() }}">Next</a></li>
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
            