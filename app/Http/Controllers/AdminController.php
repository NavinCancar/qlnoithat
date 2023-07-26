<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function AuthLoginChu(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            if($NV_MA != 1){
                return Redirect::to('dashboard')->send();
            }
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
    	return view('admin-login');
    }

    public function show_dashboard(){
        $this->AuthLogin();

        //Các mini box
        //Tổng đơn hàng
        $ddh = DB::table('don_dat_hang')->count();
        Session::put('SO_DDH',$ddh);

        //Đơn hàng chưa xử lý
        $ddh_cxl = DB::table('don_dat_hang')->where('TT_MA', 1)->count();
        Session::put('SO_DDH_CXL',$ddh_cxl);

        //Số người dùng
        $users = DB::table('khach_hang')->count();
        Session::put('SO_NGUOI_DUNG',$users);

        //Số nhân viên
        $emp = DB::table('nhan_vien')->count();
        Session::put('SO_NHAN_VIEN',$emp);

        //Doanh thu
        $ddh_dtt = DB::table('don_dat_hang')
        ->where('TT_MA', 4)->sum('ddh_tongtien');

        $ctlx = DB::table('chi_tiet_lo_xuat')->sum('CTLX_GIA');

        Session::put('DOANH_THU_L',$ctlx);
        Session::put('DOANH_THU_S',$ddh_dtt);

        $danh_gia = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
        ->orderby('DG_MA','desc')->get();

        $countdg = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')->count();
    
        Session::put('countdg',$countdg);
            
    	return view('admin.dashboard')->with('danh_gia',$danh_gia);
    }

    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('nhan_vien')->where('NV_EMAIL', $admin_email)->where('NV_MATKHAU', $admin_password)->first();
        /*echo '<pre>';
        print_r ($result);
        echo '</pre>';
        return view('admin.dashboard'); */
         if($result){
            Session::put('NV_HOTEN',$result->NV_HOTEN);
            Session::put('NV_MA',$result->NV_MA);
            Session::put('NV_DUONGDANANHDAIDIEN',$result->NV_DUONGDANANHDAIDIEN);
            return Redirect::to('/dashboard');
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản sai. Vui lòng nhập lại!');
                return Redirect::to('/admin');
        }
    }

    public function logout(Request $request){
        $this->AuthLogin();
        Session::put('NV_HOTEN',null);
        Session::put('NV_MA',null);
        Session::put('NV_DUONGDANANHDAIDIEN',null);
        return Redirect::to('/admin');
    }

    //Liệt kê các đơn hàng

    public function all_order(){
        $this->AuthLogin();

        $all_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')->get();
        $manager_order = view('admin.all_order')->with('all_DDH', $all_DDH);

        $count_order = DB::table('don_dat_hang')->count('DDH_MA');
        Session::put('count_order',$count_order);
        return view('admin-layout')->with('admin.all_order', $manager_order);
    }

        //Tất cả trạng thái
    public function all_status(){

        $all_status = DB::table('trang_thai')->get();

        $all_DDH=  DB::table('don_dat_hang')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'don_dat_hang.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')->get();


        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_don_dat_hang.NT_MA')->get();

        $count_order = DB::table('don_dat_hang')->count('DDH_MA');
        Session::put('count_order',$count_order);

        return view('admin.all_order')
        ->with('all_status', $all_status)
        ->with('all_DDH', $all_DDH)
        ->with('group_DDH', $group_DDH);
    }
        //Danh mục trạng thái
    public function show_status_order($TT_MA){

        $all_status = DB::table('trang_thai')->get();

        $status_by_id = DB::table('don_dat_hang')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'don_dat_hang.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')
        ->where('trang_thai.TT_MA', $TT_MA)->get();

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


        return view('admin.show_status_order')
        ->with('all_status', $all_status)
        ->with('id_status', $status_by_id)
        ->with('status_name', $status_name)
        ->with('all_DDH', $all_DDH)
        ->with('group_DDH', $group_DDH);
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

        return view('admin.search_all_order')
        ->with('all_status', $all_status)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH);
    }

    //Xem chi tiết đơn hàng
    public function show_detail($DDH_MA){
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
        ->where('trang_thai.TT_MA', $TT_MA)
        ->get();

        return view('admin.show_detail')->with('category', $all_category_product)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH)
        ->with('all_status', $all_status);

    }
    //Thống kê
    public function thong_ke(){
        $this->AuthLogin();

        $dayprev=Carbon::now('Asia/Ho_Chi_Minh')->subMonths(3);
        $daynow=Carbon::now('Asia/Ho_Chi_Minh');
        //echo $dayprev .";". $daynow;

        Session::put('TGBDau', $dayprev);
        Session::put('TGKThuc', $daynow);

        return view('admin.dashboard.thong_ke');
    }

    public function thong_ke_tg(Request $request){
        $this->AuthLogin();
        $homnay=Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->TGBDau && $request->TGKThuc && $request->TGBDau<=$request->TGKThuc && $request->TGKThuc<=$homnay ){
            Session::put('TGBDau', $request->TGBDau);
            Session::put('TGKThuc', $request->TGKThuc);
            return view('admin.dashboard.thong_ke');
        }
        
        Session::put('message','Xin kiểm tra lại dữ liệu đầu vào');
        return view('admin.dashboard.thong_ke');
    }

    //Phí ship (select_location nằm ở CostumerController)
    public function show_feeship(){
        $this->AuthLoginChu();
        $count_feeship = DB::table('tinh_thanh_pho')->count('TTP_MA');
        Session::put('count_feeship',$count_feeship);
        $dc = DB::table('tinh_thanh_pho')-> orderby('TTP_TEN') ->get();
        return view('admin.dashboard.show_feeship')->with('dc',$dc);
    }
    
    public function edit_feeship($TTP_MA){
        $this->AuthLoginChu();
        $dc = DB::table('tinh_thanh_pho')->where('TTP_MA','=',$TTP_MA)->get();
        return view('admin.dashboard.edit_feeship')->with('dc',$dc);
    }

    public function update_feeship(Request $request, $TTP_MA){
        $this->AuthLoginChu();
        $data = array();
        $data['TTP_CHIPHIGIAOHANG'] = $request->TTP_CHIPHIGIAOHANG;
        DB::table('tinh_thanh_pho')->where('TTP_MA',$TTP_MA)->update($data);
        Session::put('message','Cập nhật phí ship thành công');
        return Redirect::to('show_feeship');
    }
}
