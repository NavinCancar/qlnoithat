@extends('welcome')
@section('content')
<section id="blog-home" class="pr-5 mt-3 container center">
            <h2 class="font-weight-bold pt-3">Danh sách đơn hàng cũ</h2>
            <hr class="mx-auto">
            <form class="d-flex" action="{{ URL::to('/search-in-order') }}" method="POST">
                {{ csrf_field() }}
                <div style="width:30%">Tìm các đơn đặt hàng cũ:</div>
                <input class="form-control me-2" type="text" name="keywords_submit" placeholder="Nhập sách cần tìm...">
                <button class="btn btn-link" type="submit"><i class="fa fa-search icon-white"></i></a></button>
            </form>
        <?php
      $message = Session::get('message');
      if($message){
          echo '<span class="text-alert">'.$message.'</span>';
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
                        <td>Mã</td>
                        <td>Ngày đặt</td>
                        <td>Sách</td>
                        <td>Tổng tiền</td>
                        
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                @foreach($all_DDH as $key => $all_DDH)
                <tr>
                    <td>{{$all_DDH->DDH_MA}}</td>
                    <td>{{$all_DDH->DDH_NGAYDAT}}</td>
                    <td>
                        @foreach($group_DDH as $key => $nhom_DDH)
                            @if($nhom_DDH->DDH_MA==$all_DDH->DDH_MA)
                                <p style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$nhom_DDH->SACH_TEN}}</p>
                            @endif
                        @endforeach
                    </td>
                    <td>{{number_format($all_DDH->DDH_TONGTIEN)}}</td>

                    <td><a href="{{URL::to('/show-detail-bill/'.$all_DDH->DDH_MA)}}"><button style= {width:100%} type = "submit" class="btn btn-outline-dark btn-sm">Xem chi tiết</button></a></td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </section>
@endsection