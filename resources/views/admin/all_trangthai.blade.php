@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê trạng thái đơn đặt hàng
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<div class="text-notice mb-3">'.$message.'</div>';
          Session::put('message',null);
      }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã trạng thái</th>
            <th>Tên trạng thái</th>
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_trangthai as $key => $TT_pro)
          <tr>
            <td>{{$TT_pro->TT_MA}}</td>
            <td>{{$TT_pro->TT_TEN}}</td>
            <td>
              <a href="{{URL::to('/edit-trangthai/'.$TT_pro -> TT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-trangthai/'.$TT_pro -> TT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            {{ "Hiển thị ". $all_trangthai->firstItem() ."-". $all_trangthai->lastItem() ." trong ". $all_trangthai->total() ." dòng dữ liệu" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_trangthai->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Trước</a></li>
              @else
                <li><a href="{{ $all_trangthai->previousPageUrl() }}">Trước</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_trangthai->lastPage(); $key++)
                @if ($all_trangthai->currentPage() === $key + 1)
                  <li><a href="{{ $all_trangthai->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_trangthai->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_trangthai->hasMorePages())
                <li><a href="{{ $all_trangthai->nextPageUrl() }}">Sau</a></li>
              @else
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Sau</a></li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
    </footer>
  </div>
</div>
@endsection
            