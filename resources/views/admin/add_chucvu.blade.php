@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm chức vụ
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
                                <form role="form" action="{{URL::to('/save-chucvu')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chức vụ</label>
                                    <input type="text" name="chucvu_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên chức vụ" required="">
                                </div>
                                <!--
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã chức vụ</label>
                                    <input class="form-control" name="ma_product_desc" id="exampleInputPassword1" placeholder="Mã chức vụ">
                                </div>
                                -->
                                
                                <button type="submit" name="add_chucvu" class="btn btn-info">Thêm chức vụ</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            