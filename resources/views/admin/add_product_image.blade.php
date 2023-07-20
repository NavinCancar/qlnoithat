@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm hình ảnh sách
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
                                <form role="form" action="{{URL::to('/save-product-image')}}" method="post" enctype= "multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hình ảnh sách</label>
                                    <input type="text" name="HAS_TEN" class="form-control" id="exampleInputEmail1" placeholder="Tên hình ảnh sách" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đường dẫn hình ảnh sách</label>
                                    <input type="file" name="HAS_DUONGDAN" class="form-control" id="exampleInputEmail1" placeholder="Tên hình ảnh sách" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh của sách</label>
                                      <select name="SACH_MA" class="form-control input-sm m-bot15" required="">
                                        @foreach($product as $key => $prod)
                                            <option value="{{$prod->SACH_MA}}">{{$prod->SACH_TEN}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                        
                                
                                <button type="submit" name="add_product_image" class="btn btn-info">Thêm hình ảnh sách</button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection
            