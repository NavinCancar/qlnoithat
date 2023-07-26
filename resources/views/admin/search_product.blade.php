@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nội thất
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-7 m-b-xs">
        <?php
          $message = Session::get('message');
          if($message){
              echo '<span class="text-alert text-warning">'.$message.'</span></br>';
              Session::put('message',null);
          }
        ?>
        <?php
            $count= Session::get('count_product');
            if ($count) {
              echo "Tổng số dòng dữ liệu: ".$count;
              }
        ?>
      </div>
      <div class="col-sm-2">
        <p>Tìm nội thất:</p>
      </div>
      <div class="col-sm-3">
        <div class="input-group">
        <form class="d-flex" action="{{ URL::to('/search-product') }}" method="POST">
          {{ csrf_field() }}
            <input type="text" class="input-sm form-control" name="keywords_submit" style="width: 70%; margin: 0 10px" placeholder="Nhập nội thất cần tìm...">
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search icon-white"></i></a></button>
          </form>
        </div>
      </div>
    </div>
    <i>Chú ý: Nếu nội thất có có ảnh trên danh sách sẽ không dược hiển thị trên hệ thống!</i>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  <th>Mã</th>
                  <th>Tên nội thất</th>
                  <th>Ảnh nội thất</th>
                  <th>Loại nội thất</th>
                  <th>Nhà cung cấp</th>
                  <th>Giá nội thất</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th style="width:60px;"></th>
                </tr>
              </thead>
              <tbody>
              @foreach($search_product as $key => $search)
                <tr>
                  <td>{{$search->NT_MA }}</td>
                  <td>{{$search->NT_TEN}}</td>
                  <td>
                    @foreach($img_product as $key => $img)
                      @if ($search->NT_MA == $img->NT_MA)
                        <img src="public/frontend/img/noithat/{{$img->HANT_DUONGDAN}}" width="100">
                      @endif
                    @endforeach
                  </td>
                  <td>{{$search->LNT_TEN }}</td>
                  <td>{{$search->NCC_TEN }}</td>
                  <td>{{number_format($search->NT_GIA)}} VNĐ</td>
                  <td>{{$search->NT_NGAYTAO}}</td>
                  <td>{{$search->NT_NGAYCAPNHAT}}</td>
                  <td>
                    <a href="{{URL::to('/product-detail/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-info-circle text-primary text-active"></i></a>
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-google text-warning text-active"></i></a>
                    <a href="{{URL::to('/edit-product/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-product/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
          <footer class="panel-footer">
            <div class="row">

              <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
              </div>
              <div class="col-sm-7 text-right text-center-xs">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                  <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                  <li><a href="">1</a></li>
                  <li><a href="">2</a></li>
                  <li><a href="">3</a></li>
                  <li><a href="">4</a></li>

                  <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>
          </footer>
        </div>
      </div>
      @endsection
