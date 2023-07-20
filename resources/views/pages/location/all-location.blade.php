@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Địa Chỉ Giao Hàng Của Bạn</h2>
            <hr class="mx-auto">
            
            
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert">'.$message.'</span></br>';
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Mã</th>
            <th>Họ tên người nhận</th>
            <th>Số nhà</th>
            <th>Xã/Phường</th>
            <th>Huyện/Quận</th>
            <th>Tỉnh/Thành phố</th>
            <th>Ghi chú</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_DCGH as $key => $dc)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$dc->DCGH_MA}} </td>
            <td>{{$dc->DCGH_HOTENNGUOINHAN}} </td>
            <td>{{$dc->DCGH_SONHA}} </td>
            <td>{{$dc->XP_TEN}} </td>
            <td>{{$dc->HQ_TEN}} </td>
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
    <nav aria-label="...">
            <ul class="justify-content-center pagination pagination-sm mt-5">
              <li class="page-item disabled">
                <a class="page-link ">Previous</a>
              </li>
              <li class="page-item "><a class="page-link bg-active shop-nav" href="#">1</a></li>
              <li class="page-item" aria-current="page">
                <a class="page-link shop-nav" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link shop-nav" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link shop-nav" href="#">Next</a>
              </li>
            </ul>
          </nav>
  </div>
</div>

@endsection