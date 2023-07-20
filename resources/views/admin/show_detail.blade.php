@extends('admin-layout')
@section('admin-content')

<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">Thông tin chi tiết đơn đặt hàng</div><br>

    <style>
        .position-center{
            width: 80%;
        }
    </style>
      <div class="position-center">
      @foreach($all_DDH as $key => $all_DDH)
          <form role="form" action="#"  method="post" enctype= "multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                  <label for="exampleInputEmail1"><b>Mã đơn đặt hàng:</b></label>
                  <input type="text" name="DDH_MA" disabled value="{{$all_DDH->DDH_MA}}" class="form-control" id="exampleInputEmail1">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1"><b>Họ tên người đặt:</b></label>
                  <input type="text" name="DDH_MA" disabled value="{{$all_DDH->KH_HOTEN}} <Mã khách hàng: {{$all_DDH->KH_MA}}>" class="form-control" id="exampleInputEmail1">
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
                  <section class="table-responsive">
                    <table width="55%" class="table table-striped b-t b-light">
                        <thead style="background-color: #ddede0;">
                            <tr>
                              <th>Ảnh</th>
                              <th>Sách</th>
                              <th>Đơn giá</th>
                              <th>Số lượng</th>
                              <th>Tổng</th>

                            </tr>
                          </thead>

                      <tbody style="background-color: rgba(245, 242, 243, 0.76); width: 60%">
                        @foreach($group_DDH as $key => $cart_pro)
                        <tr>
                            <td ><img src="../../qlchsach/public/frontend/img/sach/{{$cart_pro->HAS_DUONGDAN}}" height="105" width="105" alt=""></td>
                            <td>
                                <h5 style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$cart_pro->SACH_TEN}}</h5>
                            </td>
                            <td>
                                <h5><span id="donGia1">{{number_format($cart_pro->CTDDH_DONGIA)}}</span> đ</h5>
                            </td>
                            <td>
                            <h5><span id="soLuong1"></span> {{$cart_pro->CTDDH_SOLUONG}}</h5>
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
            <br>
          </form>
      @endforeach
      </div>
    </div>
  </div>

  @endsection
