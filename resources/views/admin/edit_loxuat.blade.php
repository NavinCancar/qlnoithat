@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật lô xuất
                        </header>
                        <div class="panel-body">
                        @foreach($edit_loxuat as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-loxuat/'.$edit_value->LX_MA)}}" method="post">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày xuất lô </label>
                                    <input type="text" value="{{$edit_value->LX_NGAYXUAT}}" name="ngayxuat_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                <div class="form-group">
                                    
                                    <input type="hidden" value="{{$edit_value->LX_MA}}" name="malx_product_name" class="form-control" id="exampleInputEmail1" placeholder="Mã lô xuất" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung lô</label>
                                    <input type="text" value="{{$edit_value->LX_NOIDUNG}}" name="noidung_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nội dung lô" required="">
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhân viên phụ trách</label>
                                      <select name="manv_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($nvien as $key => $nv)
                                            
                                            @if($nv->NV_MA==$edit_value->NV_MA)
                                            <option selected value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option>
                                            @else
                                            <option value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_loxuat" class="btn btn-info">Cập nhật lô xuất</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            