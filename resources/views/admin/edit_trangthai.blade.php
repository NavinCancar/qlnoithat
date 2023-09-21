@extends('admin-layout-detail')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật trạng thái đơn đặt hàng
                        </header>
                        <div class="panel-body">
                            @foreach($edit_trangthai as $key => $edit_value)
                           
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-trangthai/'.$edit_value->TT_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên trạng thái</label>
                                    <input type="text" value="{{$edit_value->TT_TEN}}" name="trangthai_name" class="form-control" id="exampleInputEmail1" placeholder="Tên trạng thái" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã trạng thái</label>
                                    <textarea class="form-control" name="trangthai_desc" rows=1 cols=1 id="exampleInputPassword1" place='Mã trạng thái'>
                                    {{$edit_value->TT_MA}}</textarea>
                                    
                                </div>-->
                                
                                
                                <button type="submit" name="update_trangthai"  style="width:100%" class="btn btn-success">Cập nhật trạng thái đơn đặt hàng</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            