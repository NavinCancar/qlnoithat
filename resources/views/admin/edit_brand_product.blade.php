@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật nhà cung cấp
                        </header>
                        <div class="panel-body">
                            @foreach($edit_brand_product as $key => $edit_value)
            
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->NCC_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" value="{{$edit_value->NCC_TEN}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã nhà cung cấp</label>
                                    <textarea class="form-control" name="brand_product_id" rows=1 cols=1 id="exampleInputPassword1" place='Mã nhà cung cấp'>
                                    {{$edit_value->NCC_MA}}</textarea>
                                    
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input  type ="text" value="{{$edit_value->NCC_SODIENTHOAI}}" class="form-control" name="brand_product_phone" id="exampleInputPassword1" placeholder="Số điện thoại nhà cung cấp" required="" pattern="[0-9]{10,11}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <textarea class="form-control" style="resize:none" rows=5 name="brand_product_address" id="exampleInputPassword1" placeholder="Địa chỉ nhà cung cấp" required="">{{$edit_value->NCC_DIACHI}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type ="text" value="{{$edit_value->NCC_EMAIL}}" class="form-control" name="brand_product_email" id="exampleInputPassword1" placeholder="Email nhà cung cấp" required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                </div>
                                
                                
                                
                                
                                <button type="submit" name="update_category_product"  style="width:100%" class="btn btn-success">Cập nhật nhà cung cấp</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            