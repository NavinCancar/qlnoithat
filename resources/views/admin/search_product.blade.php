@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      KẾT QUẢ TÌM KIẾM  NỘI THẤT
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
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
              echo "<p>Tổng số dòng dữ liệu: ".$count.'</p>';
            }
            $cv= Session::get('CV_MA_User');
        ?>
      </div>
      <div class="col-sm-5">
        <div class="input-group d-flex">
        <form class="d-flex" action="{{ URL::to('/search-product') }}" method="POST">
            {{ csrf_field() }}
            <span>Tìm nội thất:</span>
            <input type="text" class="input-sm form-control" name="keywords_submit" style="width: auto; float:none" placeholder="Nhập nội thất cần tìm...">
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search icon-white"></i></a></button>
          </form>
        </div>
      </div>
      <div class="col-sm-3 m-b-xs text-right">
        <div class="btn-group" style="width: 100%;">
          <a data-toggle="dropdown" href="#" class="btn btn-default btn-block">
            <p style="white-space: normal ;">PHÂN THEO LOẠI NỘI THẤT <i class="fa fa-angle-down "></i></p>
          </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item  text-center" href="{{ URL::to('/all-product')}}">- - Tất cả loại nội thất - -</a></li>
              @foreach($all_loai as $key => $loai)
              <li><a class="dropdown-item text-center" href="{{ URL::to('/phan-theo-loai/'. $loai->LNT_MA) }}">{{ $loai->LNT_TEN }}</a></li>
              @endforeach
          </ul>
        </div>             
      </div>
    </div>
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
                    @if($cv==1)
                      <a href="{{URL::to('/product-detail/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-info-circle text-primary text-active"></i></a>
                      @endif
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-google text-warning text-active"></i></a>
                    @if($cv==1)
                      <a href="{{URL::to('/edit-product/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                      <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-product/'.$search -> NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                    @endif
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endsection
