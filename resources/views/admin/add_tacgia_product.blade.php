@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm tác giả 
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
                                <form role="form" action="{{URL::to('/save-tacgia-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tác giả</label>
                                    <input type="text" name="tacgia_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputPassword1">Mã tác giả</label>
                                    <input class="form-control" name="tacgia_product_id" id="exampleInputPassword1" placeholder="Mã nhà xuất bản">
                                </div>-->

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bút danh</label>
                                    <input type="text" name="tacgia_product_butdanh" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày sinh</label>
                                    <input type ="date" class="form-control" name="tacgia_product_date" id="exampleInputPassword1" placeholder="Ngày sinh của tác giả" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input type="text" name="tacgia_product_gioitinh" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả" required="">
                                </div>
                                
                                
                                <button type="submit" name="add_tacgia_product" class="btn btn-info">Thêm tác giả</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection