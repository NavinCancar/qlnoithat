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
                    <input class="form-control me-2" type="text" name="keywords_submit" placeholder="Nhập nội thất cần tìm...">
                    <button class="btn btn-link" type="submit"><i class="fa fa-search icon-white"></i></a></button>
                </div>       
            </form>
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
            <div class="table-responsive">
                <table class="table b-t b-light table-responsive-sm">
                    <thead>
                        <tr>
                            <td style="width: 40px">Mã</td>
                            <td style="width: 100px">Ngày đặt</td>
                            <td>Nội thất</td>
                            <td style="width: 100px">Tổng tiền</td>
                            <td>Trạng thái</td>
                            <td style="width: 110px"></td>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($all_DDH as $key => $all_don)
                    <tr>
                        <td>{{$all_don->DDH_MA}}</td>
                        <td><?php echo  date('d/m/Y', strtotime($all_don->DDH_NGAYDAT)) ?></td>
                        <td>
                            @foreach($group_DDH as $key => $nhom_DDH)
                                @if($nhom_DDH->DDH_MA==$all_don->DDH_MA)
                                    <div class="pt-1" style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>- {{$nhom_DDH->NT_TEN}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td>{{number_format($all_don->DDH_TONGTIEN)}}</td>
                        <td style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$all_don->TT_TEN}}</td>
                        <!--<td style='width: 100%;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;'>{{$all_don->TT_TEN}}</td>-->
                        <td><a href="{{URL::to('/show-detail-bill/'.$all_don->DDH_MA)}}"><button type = "submit" class="btn btn-outline-dark btn-sm">Xem chi tiết</button></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation">
                <ul class="justify-content-center pagination mt-5">
                    {{-- Previous Page Link --}}
                    @if ($all_DDH->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link shop-nav" href="{{ $all_DDH->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif
                    {{-- Pagination Elements --}}
                    @for ($key=0; $key+1<=$all_DDH->lastPage(); $key++)
                            @if ($all_DDH->currentPage() === $key + 1)
                                <li class="page-item">
                                    <a class="page-link bg-active shop-nav" href="{{ $all_DDH->url($key + 1) }}">{{ $key + 1 }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link shop-nav" href="{{ $all_DDH->url($key + 1) }}">{{ $key + 1 }}</a>
                                </li>
                            @endif
                    @endfor
                
                    {{-- Next Page Link --}}
                    @if ($all_DDH->hasMorePages())
                        <li class="page-item">
                            <a class="page-link shop-nav" href="{{ $all_DDH->nextPageUrl() }}">Next</a>
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