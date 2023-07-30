@extends('admin-layout-detail')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật chi tiết lô nhập
                        </header>
                        <div class="panel-body">
                        @foreach($edit_lonhap as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-warning">'.$message.'</span>';
                                Session::put('message',null); 
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-chitiet-lonhap/lo='.$edit_value->LN_MA.'&nothat='.$edit_value->NT_MA)}}" method="post">
                                    {{csrf_field() }}
                                    <div class="form-group"> 
                                    <label for="exampleInputEmail1">Mã lô nhập</label>
                                      <select disabled name="lonhap_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($lonhap_product as $key => $malonhap)
                                           

                                            @if($malonhap->LN_MA==$edit_value->LN_MA)
                                            <option selected value="{{$malonhap->LN_MA}}">{{$malonhap->LN_MA}}</option>
                                            @else
                                            <option value="{{$malonhap->LN_MA}}">{{$malonhap->LN_MA}}</option>
                                            @endif
                                       
                                        @endforeach
                                            


                                    </select>
                                </div>

                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Tên nội thất nhập</label>
                                      <select  disabled name="mant_product_name" class="form-control input-sm m-bot15" required="">
                                        @foreach($noithat as $key => $nt)
                                            
                                               
                                            @if($nt->NT_MA==$edit_value->NT_MA)
                                            <option selected value="{{$nt->NT_MA}}">{{$nt->NT_TEN}}</option>
                                            @else
                                            <option value="{{$nt->NT_MA}}">{{$nt->NT_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" value="{{$edit_value->CTLN_SOLUONG}}" name="soluong_product_name" class="form-control" id="exampleInputEmail1" placeholder="Số lượng" required=""  pattern="[0-9]+">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" value="{{$edit_value->CTLN_GIA}}" name="gia_product_name" class="form-control" id="exampleInputEmail1" placeholder="Giá" required=""  pattern="[0-9]+">
                                </div>
                                
                                <button type="submit" name="add_chitiet_lonhap"  style="width:100%" class="btn btn-success">Cập nhật chi tiết lô nhập</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            