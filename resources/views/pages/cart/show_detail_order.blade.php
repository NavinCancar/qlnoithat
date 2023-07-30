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
                <label for="exampleInputEmail1"><b>Phí vận chuyển - Họ tên người nhận - Địa chỉ giao:</b></label>
                <select name="DCGH_MA" class="form-control input-sm m-bot15">
                    @foreach($DCGH as $key => $DCGH)
                        <option value="{{$DCGH->DCGH_MA}}">{{number_format($DCGH->TTP_CHIPHIGIAOHANG)}} VNĐ - {{$DCGH->DCGH_HOTENNGUOINHAN}} - {{$DCGH->DCGH_VITRICUTHE}}, {{$DCGH->TTP_TEN}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Nội thất đặt:</b></label>
                <section id="cart-container" class="container my-5">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Ảnh</td>
                        <td>Nội thất</td>
                        <td>Đơn giá</td>
                        <td>Số lượng</td>
                        <td>Tổng</td>
                    </tr>
                </thead>

                <tbody>
                <?php $tong =0; ?>
                @foreach($CTGH as $key => $cart_pro)
                <tr>
                    <td ><img src="../../qlnoithat/public/frontend/img/noithat/{{$cart_pro->HANT_DUONGDAN}}" alt=""></td>
                    <td>
                        <h5 style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$cart_pro->NT_TEN}}</h5>
                    </td>
                    <td>
                        <h5><span id="donGia1">{{number_format($cart_pro->NT_GIA)}}</span> VNĐ</h5>
                    </td>
                    <td>            
                        <input disabled class="w-25 pl-1" disabled name="qty" value="{{$cart_pro->CTGH_SOLUONG}}" type="number" min="1" id="amount1">
                    </td>
                    <td>
                        <h5><span id="tongGia1"></span> {{number_format($cart_pro->CTGH_SOLUONG*$cart_pro->NT_GIA)}} VNĐ</h5>
                    </td>
                    <?php
                        $tong = $tong + $cart_pro->CTGH_SOLUONG*$cart_pro->NT_GIA;
                    ?>
                </tr>
                @endforeach


                    </tbody>
                </table>
            </section>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Thuế VAT (%):</b></label>
                        <input type="text" name="DDH_THUEVAT" readonly value="8" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Tổng tiền (Nội thất + Thuế):</b></label>
                        <input type="text" name="" readonly value="<?php echo number_format($tong+$tong*0.08);?>" class="form-control" id="exampleInputEmail1">
                        <input name="DDH_TONGTIEN" type="hidden" value="<?php echo $tong+$tong*0.08;?>" class="form-control" id="exampleInputEmail1">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Hình thức thanh toán:</b></label>
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
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 pt-4" >
                    <button type="submit" style="width:100%" class="btn btn-info btn-sm">Xác nhận đặt hàng</button>
                    <br><a href="{{URL::to('/show-cart')}}"><button type="button" style="width:100%" class="btn btn-dark btn-sm">Quay về</button></a>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

@endsection