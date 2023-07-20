@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sách
                        </header>
                        <div class="panel-body">
                        @foreach($edit_product as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product/'.$edit_value->SACH_MA)}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sách</label>
                                    <input type="text" name="SACH_TEN" class="form-control" id="exampleInputEmail1" value="{{$edit_value->SACH_TEN}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sách</label>
                                    <textarea style="resize: none"  rows="8" class="form-control" name="SACH_MOTA" id="ckeditor1" required="">"{{$edit_value->SACH_MOTA}}"</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" name="SACH_GIA" class="form-control" id="exampleInputEmail1" value="{{$edit_value->SACH_GIA}}" required=""  pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiết khấu</label>
                                    <input type="text" name="SACH_CHIETKHAU" class="form-control" id="exampleInputEmail1" value="{{$edit_value->SACH_CHIETKHAU}}" required=""  pattern="[0-9]+">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Ngày cập nhât</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày tạo</label>
                                    <input type="date" name="product_name" class="form-control" id="exampleInputEmail1" >
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số trang</label>
                                    <input type="text" name="SACH_SOTRANG" class="form-control" id="exampleInputEmail1" value="{{$edit_value->SACH_SOTRANG}}" required=""  pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ISBN</label>
                                    <input type="text" name="SACH_ISBN" class="form-control" id="exampleInputEmail1" value="{{$edit_value->SACH_ISBN}}" required=""  pattern="[0-9]+">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà xuất bản</label>
                                      <select name="NXB_MA" class="form-control input-sm m-bot15" required="">
                                        @foreach($brand_product as $key => $brand)
                                            
                                            @if($brand->NXB_MA==$edit_value->NXB_MA)
                                            <option selected value="{{$brand->NXB_MA}}">{{$brand->NXB_TEN}}</option>
                                            @else
                                            <option value="{{$brand->NXB_MA}}">{{$brand->NXB_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngôn ngữ</label>
                                      <select name="NN_MA" class="form-control input-sm m-bot15" required="">
                                        @foreach($lang_product as $key => $lang)
                                            
                                            @if($lang->NN_MA==$edit_value->NN_MA)
                                            <option selected value="{{$lang->NN_MA}}">{{$lang->NN_TEN}}</option>
                                            @else
                                            <option value="{{$lang->NN_MA}}">{{$lang->NN_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sách</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            