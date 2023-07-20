@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật chi tiết lô xuất
                        </header>
                        <div class="panel-body">
                        @foreach($edit_loxuat as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null); 
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-chitiet-loxuat/lo='.$edit_value->LX_MA.'&sach='.$edit_value->SACH_MA)}}" method="post">
                                    {{csrf_field() }}
                                    <div class="form-group"> 
                                    <label for="exampleInputEmail1">Mã lô xuất</label>
                                      <select disabled name="loxuat_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($loxuat_product as $key => $maloxuat)
                                           

                                            @if($maloxuat->LX_MA==$edit_value->LX_MA)
                                            <option selected value="{{$maloxuat->LX_MA}}">{{$maloxuat->LX_MA}}</option>
                                            @else
                                            <option value="{{$maloxuat->LX_MA}}">{{$maloxuat->LX_MA}}</option>
                                            @endif
                                       
                                        @endforeach
                                            


                                    </select>
                                </div>

                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Tên sách xuất</label>
                                      <select disabled name="masach_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($sach as $key => $masach)
                                            
                                               
                                            @if($masach->SACH_MA==$edit_value->SACH_MA)
                                            <option selected value="{{$masach->SACH_MA}}">{{$masach->SACH_TEN}}</option>
                                            @else
                                            <option value="{{$masach->SACH_MA}}">{{$masach->SACH_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" value="{{$edit_value->CTLX_SOLUONG}}" name="soluong_product_name" class="form-control" id="exampleInputEmail1" placeholder="Số lượng" required=""  pattern="[0-9]+">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" value="{{$edit_value->CTLX_GIA}}" name="gia_product_name" class="form-control" id="exampleInputEmail1" placeholder="Giá" required=""  pattern="[0-9]+">
                                </div>
                                
                                <button type="submit" name="add_chitiet_loxuat" class="btn btn-info">Cập nhật chi tiết lô xuất</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            