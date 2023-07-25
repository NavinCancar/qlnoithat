@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật nội thất
                        </header>
                        <div class="panel-body">
                        @foreach($edit_product as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product/'.$edit_value->NT_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nội thất</label>
                                    <input type="text" name="NT_TEN" class="form-control" id="exampleInputEmail1" value="{{$edit_value->NT_TEN}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều dài</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="number" name="NT_CHIEUDAI" class="form-control" id="exampleInputEmail1" value="{{$edit_value->NT_CHIEUDAI}}" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều rộng</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="number" name="NT_CHIEURONG" class="form-control"id="exampleInputEmail1" value="{{$edit_value->NT_CHIEURONG}}" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều cao</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="number" name="NT_CHIEUCAO" class="form-control" id="exampleInputEmail1" value="{{$edit_value->NT_CHIEUCAO}}" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả chất liệu</label>
                                    <textarea style="resize: none"  rows="8" class="form-control" name="NT_MOTACHATLIEU" id="ckeditor1" required="">{{$edit_value->NT_MOTACHATLIEU}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="text" name="NT_GIA" class="form-control" id="exampleInputEmail1" required="" value="{{$edit_value->NT_GIA}}" pattern="[0-9]+">
                                        <span style="margin-left: 10px;">VNĐ</span>
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Ngày cập nhât</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày tạo</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1" >
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại nội thất</label>
                                      <select name="LNT_MA" class="form-control input-sm m-bot15">
                                        @foreach($type_product as $key => $type)
                                            @if($type->LNT_MA==$edit_value->LNT_MA)
                                            <option selected value="{{$type->LNT_MA}}">{{$type->LNT_TEN}}</option>
                                            @else
                                            <option value="{{$type->LNT_MA}}">{{$type->LNT_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="NCC_MA" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            @if($brand->NCC_MA==$edit_value->NCC_MA)
                                            <option selected value="{{$brand->NCC_MA}}">{{$brand->NCC_TEN}}</option>
                                            @else
                                            <option value="{{$brand->NCC_MA}}">{{$brand->NCC_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="add_product" style="width:100%" class="btn btn-success">Cập nhật nội thất</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            