@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm chi tiết thể loại sách
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
                                <form role="form" action="{{URL::to('/save-cttheloai-cuasach')}}" method="post">
                                    {{csrf_field() }}
                                <!--div class="form-group">
                                    <label for="exampleInputPassword1">Mã lô nhập</label>
                                    <input type="text" name="maln_product_name" class="form-control" id="exampleInputEmail1" placeholder="Mã lô nhập">
                                </div>-->
                                
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Sách</label>
                                      <select name="MASACH" class="form-control input-sm m-bot15" required="">
                                        @foreach($MASACH as $key => $MS)
                                            <option value="{{$MS->SACH_MA}}">{{$MS->SACH_TEN}}</option> 
                                            
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Thể loại</label>
                                      <select name="TLS_MA" class="form-control input-sm m-bot15" required="">
                                        //@foreach($TLS_MA as $key => $TL)
                                            <option value="{{$TL->TLS_MA}}">{{$TL->TLS_TEN}}</option> 
                                            
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add-cttheloai-cuasach" class="btn btn-info">Thêm thể loại của sách</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            