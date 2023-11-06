@extends('welcome')
 @section('content')
<section id="featured" class="my-3 py-3 row" >
    <div class="container mt-3 py-3">
        <h3 class="font-weight-bold">Kết quả tìm kiếm</h3>
        <hr>
    </div>
        <div class="row mx-auto container-fluid col-lg-9 col-md-10 col-12">
            @foreach($search_product as $key => $product)
            <div class="product text-center col-lg-3 col-md-4 col-12">
                
                    <img class="img-fluid mb-3" src="public/frontend/img/noithat/{{$product->HANT_DUONGDAN}}" alt="">

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

                    <div class="row">
                        <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}" class="col-8 p-0" style="text-decoration: none;">
                            <button class="buy-btn btn-block "><i class="fa-solid fa-eye"></i> XEM</button>
                        </a>
                        <form action="{{URL::to('/save-cart')}}" method="POST" class="col-4 p-0">
                            {{ csrf_field() }}
                            <input name="qty" type="hidden" value="1">
                            <input name="productid_hidden" type="hidden" value="{{$product->NT_MA}}" />
                            <button type="submit" class="cart-btn btn-block"><i class="fa-solid fa-shopping-cart"></i></button>
                        </form>
                    </div>
                </div>
            
            @endforeach
        </div>
    </section>
@endsection
