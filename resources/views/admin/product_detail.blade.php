@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chi tiết nội thất
                        </header>
                        <div class="panel-body">
                        @foreach($edit_product as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-warning">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            $NT_MA= $edit_value->NT_MA;
                            ?>
                            <div class="position-center">
                                <form role="form" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nội thất</label>
                                    <input readonly type="text" name="NT_TEN" class="form-control" id="exampleInputEmail1" value="{{$edit_value->NT_TEN}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều dài</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input readonly  type="number" name="NT_CHIEUDAI" class="form-control" id="exampleInputEmail1" value="{{$edit_value->NT_CHIEUDAI}}" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều rộng</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input readonly type="number" name="NT_CHIEURONG" class="form-control"id="exampleInputEmail1" value="{{$edit_value->NT_CHIEURONG}}" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiều cao</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input readonly type="number" name="NT_CHIEUCAO" class="form-control" id="exampleInputEmail1" value="{{$edit_value->NT_CHIEUCAO}}" required="">
                                        <span style="margin-left: 15px;">mm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả chất liệu</label>
                                    <textarea readonly style="resize: none"  rows="8" class="form-control" name="NT_MOTACHATLIEU" id="ckeditor1" required="">{{$edit_value->NT_MOTACHATLIEU}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <div style="display: flex; align-items: baseline;">
                                        <input readonly type="text" name="NT_GIA" class="form-control" id="exampleInputEmail1" required="" value="{{$edit_value->NT_GIA}}" pattern="[0-9]+">
                                        <span style="margin-left: 10px;">VNĐ</span>
                                    </div>
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
                                    <label for="exampleInputPassword1">Loại nội thất</label>
                                      <select readonly name="LNT_MA" class="form-control input-sm m-bot15">
                                        @foreach($type_product as $key => $type)
                                            @if($type->LNT_MA==$edit_value->LNT_MA)
                                            <option selected value="{{$type->LNT_MA}}">{{$type->LNT_TEN}}</option>
                                            @else
                                            <option value="{{$type->LNT_MA}}">{{$type->LNT_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select readonly name="NCC_MA" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            @if($brand->NCC_MA==$edit_value->NCC_MA)
                                            <option selected value="{{$brand->NCC_MA}}">{{$brand->NCC_TEN}}</option>
                                            @else
                                            <option value="{{$brand->NCC_MA}}">{{$brand->NCC_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            </div>
                            @endforeach
                            <hr>

                            <style>
                                #file-input, #file-input2 {
                                display: none;
                                }

                                .frame {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                width: 200px;
                                border: 3px solid white;
                                font-size: 60px;
                                font-weight: bold;
                                color: black;
                                cursor: pointer;
                                }

                                .frame:hover {
                                background-color: #f2f2f2;
                                }

                                label {
                                margin: 0;
                                }
                            </style>

                            <div class="position-center">
                                <label for="exampleInputPassword1">Ảnh bìa</label>
                                <?php
                                    $cover_img_check = Session::get('cover_img_check');
                                ?>
                                <form role="form" action="{{URL::to('/update-image/'.$NT_MA)}}" method="post" enctype= "multipart/form-data">
                                    {{csrf_field() }}
                                    <input type="hidden" name="HANT_TEN" id="exampleInputEmail1" required="" value="<?php echo $NT_MA.'-1' ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @if($cover_img_check != 0)
                                                @foreach($cover_img as $key => $cover)
                                                <input required=""  type="hidden" name="HANT_DUONGDAN" disabled value="{{$cover->HANT_DUONGDAN}}" class="form-control" id="exampleInputEmail1">
                                                <div class="container">
                                                    <label for="file-input">
                                                        <img class="frame" src="../public/frontend/img/noithat/{{$cover->HANT_DUONGDAN}}" id="img-preview" src="" alt="Image Preview">
                                                        <input required=""  type="file" name="HANT_DUONGDAN" class="form-control"  id="file-input">
                                                    </label>
                                                </div>
                                                @endforeach  
                                            @else
                                                <input required=""  type="hidden" name="HANT_DUONGDAN" disabled value="" class="form-control" id="exampleInputEmail1">
                                                <div class="container">
                                                    <label for="file-input">
                                                        <img class="frame" src="../public/backend/images/add.png" id="img-preview" src="" alt="Image Preview">
                                                        <input required="" type="file" name="HANT_DUONGDAN" class="form-control"  id="file-input">
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" name="update_cover_img" style="width:100%" class="btn btn-success btn-sm">Thêm/cập nhật ảnh bìa</button>
                                            @if($cover_img_check != 0)
                                                <span> (Mã: {{$cover->HANT_MA}}, đường dẫn: {{$cover->HANT_DUONGDAN}}) </span>
                                            @endif
                                        </div>
                                    </div>
                                </form> 
                            </div>
                            <hr>
                            <div class="position-center">
                            <label for="exampleInputPassword1">Ảnh khác</label>
                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                        <tr>
                                            <th>Mã</th>
                                            <th>Đường dẫn</th>
                                            <th>Hình ảnh nội thất</th>
                                            <th style="width:30px;"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($another_img as $key => $another)
                                        <tr>
                                            <td>{{$another->HANT_MA}}</td>
                                            <td>{{$another->HANT_DUONGDAN}}</td>
                                            <td><img src="../public/frontend/img/noithat/{{$another->HANT_DUONGDAN}}" width="150"></td>
                                            <td>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-image/'.$another -> HANT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            
                                <form role="form" action="{{URL::to('/update-image/'.$NT_MA)}}" method="post" enctype= "multipart/form-data">
                                    {{csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Đường dẫn hình ảnh nội thất</label>
                                                <input required="" type="hidden" name="HANT_DUONGDAN" disabled value="" class="form-control" id="exampleInputEmail1">
                                                <div class="container">
                                                    <label for="file-input2">
                                                        <img class="frame" src="../public/backend/images/add.png" id="img-preview2" src="" alt="Image Preview">
                                                        <input required="" type="file" name="HANT_DUONGDAN" class="form-control" id="file-input2" required="">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tên hình ảnh nội thất</label>
                                                <input type="text" name="HANT_TEN" class="form-control" id="exampleInputEmail1" required=""  value="<?php echo $NT_MA.'-' ?>" pattern = "^(?!.*-1)\d+-\d+$">
                                            </div>
                                            
                                            <button type="submit" name="update_another_img" style="width:100%" class="btn btn-success btn-sm">Thêm/cập nhật ảnh khác</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

<script>
    const fileInput = document.getElementById('file-input');
    const imgPreview = document.getElementById('img-preview');

    fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', (event) => {
        imgPreview.src = event.target.result;
    });

    reader.readAsDataURL(file);
    }); 
    //------
    const fileInput2 = document.getElementById('file-input2');
    const imgPreview2 = document.getElementById('img-preview2');

    fileInput2.addEventListener('change', (event) => {
    const file2 = event.target.files[0];
    const reader2 = new FileReader();

    reader2.addEventListener('load', (event) => {
        imgPreview2.src = event.target.result;
    });

    reader2.readAsDataURL(file2);
    });

</script>
@endsection
            