@extends('welcome')
 @section('content')
<section id="featured" class="my-3 py-3 row" >
    <div class="container mt-3 py-3">
        <h2 class="font-weight-bold">Kết quả tìm kiếm</h2>
        <hr>
    </div>
        <div class="row mx-auto container-fluid col-lg-9 col-md-12 col-12">
            @foreach($search_product as $key => $product)
            <div class="product text-center col-lg-3 col-md-4 col-12">
                
                    <img class="img-fluid mb-3" src="public/frontend/img/sach/{{$product->HAS_DUONGDAN}}" alt="">

                    <div class="star">
                        <?php
                          // Create connection
                          $conn = new mysqli('localhost', 'root', '', 'qlchsach');
                          // Check connection
                          if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                          }
                          $point = "select ROUND(AVG(DG_DIEM)) dg from Danh_gia group by SACH_MA having SACH_MA ='".$product->SACH_MA."'";
                          $result = $conn->query($point);
                          //$dg='';
                          $dg=0;
                          while ($row = $result->fetch_assoc()) {
                              $dg= $row['dg']."<br>";
                          }
                          $x = 1;
                          for ($x = 1; $x <= $dg; $x++) {
                          echo '<i class="fas fa-star"></i>';
                          }
                        ?>
                    </div>
                    <h5 class="p-name">{{$product->SACH_TEN}}</h5>
                    <h4 class="p-price">{{number_format($product->SACH_GIA)}} đ</h4>

                    <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->SACH_MA) }}"><button class="buy-btn">MUA NGAY</button></a>
                </div>
            
            @endforeach
        </div>
    </section>
@endsection
