@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm lô nhập
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
                                <form role="form" action="{{URL::to('/save-lonhap')}}" method="post">
                                    {{csrf_field() }}
                                <!--div class="form-group">
                                    <label for="exampleInputPassword1">Mã lô nhập</label>
                                    <input type="text" name="maln_product_name" class="form-control" id="exampleInputEmail1" placeholder="Mã lô nhập">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày nhập lô</label>
                                    <input type="Date" name="ngaynhap_product_name" class="form-control" id="exampleInputEmail1" placeholder="Ngày nhập lô" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung lô</label>
                                    <input type="text" name="noidung_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nội dung lô nhập" required="">
                                </div>
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Nhân viên</label>
                                      <select name="manv_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($nvien as $key => $nv)
                                            <option value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option> 
                                            
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_lonhap" class="btn btn-info">Thêm lô nhập</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            