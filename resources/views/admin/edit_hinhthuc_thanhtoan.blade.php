@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật hình thức thanh toán đơn đặt hàng
                        </header>
                        <div class="panel-body">
                            @foreach($edit_hinhthuc_thanhtoan as $key => $edit_value)
                           
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-hinhthu-thanhtoan/'.$edit_value->HTTT_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hình thức thanh toán</label>
                                    <input type="text" value="{{$edit_value->HTTT_TEN}}" name="hinhthuc_thanhtoan_name" class="form-control" id="exampleInputEmail1" placeholder="Tên hình thức thanh toán" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã hình thức thanh toán</label>
                                    <textarea class="form-control" name="hinhthuc_thanhtoan_desc" rows=1 cols=1 id="exampleInputPassword1" place='Mã hình thức thanh toán'>
                                    {{$edit_value->HTTT_MA}}</textarea>
                                    
                                </div>-->
                                
                                
                                <button type="submit" name="update_hinhthuc_thanhtoan" class="btn btn-info">Cập nhật hình thức thanh toán đơn đặt hàng</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            