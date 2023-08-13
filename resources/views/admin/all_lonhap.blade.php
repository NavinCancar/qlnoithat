@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê lô nhập
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert text-warning">'.$message.'</span>';
          Session::put('message',null);
      }
    ?>
    <?php
				$count= Session::get('count_lonhap');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Mã lô nhập</th>
            <th>Nhân viên phụ trách</th>
            <th>Ngày nhập</th>
            <th>Nội dung</th>
            <th style="width:90px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_lonhap as $key => $pro)
          <tr>
            <td>{{$pro->LN_MA }}</td>
            <td>{{$pro->NV_HOTEN}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($pro->LN_NGAYNHAP))}}</td> 
            <td>{{$pro->LN_NOIDUNG}}</td>
            <td>
              <a href="{{URL::to('/show-chitiet-lonhap/'.$pro -> LN_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-info-circle text-primary text-active"></i></a>
              <a href="{{URL::to('/edit-lonhap/'.$pro -> LN_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-lonhap/'.$pro -> LN_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
            {{ "Showing ". $all_lonhap->firstItem() ."-". $all_lonhap->lastItem() ." of ". $all_lonhap->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($all_lonhap->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $all_lonhap->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$all_lonhap->lastPage(); $key++)
                @if ($all_lonhap->currentPage() === $key + 1)
                  <li><a href="{{ $all_lonhap->url($key + 1) }}" style="color:#fff; background-color: #ffbd0b">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $all_lonhap->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($all_lonhap->hasMorePages())
                <li><a href="{{ $all_lonhap->nextPageUrl() }}">Next</a></li>
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
            