@extends('welcome')
@section('content')
        <section id="form"><!--form-->
            <div class="container pt-3">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h3 class="font-weight-bold">Đăng nhập</h3>
                            <hr>
                            <?php
                                $message= Session::get('message');
                                if($message){
                                    echo '<div class="text-notice mb-3">'. $message .'</div>';
                                    Session::put('message', null);
                                }
                            ?>
                            
                            <form action="{{URL::to('/costumer-check')}}" method="post">
                                {{ csrf_field() }}
                                <input type="text" class="ggg" name="sdt" placeholder="Nhập số điện thoại" required="" pattern="[0-9]{10,11}">
			                    <input type="password" class="ggg" name="password" placeholder="Nhập password" required="">
                                <span>
                                    <input type="checkbox" class="checkbox">
                                    Nhớ lần đăng nhập tiếp theo
                                </span>
                                <button type="submit" class="btn btn-default">Đăng nhập</button>
                            </form>
                            
                            <p class="pt-4">Bạn là nhân viên? <a href="{{URL::to('/admin')}}" style="color: #35a2a1;">Chuyển hướng đến trang admin!</a></p>
                            
                        </div><!--/login form-->
                    </div>

                    <div class="col-sm-2">
                        <h2 class="form-center"><img src="public/frontend/img/or.png" alt="" width="100%"></h2>
                    </div>

                    <div class="col-sm-5">
                        <div class="signup-form"><!--sign up form-->
                            <h3 class="font-weight-bold">Đăng ký</h3>
                            <hr>
                            <?php
                                $message2= Session::get('message2');
                                if($message2){
                                    echo '<div class="text-notice mb-3">'. $message2 .'</div>';
                                    Session::put('message2', null);
                                }
                            ?>
                            <form action="{{URL::to('/dang-ky')}}" method="post" enctype= "multipart/form-data">
                                {{ csrf_field() }}
                                <input type="text" class="ggg" name="KH_SODIENTHOAI" placeholder="Nhập số điện thoại" required="" pattern="[0-9]{10,11}">
			                    <input type="password" class="ggg" name="KH_MATKHAU" placeholder="Nhập password" required="">
                                <input type="text" class="ggg" name="KH_HOTEN" placeholder="Nhập họ tên" required="">
                                <input type="date" class="ggg" name="KH_NGAYSINH" placeholder="Nhập ngày sinh" max="<?php echo date('Y-m-d', strtotime('-15 years')); ?>" required="">
			                    
                                <style>
                                    input[type="radio"] {
                                        transform: scale(0.5); /* Điều chỉnh kích thước */
                                        height: 20px;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-6" style="display: flex; align-items: center; flex-wrap: nowrap;">
                                        <input type="radio" id="nam" name="KH_GIOITINH" value="Nam" required="" style="width: 50px; margin-left: 30%;">
                                        <label for="nam" >Nam</label>
                                    </div>
                                    <div class="col-6" style="display: flex; align-items: center; flex-wrap: nowrap;">
                                        <input type="radio" id="nu" name="KH_GIOITINH" value="Nữ" required="" style="width: 50px; margin-left: 20%;">
                                        <label for="nu">Nữ</label>
                                    </div>
                                </div>

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
