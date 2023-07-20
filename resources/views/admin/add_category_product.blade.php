@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thể loại sách
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thể loại</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thể loại" required="">
                                </div>
                                <!--
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã thể loại</label>
                                    <input class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Mã thể loại sách">
                                </div>
                                -->
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm thể loại sách</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            