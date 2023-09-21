@extends('admin-layout-detail')
@section('admin-content')

<div class="table-agile-info">
    <div class="panel panel-default">
    <div class="panel-heading">Thông tin khách hàng mở rộng</div><br>

    <style>
        .position-center{
            width: 80%;
        }
    </style>
      <div class="position-center">
      @foreach($all_KH as $key => $all_KH)
          <form role="form" action="#"  method="post" enctype= "multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                  <label for="exampleInputEmail1"><b>Mã khách hàng:</b></label>
                  <input type="text" name="KH_MA" disabled value="{{$all_KH->KH_MA}}" class="form-control" id="exampleInputEmail1">
                </div>


                <h3 class="text-center p-3">-- Thông tin giỏ hàng và chi tiết giỏ hàng --</h3>
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Mã giỏ hàng:</b></label>
                    <input type="text" name="KH_MA" disabled value="{{$all_KH->GH_MA}}" class="form-control" id="exampleInputEmail1">
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><b>Thời gian cập nhật lần cuối:</b></label>
                    <input type="text" name="KH_MA" disabled value="{{$all_KH->GH_NGAYCAPNHATLANCUOI}}" class="form-control" id="exampleInputEmail1">
                </div>
              <div class="form-group">
                  <label for="exampleInputEmail1"><b>Giỏ hàng hiện tải đang chứa:</b></label>
                  <section class="table-responsive">
                    <table width="55%" class="table table-striped b-t b-light">
                        <thead style="background-color: #ddede0;">
                            <tr>
                              <th>Mã</th>
                              <th>Ảnh</th>
                              <th>Nội thất</th>
                              <th>Số lượng</th>
                            </tr>
                        </thead>
                      <tbody style="background-color: rgba(245, 242, 243, 0.76); width: 60%">
                        @foreach($group_GH as $key => $cart_pro)
                        <tr>
                            <td><h5><span id="soLuong1"></span> {{$cart_pro->NT_MA}}</h5></td>
                            <td ><img src="../../qlnoithat/public/frontend/img/noithat/{{$cart_pro->HANT_DUONGDAN}}" height="105" width="105" alt=""></td>
                            <td>
                                <h5 style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$cart_pro->NT_TEN}}</h5>
                            </td>
                            <td>
                                <h5><span id="soLuong1"></span> {{$cart_pro->CTGH_SOLUONG}}</h5>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                  </table>
              </section>
              </div>
              <br>
              <h3 class="text-center p-3">-- Thông tin địa chỉ giao hàng của khách --</h3>
              <div class="form-group">
                  <label for="exampleInputEmail1"><b>Địa chỉ giao hàng:</b></label>
                  <section class="table-responsive">
                    <table width="55%" class="table table-striped b-t b-light">
                        <thead style="background-color: #ddede0;">
                            <tr>
                              <th>Mã</th>
                              <th>Họ tên người nhận</th>
                              <th>Vị trí cụ thể</th>
                              <th>Tỉnh/thành phố</th>
                              <th>Ghi chú</th>
                            </tr>
                        </thead>
                      <tbody style="background-color: rgba(245, 242, 243, 0.76); width: 60%">
                        @foreach($group_DC as $key => $dc)
                        <tr>
                            <td><h5>{{$dc->DCGH_MA}}</h5></td>
                            <td><h5>{{$dc->DCGH_HOTENNGUOINHAN}}</h5></td>
                            <td><h5>{{$dc->DCGH_VITRICUTHE}}</h5></td>
                            <td><h5>{{$dc->TTP_TEN}}</h5></td>
                            <td><h5>{{$dc->DCGH_GHICHU}}</h5></td>
                        </tr>
                        @endforeach
                        </tbody>
                  </table>
              </section>
              </div>
            
          </form>
      @endforeach
      </div>
    </div>
  </div>

  @endsection
