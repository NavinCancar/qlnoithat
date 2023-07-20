@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật tác giả của sách
                        </header>
                        <div class="panel-body">
                        @foreach($edit_tacgia_cuasach as $key => $edit_value)
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-tacgia-cuasach/sach='.$edit_value->SACH_MA.'&tacgia='.$edit_value->TG_MA)}}" method="post">
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
                                    <label for="exampleInputPassword1">Tên tác giả</label>
                                      <select name="tacgia" class="form-control input-sm m-bot15" required="">
                                        @foreach($tacgia as $key => $MTG)
                                            
                                            @if($MTG->TG_MA==$edit_value->TG_MA)
                                            <option selected value="{{$MTG->TG_MA}}">{{$MTG->TG_HOTEN}}</option>
                                            @else
                                            <option value="{{$MTG->TG_MA}}">{{$MTG->TG_HOTEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                
                                <button type="submit" name="update_tacgia_cuasach" class="btn btn-info">Cập nhật tác giả của sách</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            