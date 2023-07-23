@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <h2 class="text-center font-weight-bold pt-3">Thêm địa chỉ giao hàng của bạn</h2>
    <hr class="mx-auto">
    <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert">'.$message.'</span></br>';
          Session::put('message',null);
      }
    ?>
    
    <div class="position-center">
        <form role="form" action="{{URL::to('/save-location')}}"  method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Họ tên người nhận:</b></label>
                        <input type="text" name="DCGH_HOTENNGUOINHAN" class="form-control" id="exampleInputEmail1" placeholder="Họ tên người nhận" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><b>Chọn tỉnh/thành phố:</b></label>
                        <select name="TTP_MA" id="TTP_MA" class="form-control input-sm m-bot15" required="">
                            <option value="">-- Chọn tỉnh / thành phố --</option>
                            @foreach($ttp as $key => $ttp)
                                <option value="{{$ttp->TTP_MA}}">{{$ttp->TTP_TEN}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Ví trí cụ thể:</b></label>
                        <input type="text" name="DCGH_VITRICUTHE" class="form-control" placeholder="Ví trí cụ thể" required="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1"><b>Ghi chú:</b></label>
                        <textarea style="resize: none"  rows="8" class="form-control" name="DCGH_GHICHU" id="ckeditor1" placeholder="Ghi chú"></textarea>
                    </div>                  
                    <button type="submit" style="width:100%" class="btn btn-info btn-sm" name="save_location">Thêm địa chỉ giao hàng</button>
                </div>
            </div>

            

            
        </form>
    </div>

  </div>
</div>

@endsection