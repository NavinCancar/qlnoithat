@extends('welcome')
@section('content')
<section id="blog-home" class="pr-5 mt-3 container center">
            <h2 class="font-weight-bold pt-3">Giỏ hàng</h2>
            <hr class="mx-auto">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert text-warning">'.$message.'</span>';
                Session::put('message',null);
            }
        ?>
        </section>
        <?php
        //$c= Cart::content();
        //echo '<pre>';
        //print_r ($c);
        //echo '</pre>';
        ?>
        <section id="cart-container" class="container my-5">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Ảnh</td>
                        <td>Nội thất</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Tổng</td>
                        <td style="width: 50px;">Xoá</td>
                    </tr>
                </thead>

                <tbody>
                <?php $tong =0; ?>
                @foreach($all_cart_product as $key => $cart_pro)
                <tr>
                    <td ><img src="../qlnoithat/public/frontend/img/noithat/{{$cart_pro->HANT_DUONGDAN}}" alt=""></td>
                    <td>
                        <h5 style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$cart_pro->NT_TEN}}</h5>
                    </td>
                    <td>
                        <h5><span id="donGia1">{{number_format($cart_pro->NT_GIA)}}</span> VNĐ</h5>
                    </td>
                    <td>
                        <form action="{{URL::to('/update-cart')}}" method="POST">
                            {{ csrf_field() }}
                                                
                            <input class="w-25 pl-1" name="qty" value="{{$cart_pro->CTGH_SOLUONG}}" type="number" min="1" id="amount1">
                            <input name="productid_hidden" type="hidden"  value="{{$cart_pro->NT_MA}}" />
                            <button type = "submit" class="btn btn-outline-dark btn-sm">Cập nhật</button>
                        </form>
                    </td>
                    <td>
                        <h5><span id="tongGia1"></span> {{number_format($cart_pro->CTGH_SOLUONG*$cart_pro->NT_GIA)}} VNĐ</h5>
                    </td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')" href="{{URL::to('/delete-cart/'.$cart_pro->NT_MA)}}" class="active styling-edit" ui-toggle-class=""><i class="fas fa-x" style="color: #ec4c36; font-size: large;"></i></a></td>
                    <?php
                        $tong = $tong + $cart_pro->CTGH_SOLUONG*$cart_pro->NT_GIA;
                    ?>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>

        <section id="cart-bottom" class="container">
        <div class="row">
            <div class="total col-lg-8 col-md-8 col-12">
                <div>
                    <h5>Tổng giỏ hàng</h5>
                    <div class="d-flex justify-content-between">
                        <h6>Tổng tiền</h6>
                        <p><span id="total"></span>
                        <?php echo number_format($tong); ?> VNĐ
                        </p>
                    </div>
                    <a href="{{URL::to('/show-detail-order')}}"><button class="ml-auto" onclick="buy()">Đặt hàng</button></a>
                </div>
            </div>
            <div class="total col-lg-4 col-md-4 col-12">
                <style>
                    .code-btn {
                    width: 100%;
                    height: 100%;
                    display: inline-block;
                    position: relative;
                    padding: 12px 24px;
                    font-size: 16px;
                    font-weight: bold;
                    text-transform: uppercase;
                    color: #fff;
                    background-color: #000;
                    /*background: url(https://t4.ftcdn.net/jpg/01/26/08/21/240_F_126082169_KlqWhWjl4QZRtrt9TzwZLt8U8qcBfrsq.jpg);*/
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    overflow: hidden;
                    transition: all 0.3s ease;
                    z-index: 1;
                    }

                    .code-btn::before {
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 0;
                    height: 0;
                    background-color: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transition: all 0.5s ease;
                    z-index: -1;
                    }

                    .code-btn:hover::before {
                    width: 300px;
                    height: 300px;
                    }

                    .code-btn span {
                    display: inline-block;
                    }

                    .arrow-icon {
                    position: absolute;
                    top: 50%;
                    right: 24px;
                    transform: translateY(-50%);
                    fill: #fff;
                    transition: all 0.3s ease;
                    }

                    .code-btn:hover .arrow-icon {
                    transform: translateY(-50%) translateX(5px);
                    }
                </style>
                <a href="{{URL::to('/show-all-bill')}}"><button class="code-btn">
                <span>Xem các đơn hàng cũ</span>
                <i class="fas fa-angle-double-right"></i>
                </button></a>
            </div>
        </section>
@endsection