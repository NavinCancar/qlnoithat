@extends('admin-layout')
@section('admin-content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Quản lý phí ship
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
    @foreach($dc as $key => $edit_value)
        <form role="form" action="{{URL::to('/update_feeship/'.$edit_value -> XP_MA)}}"  method="post" enctype= "multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Tên tỉnh/thành phố:</b></label>
                <input type="text" disabled name="TTP_MA" value="{{$edit_value->TTP_TEN}}" class="form-control" id="exampleInputEmail1" required="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Tên huyện/quận:</b></label>
                <input type="text" disabled name="HQ_MA" value="{{$edit_value->HQ_TEN}}" class="form-control" id="exampleInputEmail1" required="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Tên xã/phường:</b></label>
                <input type="text" disabled name="XP_MA" value="{{$edit_value->XP_TEN}}" class="form-control" id="exampleInputEmail1" required="">
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Phí ship:</b></label>
                <input type="text" name="XP_CHIPHIGIAOHANG" value="{{$edit_value->XP_CHIPHIGIAOHANG}}" class="form-control" placeholder="Số nhà" required=""  pattern="[0-9]+">
            </div>                
            <button type="submit" name="save_location" class="btn btn-info ">Cập nhật phí ship</button>
        </form>
        @endforeach
    </div>
</div>

@endsection
            