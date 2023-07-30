@extends('admin-layout-detail')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật trạng thái đơn hàng
                        </header>
                        <div class="panel-body">
                        @foreach($edit_order as $key => $edit_value)
                            <div class="position-center">

                                <form role="form" action="{{URL::to('/update_status/ddh='.$edit_value->DDH_MA.'&tt='.$edit_value->TT_MA)}})}}" method="post">
                                    {{csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã đơn đặt hàng</label>
                                    <input type="text" disabled value="{{$edit_value->DDH_MA}}" name="DDH_MA" class="form-control" id="exampleInputEmail1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên trạng thái</label>
                                      <select name="TT_MA" class="form-control input-sm m-bot15" required="">

                                        @foreach($trangthai as $key => $tt)
                                            
                                            @if($tt->TT_MA==$edit_value->TT_MA)
                                            <option selected value="{{$tt->TT_MA}}">{{$tt->TT_TEN}}</option>
                                            @elseif($tt->TT_MA<$edit_value->TT_MA)

                                            @else
                                            <option value="{{$tt->TT_MA}}">{{$tt->TT_TEN}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_employee"  style="width:100%" class="btn btn-success">Cập nhật trạng thái đơn đặt hàng</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            