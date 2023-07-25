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
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nội thất</label>
                                    <input type="text" name="NT_TEN" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả nội thất</label>
                                    <textarea style="resize: none"  rows="8" class="form-control" name="NT_MOTA" id="ckeditor1" placeholder="Mô tả sản phẩm" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" name="NT_GIA" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất" required=""  pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiết khấu</label>
                                    <input type="text" name="NT_CHIETKHAU" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất" required=""  pattern="[0-9]+">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Ngày cập nhât</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày tạo</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số trang</label>
                                    <input type="text" name="NT_SOTRANG" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất" required=""  pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ISBN</label>
                                    <input type="text" name="NT_ISBN" class="form-control" id="exampleInputEmail1" placeholder="Tên nội thất" required="" pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà xuất bản</label>
                                      <select name="NXB_MA" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->NXB_MA}}">{{$brand->NXB_TEN}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngôn ngữ</label>
                                      <select name="NN_MA" class="form-control input-sm m-bot15">
                                        @foreach($lang_product as $key => $lang)
                                            <option value="{{$lang->NN_MA}}">{{$lang->NN_TEN}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm nội thất</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            