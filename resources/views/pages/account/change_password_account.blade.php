@extends('welcome')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
            <h2 class="text-center font-weight-bold pt-3">Đổi mật khẩu</h2>
            <hr class="mx-auto">
            <?php
                $message= Session::get('message');
                if($message){
                    echo '<div class="text-notice mb-3">'.$message.'</div>';
                    Session::put('message', null);
                }
            ?>
    <div class="position-center">
    <form role="form" action="{{URL::to('/update-mat-khau')}}" method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Mật khẩu mới:</b></label>
                        <input type="password" name="KH_MATKHAUMOI1" class="form-control" id="exampleInputEmail1" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Nhập lại mật khẩu mới:</b></label>
                        <input type="password" name="KH_MATKHAUMOI2" class="form-control" id="exampleInputEmail1" required="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 mb-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Mật khẩu cũ:</b></label>
                        <input type="password" name="KH_MATKHAUCU" class="form-control" id="exampleInputEmail1" required="">
                    </div>
                    <button type="submit" style="width:100%" class="btn btn-info btn-sm">Đổi mật khẩu</button>
                    <a href="{{URL::to('/doi-mat-khau')}}"><button type="button" style="width:100%" class="btn btn-dark btn-sm">Quay về</button></a>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

@endsection