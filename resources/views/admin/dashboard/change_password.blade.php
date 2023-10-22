@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Đổi mật khẩu
                        </header>
                        <div class="panel-body">
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<div class="text-notice mb-3">'.$message.'</div>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-password')}}" method="post" enctype= "multipart/form-data">
                                    {{csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu cũ</label>
                                    <input type="password" name="NV_MATKHAUCU" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu mới</label>
                                    <input type="password" name="NV_MATKHAUMOI1" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="NV_MATKHAUMOI2" class="form-control" id="exampleInputEmail1" required="">
                                </div>

                                <button type="submit" name="update_password"  style="width:100%" class="btn btn-success">Cập nhật mật khẩu</button>
                            </form>
                            </div>
                        </div>
                    </section>
@endsection
            