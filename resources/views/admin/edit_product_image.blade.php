@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật hình ảnh nội thất
                        </header>
                        <div class="panel-body">
                            @foreach($edit_product_image as $key => $edit_value)
                           
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product-image/'.$edit_value->HAS_MA)}}" method="post" enctype= "multipart/form-data">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hình ảnh nội thất</label>
                                    <input type="text" name="HAS_TEN" class="form-control" id="exampleInputEmail1" value="{{$edit_value->HAS_TEN}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đường dẫn hình ảnh nội thất</label>
                                    <input type="file" name="HAS_DUONGDAN" class="form-control" id="exampleInputEmail1" placeholder="Tên hình ảnh nội thất">
                                    <br>
                                    <span><label for="exampleInputEmail1">Đường dẫn hình ảnh nội thất ban đầu: </label> {{$edit_value->HAS_DUONGDAN}} => </span>
                                    <img src="{{URL::to('public/frontend/img/noithat/'.$edit_value->HAS_DUONGDAN)}}" height="100" width="100">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh của nội thất</label>
                                      <select name="NT_MA" class="form-control input-sm m-bot15" required="">
                                        @foreach($product as $key => $prod)
                                            
                                            @if($prod->NT_MA==$edit_value->NT_MA)
                                            <option selected value="{{$prod->NT_MA}}">{{$prod->NT_TEN}}</option>
                                            @else
                                            <option value="{{$prod->NT_MA}}">{{$prod->NT_TEN}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                
                                
                                <button type="submit" name="update_product_image" class="btn btn-info">Cập nhật hình ảnh nội thất</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
@endsection
            