@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Cập nhật tài khoản</h2>
            <hr class="mx-auto">
   
    <div class="position-center">
    @foreach($account_info as $key => $account_info)
    <form role="form" action="{{URL::to('/update-tai-khoan')}}" method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 center mb-3">
                <div class="form-group">
                    <p><label for="exampleInputEmail1"><b>Ảnh đại diện:</b></label></p>
                    <input type="hidden" name="KH_DUONGDANANHDAIDIEN" disabled value="{{$account_info->KH_DUONGDANANHDAIDIEN}}" class="form-control" id="exampleInputEmail1">
                    <style>
                        #file-input {
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
                    <label for="file-input" >
                        <img class="circle" src="public/frontend/img/khachhang/{{$account_info->KH_DUONGDANANHDAIDIEN}}" id="img-preview" src="" alt="Image Preview">
                        <input type="file" name="KH_DUONGDANANHDAIDIEN" class="form-control"  id="file-input">
                    </label>

                    </div>
                    <!--<input type="file" name="KH_DUONGDANANHDAIDIEN" class="form-control" >-->
                </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Họ tên:</b></label>
                        <input type="text" name="KH_HOTEN" value="{{$account_info->KH_HOTEN}}" class="form-control" id="exampleInputEmail1" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Ngày sinh:</b></label>
                        <input type="date" name="KH_NGAYSINH" value="{{$account_info->KH_NGAYSINH}}" class="form-control" id="exampleInputEmail1" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Giới tính:</b></label>
                        <input type="text" name="KH_GIOITINH" value="{{$account_info->KH_GIOITINH}}" class="form-control" id="exampleInputEmail1" required="">
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Số điện thoại:</b></label>
                <input type="text" name="KH_SODIENTHOAI" value="{{$account_info->KH_SODIENTHOAI}}" class="form-control" id="exampleInputEmail1"required=""  pattern="[0-9]{10,11}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Địa chỉ:</b></label>
                <input type="text" name="KH_DIACHI" value="{{$account_info->KH_DIACHI}}" class="form-control" id="exampleInputEmail1" required="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Email:</b></label>
                <input type="text" name="KH_EMAIL" value="{{$account_info->KH_EMAIL}}" class="form-control" id="exampleInputEmail1" required=""  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
            </div>
            <button type="submit" style="width:100%" class="btn btn-info btn-sm">Lưu cập nhật</button>
        </form>
    @endforeach
    </div>
    <a href="{{URL::to('/tai-khoan')}}"><button type="button" style="width:100%" class="btn btn-dark btn-sm">Quay về</button></a>
  </div>
</div>
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


</script>

@endsection