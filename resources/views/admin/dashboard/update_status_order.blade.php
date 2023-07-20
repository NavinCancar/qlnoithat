@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật trạng thái đơn hàng
                        </header>
                        <div class="panel-body">
                        @foreach($edit_order as $key => $edit_value)
                            <div class="position-center">

                                <form role="form" action="{{URL::to('/update_status/ddh='.$edit_value->DDH_MA.'&tt='.$edit_value->TT_MA)}})}}" method="post">
                                    {{csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã đơn đặt hàng</label>
                                    <input type="text" disabled value="{{$edit_value->DDH_MA}}" name="DDH_MA" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên trạng thái</label>
                                      <select name="TT_MA" class="form-control input-sm m-bot15" required="">

                                        @foreach($trangthai as $key => $tt)
                                            
                                            @if($tt->TT_MA==$edit_value->TT_MA)
                                            <option selected value="{{$tt->TT_MA}}">{{$tt->TT_TEN}}</option>
                                            @else
                                            <option value="{{$tt->TT_MA}}">{{$tt->TT_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" value="{{$edit_value->TT_MA}}" name="TT_MABD" class="form-control" id="exampleInputEmail1">
                                @if($edit_value->TT_MA==1)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhân viên xử lý</label>
                                      <select name="NVXL_MA" class="form-control input-sm m-bot15" required="">

                                        @foreach($nhanvienxl as $key => $nv)
                                            <option selected value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày cập nhật</label>
                                    <input type="text" disabled  value="{{$edit_value->CTTT_NGAYCAPNHAT}}" name="CTTT_NGAYCAPNHAT" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú</label>
                                    <input type="text" value="{{$edit_value->CTTT_GHICHU}}" name="CTTT_GHICHU" class="form-control" id="exampleInputEmail1" required="">
                                </div>

                                
                                <button type="submit" name="add_employee" class="btn btn-info">Cập nhật trạng thái đơn đặt hàng</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            