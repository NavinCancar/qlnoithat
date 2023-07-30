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
{//Backend---------------------------------------------------------------------------

    public function AuthLoginChu(){
        $NV_MA = Session::get('NV_MA');
        $CV_MA = DB::table('nhan_vien')->where('NV_MA',$NV_MA)->first();
        if($NV_MA){
            if($CV_MA->CV_MA != 1){
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

    //--All

    //Giao diện
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
        $homnay=Carbon::now('Asia/Ho_Chi_Minh');

        $ddh_dtt = DB::table('don_dat_hang')->where('TT_MA', 4)
        ->whereMonth('DDH_NGAYDAT', $homnay)->whereYear('DDH_NGAYDAT', $homnay)->sum('ddh_tongtien');

        $ctlx = DB::table('chi_tiet_lo_xuat')
        ->join('lo_xuat','lo_xuat.LX_MA','=','chi_tiet_lo_xuat.LX_MA')
        ->whereMonth('LX_NGAYXUAT', $homnay)->whereYear('LX_NGAYXUAT', $homnay)->sum('CTLX_GIA');

        Session::put('DOANH_THU_L',$ctlx);
        Session::put('DOANH_THU_S',$ddh_dtt);
            
    	return view('admin.dashboard');
    }

    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('nhan_vien')->where('NV_EMAIL', $admin_email)->where('NV_MATKHAU', $admin_password)->first();
        if($result){
            Session::put('NV_HOTEN',$result->NV_HOTEN);
            Session::put('NV_MA',$result->NV_MA);
            Session::put('CV_MA_User',$result->CV_MA);
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

    //--Only chủ cửa hàng

    //Thống kê
    public function thong_ke(){
        $this->AuthLoginChu();

        $dayprev=Carbon::now('Asia/Ho_Chi_Minh')->subMonths(3);
        $daynow=Carbon::now('Asia/Ho_Chi_Minh');
        //echo $dayprev .";". $daynow;

        Session::put('TGBDau', $dayprev);
        Session::put('TGKThuc', $daynow);

        return view('admin.dashboard.thong_ke');
    }

    public function thong_ke_tg(Request $request){
        $this->AuthLoginChu();
        $homnay=Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->TGBDau && $request->TGKThuc && $request->TGBDau<=$request->TGKThuc && $request->TGKThuc<=$homnay ){
            Session::put('TGBDau', $request->TGBDau);
            Session::put('TGKThuc', $request->TGKThuc);
            return view('admin.dashboard.thong_ke');
        }
        Session::put('message','Xin kiểm tra lại dữ liệu đầu vào');
        return view('admin.dashboard.thong_ke');
    }

    //Phí ship
    public function show_feeship(){
        $this->AuthLoginChu();
        $count_feeship = DB::table('tinh_thanh_pho')->count('TTP_MA');
        Session::put('count_feeship',$count_feeship);
        $dc = DB::table('tinh_thanh_pho')-> orderby('TTP_TEN')->paginate(10);
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
