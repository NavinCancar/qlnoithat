@extends('admin-layout')
@section('admin-content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nhân viên
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
                                <form role="form" action="{{URL::to('/save-employee')}}" method="post" enctype= "multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="NV_HOTEN" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chức vụ</label>
                                      <select name="CV_MA" class="form-control input-sm m-bot15" required="">
                                        @foreach($position as $key => $pos)
                                            <option value="{{$pos->CV_MA}}">{{$pos->CV_TEN}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="NV_SODIENTHOAI" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="" pattern="[0-9]{10,11}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" name="NV_DIACHI" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" name="NV_NGAYSINH" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên"  max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input type="text" name="NV_GIOITINH" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="NV_EMAIL" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh đại diện</label>
                                    <style>
                                        #file-input-f {
                                        display: none;
                                        }

                                        .circle {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 200px;
                                        width: 200px;
                                        border-radius: 50%;
                                        border: 3px solid white;
                                        font-size: 60px;
                                        font-weight: bold;
                                        color: black;
                                        cursor: pointer;
                                        }

                                        .circle:hover {
                                        background-color: #f2f2f2;
                                        }

                                        label {
                                        margin: 0;
                                        }
                                    </style>
                    
                                    <div class="container">
                                        <label for="file-input-f" >
                                            <img class="circle" src="{{URL::to('public/backend/images/nhanvien/macdinh.png')}}" height="200" width="200" id="img-preview" src="" alt="Image Preview">
                                            <input type="file" name="NV_DUONGDANANHDAIDIEN" class="form-control" id="file-input-f">

                                        </label>
                                    </div>
                                </div>
                            
                                <button type="submit" name="add_employee"  style="width:100%" class="btn btn-success">Thêm nhân viên</button>
                            </form>
                            </div>
                        </div>
                    </section>

<script>
    const fileInput = document.getElementById('file-input-f');
    const imgPreview = document.getElementById('img-preview');

    fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', (event) => {
        imgPreview.src = event.target.result;
    });

    reader.readAsDataURL(file);
    });
</script>
@endsection
            