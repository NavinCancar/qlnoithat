<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use Carbon\Carbon;
session_start();

class CostumerController extends Controller
{
    public function AuthLogin(){
        $KH_MA = Session::get('KH_MA');
        if($KH_MA){
            return Redirect::to('show-cart');
        }else{
            return Redirect::to('trang-chu')->send();
        }
    }
    //Dang nhap/xuat khach hang
    public function dang_nhap(){
        $all_category_product = DB::table('the_loai_sach')->get();

    	return view('login')->with('category', $all_category_product);
    }

    public function trang_chu(Request $request){
        //Đăng nhập
    	$costum_sdt = $request->sdt;
        $costum_password = $request->password;
        
        $result = DB::table('khach_hang')->where('KH_SODIENTHOAI', $costum_sdt)->where('KH_MATKHAU', $costum_password)->first();
        /*echo '<pre>';
        print_r ($result);
        echo '</pre>';*/
        
        if($result){
            Session::put('KH_HOTEN',$result->KH_HOTEN);
            Session::put('KH_MA',$result->KH_MA);
            Session::put('KH_DUONGDANANHDAIDIEN',$result->KH_DUONGDANANHDAIDIEN);
            return Redirect::to('/trang-chu');
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản sai. Vui lòng nhập lại!');
                //Session::put('message',$request->password);
                return Redirect::to('/dang-nhap');
        } 
    }

    public function logout(Request $request){
        $this->AuthLogin();
        Session::put('KH_HOTEN',null);
        Session::put('KH_MA',null);
        Session::put('KH_DUONGDANANHDAIDIEN',null);
        return Redirect::to('/trang-chu');
    }
    
    public function signup(Request $request){
        //Đăng ký
        $data = array();
        $data['KH_SODIENTHOAI'] = $request->KH_SODIENTHOAI;
        $data['KH_MATKHAU'] = $request->KH_MATKHAU;  
        $data['KH_HOTEN'] = $request->KH_HOTEN;
        $data['KH_NGAYSINH'] = $request->KH_NGAYSINH;
        $data['KH_GIOITINH'] = $request->KH_GIOITINH;
        $data['KH_DIACHI'] = $request->KH_DIACHI;
        $data['KH_EMAIL'] = $request->KH_EMAIL;
        $get_image= $request->file('KH_DUONGDANANHDAIDIEN');
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/frontend/img/khachhang',$new_image);
            $data['KH_DUONGDANANHDAIDIEN'] = $new_image;
        }
        else {
            $data['KH_DUONGDANANHDAIDIEN'] = 'macdinh.png';
        }

        $dskh=DB::table('khach_hang')->get();
        foreach ($dskh as $ds){
            if ($ds->KH_SODIENTHOAI==$request->KH_SODIENTHOAI) {
                Session::put('message','Số điện thoại này đã có trong hệ thống, vui lòng đăng ký bằng số khác!');
                return Redirect::to('/dang-nhap');
            }
        }
        DB::table('khach_hang')->insert($data);

        $KH_MA=DB::table('khach_hang')
        ->orderby('khach_hang.KH_MA','desc')->first();
        $data2 = array();
        
            $data2['GH_MA'] = $KH_MA->KH_MA;
            $data2['KH_MA'] = $KH_MA->KH_MA;
            $data2['GH_NGAYCAPNHATLANCUOI'] = Carbon::now('Asia/Ho_Chi_Minh');

            //print_r ($data2);
            DB::table('gio_hang')->insert($data2);

        //echo '<pre>';
        //print_r ($data);
        //echo '</pre>';

        $data3['GH_MA'] = $KH_MA->KH_MA;
        DB::table('khach_hang')->where('KH_MA',$KH_MA->KH_MA)->update($data3);
        
