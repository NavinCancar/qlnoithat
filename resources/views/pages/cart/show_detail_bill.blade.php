@extends('all-product')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Thông tin chi tiết đơn đặt hàng</h2>
            <hr class="mx-auto">
   
    <div class="position-center">
    @foreach($all_DDH as $key => $all_DDH)
        <form role="form" action="#"  method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Mã đơn đặt hàng:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DDH_MA}}" class="form-control" id="exampleInputEmail1">
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Trạng thái đơn hàng:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->TT_TEN}}" class="form-control" id="exampleInputEmail1">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1"><b>Họ tên người nhận:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DCGH_HOTENNGUOINHAN}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Địa chỉ giao:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DCGH_SONHA}}, {{$all_DDH->XP_TEN}}, {{$all_DDH->HQ_TEN}}, {{$all_DDH->TTP_TEN}}" 
                class="form-control" id="exampleInputEmail1">
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
                @foreach($group_DDH as $key => $cart_pro)
                <tr>
                    <td ><img src="../../qlchsach/public/frontend/img/sach/{{$cart_pro->HAS_DUONGDAN}}" alt=""></td>
                    <td>
                        <h5 style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$cart_pro->SACH_TEN}}</h5>
                    </td>
                    <td>
                        <h5><span id="donGia1">{{number_format($cart_pro->CTDDH_DONGIA)}}</span> đ</h5>
                    </td>
                    <td>
                        <form action="{{URL::to('/update-cart')}}" method="POST">
                            {{ csrf_field() }}
                                                
                            <input class="w-25 pl-1" disabled name="qty" value="{{$cart_pro->CTDDH_SOLUONG}}" type="number" min="1" id="amount1">
                        </form>
                    </td>
                    <td>
                        <h5><span id="tongGia1"></span> {{number_format($cart_pro->CTDDH_SOLUONG*$cart_pro->CTDDH_DONGIA)}} đ</h5>
                    </td>
                </tr>
                @endforeach


                    </tbody>
                </table>
            </section>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Ngày đặt:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DDH_NGAYDAT}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Phí ship:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DDH_PHISHIPTHUCTE}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Thuế VAT:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DDH_THUEVAT}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Tổng tiền:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{number_format($all_DDH->DDH_TONGTIEN)}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Hình thức thanh toán:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->HTTT_TEN}}" class="form-control" id="exampleInputEmail1">
            </div>
            @if($all_DDH->HTTT_MA!=1)
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Hình ảnh chuyển khoản:</b></label>
                <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DDH_DUONGDANHINHANHCHUYENKHOAN}}" class="form-control" id="exampleInputEmail1">
                <img src="../public/frontend/img/minhchung/{{$all_DDH->DDH_DUONGDANHINHANHCHUYENKHOAN}}">
            </div>
            @endif

        </form>
    @endforeach
    </div>
    <a href="{{URL::to('/show-all-bill')}}"><button type="button" style="width:100%" class="btn btn-dark btn-sm">Quay về</button></a>
  </div>
</div>

@endsection