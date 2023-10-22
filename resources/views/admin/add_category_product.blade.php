@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm loại nội thất
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại nội thất</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên loại nội thất" required="">
                                </div>
                                
                                <button type="submit" name="add_category_product"  style="width:100%" class="btn btn-success">Thêm loại nội thất</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            