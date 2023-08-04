<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use PDF;

use Carbon\Carbon;
session_start();

class OrderController extends Controller
{//Backend--Chủ cửa hàng + Bán hàng-------------------------------------------------------
    
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        $CV_MA = DB::table('nhan_vien')->where('NV_MA',$NV_MA)->first();
        if($NV_MA){
            if($CV_MA->CV_MA != 1 && $CV_MA->CV_MA != 3){
                return Redirect::to('dashboard')->send();
            }
        }else{
            return Redirect::to('admin')->send();
        }
    }

    //Liệt kê các đơn hàng
    /*public function all_order(){
        $this->AuthLogin();

        $all_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')->get();
        $manager_order = view('admin.all_order')->with('all_DDH', $all_DDH);

        $count_order = DB::table('don_dat_hang')->count('DDH_MA');
        Session::put('count_order',$count_order);
        return view('admin-layout')->with('admin.all_order', $manager_order);
    }*/

    //Tất cả trạng thái
    public function all_status(){
        $this->AuthLogin();
        $all_status = DB::table('trang_thai')->get();

        $all_DDH=  DB::table('don_dat_hang')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'don_dat_hang.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')->paginate(10);
        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')->get();

        $count_order = DB::table('don_dat_hang')->count('DDH_MA');
        Session::put('count_order',$count_order);

        return view('admin.all_order')->with('all_status', $all_status)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH);
    }

    //Danh mục trạng thái
    public function show_status_order($TT_MA){
        $this->AuthLogin();
        $all_status = DB::table('trang_thai')->get();

        $status_by_id = DB::table('don_dat_hang')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'don_dat_hang.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')
        ->where('trang_thai.TT_MA', $TT_MA)->paginate(10);

        $status_count = DB::table('don_dat_hang')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'don_dat_hang.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')
        ->where('trang_thai.TT_MA', $TT_MA)->count();
        Session::put('status_count',$status_count);

        $status_name = DB::table('trang_thai')->where('trang_thai.TT_MA', $TT_MA )->get();

        $all_DDH=  DB::table('don_dat_hang')->orderby('don_dat_hang.DDH_MA','desc')->get();

        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')->get();

        return view('admin.show_status_order')->with('all_status', $all_status)
        ->with('id_status', $status_by_id)->with('status_name', $status_name)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH);
    }

    //Tìm kiếm sản phẩm trong tất cả các đơn đặt hàng
    public function search_all_order(Request $request){
        $this->AuthLogin();

        $all_status = DB::table('trang_thai')->get();

        $keywords = $request ->keywords_submit;

        $all_DDH=  DB::table('don_dat_hang')
        //->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        //->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'don_dat_hang.TT_MA')
        //->where('noi_that.NT_MA', 'like', '%'.$keywords.'%')
        ->where('don_dat_hang.DDH_MA', '=', $keywords)
        ->orderby('don_dat_hang.DDH_MA','desc')->get();

        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')->get();

        return view('admin.search_all_order')->with('all_status', $all_status)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH);
    }

    //Xem chi tiết đơn hàng
    public function show_detail($DDH_MA){
        $this->AuthLogin();
        $all_category_product = DB::table('loai_noi_that')->get();
        $all_DDH=  DB::table('don_dat_hang')
        ->join('khach_hang','khach_hang.KH_MA','=','don_dat_hang.KH_MA')
        ->join('dia_chi_giao_hang','dia_chi_giao_hang.DCGH_MA','=','don_dat_hang.DCGH_MA')
        ->join('hinh_thuc_thanh_toan','hinh_thuc_thanh_toan.HTTT_MA','=','don_dat_hang.HTTT_MA')
        ->join('tinh_thanh_pho','dia_chi_giao_hang.TTP_MA','=','tinh_thanh_pho.TTP_MA')
        ->where('don_dat_hang.DDH_MA', $DDH_MA)->get();

        $group_DDH = DB::table('chi_tiet_don_dat_hang')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('chi_tiet_don_dat_hang.DDH_MA', $DDH_MA)->get();

        $TT_MA = Session::get('TT_MA');

        $all_status = DB::table('trang_thai')
        ->where('trang_thai.TT_MA', $TT_MA)->get();

        return view('admin.show_detail')->with('category', $all_category_product)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH)->with('all_status', $all_status);
    }



    //In vận đơn giao hàng
    public function print_bill($DDH_MA){
        $this->AuthLogin();
        
        $pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_bill_convert($DDH_MA));
		
		return $pdf->stream();
    }

    public function print_bill_convert($DDH_MA){

		$all_DDH=  DB::table('don_dat_hang')
        ->join('khach_hang','khach_hang.KH_MA','=','don_dat_hang.KH_MA')
        ->join('dia_chi_giao_hang','dia_chi_giao_hang.DCGH_MA','=','don_dat_hang.DCGH_MA')
        ->join('hinh_thuc_thanh_toan','hinh_thuc_thanh_toan.HTTT_MA','=','don_dat_hang.HTTT_MA')
        ->join('tinh_thanh_pho','dia_chi_giao_hang.TTP_MA','=','tinh_thanh_pho.TTP_MA')
        ->where('don_dat_hang.DDH_MA', $DDH_MA)->first();

        $group_DDH = DB::table('chi_tiet_don_dat_hang')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')
        ->where('chi_tiet_don_dat_hang.DDH_MA', $DDH_MA)->get();

        /*echo '<pre>';
            print_r ($all_DDH);
        echo '</pre>';


		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_quantity;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'không mã';
					}		

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.number_format($product->product_feeship,0,',','.').'đ'.'</td>
						<td>'.$product->product_sales_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
*/
		$output = '';

        $output .= '<!DOCTYPE>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vận đơn giao hàng</title>
            <style>
                body {
                    font-family: DejaVu Sans;
                    margin: 0;
                    padding: 10px;
                }
                
                h2 {
                    text-align: center;
                }

                .invoice-details {
                    margin-top: 25px;
                    padding: 15px;
                    border: 1px solid #ccc;
                }

                .shipper-details,
                .consignee-details {
                    margin-bottom: 10px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                td, th {
                    border: 1px solid #ccc;
                    padding: 5px;
                }

                .order-details {
                    margin-top: 20px;
                }

                .total-price {
                    margin-top: 10px;
                    text-align: right;
                }
            </style>
        </head>
        <body>
            <h2>VẬN ĐƠN GIAO HÀNG</h2>
            
            <div class="invoice-details">
                <h3>Thông tin vận đơn</h3>
                
                <table>
                    <tr>
                        <th>Mã đơn hàng:</th>
                        <td>'.$DDH_MA.'</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo đơn hàng:</th>
                        <td>'. date('d/m/Y H:i:s', strtotime($all_DDH->DDH_NGAYDAT)).'</td>

                    </tr>
                    <tr>
                        <th>Người gửi hàng:</th>
                        <td class="shipper-details">
                            Tên người gửi: Cửa hàng nội thất RELAX<br>
                            Số điện thoại: 0999888777<br>
                            Địa chỉ: 123, đường Mậu Thân, Ninh Kiều, Cần Thơ
                        </td>
                    </tr>
                    <tr>
                        <th>Người nhận hàng:</th>
                        <td class="consignee-details">
                            Tên người nhận: '.$all_DDH->DCGH_HOTENNGUOINHAN.'<br>
                            Số điện thoại: '.$all_DDH->KH_SODIENTHOAI.'<br>
                            Địa chỉ: '.$all_DDH->DCGH_VITRICUTHE.', '.$all_DDH->TTP_TEN.'<br>
                            Ghi chú: '.$all_DDH->DCGH_GHICHU.'
                        </td>
                    </tr>
                </table>
            </div>

            <div class="order-details">
                <h3>Chi tiết đơn hàng</h3>

                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                    </tr>';
                    foreach ($group_DDH as $key => $ctddh){
                        $output .= '<tr>
                                        <td>'.$ctddh->NT_TEN.'</td>
                                        <td>'.$ctddh->CTDDH_SOLUONG.'</td>
                                    </tr>';
                    }
                    
            $output .= '</table>
                <br>
                <div class="total-price">
                    <h3>Tổng đơn hàng: '.number_format($all_DDH->DDH_TONGTIEN).' VNĐ</h3>
                </div>
                <div class="total-price">
                    Hình thức thanh toán: '.$all_DDH->HTTT_TEN.'
                </div>
            </div>
            
        </body>
        </html>';
        return $output;
	}


    public function update_status_order($DDH_MA){
        $this->AuthLogin();

        $trangthai = DB::table('TRANG_THAI')->orderby('TT_MA')->get(); 
        $edit_order = DB::table('don_dat_hang')->where('DDH_MA',$DDH_MA)->get();

        $manager_order = view('admin.dashboard.update_status_order')->with('edit_order', $edit_order)->with('trangthai',$trangthai);
        return view('admin-layout-detail')->with('admin.dashboard.update_status_order', $manager_order);
    }

    public function update_status(Request $request, $DDH_MA, $TT_MA){
        $this->AuthLogin();
        $NV_MA = Session::get('NV_MA');

        $data = array();
        $data['TT_MA'] = $request->TT_MA;
        DB::table('don_dat_hang')->where('DDH_MA', $request->DDH_MA)->update($data);

        Session::put('message','Cập nhật trạng thái đơn hàng thành công');
        return Redirect::to('/trang-thai/tat-ca');
    }

    //Đánh giá
    public function all_comment(){
        $this->AuthLogin();

        $danh_gia = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
        ->orderby('DG_MA','desc')->paginate(10);

        $countdg = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')->count();
    
        Session::put('countdg',$countdg);

        return view('admin.dashboard.all_comment')->with('danh_gia', $danh_gia);
    }

    public function delete_comment($DG_MA){
        $this->AuthLogin();

        $danh_gia = DB::table('danh_gia')->where('DG_MA',$DG_MA)->delete();
        Session::put('message','Xoá đánh giá thành công');

        return Redirect::to('/danh-gia');
    }
}
