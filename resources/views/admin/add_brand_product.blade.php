@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nhà xuất bản
                        </header>
                        <div class="panel-body">
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thể nhà xuất bản</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà xuất bản" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã thể nhà xuất bản</label>
                                    <input class="form-control" name="brand_product_id" id="exampleInputPassword1" placeholder="Mã nhà xuất bản">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input  type ="text" class="form-control" name="brand_product_phone" id="exampleInputPassword1" placeholder="Số điện thoại nhà xuất bản" required=""  pattern="[0-9]{10,11}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <textarea class="form-control" style="resize:none" rows=5 name="brand_product_address" id="exampleInputPassword1" placeholder="Địa chỉ nhà xuất bản" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type ="text" class="form-control" name="brand_product_email" id="exampleInputPassword1" placeholder="Email nhà xuất bản" required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                </div>
                                
                                
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm nhà xuất bản</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            