        Session::put('message','Đăng ký thành công, giờ bạn có thể đăng nhập!');
        return Redirect::to('/dang-nhap');
    }

    //Địa chỉ giao hàng
    public function all_location(){
        $this->AuthLogin();
        $KH_MA = Session::get('KH_MA');
        $all_category_product = DB::table('the_loai_sach')->get();
        $all_DCGH = DB::table('dia_chi_giao_hang')
        ->join('xa_phuong','dia_chi_giao_hang.XP_MA','=','xa_phuong.XP_MA')
        ->join('huyen_quan','huyen_quan.HQ_MA','=','xa_phuong.HQ_MA')
        ->join('tinh_thanh_pho','huyen_quan.TTP_MA','=','tinh_thanh_pho.TTP_MA')
        ->join('co_dia_chi_giao_hang','dia_chi_giao_hang.DCGH_MA','=','co_dia_chi_giao_hang.DCGH_MA')
        ->where('co_dia_chi_giao_hang.KH_MA',$KH_MA)
        ->orderby('dia_chi_giao_hang.DCGH_MA','desc')->get();
        
        $count_DCGH = DB::table('dia_chi_giao_hang')
        ->join('co_dia_chi_giao_hang','dia_chi_giao_hang.DCGH_MA','=','co_dia_chi_giao_hang.DCGH_MA')
        ->where('co_dia_chi_giao_hang.KH_MA',$KH_MA)
        ->count('dia_chi_giao_hang.DCGH_MA');
        Session::put('count_DCGH',$count_DCGH);
        return view('pages.location.all-location')->with('category', $all_category_product)
        ->with('all_DCGH', $all_DCGH);
    }

    public function add_location(){
        $this->AuthLogin();
        $KH_MA = Session::get('KH_MA');
        $all_category_product = DB::table('the_loai_sach')->get();

        $ttp= DB::table('tinh_thanh_pho')->orderby('TTP_TEN')->get();
        //$hq= DB::table('huyen_quan')->orderby('HQ_MA')->get();
        //$xp= DB::table('xa_phuong')->orderby('XP_MA')->get();
        
        return view('pages.location.add-location')->with('category', $all_category_product)
        //->with('ttp', $ttp)->with('hq', $hq)->with('xp', $xp);
        ->with(compact('ttp'));
    }

    public function select_location(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="TTP_MA"){
    			$select_HQ = DB::table('huyen_quan')->where('TTP_MA',$data['ma_id'])->orderby('HQ_TEN')->get();
    			$output.='<option value="">-- Chọn huyện / quận --</option>';
    			foreach($select_HQ as $key => $hq){
    				$output.='<option value="'.$hq->HQ_MA.'">'.$hq->HQ_TEN.'</option>';
    			}
    		}
            else{

                $select_XP = DB::table('xa_phuong')->where('HQ_MA',$data['ma_id'])->orderby('XP_TEN')->get();
    			$output.='<option value="">-- Chọn xã / phường --</option>';
    			foreach($select_XP as $key => $xp){
    				$output.='<option value="'.$xp->XP_MA.'">'.$xp->XP_TEN.'</option>';
    			}
    		}
    		echo $output;
    	}
    }

    public function save_location(Request $request){
        
        $this->AuthLogin();
        $data = array();
        $data['DCGH_HOTENNGUOINHAN'] = $request->DCGH_HOTENNGUOINHAN;
        $data['XP_MA'] = $request->XP_MA;
        $data['DCGH_SONHA'] = $request->DCGH_SONHA;
        if ($request->DCGH_GHICHU == NULL) $request->DCGH_GHICHU = "Không";
        $data['DCGH_GHICHU'] = $request->DCGH_GHICHU;

        DB::table('dia_chi_giao_hang')->insert($data);

        $data2 = array();
        $KH_MA = Session::get('KH_MA');
        $DCGH_MA=DB::table('dia_chi_giao_hang')
        ->orderby('dia_chi_giao_hang.DCGH_MA','desc')->first();
        $data2['DCGH_MA'] = $DCGH_MA->DCGH_MA;
        $data2['KH_MA'] = $KH_MA;

        DB::table('co_dia_chi_giao_hang')->insert($data2);

        Session::put('message','Thêm địa chỉ giao hàng mới thành công');
        return Redirect::to('them-dia-chi-giao-hang');
        
    }

    public function edit_location($DCGH_MA){
        $this->AuthLogin();
        $KH_MA = Session::get('KH_MA');
        $all_category_product = DB::table('the_loai_sach')->get();

        $ttp= DB::table('tinh_thanh_pho')->orderby('TTP_TEN')->get();
        $hq= DB::table('huyen_quan')->orderby('HQ_TEN')->get();
        $xp= DB::table('xa_phuong')->orderby('XP_TEN')->get();
        $edit_location = DB::table('dia_chi_giao_hang')
        ->join('xa_phuong','dia_chi_giao_hang.XP_MA','=','xa_phuong.XP_MA')
        ->join('huyen_quan','huyen_quan.HQ_MA','=','xa_phuong.HQ_MA')
        ->where('dia_chi_giao_hang.DCGH_MA',$DCGH_MA)->get();
        return view('pages.location.edit-location')->with('category', $all_category_product)
        ->with('ttp', $ttp)->with('hq', $hq)->with('xp', $xp)->with(compact('ttp'))->with('edit_location', $edit_location);
    }

    public function update_location(Request $request, $DCGH_MA){
        $this->AuthLogin();
        $data = array();
        $data['DCGH_HOTENNGUOINHAN'] = $request->DCGH_HOTENNGUOINHAN;
        $data['XP_MA'] = $request->XP_MA;
        $data['DCGH_SONHA'] = $request->DCGH_SONHA;
        if ($request->DCGH_GHICHU == NULL) $request->DCGH_GHICHU = "Không";
        $data['DCGH_GHICHU'] = $request->DCGH_GHICHU;

        DB::table('dia_chi_giao_hang')->where('DCGH_MA',$DCGH_MA)->update($data);

        Session::put('message','Cập nhật địa chỉ giao hàng thành công');
        return Redirect::to('dia-chi-giao-hang');

    }

    public function delete_location($DCGH_MA){
        $this->AuthLogin();
        DB::table('co_dia_chi_giao_hang')->where('DCGH_MA',$DCGH_MA)->delete();
        DB::table('dia_chi_giao_hang')->where('DCGH_MA',$DCGH_MA)->delete();
        
        Session::put('message','Xóa sách thành công');
        return Redirect::to('dia-chi-giao-hang');

    }

    //Account

    public function show_account(){
        $this->AuthLogin();
        $KH_MA = Session::get('KH_MA');
        $all_category_product = DB::table('the_loai_sach')->get();
        $account_info = DB::table('khach_hang')->where('KH_MA',$KH_MA)->get();
        
        return view('pages.account.show_account')
        ->with('category', $all_category_product)->with('account_info', $account_info);

    }
    public function edit_account(){
        $this->AuthLogin();
        $KH_MA = Session::get('KH_MA');
        $all_category_product = DB::table('the_loai_sach')->get();
        $account_info = DB::table('khach_hang')->where('KH_MA',$KH_MA)->get();
        
        return view('pages.account.edit_account')
        ->with('category', $all_category_product)->with('account_info', $account_info);

    }
    public function update_account(Request $request){
        $this->AuthLogin();
        $KH_MA = Session::get('KH_MA');
        $data = array();
        $data['KH_HOTEN'] = $request->KH_HOTEN;
        $data['KH_SODIENTHOAI'] = $request->KH_SODIENTHOAI;
        $data['KH_NGAYSINH'] = $request->KH_NGAYSINH;
        $data['KH_GIOITINH'] = $request->KH_GIOITINH;
        $data['KH_DIACHI'] = $request->KH_DIACHI;
        $data['KH_EMAIL'] = $request->KH_EMAIL;
        $get_image= $request->file('KH_DUONGDANANHDAIDIEN');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/frontend/img/khachhang',$new_image);
            $data['KH_DUONGDANANHDAIDIEN'] = $new_image;
        }

        DB::table('khach_hang')->where('KH_MA',$KH_MA)->update($data);
        Session::put('message','Cập nhật thông tin thành công');
        return Redirect::to('cap-nhat-tai-khoan');
    }
}
