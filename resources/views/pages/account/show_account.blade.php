@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Tài khoản</h2>
            <hr class="mx-auto">
   
    <div class="position-center">
    @foreach($account_info as $key => $account_info)
        <form role="form" action="#"  method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 center mb-3">
                <div class="form-group">
                    <p><label for="exampleInputEmail1"><b>Ảnh đại diện:</b></label></p>
                    <img style="height: 200px; width: 200px;" class="rounded-circle" src="public/frontend/img/khachhang/{{$account_info->KH_DUONGDANANHDAIDIEN}}">
                    <input type="hidden" name="KH_DUONGDANANHDAIDIEN" disabled value="{{$account_info->KH_DUONGDANANHDAIDIEN}}" class="form-control" id="exampleInputEmail1">
                    
                </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Họ tên:</b></label>
                        <input type="text" name="KH_HOTEN" disabled value="{{$account_info->KH_HOTEN}}" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Ngày sinh:</b></label>
                        <input type="text" name="KH_NGAYSINH" disabled value="{{$account_info->KH_NGAYSINH}}" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Giới tính:</b></label>
                        <input type="text" name="KH_GIOITINH" disabled value="{{$account_info->KH_GIOITINH}}" class="form-control" id="exampleInputEmail1">
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Số điện thoại:</b></label>
                <input type="text" name="KH_SODIENTHOAI" disabled value="{{$account_info->KH_SODIENTHOAI}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Địa chỉ:</b></label>
                <input type="text" name="KH_DIACHI" disabled value="{{$account_info->KH_DIACHI}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Email:</b></label>
                <input type="text" name="KH_EMAIL" disabled value="{{$account_info->KH_EMAIL}}" class="form-control" id="exampleInputEmail1">
            </div>

        </form>
    @endforeach
    </div>
    <a href="{{URL::to('/cap-nhat-tai-khoan')}}"><button type="button" style="width:100%" class="btn btn-info btn-sm">Cập nhật tài khoản</button></a>
    <br>
    <a href="{{URL::to('/trang-chu')}}"><button type="button" style="width:100%" class="btn btn-dark btn-sm">Quay về</button></a>
  </div>
</div>

@endsection