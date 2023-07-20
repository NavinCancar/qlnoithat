@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Tài khoản nhân viên
                        </header>
                        <div class="panel-body">
                        @foreach($edit_employee as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-employee/'.$edit_value->NV_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" disabled value="{{$edit_value->NV_HOTEN}}" name="NV_HOTEN" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chức vụ</label>
                                      <select disabled name="CV_MA" class="form-control input-sm m-bot15" required="">

                                        @foreach($position as $key => $pos)
                                            
                                            @if($pos->CV_MA==$edit_value->CV_MA)
                                            <option selected value="{{$pos->CV_MA}}">{{$pos->CV_TEN}}</option>
                                            @else
                                            <option value="{{$pos->CV_MA}}">{{$pos->CV_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" disabled value="{{$edit_value->NV_SODIENTHOAI}}" name="NV_SODIENTHOAI" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text"disabled value="{{$edit_value->NV_DIACHI}}" name="NV_DIACHI" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" disabled value="{{$edit_value->NV_NGAYSINH}}" name="NV_NGAYSINH" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input type="text" disabled value="{{$edit_value->NV_GIOITINH}}" name="NV_GIOITINH" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" disabled value="{{$edit_value->NV_EMAIL}}" name="NV_EMAIL" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>

                                <div class="form-group">
                                    
            
                                    
                                </div>
                                <div class="form-group">
                                    <p><label for="exampleInputEmail1"><b>Ảnh đại diện:</b></label></p>
                                    <img src="{{URL::to('public/backend/images/nhanvien/'.$edit_value->NV_DUONGDANANHDAIDIEN)}}" class="rounded-circle" height="200" width="200">
                                    <input type="hidden" name="NV_DUONGDANANHDAIDIEN" disabled value="{{$edit_value->NV_DUONGDANANHDAIDIEN}}" class="form-control" id="exampleInputEmail1">
                                    
                                </div>

                                <a href="{{URL::to('/edit-employee/'.$edit_value -> NV_MA)}}"><button type="button" name="add_employee" class="btn btn-info">Cập nhật tài khoản nhân viên</button></a>
                                
                            </form>
                            
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            