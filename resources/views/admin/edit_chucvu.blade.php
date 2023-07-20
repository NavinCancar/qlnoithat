@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật chức vụ
                        </header>
                        <div class="panel-body">
                            @foreach($edit_chucvu as $key => $edit_value)
                           
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-chucvu/'.$edit_value->CV_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chức vụ</label>
                                    <input type="text" value="{{$edit_value->CV_TEN}}" name="chucvu_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thể loại" required="">
                                </div>
                                
                                
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật chức vụ</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            