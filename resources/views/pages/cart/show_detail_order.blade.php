@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Thông tin chi tiết đơn đặt hàng</h2>
            <hr class="mx-auto">
   
    <div class="position-center">
    
        <form role="form" action="{{URL::to('/order')}}"  method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Họ tên người nhận, địa chỉ giao:</b></label>
                <select name="DCGH_MA" class="form-control input-sm m-bot15">
                    @foreach($DCGH as $key => $DCGH)
                        <option value="{{$DCGH->DCGH_MA}}">{{number_format($DCGH->XP_CHIPHIGIAOHANG)}} đ, {{$DCGH->DCGH_HOTENNGUOINHAN}}, {{$DCGH->DCGH_SONHA}}, {{$DCGH->XP_TEN}}, {{$DCGH->HQ_TEN}}, {{$DCGH->TTP_TEN}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Sách đặt:</b></label>
                <section id="cart-container" class="container my-5">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Ảnh</td>
                        <td>Sách</td>
                        <td>Đơn giá</td>
                        <td>Số lượng</td>
                        <td>Tổng</td>
                    </tr>
                </thead>

                <tbody>
                <?php $tong =0; ?>
                @foreach($CTGH as $key => $cart_pro)
                <tr>
                    <td ><img src="../../qlchsach/public/frontend/img/sach/{{$cart_pro->HAS_DUONGDAN}}" alt=""></td>
                    <td>
                        <h5 style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$cart_pro->SACH_TEN}}</h5>
                    </td>
                    <td>
                        <h5><span id="donGia1">{{number_format($cart_pro->SACH_GIA)}}</span> đ</h5>
                    </td>
                    <td>            
                        <input disabled class="w-25 pl-1" disabled name="qty" value="{{$cart_pro->CTGH_SOLUONGSACH}}" type="number" min="1" id="amount1">
                    </td>
                    <td>
                        <h5><span id="tongGia1"></span> {{number_format($cart_pro->CTGH_SOLUONGSACH*$cart_pro->SACH_GIA)}} đ</h5>
                    </td>
                    <?php
                        $tong = $tong + $cart_pro->CTGH_SOLUONGSACH*$cart_pro->SACH_GIA;
                    ?>
                </tr>
                @endforeach


                    </tbody>
                </table>
            </section>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Thuế VAT (%):</b></label>
                <input type="text" name="DDH_THUEVAT" readonly value="8" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Tổng tiền (Sách + Thuế):</b></label>
                <input type="text" name="" readonly value="<?php echo number_format($tong+$tong*0.08);?>" class="form-control" id="exampleInputEmail1">
                <input name="DDH_TONGTIEN" type="hidden" value="<?php echo $tong+$tong*0.08;?>" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Họ tên người nhận, địa chỉ giao:</b></label>
                <select name="HTTT_MA" class="form-control input-sm m-bot15">
                    @foreach($HTTT as $key => $HTTT)
                        <option value="{{$HTTT->HTTT_MA}}">{{$HTTT->HTTT_TEN}}</option>
                    @endforeach 
                </select>
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1"><b>Hình ảnh chuyển khoản (trừ phương thức thanh toán trực tiếp):</b></label>
                <input type="file" name="DDH_DUONGDANHINHANHCHUYENKHOAN" class="form-control" id="exampleInputEmail1" >
            </div>
          <button type="submit" style="width:100%" class="btn btn-info btn-sm">Xác nhận đặt hàng</button></a>
            <br>
        </form>
    </div>
    
    <a href="{{URL::to('/show-cart')}}"><button type="button" style="width:100%" class="btn btn-dark btn-sm">Quay về</button></a>
  </div>
</div>

@endsection