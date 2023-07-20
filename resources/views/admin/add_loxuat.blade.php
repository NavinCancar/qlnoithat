@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm lô xuất
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
                                <form role="form" action="{{URL::to('/save-loxuat')}}" method="post">
                                    {{csrf_field() }}
                                <!--div class="form-group">
                                    <label for="exampleInputPassword1">Mã lô xuất</label>
                                    <input type="text" name="malx_product_name" class="form-control" id="exampleInputEmail1" placeholder="Mã lô xuất">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày xuất lô</label>
                                    <input type="Date" name="ngayxuat_product_name" class="form-control" id="exampleInputEmail1" placeholder="Ngày lô xuất" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung lô</label>
                                    <input type="text" name="noidung_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nội dung lô xuất" required="">
                                </div>
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Nhân viên</label>
                                      <select name="manv_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($nvien as $key => $nv)
                                            <option value="{{$nv->NV_MA}}">{{$nv->NV_HOTEN}}</option> 
                                            
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_loxuat" class="btn btn-info">Thêm lô xuất</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            