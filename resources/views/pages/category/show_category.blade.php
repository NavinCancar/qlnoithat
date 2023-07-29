@extends('all-product')
 @section('content')
<section id="featured" class="my-3 py-3 row" >
        <div class="container mt-3 py-3">
            @foreach($category_name as $key => $name)
            <h2 class="font-weight-bold">{{ $name->LNT_TEN }}</h2>
            <?php
              $LNT_MA=$name->LNT_MA;
            ?>
            @endforeach

            <hr>
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
                    <h4 class="p-price">{{number_format($product->NT_GIA)}} đ</h4>

                    <a href="{{ URL::to('/chi-tiet-san-pham/'. $product->NT_MA) }}"><button class="buy-btn">XEM NGAY</button></a>
                </div>
            @endforeach
        </div>
        <div class=" col-lg-3 col-md-12 col-12">
            <ul class="list-group rounded-2">
                <li class="list-group-item center disabled text-bg-dark" ><h4>Danh mục sản phẩm</h4></li>
                <li class="list-group-item"  ><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/tat-ca')}}" >- - Tất cả sản phẩm - -</a></li>
                @foreach($category as $key => $cate)
                <li class="list-group-item
                <?php
                if($cate->LNT_MA == $LNT_MA) echo 'bg-active'
                ?>
                "><a class="shop-list" href="{{ URL::to('/danh-muc-san-pham/'. $cate->LNT_MA) }}">{{ $cate->LNT_TEN }}</a></li>
                @endforeach
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
