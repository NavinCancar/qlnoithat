@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm chi tiết lô xuất
                        </header>
                        <div class="panel-body">
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-warning">'.$message.'</span>';
                                Session::put('message',null); 
                            }
                            ?>
                            @foreach($lo as $key => $malo)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-chitiet-loxuat/'.$malo->LX_MA)}}" method="post">
                                        {{csrf_field() }}
                                    <div class="form-group"> 
                                        <label for="exampleInputEmail1">Mã nội thất xuất</label>
                                        <input type="number" name="mant_product_name" class="form-control" id="result" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng</label>
                                        <input type="text" name="soluong_product_name" class="form-control"   required="" pattern="[0-9]+">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá</label>
                                        <input type="text" name="gia_product_name" class="form-control" id="exampleInputEmail1"  required="" pattern="[0-9]+">
                                    </div>
                                    
                                    <button type="submit" name="add_chitiet_loxuat"  style="width:100%" class="btn btn-success">Thêm chi tiết lô xuất</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
