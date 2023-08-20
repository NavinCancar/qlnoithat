@extends('all-product')
 @section('content')
<section id="featured" class="my-3 py-3 row" >
        <div class="container mt-3 py-3">
            @foreach($category_name as $key => $name)
            <h3 class="font-weight-bold">{{ $name->LNT_TEN }}</h3>
            <?php
              $LNT_MA=$name->LNT_MA;
            ?>
            @endforeach
            <hr>
            <?php
                $chuoi_gia = Session::get('chuoi_gia');
                if($chuoi_gia){}
                else{$chuoi_gia="moi-nhat";}
            ?>
        </div>
        <div class="row mx-auto container-fluid col-lg-9 col-md-12 col-12">
            @foreach($category_by_id as $key => $product)
                <div class="product text-center col-lg-3 col-md-4 col-12">
                    <img class="img-fluid mb-3" src="../public/frontend/img/noithat/{{$product->HANT_DUONGDAN}}" alt="">

                    <div class="star">
                        <?php
                        // Create connection
                        $conn = new mysqli('localhost', 'root', '', 'qlnoithat');
                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }
                        $point = "select ROUND(AVG(DG_DIEM)) dg, COUNT('DG_MA') sl  from Danh_gia group by NT_MA having NT_MA ='".$product->NT_MA."'";
                        $result = $conn->query($point);
                        $dg=0; $sl=0;
                        while ($row = $result->fetch_assoc()) {
                            $dg= $row['dg']."<br>";
                            $sl= $row['sl'];
                        }
                        $x = 1;
                        for ($x = 1; $x <= $dg; $x++) {
                        echo '<i class="fas fa-star"></i>';
                        } 
                        echo '<i> ('.$sl.')</i>';
                        ?>
                    </div>
                    <h5 class="p-name">{{$product->NT_TEN}}</h5>
                    <h4 class="p-price">{{number_format($product->NT_GIA)}} VNĐ</h4>

                    <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}"><button class="buy-btn">XEM NGAY</button></a>
                </div>
            @endforeach
        </div>
        <!--Bộ lọc-->
        <div class=" col-lg-3 col-md-12 col-12">
            <ul class="list-group rounded-2">
                <li class="list-group-item center disabled text-bg-dark" ><h4>Danh mục sản phẩm</h4></li>
                <li class="list-group-item"  ><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/tat-ca&'.$chuoi_gia)}}" >- - Tất cả sản phẩm - -</a></li>
                @foreach($category as $key => $cate)
                <li class="list-group-item
                <?php
                if($cate->LNT_MA == $LNT_MA) echo 'bg-active'
                ?>
                "><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'. $cate->LNT_MA.'&'.$chuoi_gia) }}">{{ $cate->LNT_TEN }}</a></li>
                @endforeach
            </ul>
            <ul class="list-group rounded-2 pt-5">
                <li class="list-group-item center disabled text-bg-dark" ><h4>Bộ lọc</h4></li>
                <li class="list-group-item <?php if($chuoi_gia=='moi-nhat') echo'bg-active';?>"><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'.$LNT_MA.'&moi-nhat')}}" >Mới nhất</a></li>
                <li class="list-group-item <?php if($chuoi_gia=='cu-nhat') echo'bg-active';?>"><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'.$LNT_MA.'&cu-nhat')}}" >Cũ nhất</a></li>
                <li class="list-group-item <?php if($chuoi_gia=='thap-len-cao') echo'bg-active';?>"><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'.$LNT_MA.'&thap-len-cao')}}" >Sắp xếp từ thấp lên cao</a></li>
                <li class="list-group-item <?php if($chuoi_gia=='cao-xuong-thap') echo'bg-active';?>"><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'.$LNT_MA.'&cao-xuong-thap')}}" >Sắp xếp từ cao xuống thấp</a></li>
            </ul>
            <ul class="list-group rounded-2 pt-5">
                <li class="list-group-item center disabled text-bg-dark" ><h4>Lọc theo khoảng giá</h4></li>
                <li class="list-group-item">
                    <form role="form" action="{{URL::to('/loc-gia&'.$LNT_MA.'&'.$chuoi_gia)}}"  method="post" enctype= "multipart/form-data">
                        {{ csrf_field() }}
                        <div class="d-flex">
                            <span>Từ&emsp;</span>
                            <input type="number" name="GiaThapNhat" class="form-control" placeholder="Mức giá thấp nhất" required="" min="0">
                        </div>
                        <div class="d-flex">
                            <span>Đến&ensp;</span>
                            <input type="number" name="GiaCaoNhat" class="form-control" placeholder="Mức giá cao nhất" required="" min="0">
                        </div>
                        <button type="submit" style="width:100%" class="btn btn-dark btn-sm">Tiến hành lọc</button>
                    </form>
                </li>
            </ul>
        </div>
         <!--icon thu tu-->
         <nav aria-label="Page navigation">
          <ul class="justify-content-center pagination mt-5">
              {{-- Previous Page Link --}}
              @if ($category_by_id->onFirstPage())
                  <li class="page-item disabled">
                      <a class="page-link" href="#">Previous</a>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link shop-nav" href="{{ $category_by_id->previousPageUrl() }}">Previous</a>
                  </li>
              @endif
              {{-- Pagination Elements --}}
              @for ($key=0; $key+1<=$category_by_id->lastPage(); $key++)
                    @if ($category_by_id->currentPage() === $key + 1)
                        <li class="page-item">
                            <a class="page-link bg-active shop-nav" href="{{ $category_by_id->url($key + 1) }}">{{ $key + 1 }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link shop-nav" href="{{ $category_by_id->url($key + 1) }}">{{ $key + 1 }}</a>
                        </li>
                    @endif
              @endfor
          
              {{-- Next Page Link --}}
              @if ($category_by_id->hasMorePages())
                  <li class="page-item">
                      <a class="page-link shop-nav" href="{{ $category_by_id->nextPageUrl() }}">Next</a>
                  </li>
              @else
                  <li class="page-item disabled">
                      <a class="page-link" href="#">Next</a>
                  </li>
              @endif
          </ul>
      </nav>
    </section> 
@endsection
