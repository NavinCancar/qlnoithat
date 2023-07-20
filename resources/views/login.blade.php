@extends('welcome')
@section('content')
        <section id="form"><!--form-->
            <div class="container pt-3">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2 class="font-weight-bold">Đăng nhập</h2>
                            <hr>
                            <form action="{{URL::to('/costumer-check')}}" method="post">
                                {{ csrf_field() }}
                                <input type="text" class="ggg" name="sdt" placeholder="Nhập số điện thoại" required="">
			                    <input type="password" class="ggg" name="password" placeholder="Nhập password" required="">
                                <span>
                                    <input type="checkbox" class="checkbox">
                                    Nhớ lần đăng nhập tiếp theo
                                </span>
                                <button type="submit" class="btn btn-default">Đăng nhập</button>
                            </form>
                        </div><!--/login form-->
                        <?php
                            $message= Session::get('message');
                            if($message){
                                echo '<span class="">'. $message .'</span>';
                                Session::put('message', null);
                            }
                            ?>
                    </div>

                    <div class="col-sm-2">
                        <h2 class="or form-center">OR</h2>
                    </div>

                    <div class="col-sm-5">
                        <div class="signup-form"><!--sign up form-->
                            <h2 class="font-weight-bold">Đăng ký</h2>
                            <hr>
                            <form action="{{URL::to('/dang-ky')}}" method="post" enctype= "multipart/form-data">
                                {{ csrf_field() }}
                                <input type="text" class="ggg" name="KH_SODIENTHOAI" placeholder="Nhập số điện thoại" required="" pattern="[0-9]{10,11}">
			                    <input type="password" class="ggg" name="KH_MATKHAU" placeholder="Nhập password" required="">
                                <input type="text" class="ggg" name="KH_HOTEN" placeholder="Nhập họ tên" required="">
                                <input type="date" class="ggg" name="KH_NGAYSINH" placeholder="Nhập ngày sinh" max="<?php echo date('Y-m-d', strtotime('-12 years')); ?>" required="">
			                    <input type="text" class="ggg" name="KH_GIOITINH" placeholder="Nhập giới tính" required="">
                                <input type="text" class="ggg" name="KH_DIACHI" placeholder="Nhập địa chỉ" required="">
                                <input type="text" class="ggg" name="KH_EMAIL" placeholder="Nhập email"  required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
			                    <input type="file" class="ggg" name="KH_DUONGDANANHDAIDIEN" placeholder="Chọn ảnh đại diện">
                                <button type="submit" class="btn btn-default">Đăng ký</button>
                            </form>

                        </div><!--/sign up form-->
                    </div>
                </div>
            </div>
        </section><!--/form-->

@endsection
