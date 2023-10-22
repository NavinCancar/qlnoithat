@extends('admin-layout-detail')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chi tiết lô xuất
                        </header>
                        <div class="panel-body">
                        @foreach($edit_loxuat as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<div class="text-notice mb-3">'.$message.'</div>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã lô xuất</label>
                                    <input type="text" value="{{$edit_value->LX_MA}}" readonly name="ngayxuat_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày nhập lô</label>
                                    <input type="text" value="{{date('d/m/Y H:i:s', strtotime($edit_value->LX_NGAYXUAT))}}" readonly name="ngayxuat_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung lô</label>
                                    <input type="text" value="{{$edit_value->LX_NOIDUNG}}" readonly name="noidung_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhân viên phụ trách</label>
                                      <select name="manv_product_name"  readonly class="form-control input-sm m-bot15" required="">
                                        @foreach($nvien as $key => $nv)
                                            @if($nv->NV_MA==$edit_value->NV_MA)
                                            <option selected value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option>
                                            @else
                                            <option value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chi tiết lô xuất:</label>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>Mã nội thất</th>
                                                <th>Tên nội thất</th>
                                                <th>Hình ảnh</th>
                                                <th>Số lượng nhập</th>
                                                <th>Giá nhập</th>
                                                <th style="width:30px;"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_chitiet_loxuat as $key => $ct)
                                            <tr>
                                                <td>{{$ct->NT_MA}}</td>
                                                <td>{{$ct->NT_TEN}}</td>
                                                <td><img src="../public/frontend/img/noithat/{{$ct->HANT_DUONGDAN}}" width="120"></td>
                                                <td>{{$ct->CTLX_SOLUONG}}</td>
                                                <td>{{number_format($ct->CTLX_GIA)}} VNĐ</td>
                                                <td>
                                                    <a href="{{URL::to('/edit-chitiet-loxuat/lo='.$ct -> LX_MA.'&nothat='.$ct -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-chitiet-loxuat/lo='.$ct -> LX_MA.'&nothat='.$ct -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <a href="{{URL::to('/add-chitiet-loxuat/'.$edit_value->LX_MA)}}"><button type="button" name="add_chitiet_loxuat"  style="width:100%" class="btn btn-success">Cập nhật thêm chi tiết lô xuất</button></a>
                                    </div>
                                </div>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            