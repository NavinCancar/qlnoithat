@extends('admin-layout')
@section('admin-content')
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<style>
.anh{
    width: 15em;
    margin: 0 10% 5%;
}
.khung{
    height: 16em;
    text-decoration: none;
}

#pie-chart {
  font-family: Arial, sans-serif;
}
</style>

<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading" style="margin-bottom: 10px;">
                                Bảng báo cáo - thống kê (
                                    <?php
                                    $connect = mysqli_connect("localhost", "root", "", "qlnoithat");
                                    $TGBDau = Session::get('TGBDau');
                                    $TGKThuc= Session::get('TGKThuc');
                                    echo (date('d/m/Y', strtotime($TGBDau)). ' - '.date('d/m/Y', strtotime($TGKThuc)))
                                    ?>
                                )
                    </header>
                    <i style="padding:15px">Doanh thu tính những sản phẩm đã đến tay khách hàng, thống kê tính xu hướng mua (chỉ loại bỏ trường hợp bị huỷ hàng)</i>
                    <div class="panel-body">
                        <form role="form" action="{{URL::to('/thong-ke-thoi-gian')}}" method="post">
                                {{csrf_field() }}
                            <div class="form-group row">
                                <div class="col-sm-3"><label for="exampleInputEmail1">Tính theo thời gian:</label></div>
                                <div class="col-sm-3">Từ: &nbsp;&nbsp;&nbsp;&nbsp; <input type="date" name="TGBDau" required=""></div>
                                <div class="col-sm-3">Đến: &nbsp;&nbsp; <input type="date" name="TGKThuc" required=""></div>
                                <div class="col-sm-3"><button type="submit" class="btn btn-success">Tính toán</button></div>
                                
                            </div>
                        </form> 
                         <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-warning">'.$message.'</span></br>';
                            Session::put('message',null);
                        }
                        ?>
                    </div>
                </section>
                <?php
                    $ddh_dtt = DB::table('don_dat_hang')
                    ->where('TT_MA', 4)->whereBetween('DDH_NGAYDAT', [$TGBDau, $TGKThuc])->sum('ddh_tongtien');
            
                    $ctlx = DB::table('chi_tiet_lo_xuat')->join('lo_xuat','lo_xuat.LX_MA','=','chi_tiet_lo_xuat.LX_MA')
                    ->whereBetween('LX_NGAYXUAT', [$TGBDau, $TGKThuc])->sum('CTLX_GIA');

                    $ctln = DB::table('chi_tiet_lo_nhap')->join('lo_nhap','lo_nhap.LN_MA','=','chi_tiet_lo_nhap.LN_MA')
                    ->whereBetween('LN_NGAYNHAP', [$TGBDau, $TGKThuc])->sum('CTLN_GIA');
                ?>
                <section class="panel"> 
                    <header class="panel-heading">
                        - Báo cáo tổng quát doanh thu - lợi nhuận -
                    </header>
                    <div class="panel-body">                    
                        <div class="panel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Doanh thu từ đơn đặt hàng đã được nhận (Bán nội thất):</td>
                                            <td><?php echo number_format($ddh_dtt);?> VNĐ</td>
                                        </tr>
                                        <tr>
                                            <td>Doanh thu từ lô xuất (Bán lại nội thất):</td>
                                            <td><?php echo number_format($ctlx);?> VNĐ</td>
                                        </tr>
                                        <tr style="background-color: #e2e3e5;">
                                            <td><b>Tổng doanh thu:</b></td>
                                            <td><?php echo number_format($ddh_dtt+$ctlx);?> VNĐ</td>
                                        </tr>
                                        <tr>
                                            <td>Chi phí cho lô nhập:</td>
                                            <td><?php echo number_format($ctln);?> VNĐ</td>
                                        </tr>
                                        <tr style="background-color: #e2e3e5;">
                                            <td><b>Tổng lợi nhuận:</b></td>
                                            <td><?php echo number_format($ddh_dtt+$ctlx-$ctln);?> VNĐ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel"> 
                    <header class="panel-heading">
                        - Thống kê doanh số bán nội thất -
                    </header>
                    <div class="panel-body">                    
                        <div class="panel">
                            <div id="chart"></div>
                        </div>
                    </div>
                </section>

                <section class="panel"> 
                    <header class="panel-heading">
                        - Thống kê theo loại nội thất -
                    </header>
                    <style>
                    #pie-chart {
                        font-family: inherit  !important;
                        font: inherit  !important;
                    }
                    text[font="10px &quot;Arial&quot;"],
                    tspan[style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"] {
                        font: inherit  !important;
                    }

                    </style>
                    <div class="panel-body">                    
                        <div class="panel">
                        <div id="pie-chart" style="height:80%"></div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <header class="panel-heading" >
                        - Thống kê nội thất bán nhiều nhất -
                    </header><br>
                    <div class="row">
                    <?php
            
                    $query ="SELECT n.*, c.*, h.*, SUM(ctddh_soluong) tong FROM noi_that n 
                    JOIN hinh_anh_noi_that h on n.NT_MA = h.NT_MA
                    JOIN chi_tiet_don_dat_hang c on n.NT_MA = c.NT_MA 
                    JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
                    WHERE h.HANT_DUONGDAN LIKE '%-1%'
                    AND d.TT_MA != 5
                    AND d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                    GROUP by n.NT_MA HAVING SUM(ctddh_soluong) = (SELECT max(tongsoluong) 
                                                                FROM (SELECT c.NT_MA, SUM(ctddh_soluong) tongsoluong 
                                                                    FROM chi_tiet_don_dat_hang c 
                                                                    JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA 
                                                                    WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."' 
                                                                    AND d.TT_MA != 5
                                                                    GROUP BY (c.NT_MA)) sum_nt) 
                    ORDER by n.NT_TEN";
                    $result = mysqli_query($connect, $query);
                    /*$row = mysqli_fetch_array($result);
                    echo '<pre>';
                    print_r ($row);
                    echo '</pre>';*/

                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <div class="col-sm-4">
                        <section class="panel">
                            <div class="panel-body khung">
                            <a href="chi-tiet-san-pham/'. $row["NT_MA"].'"><img class="img-fluid mb-3 anh" src="public/frontend/img/noithat/'.$row["HANT_DUONGDAN"].'" alt=""></a>
                            <br>
                            <h4 class="text-center">'.$row["NT_TEN"].'</h4>
                            <h5 class="text-center">'.number_format($row["NT_GIA"]).' VNĐ</h5>   
                            <h5 class="text-center">Số lượng bán: '.$row["tong"].'</h5>     
                            </div>
                        </section>
                        </div>';
                    }
                    ?>
                        
                    </div>
                </section>

                <section class="panel">
                    <header class="panel-heading" >
                        - Thống kê nội thất bán ít nhất -
                    </header><br>
                    <div class="row">
                    <?php
            
                    $query ="SELECT n.*, c.*, h.*, SUM(ctddh_soluong) as tong FROM noi_that n 
                    JOIN hinh_anh_noi_that h on n.NT_MA = h.NT_MA
                    JOIN chi_tiet_don_dat_hang c on n.NT_MA = c.NT_MA 
                    JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
                    WHERE h.HANT_DUONGDAN LIKE '%-1%'
                    AND d.TT_MA != 5
                    AND d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                    GROUP by n.NT_MA HAVING SUM(ctddh_soluong) = (SELECT min(tongsoluong) 
                                                                FROM (SELECT c.NT_MA, SUM(ctddh_soluong) tongsoluong 
                                                                    FROM chi_tiet_don_dat_hang c 
                                                                    JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA 
                                                                    WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                                                                    AND d.TT_MA != 5 
                                                                    GROUP BY (c.NT_MA)) sum_nt) 
                    ORDER by n.NT_TEN";
                    $result = mysqli_query($connect, $query);
                    /*$row = mysqli_fetch_array($result);
                    echo '<pre>';
                    print_r ($row);
                    echo '</pre>';*/
                    
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <div class="col-sm-4">
                        <section class="panel">
                            <div class="panel-body khung">
                            <a href="chi-tiet-san-pham/'. $row["NT_MA"].'"><img class="img-fluid mb-3 anh" src="public/frontend/img/noithat/'.$row["HANT_DUONGDAN"].'" alt=""></a>
                            <br>
                            <h4 class="text-center">'.$row["NT_TEN"].'</h4>
                            <h5 class="text-center">'.number_format($row["NT_GIA"]).' VNĐ</h5>
                            <h5 class="text-center">Số lượng bán: '.$row["tong"].'</h5>          
                            </div>
                        </section>
                        </div>';
                    }
                    ?>
                    </div>
                </section>

            
                <section class="panel">
                    <header class="panel-heading" >
                        - Thống kê nội thất không bán được -
                    </header><br>
                    <div class="row">
                    <?php
            
                    $query ="SELECT n.*, h.* FROM noi_that n JOIN hinh_anh_noi_that h on n.NT_MA = h.NT_MA
                    WHERE h.HANT_DUONGDAN LIKE '%-1%'
                    AND n.NT_MA NOT IN (SELECT n.NT_ma FROM noi_that n 
                                        JOIN chi_tiet_don_dat_hang c on n.NT_MA = c.NT_MA 
                                        JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
                                        WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
                                        AND d.TT_MA != 5
                                        GROUP by n.NT_MA) 
                    ORDER by n.NT_TEN";
                    $result = mysqli_query($connect, $query);
                    /*$row = mysqli_fetch_array($result);
                    echo '<pre>';
                    print_r ($row);
                    echo '</pre>';*/
                    
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <div class="col-lg-3 col-md-6">
                        <section class="panel">
                            <div class="panel-body">
                            <a href="chi-tiet-san-pham/'. $row["NT_MA"].'"><h5 class="text-center" style="color: gray;">'.$row["NT_TEN"].'</h5></a>
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
/*$connect = mysqli_connect("localhost", "root", "", "qlnoithat");
$query = "SELECT * FROM DON_DAT_HANG ORDER BY DDH_NGAYDAT";
    if (Session::get('TGBDau') && Session::get('TGKThuc')) {
        $TGBDau = Session::get('TGBDau');
        $TGKThuc= Session::get('TGKThuc');
        $query = "SELECT * FROM DON_DAT_HANG  WHERE DDH_NGAYDAT BETWEEN '". $TGBDau ."' AND '".  $TGKThuc."' ORDER BY DDH_NGAYDAT";     
    }*/

$query = "SELECT * FROM DON_DAT_HANG  WHERE DDH_NGAYDAT BETWEEN '". $TGBDau ."' AND '".  $TGKThuc."' AND TT_MA != 5 ORDER BY DDH_NGAYDAT";
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
        $query ="SELECT l.*, SUM(ctddh_soluong) tong FROM loai_noi_that l
        JOIN noi_that n on n.LNT_MA = l.LNT_MA 
        JOIN chi_tiet_don_dat_hang c on n.NT_MA = c.NT_MA 
        JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
        WHERE d.DDH_NGAYDAT BETWEEN '".$TGBDau."' AND '".$TGKThuc."'
        AND d.TT_MA != 5
        GROUP by l.LNT_MA ORDER BY tong;";
        $result = mysqli_query($connect, $query);
            /*$row = mysqli_fetch_array($result);
            echo '<pre>';
            print_r ($row);
            echo '</pre>';*/

        while($row = mysqli_fetch_array($result)){
            echo '{label: "'. $row["LNT_TEN"].'", value: '. $row["tong"].'},';
        }
        ?>
  ]
});
</script>
@endsection
            