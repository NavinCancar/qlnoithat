@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nội thất
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nội thất</label>
                                    <input type="text" name="NT_TEN" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều dài</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="number" name="NT_CHIEUDAI" class="form-control" id="exampleInputEmail1" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều rộng</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="number" name="NT_CHIEURONG" class="form-control"id="exampleInputEmail1" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều cao</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="number" name="NT_CHIEUCAO" class="form-control" id="exampleInputEmail1" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả chất liệu</label>
                                    <textarea style="resize: none"  rows="8" class="form-control" name="NT_MOTACHATLIEU" id="ckeditor1" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input type="text" name="NT_GIA" class="form-control" id="exampleInputEmail1" required=""  pattern="[0-9]+">
                                        <span style="margin-left: 10px;">VNĐ</span>
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Ngày cập nhât</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày tạo</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại nội thất</label>
                                      <select name="LNT_MA" class="form-control input-sm m-bot15">
                                        @foreach($type_product as $key => $type)
                                            <option value="{{$type->LNT_MA}}">{{$type->LNT_TEN}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Xưởng chế tác</label>
                                      <select name="XCT_MA" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->XCT_MA}}">{{$brand->XCT_TEN}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" style="width:100%" class="btn btn-success" name="add_product">Thêm nội thất</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            