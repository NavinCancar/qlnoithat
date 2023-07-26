@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nhà cung cấp
                        </header>
                        <div class="panel-body">
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-warning">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thể nhà cung cấp</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã thể nhà cung cấp</label>
                                    <input class="form-control" name="brand_product_id" id="exampleInputPassword1" placeholder="Mã nhà cung cấp">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input  type ="text" class="form-control" name="brand_product_phone" id="exampleInputPassword1" placeholder="Số điện thoại nhà cung cấp" required=""  pattern="[0-9]{10,11}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <textarea class="form-control" style="resize:none" rows=5 name="brand_product_address" id="exampleInputPassword1" placeholder="Địa chỉ nhà cung cấp" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type ="text" class="form-control" name="brand_product_email" id="exampleInputPassword1" placeholder="Email nhà cung cấp" required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                </div>
                                
                                
                                <button type="submit" name="add_brand_product"  style="width:100%" class="btn btn-success">Thêm nhà cung cấp</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            