@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thể loại sách
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key => $edit_value)
                           
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->TLS_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thể loại</label>
                                    <input type="text" value="{{$edit_value->TLS_TEN}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thể loại" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã thể loại</label>
                                    <textarea class="form-control" name="category_product_desc" rows=1 cols=1 id="exampleInputPassword1" place='Mã thể loại'>
                                    {{$edit_value->TLS_MA}}</textarea>
                                    
                                </div>-->
                                
                                
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật thể loại sách</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            