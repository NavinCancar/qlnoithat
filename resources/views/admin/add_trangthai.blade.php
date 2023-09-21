@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm trạng thái đơn đặt hàng
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
                                <form role="form" action="{{URL::to('/save-trangthai')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên trạng thái</label>
                                    <input type="text" name="trangthai_name" class="form-control" id="exampleInputEmail1" placeholder="Tên trạng thái" required="">
                                </div>
                                <!--
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã trạng thái</label>
                                    <input class="form-control" name="trangthai_desc" id="exampleInputPassword1" placeholder="Mã trạng thái">
                                </div>
                                -->
                                
                                <button type="submit" name="add_trangthai"  style="width:100%" class="btn btn-success">Thêm trạng thái</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            