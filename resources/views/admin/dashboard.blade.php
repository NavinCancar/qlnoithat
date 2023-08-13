@extends('admin-layout')
@section('admin-content')
<!-- //market-->
<div  style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); background: #3fc0be; text-align: center; color: #fff; font-family: Arial, sans-serif; font-weight: bold;">
      <br><h1>Trang quản trị bán nội thất</h1><br>
</div>
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart"></i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Tổng số đơn hàng</h4>
					<h3>
						<?php
							$ddh= Session::get('SO_DDH');
							if ($ddh) {
								echo $ddh;
							}
						?>
					</h3>
					<a href="{{URL::to('/trang-thai/tat-ca')}}"><p>Xem thêm</p></a>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Tổng số đơn chưa xử lý</h4>
						<h3>
							<?php
								$ddh_cxl= Session::get('SO_DDH_CXL');
									echo $ddh_cxl;
							?>
						</h3>
						<a href="{{URL::to('/danh-muc-trang-thai/1')}}"><p>Xem thêm</p></a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
                        <i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng số người dùng</h4>
						<h3>
						<?php
							$users= Session::get('SO_NGUOI_DUNG');
							if ($users) {
								echo $users;
							}
						?>
						</h3>
						<a href="{{URL::to('/all-khachhang')}}"><p>Xem thêm</p></a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<style>
				.market-update-right i.fa.fa-user {
					font-size:3em;
					color:#fff;
					text-align: left;
				}
			</style>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-user"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng số nhân viên</h4>
						<h3>
						<?php
							$emp= Session::get('SO_NHAN_VIEN');
							if ($emp) {
								echo $emp;
							}
						?>
						</h3>
						<a href="{{URL::to('/all-employee')}}"><p>Xem thêm</p></a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>

			<style>
			.market-update-block.clr-block-5 {
				margin: 0 0 1.5em ;
				background: #f6d903 ;
				box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
				transition: 0.5s all;
			-webkit-transition: 0.5s all;
			-moz-transition: 0.5s all;
			-o-transition: 0.5s all;
			}

			.market-update-block.clr-block-5:hover {
				background:#ffbd0b;
				transition: 0.5s all;
			-webkit-transition: 0.5s all;
			-moz-transition: 0.5s all;
			-o-transition: 0.5s all;
			}
		</style>
		<div class="col-md-12 market-update-gd" style="width:100%">
				<div class="market-update-block clr-block-5" style="margin-top: 1.5em;">
					<div class="col-md-2 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-10 market-update-left">
						<h4>Tổng doanh thu của tháng 
						<?php
							$date_array = getdate();
							echo $date_array['mon'].'/'.$date_array['year'];
						?>
						</h4>
						<h3>
							<?php
								$dtl= Session::get('DOANH_THU_L');
								$dtb= Session::get('DOANH_THU_B');
								$dt = $dtl+$dtb;
								if ($dtl+$dtb) {
									echo number_format($dtl+$dtb);
								}
							?>
						VNĐ</h3>
						<h4>- Bán nội thất:
							<?php
								if ($dtb) {
									echo number_format($dtb);
								}
							?> VNĐ <br>- Bán lại nội thất:
							<?php
								if ($dtl) {
									echo number_format($dtl);
								} 
							?> VNĐ
						</h4>
					</div>
				  <div class="clearfix"> </div>
				</div>
		</div>

		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
@endsection