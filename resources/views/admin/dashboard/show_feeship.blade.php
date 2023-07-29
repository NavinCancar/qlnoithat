@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
        Quản lý phí ship
    </div>
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert text-warning">'.$message.'</span></br>';
          Session::put('message',null);
      }
    ?>
    <?php
				$count= Session::get('count_feeship');
				if ($count) {
					echo "<p style='padding:15px'>Tổng số dòng dữ liệu: ".$count.'</p>';
				}
		?>
<div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Tên tỉnh/thành phố</th>
                        <th>Phí ship</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dc as $key => $dchi)
                    <tr>
                        <td>{{$dchi->TTP_TEN }}</td>
                        <td>{{number_format($dchi->TTP_CHIPHIGIAOHANG)}} đ</td>
                        <td>
                        <a href="{{URL::to('/edit_feeship/'.$dchi -> TTP_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
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
            {{ "Showing ". $dc->firstItem() ."-". $dc->lastItem() ." of ". $dc->total() ." items" }}
          </small>
        </div>
        <nav aria-label="Page navigation">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- Previous Page Link --}}
              @if ($dc->onFirstPage())
                <li style="pointer-events: none;"><a href="#" style="background-color: #ddd">Previous</a></li>
              @else
                <li><a href="{{ $dc->previousPageUrl() }}">Previous</a></li>
              @endif

              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$dc->lastPage(); $key++)
                @if ($dc->currentPage() === $key + 1)
                  <li><a href="{{ $dc->url($key + 1) }}" style="color:#fff; background-color: #8b5c7e">{{ $key + 1 }}</a></li>
                @else
                  <li><a href="{{ $dc->url($key + 1) }}">{{ $key + 1 }}</a></li>
                @endif
              @endfor
                
              {{-- Next Page Link --}}
              @if ($dc->hasMorePages())
                <li><a href="{{ $dc->nextPageUrl() }}">Next</a></li>
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
            