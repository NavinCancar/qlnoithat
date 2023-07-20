@extends('all-product')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Cập Nhật Địa Chỉ Giao Hàng Của Bạn</h2>
            <hr class="mx-auto">
    
    <div class="position-center">
    @foreach($edit_location as $key => $edit_value)
        <form role="form" action="{{URL::to('/update-location/'.$edit_value->DCGH_MA)}}"  method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Họ tên người nhận:</b></label>
                <input type="text" name="DCGH_HOTENNGUOINHAN" value="{{$edit_value->DCGH_HOTENNGUOINHAN}}" class="form-control" id="exampleInputEmail1" placeholder="Họ tên người nhận" required="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1"><b>Chọn tỉnh/thành phố:</b></label>
                <select name="TTP_MA" id="TTP_MA" class="form-control input-sm m-bot15 choose TTP_MA" required="">
                    <option value="">-- Chọn tỉnh / thành phố --</option>
                    @foreach($ttp as $key => $ttp)
                        @if($ttp->TTP_MA==$edit_value->TTP_MA)
                        <option selected value="{{$ttp->TTP_MA}}">{{$ttp->TTP_TEN}}</option>
                        @else
                        <option value="{{$ttp->TTP_MA}}">{{$ttp->TTP_TEN}}</option>
                        @endif
                    @endforeach
                                            
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><b>Chọn huyện/quận:</b></label>
                <select name="HQ_MA" id="HQ_MA" class="form-control input-sm m-bot15 choose HQ_MA" required="">
                    <option value="">-- Chọn huyện / quận --</option>
                    @foreach($hq as $key => $hq)    
                        @if($hq->HQ_MA==$edit_value->HQ_MA)
                        <option selected value="{{$hq->HQ_MA}}">{{$hq->HQ_TEN}}</option>
                        @else
                        <option value="{{$hq->HQ_MA}}">{{$hq->HQ_TEN}}</option>
                        @endif
                    @endforeach                   
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><b>Chọn xã/phường:</b></label>
                <select name="XP_MA" id="XP_MA" class="form-control input-sm m-bot15 XP_MA" required="">
                    <option value="">-- Chọn xã / phường --</option>
                    @foreach($xp as $key => $xp)    
                        @if($xp->XP_MA==$edit_value->XP_MA)
                        <option selected value="{{$xp->XP_MA}}">{{$xp->XP_TEN}}</option>
                        @else
                        <option value="{{$xp->XP_MA}}">{{$xp->XP_TEN}}</option>
                        @endif
                    @endforeach 
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Số nhà:</b></label>
                <input type="text" name="DCGH_SONHA" value="{{$edit_value->DCGH_SONHA}}" class="form-control" placeholder="Số nhà" required="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1"><b>Ghi chú:</b></label>
                <textarea style="resize: none"  rows="8" class="form-control" name="DCGH_GHICHU" id="ckeditor1" placeholder="Ghi chú" required="">{{$edit_value->DCGH_GHICHU}}</textarea>
            </div>                  
            <button type="submit" name="save_location" class="btn btn-info ">Cập nhật địa chỉ giao hàng</button>
        </form>
        @endforeach
    </div>

  </div>
</div>

@endsection