@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm hình thức thanh toán đơn đặt hàng
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
                                <form role="form" action="{{URL::to('/save-hinhthu-thanhtoan')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hình thức thanh toán</label>
                                    <input type="text" name="hinhthuc_thanhtoan_name" class="form-control" id="exampleInputEmail1" placeholder="Tên hình thức thanh toán" required="">
                                </div>
                                <!--
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã hình thức thanh toán</label>
                                    <input class="form-control" name="hinhthuc_thanhtoan_desc" id="exampleInputPassword1" placeholder="Mã hình thức thanh toán">
                                </div>
                                -->
                                
                                <button type="submit" name="add_hinhthuc_thanhtoan" class="btn btn-info">Thêm hình thức thanh toán</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            