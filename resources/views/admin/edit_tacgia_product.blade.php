@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật tác giả
                        </header>
                        <div class="panel-body">
                            @foreach($edit_tacgia_product as $key => $edit_value)
            
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-tacgia-product/'.$edit_value->TG_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tác giả</label>
                                    <input type="text" value="{{$edit_value->TG_HOTEN}}" name="tacgia_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
           
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bút danh</label>
                                    <input type="text" value="{{$edit_value->TG_BUTDANH}}" name="tacgia_product_butdanh" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày sinh</label>
                                    <input type ="date" class="form-control" value="{{$edit_value->TG_NGAYSINH}}" name="tacgia_product_date" id="exampleInputPassword1" placeholder="Ngày sinh của tác giả" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input type="text" value="{{$edit_value->TG_GIOITINH}}" name="tacgia_product_gioitinh" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                
                                
                                
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật tác giả</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            