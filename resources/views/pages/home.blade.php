@extends('welcome')
 @section('content')
 <div class="row mx-auto pt-1 pb-5">
        <div style="background-color:#fff" class="center">
            <img src="{{('public/frontend/img/banner/bannertop.png')}}" id="top_banner_phone" alt="" width="100%"/>
        </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-10 ">
                <!-- Carousel -->
                <div id="demo" class="carousel slide " data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner ">
                        <div class="carousel-item active">
                            <img src="{{('public/frontend/img/banner/banner1.png')}}"
                                class="d-block w-100 rounded-2 ">
                        </div>
                        <div class="carousel-item">
                            <img src="{{('public/frontend/img/banner/banner2.png')}}"
                                class="d-block w-100 rounded-2 ">
                        </div>
                        <div class="carousel-item">
                            <img src="{{('public/frontend/img/banner/banner3.png')}}"
                                class="d-block w-100 rounded-2 ">
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev carousel-button" type="button" data-bs-target="#demo"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next carousel-button" type="button" data-bs-target="#demo"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
 <!-- Mat hang -->
 <section id="clothes" class="my-5">
            <div class="container text-center mt-5 py-1">
                <h3>NỘI THẤT HOT NHẤT</h3>
                <hr class="mx-auto">
            </div>    
               
            <div class="row mx-auto container-fluid">
                @foreach($hot_product as $key => $hot)
                <div class="product text-center col-lg-3 col-md-4 col-12">
                    <img class="img-fluid mb-3" src="public/frontend/img/noithat/{{$hot->HANT_DUONGDAN}}" alt="">

                    <div class="star">
                        <?php
                        // Create connection
                        $conn = new mysqli('localhost', 'root', '', 'qlnoithat');
                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }
                        $point = "select ROUND(AVG(DG_DIEM)) dg, COUNT('DG_MA') sl from Danh_gia group by NT_MA having NT_MA ='".$hot->NT_MA."'";
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
                    <h5 class="p-name">{{$hot->NT_TEN}}</h5>
                    <h4 class="p-price">{{number_format($hot->NT_GIA)}} VNĐ</h4>
                    <div class="row">
                        <a href="{{ URL::to('/chi-tiet-san-pham/'. $hot->NT_MA) }}" class="col-5 p-0" style="text-decoration: none;">
                            <button class="buy-btn btn-block "><i class="fa-solid fa-eye"></i> XEM</button>
                        </a>
                        <form action="{{URL::to('/save-cart')}}" method="POST" class="col-7 p-0">
                            {{ csrf_field() }}
                            <input name="qty" type="hidden" value="1">
                            <input name="productid_hidden" type="hidden" value="{{$hot->NT_MA}}" />
                            <button type="submit" class="cart-btn btn-block"><i class="fa-solid fa-shopping-cart"></i> THÊM GIỎ</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
            <div class="banner-nho">
                <section id="banner" class="my-5 py-5">
                    <div class="container-fluid">
                    </div>
                </section>
            </div>
            <section id="clothes" class="my-5">
            <div class="container text-center mt-5 py-1">
                <h3>NỘI THẤT MỚI</h3>
                <hr class="mx-auto">
            </div>    
               
            <div class="row mx-auto container-fluid">
                @foreach($all_product as $key => $product)
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
                        $point = "select ROUND(AVG(DG_DIEM)) dg, COUNT('DG_MA') sl from Danh_gia group by NT_MA having NT_MA ='".$product->NT_MA."'";
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
                        <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}" class="col-5 p-0" style="text-decoration: none;">
                            <button class="buy-btn btn-block "><i class="fa-solid fa-eye"></i> XEM</button>
                        </a>
                        <form action="{{URL::to('/save-cart')}}" method="POST" class="col-7 p-0">
                            {{ csrf_field() }}
                            <input name="qty" type="hidden" value="1">
                            <input name="productid_hidden" type="hidden" value="{{$product->NT_MA}}" />
                            <button type="submit" class="cart-btn btn-block"><i class="fa-solid fa-shopping-cart"></i> THÊM GIỎ</button>
                        </form>
                    </div>
                </form>
                </div>
                @endforeach
            </div>
        </section>
            <style>
                #re {
                    display: block;
                }
                #dat {
                    display: none;
                }
            </style>
            <button class ="btn btn-dark" id="toggle-btn">
            <i class="fa-solid fa-filter"></i> TOP NỘI THẤT ĐẮT/RẺ NHẤT
            </button>
            <div id ="re">
            <section id="clothes" class="my-5">
            <div class="container text-center mt-5 py-1">
                <h3>NỘI THẤT RẺ NHẤT</h3>
                <hr class="mx-auto">
            </div>    
               
            <div class="row mx-auto container-fluid">
                @foreach($cheap_product as $key => $product)
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
                        <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}" class="col-5 p-0" style="text-decoration: none;">
                            <button class="buy-btn btn-block "><i class="fa-solid fa-eye"></i> XEM</button>
                        </a>
                        <form action="{{URL::to('/save-cart')}}" method="POST" class="col-7 p-0">
                            {{ csrf_field() }}
                            <input name="qty" type="hidden" value="1">
                            <input name="productid_hidden" type="hidden" value="{{$product->NT_MA}}" />
                            <button type="submit" class="cart-btn btn-block"><i class="fa-solid fa-shopping-cart"></i> THÊM GIỎ</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        </div>
            <div id ="dat" >
            <section id="clothes" class="my-5">
            <div class="container text-center mt-5 py-1">
                <h3>NỘI THẤT ĐẮT NHẤT</h3>
                <hr class="mx-auto">
            </div>    
               
            <div class="row mx-auto container-fluid">
                @foreach($exp_product as $key => $product)
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
                        <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}" class="col-5 p-0" style="text-decoration: none;">
                            <button class="buy-btn btn-block "><i class="fa-solid fa-eye"></i> XEM</button>
                        </a>
                        <form action="{{URL::to('/save-cart')}}" method="POST" class="col-7 p-0">
                            {{ csrf_field() }}
                            <input name="qty" type="hidden" value="1">
                            <input name="productid_hidden" type="hidden" value="{{$product->NT_MA}}" />
                            <button type="submit" class="cart-btn btn-block"><i class="fa-solid fa-shopping-cart"></i> THÊM GIỎ</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        </div>
<script>
    document.getElementById('toggle-btn').addEventListener('click', function() {
        var re = document.getElementById('re');
        var dat = document.getElementById('dat');
        
        if (re.style.display !== 'none') {
            re.style.display = 'none';
            dat.style.display = 'block';
        } else {
            re.style.display = 'block';
            dat.style.display = 'none';
        }
    });
</script>
            
        

 

@endsection