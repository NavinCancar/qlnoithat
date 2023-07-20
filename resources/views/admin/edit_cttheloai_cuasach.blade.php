@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thể loại của sách
                        </header>
                        <div class="panel-body">
                        @foreach($edit_cttheloai_cuasach as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-cttheloai-cuasach/sach='.$edit_value->SACH_MA.'&theloai='.$edit_value->TLS_MA)}}" method="post">
                                {{csrf_field() }}
                                <div class="form-group"> 
                                    <label for="exampleInputEmail1">Tên sách</label>
                                    <select name="sach" class="form-control input-sm m-bot15" required="">
                                        @foreach($sach as $key => $MS)
                                            
                                            @if($MS->SACH_MA==$edit_value->SACH_MA)
                                            <option selected value="{{$MS->SACH_MA}}">{{$MS->SACH_TEN}}</option>
                                            @else
                                            <option value="{{$MS->SACH_MA}}">{{$MS->SACH_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên thể loại</label>
                                      <select name="theloai" class="form-control input-sm m-bot15" required="">
                                        @foreach($theloai as $key => $TL)
                                            
                                            @if($TL->TLS_MA==$edit_value->TLS_MA)
                                            <option selected value="{{$TL->TLS_MA}}">{{$TL->TLS_TEN}}</option>
                                            @else
                                            <option value="{{$TL->TLS_MA}}">{{$TL->TLS_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                
                                <button type="submit" name="update_cttheloai_cuasach" class="btn btn-info">Cập nhật thể loại của sách</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            