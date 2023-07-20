@extends('admin-layout')
@section('admin-content')
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<style>
.panel-sub-heading {
    position: relative;
    height: 40px;
    line-height: 40px;
    width: 30%;
    letter-spacing: 0.2px;
    color: #000;
    font-size: 18px;
    font-weight: 400;
    padding: 0 16px;
    background:#ddede0;
    border-top-right-radius: 2px;
    border-top-left-radius: 2px; 
    text-transform: uppercase;
    text-align: center;
}

.anh{
    width:80%;
    margin: 0 10% 5%;
}
.khung{
    height: 25em;
    text-decoration: none;
}
</style>

<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                                Bảng thống kê (
                                    <?php
                                    $connect = mysqli_connect("localhost", "root", "", "qlchsach");
                                    $TGBDau = Session::get('TGBDau');
                                    $TGKThuc= Session::get('TGKThuc');
                                    echo (date('d/m/Y', strtotime($TGBDau)). ' - '.date('d/m/Y', strtotime($TGKThuc)))
                                    ?>
                                )
                    </header>
                    <div class="panel-body">
                        <form role="form" action="{{URL::to('/thong-ke-thoi-gian')}}" method="post">
                                {{csrf_field() }}
                            <div class="form-group">
                                        <label for="exampleInputEmail1">Thống kê theo thời gian:</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Từ: &nbsp;&nbsp; <input type="date" name="TGBDau"  placeholder="Thời gian bắt đầu" required="">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Đến: &nbsp;&nbsp; <input type="date" name="TGKThuc"  placeholder="Thời gian kết thúc" required="">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <button type="submit" class="btn btn-success">Thông kê</button>
                            </div>
                        </form> 
                         <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span></br>';
                            Session::put('message',null);
                        }
                        ?>
                    </div>
                </section>

                <section class="panel"> 
                    <header class="panel-sub-heading">
                            Thống kê doanh số bán sách
                    </header>
                    <div class="panel-body">                    
                        <div class="panel">
                            <div id="chart" style="height: 60%;"></div>
                        </div>
                    </div>
                </section>
                <section class="panel"> 
                    <header class="panel-sub-heading">
                            Thống kê thể loại sách
                    </header>
                    <div class="panel-body">                    
                        <div class="panel">
                        <div id="pie-chart" style="font:Arial" ></div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <header class="panel-sub-heading" >
                            Sách bán nhiều nhất
                    </header><br>
                    <div class="row">
                    <?php
            
                    $query ="SELECT s.*, c.*, h.*, SUM(ctddh_soluong) tong FROM sach s 
                    JOIN hinh_anh_sach h on s.SACH_MA = h.SACH_MA
                    JOIN chi_tiet_don_dat_hang c on s.SACH_MA = c.SACH_MA 
                    JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
                    WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                    GROUP by s.SACH_MA HAVING SUM(ctddh_soluong) = (SELECT max(tongsoluong) FROM (SELECT c.SACH_MA, SUM(ctddh_soluong) tongsoluong FROM chi_tiet_don_dat_hang c JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA WHERE d.DDH_NGAYDAT BETWEEN '"
                    .$TGBDau."' AND '".$TGKThuc."' GROUP BY (c.SACH_MA)) sum_sach)";
                    $result = mysqli_query($connect, $query);
                    /*$row = mysqli_fetch_array($result);
                    echo '<pre>';
                    print_r ($row);
                    echo '</pre>';*/

                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <div class="col-lg-4">
                        <section class="panel">
                            <div class="panel-body khung">
                            <a href="chi-tiet-san-pham/'. $row["SACH_MA"].'"><img class="img-fluid mb-3 anh" src="public/frontend/img/sach/'.$row["HAS_DUONGDAN"].'" alt=""></a>
                            <br>
                            <h4 class="text-center">'.$row["SACH_TEN"].'</h4>
                            <h4 class="text-center">'.number_format($row["SACH_GIA"]).' đ</h4>   
                            <h5 class="text-center">Số lượng bán: '.$row["tong"].'</h5>     
                            </div>
                        </section>
                        </div>';
                    }
                    ?>
                        
                    </div>
                </section>

                <section class="panel">
                    <header class="panel-sub-heading" >
                            Sách bán ít nhất
                    </header><br>
                    <div class="row">
                    <?php
            
                    $query ="SELECT s.*, c.*, h.*, SUM(ctddh_soluong) as tong FROM sach s 
                    JOIN hinh_anh_sach h on s.SACH_MA = h.SACH_MA
                    JOIN chi_tiet_don_dat_hang c on s.SACH_MA = c.SACH_MA 
                    JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
                    WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                    GROUP by s.SACH_MA HAVING SUM(ctddh_soluong) = (SELECT min(tongsoluong) FROM (SELECT c.SACH_MA, SUM(ctddh_soluong) tongsoluong FROM chi_tiet_don_dat_hang c JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA WHERE d.DDH_NGAYDAT BETWEEN '"
                    .$TGBDau."' AND '".$TGKThuc."' GROUP BY (c.SACH_MA)) sum_sach)";
                    $result = mysqli_query($connect, $query);
                    /*$row = mysqli_fetch_array($result);
                    echo '<pre>';
                    print_r ($row);
                    echo '</pre>';*/
                    
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <div class="col-lg-4">
                        <section class="panel">
                            <div class="panel-body khung">
                            <a href="chi-tiet-san-pham/'. $row["SACH_MA"].'"><img class="img-fluid mb-3 anh" src="public/frontend/img/sach/'.$row["HAS_DUONGDAN"].'" alt=""></a>
                            <br>
                            <h4 class="text-center">'.$row["SACH_TEN"].'</h4>
                            <h4 class="text-center">'.number_format($row["SACH_GIA"]).' đ</h4>
                            <h5 class="text-center">Số lượng bán: '.$row["tong"].'</h5>          
                            </div>
                        </section>
                        </div>';
                    }
                    ?>
                    </div>
                </section>

            
                <section class="panel">
                    <header class="panel-sub-heading" >
                            Sách không bán được
                    </header><br>
                    <div class="row">
                    <?php
            
                    $query ="SELECT s.*, h.* FROM sach s JOIN hinh_anh_sach h on s.SACH_MA = h.SACH_MA
                    WHERE s.SACH_MA NOT IN (SELECT s.sach_ma FROM sach s 
                                        JOIN chi_tiet_don_dat_hang c on s.SACH_MA = c.SACH_MA 
                                        JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
                                        WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                                        GROUP by s.SACH_MA)";
                    $result = mysqli_query($connect, $query);
                    /*$row = mysqli_fetch_array($result);
                    echo '<pre>';
                    print_r ($row);
                    echo '</pre>';*/
                    
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <div class="col-lg-4">
                        <section class="panel">
                            <div class="panel-body khung">
                            <a href="chi-tiet-san-pham/'. $row["SACH_MA"].'"><img class="img-fluid mb-3 anh" src="public/frontend/img/sach/'.$row["HAS_DUONGDAN"].'" alt=""></a>
                            <br>
                            <h4 class="text-center">'.$row["SACH_TEN"].'</h4>
                            <h4 class="text-center">'.number_format($row["SACH_GIA"]).' đ</h4>
                            <h5 class="text-center">Số lượng bán: 0</h5>          
                            </div>
                        </section>
                        </div>';
                    }
                    ?>
                    </div>
                </section>
            </div> 
</div>                  



<?php 
/*$connect = mysqli_connect("localhost", "root", "", "qlchsach");
$query = "SELECT * FROM DON_DAT_HANG ORDER BY DDH_NGAYDAT";
    if (Session::get('TGBDau') && Session::get('TGKThuc')) {
        $TGBDau = Session::get('TGBDau');
        $TGKThuc= Session::get('TGKThuc');
        $query = "SELECT * FROM DON_DAT_HANG  WHERE DDH_NGAYDAT BETWEEN '". $TGBDau ."' AND '".  $TGKThuc."' ORDER BY DDH_NGAYDAT";     
    }*/

$query = "SELECT * FROM DON_DAT_HANG  WHERE DDH_NGAYDAT BETWEEN '". $TGBDau ."' AND '".  $TGKThuc."' ORDER BY DDH_NGAYDAT";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ year:'".$row["DDH_NGAYDAT"]."', profit:".$row["DDH_TONGTIEN"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'year',
 ykeys:['profit'],
 labels:['Doanh thu'],
 hideHover:'auto',
 stacked:true
});
Morris.Donut({
  element: 'pie-chart',
  data: [
    <?php
            
        $query ="SELECT t.*, SUM(ctddh_soluong) tong FROM the_loai_sach t
        JOIN cua_sach s on s.TLS_MA = t.TLS_MA 
        JOIN chi_tiet_don_dat_hang c on s.SACH_MA = c.SACH_MA 
        JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
        WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
        GROUP by t.TLS_MA ORDER BY tong;";
        $result = mysqli_query($connect, $query);
            /*$row = mysqli_fetch_array($result);
            echo '<pre>';
            print_r ($row);
            echo '</pre>';*/

        while($row = mysqli_fetch_array($result)){
            echo '{label: "'. $row["TLS_TEN"].'", value: '. $row["tong"].'},';
        }
        ?>
  ]
});
</script>
@endsection
            