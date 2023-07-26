@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật loại nội thất
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key => $edit_value)
                           
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->LNT_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại nội thất</label>
                                    <input type="text" value="{{$edit_value->LNT_TEN}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên loại nội thất" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã loại nội thất</label>
                                    <textarea class="form-control" name="category_product_desc" rows=1 cols=1 id="exampleInputPassword1" place='Mã loại nội thất'>
                                    {{$edit_value->LNT_MA}}</textarea>
                                    
                                </div>-->
                                <button type="submit" name="update_category_product"  style="width:100%" class="btn btn-success">Cập nhật loại nội thất</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            