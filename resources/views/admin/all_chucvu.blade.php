@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chức vụ
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<div class="text-notice mb-3">'.$message.'</div>';
          Session::put('message',null);
      }
    ?>
        <?php
				$count= Session::get('count_chucvu');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã chức vụ</th>
            <th>Tên chức vụ</th>
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_chucvu as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->CV_MA}}</td>
            <td>{{$cate_pro->CV_TEN}}</td>
            <td>
              <a href="{{URL::to('/edit-chucvu/'.$cate_pro -> CV_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-chucvu/'.$cate_pro -> CV_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            {{ "Showing ". $all_chucvu->firstItem() ."-". $all_chucvu->lastItem() ." of ". $all_chucvu->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_chucvu->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_chucvu->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_chucvu->lastPage(); $key++)
                @if ($all_chucvu->currentPage() === $key + 1)
                  <li><a href="{{ $all_chucvu->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_chucvu->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_chucvu->hasMorePages())
                <li><a href="{{ $all_chucvu->nextPageUrl() }}">Next</a></li>
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
            