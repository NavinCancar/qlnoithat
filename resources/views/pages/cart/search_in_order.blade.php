@extends('welcome')
@section('content')
<section id="blog-home" class="pr-5 mt-3 container center">
            <h2 class="font-weight-bold pt-3">Danh sách đơn hàng cũ</h2>
            <hr class="mx-auto">
            <form class="row" action="{{ URL::to('/search-in-order') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-sm-3">
                    <div class="pt-1" style="text-align: left">Tìm các đơn đặt hàng cũ:</div>
                </div>
                <div class="col-sm-9 d-flex">
                    <input class="form-control me-2" type="text" name="keywords_submit" placeholder="Nhập đơn hàng cần tìm...">
                    <button class="btn btn-link" type="submit"><i class="fa fa-search icon-white"></i></a></button>
                </div>       
            </form>
        <?php
            $message = Session::get('message');
            if($message){
                echo '<div class="text-notice mb-3">'.$message.'</div>';
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
        <div class="table-responsive mt-4">
            <table class="table b-t b-light table-responsive-md text-center">
                <thead style="background-color:#35A2A146;">
                <tr>
                    <th style="width: 40px">Mã</th>
                    <th style="width: 100px">Ngày đặt</th>
                    <th>Nội thất</th>
                    <th style="width: 100px">Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th style="width: 110px"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_DDH as $key => $all_DDH)
                <tr>
                    <td>{{$all_DDH->DDH_MA}}</td>
                    <td><?php echo  date('d/m/Y', strtotime($all_DDH->DDH_NGAYDAT)) ?></td>
                    <td>
                        @foreach($group_DDH as $key => $nhom_DDH)
                            @if($nhom_DDH->DDH_MA==$all_DDH->DDH_MA)
                                <div class="pt-1" style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>- {{$nhom_DDH->NT_TEN}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{number_format($all_DDH->DDH_TONGTIEN)}} VNĐ</td>
                    <td style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$all_DDH->TT_TEN}}</td>
                    <!--<td style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$all_DDH->TT_TEN}}</td>-->
                    <td><a href="{{URL::to('/show-detail-bill/'.$all_DDH->DDH_MA)}}"><button type = "submit" class="btn btn-outline-dark btn-sm">Xem chi tiết</button></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection