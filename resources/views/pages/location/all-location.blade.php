@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <h2 class="text-center font-weight-bold pt-3">Địa chỉ giao hàng của bạn</h2>
    <hr class="mx-auto">    
    <?php
      $message = Session::get('message');
      if($message){
          echo '<div class="text-notice mb-3">'.$message.'</div>';
          Session::put('message',null);
      }
    ?>
    <div class='row'>
        <div class="col-sm-9">
        <?php
          $count= Session::get('count_DCGH');
          if ($count) {
              echo "Tổng số dòng dữ liệu: ".$count;
          }
		    ?>
        </div>
        <div class="col-sm-3">
            <a href="{{URL::to('/them-dia-chi-giao-hang')}}">
              <button type="button" style="width:100%" class="btn btn-info btn-sm">
                <b>Thêm địa chỉ giao hàng</b>
              </button>
            </a>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light table-responsive-md">
        <thead>
          <tr>
            <th>Mã</th>
            <th>Họ tên người nhận</th>
            <th>Ví trí cụ thể</th>
            <th>Tỉnh/Thành phố</th>
            <th>Ghi chú</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_DCGH as $key => $dc)
          <tr>
            <td>{{$dc->DCGH_MA}} </td>
            <td>{{$dc->DCGH_HOTENNGUOINHAN}} </td>
            <td>{{$dc->DCGH_VITRICUTHE}} </td>
            <td>{{$dc->TTP_TEN}} </td>
            <td>{{$dc->DCGH_GHICHU}} </td>
            <td>
              <a href="{{URL::to('/sua-dia-chi-giao-hang/'.$dc -> DCGH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/xoa-dia-chi-giao-hang/'.$dc -> DCGH_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection