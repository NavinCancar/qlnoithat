@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm tác giả của sách
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
                                <form role="form" action="{{URL::to('/save-tacgia-cuasach')}}" method="post">
                                    {{csrf_field() }}
                                <!--div class="form-group">
                                    <label for="exampleInputPassword1">Mã lô nhập</label>
                                    <input type="text" name="maln_product_name" class="form-control" id="exampleInputEmail1" placeholder="Mã lô nhập">
                                </div>-->
                                
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Sách</label>
                                      <select name="sach" class="form-control input-sm m-bot15" required="">
                                        @foreach($sach as $key => $MS)
                                            <option value="{{$MS->SACH_MA}}">{{$MS->SACH_TEN}}</option> 
                                            
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Tác giả</label>
                                      <select name="tacgia" class="form-control input-sm m-bot15" required="">
                                        @foreach($tacgia as $key => $MTG)
                                            <option value="{{$MTG->TG_MA}}">{{$MTG->TG_HOTEN}}</option> 
                                            
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                <button type="submit" name="add-tacgia-cuasach" class="btn btn-info">Thêm tác giả của sách</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            