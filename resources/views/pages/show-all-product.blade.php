@extends('all-product')
@section('content')
<section id="featured" class="my-3 py-3 row" >
        <div class="container mt-3 py-3">
            <h2 class="font-weight-bold">SẢN PHẨM</h2>
            <hr>
        </div>
        <div class="row mx-auto container-fluid col-lg-9 col-md-12 col-12">
            @foreach($all_product as $key => $product)
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
                    <h4 class="p-price">{{number_format($product->NT_GIA)}} đ</h4>
                    <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}"><button class="buy-btn">XEM NGAY</button></a>
                </div>
            @endforeach
        </div>
        <div class=" col-lg-3 col-md-12 col-12">
            <ul class="list-group rounded-2">
                <li class="list-group-item center disabled text-bg-dark" ><h4>Danh mục sản phẩm</h4></li>
                <li class="list-group-item bg-active"  ><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/tat-ca')}}" >- - Tất cả sản phẩm - -</a></li>
                @foreach($category as $key => $cate)
                <li class="list-group-item"><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'. $cate->LNT_MA) }}">{{ $cate->LNT_TEN }}</a></li>
                @endforeach
            </ul>
        </div>
        <!--icon thu tu-->
        <nav aria-label="...">
            <ul class="pagination mt-5">
              <li class="page-item disabled">
                <a class="page-link ">Previous</a>
              </li>
              <li class="page-item "><a class="page-link bg-active shop-nav" href="#">1</a></li>
              <li class="page-item" aria-current="page">
                <a class="page-link shop-nav" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link shop-nav" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link shop-nav" href="#">Next</a>
              </li>
            </ul>
          </nav>

    </section>
@endsection

