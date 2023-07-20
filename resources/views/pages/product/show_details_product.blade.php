@extends('all-product')
@section('content')

<!--Chi tiet sach-->
<section class="container sproduct my-2 pt-1">

    <div class="row mt-1">
        @foreach($product_detail as $key => $value)
        <div class="col-lg-5 col-md-12 col-12">
         <img class="img-fluid w-100 pb-1" id="MainImg" src="../public/frontend/img/sach/{{$value->HAS_DUONGDAN}}" alt="">
        </div>
            <div class="col-lg-7 col-md-12 col-12" style="text-align:justify">
                <h2 class="py-4">{{$value->SACH_TEN}}</h2>
                <div class="star">
                    <?php
                        // Create connection
                        $conn = new mysqli('localhost', 'root', '', 'qlchsach');
                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }
                        $point = "select ROUND(AVG(DG_DIEM)) dg from Danh_gia group by SACH_MA having SACH_MA ='".$value->SACH_MA."'";
                        $result = $conn->query($point);
                        $dg=0;
                        while ($row = $result->fetch_assoc()) {
                            $dg= $row['dg']."<br>";
                        }
                        $x = 1;
                        for ($x = 1; $x <= $dg; $x++) {
                        echo '<i class="fas fa-star" ></i>';
                        }
                        ?>
                    </div>
                <form action="{{URL::to('/save-cart')}}" method="POST">
                    {{ csrf_field() }}
                    <?php
                    $ton = Session::get('ton');
                    ?>
                    <h2>{{number_format($value->SACH_GIA)}} đ</h2>
                    <p>Số lượng: <input name="qty" type="number" min="1" max="<?php echo $ton; ?>" value="1"> |
                    Số lượng tồn: 
                        <?php
                            echo $ton;
                            Session::put('ton',null);
                        ?> |
                    Đã bán: 
                        <?php
                            $ban = Session::get('ban');
                            echo $ban;
                            Session::put('ban',null);
                        ?> |
                    </p>
					<input name="productid_hidden" type="hidden"  value="{{$value->SACH_MA}}" />
                    <button type = "submit" class="buy-btn">THÊM GIỎ HÀNG</button>
                </form>
                <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                ?>
                <h3 class="mt-5 mb-3">Mô tả sách </h3>
                <hr class="">
                <p><span class="bold">Tác giả: </span>
                @foreach($author_product as $key => $au)
                {{$au->TG_HOTEN}} |
                @endforeach
                </p>

                <p><span class="bold">Thể loại: </span>
                @foreach($category_product as $key => $cate)
                {{$cate->TLS_TEN}} |
                @endforeach
                </p>

                <p><span class="bold">Nội dung: </span>{{$value->SACH_MOTA}}</p>
                <p><span class="bold">Ngôn ngữ: </span>{{$value->NN_TEN}}</p>
                <p><span class="bold">Nhà xuất bản: </span>{{$value->NXB_TEN}}</p>
                <p><span class="bold">Số trang: </span>{{$value->SACH_SOTRANG}}</p>
                <p><span class="bold">ISBN: </span>{{$value->SACH_ISBN}}</p>
            </div>
        @endforeach
    </div>
</section>


<style>
    
#comments {
    box-shadow: 0 -1px 6px 1px rgba(0,0,0,0.1);
	background-color:#FFFFFF;
}

#comments form {
	margin-bottom:30px;
}

#comments .btn {
	margin-top:7px;
}

#comments form fieldset {
	clear:both;
}

#comments form textarea {
	height:100px;
}

#comments .media {
	border-top:1px dashed #DDDDDD;
	padding:20px 0;
	margin:0;
}

#comments .media > .pull-left {
    margin-right:20px;
}

#comments .media img {
	max-width:100px;
}

#comments .media h4 {
	margin:0 0 10px;
}

#comments .media h4 span {
	font-size:14px;
	float:right;
	color:#999999;
}

#comments .media p {
	margin-bottom:15px;
	text-align:justify;
}

#comments .media-detail {
	margin:0;
}

#comments .media-detail li {
	color:#AAAAAA;
	font-size:12px;
	padding-right: 10px;
	font-weight:600;
}

#comments .media-detail a:hover {
	text-decoration:underline;
}

#comments .media-detail li:last-child {
	padding-right:0;
}

#comments .media-detail li i {
	color:#666666;
	font-size:15px;
	margin-right:10px;
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<section class="content-item" id="comments">
<div class="container text-center mt-5 py-4">
            <h3>Bình luận</h3>
            <hr class="mx-auto">
</div>
    <div class="container ps-5 pb-5 pe-5">   
        <style>

                fieldset label {
                    cursor: pointer;
                    font-size: 2em;
                    color: grey;
                }
                
                fieldset input[type="radio"] {
                    appearance: none;
                    -webkit-appearance: none;
                    display: none; 
                }
                
                fieldset label:before {
                    content: '★';
                }
                
                fieldset input[type="radio"]:checked ~ label:before {
                    color: orange;
                }

        </style>
                <?php
                    $KH_MA = Session::get('kh');
                ?>
                @foreach($binh_luan as $key => $bl)
                @if($bl->KH_MA==$KH_MA)
                <form  role="form"  action="{{URL::to('/danh-gia/'.$bl->SACH_MA)}}" method="POST" >
                    {{ csrf_field() }}
                    <fieldset>
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="DG_NOIDUNG" placeholder="Nhập bình luận.." required=""></textarea>
                                <fieldset  class=" pull-right">
                                <input type="radio" id="star5" name="DG_DIEM" value="5">
                                <label for="star5"></label>
                                <input type="radio" id="star4" name="DG_DIEM" value="4">
                                <label for="star4"></label>
                                <input type="radio" id="star3" name="DG_DIEM" value="3">
                                <label for="star3"></label>
                                <input type="radio" id="star2" name="DG_DIEM" value="2">
                                <label for="star2"></label>
                                <input type="radio" id="star1" name="DG_DIEM" value="1" required>
                                <label for="star1"></label>
                                </fieldset>
                                <button type="submit" class="btn btn-success pull-left">Đăng bình luận mới</button>
                            </div>
                    </fieldset>
                </form>
                @endif
                @endforeach
                <?php
                            $countdg = Session::get('countdg');
                            if($countdg){
                                echo '<h4> Có '.$countdg.' bình luận</h4>';
                                Session::put('countdg',null);
                            }
                ?>
                
                <!-- COMMENT 1 - START -->
                @foreach($danh_gia as $key => $dg)
                <div class="media">
                    <a class="pull-left" href="#"><img class="media-object rounded-circle" src="../public/frontend/img/khachhang/{{$dg->KH_DUONGDANANHDAIDIEN}}" alt=""></a>
                    <div class="media-body ">
                        <h4 class="media-heading">{{$dg->KH_HOTEN}}<span class="list-unstyled list-inline media-detail pull-right"> {{$dg->DG_THOIGIAN}}</span></h4>
                        <p>{{$dg->DG_NOIDUNG}}</p>
                        <ul class="list-unstyled list-inline media-detail pull-left">
                        <div class="star">
                            <?php
                                // Create connection
                                $conn = new mysqli('localhost', 'root', '', 'qlchsach');
                                // Check connection
                                if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                                }
                                $point = "select DG_DIEM dg from Danh_gia where DG_MA ='".$dg->DG_MA."'";
                                $result = $conn->query($point);
                                $dg=0;
                                while ($row = $result->fetch_assoc()) {
                                    $dg= $row['dg']."<br>";
                                }
                                $x = 1;
                                for ($x = 1; $x <= $dg; $x++) {
                                echo '<i class="fas fa-star" ></i>';
                                }
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
                @endforeach
                <!-- COMMENT 1 - END -->


    </div>
</section>

    <!--Sach lien quan-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Sách liên quan</h3>
            <hr class="mx-auto">
        </div>

        <div class="row mx-auto container-fluid">
            @foreach($product_relate as $key => $relate)
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img class="img-fluid mb-3" src="../public/frontend/img/sach/{{$relate->HAS_DUONGDAN}}" alt="">
                <div class="star">
                    <?php
                        // Create connection
                        $conn = new mysqli('localhost', 'root', '', 'qlchsach');
                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }
                        $point = "select ROUND(AVG(DG_DIEM)) dg from Danh_gia group by SACH_MA having SACH_MA ='".$relate->SACH_MA."'";
                        $result = $conn->query($point);
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
                <h5 class="p-name">{{$relate->SACH_TEN}}</h5>
                <h4 class="p-price">{{number_format($relate->SACH_GIA)}}</h4>
                <a href="{{ URL::to('/chi-tiet-san-pham/'. $relate->SACH_MA) }}"><button class="buy-btn">XEM NGAY</button></a>
            </div>
            @endforeach
        </div>
    </section>


@endsection