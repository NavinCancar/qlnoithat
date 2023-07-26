<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Carbon\Carbon;
session_start();

class OrderController extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function update_status_order($DDH_MA){
        $this->AuthLogin();

        $trangthai = DB::table('TRANG_THAI')->get(); 
        $edit_order = DB::table('don_dat_hang')->where('DDH_MA',$DDH_MA)->get();

        $manager_order = view('admin.dashboard.update_status_order')->with('edit_order', $edit_order)->with('trangthai',$trangthai);
        return view('admin-layout')->with('admin.dashboard.update_status_order', $manager_order);
    }

    public function update_status(Request $request, $DDH_MA, $TT_MA){
        $this->AuthLogin();
        $NV_MA = Session::get('NV_MA');

        $data = array();
        $data['TT_MA'] = $request->TT_MA;
        DB::table('don_dat_hang')->where('DDH_MA', $request->DDH_MA)->update($data);

        Session::put('message','Cập nhật trạng thái đơn đặt hàng thành công');
        return Redirect::to('/trang-thai/tat-ca');
    }

    public function all_lktt_trangthaiddh(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_lktt_trangthaiddh = DB::table('duoc_quan_ly_boi')
        ->join('nhan_vien','nhanvien.NV_MA','=','duoc_quan_ly_boi.NV_MA')
        ->join('trang_thai','trang_thai.TT_MA','=','duoc_quan_ly_boi.TT_MA')
        ->orderby('nhanvien.NV_MA')->get();

        
        $manager_lktt_trangthaiddh = view('admin.all_lktt_trangthaiddh')->with('all_lktt_trangthaiddh', $all_lktt_trangthaiddh);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_lktt_trangthaiddh', $manager_lktt_trangthaiddh); 
    }

    public function all_nguoixuly(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_nguoixuly = DB::table('duoc_xu_ly')
        ->join('nhan_vien','nhanvien.NV_MA','=','duoc_xu_ly.NV_MA')
        
        ->orderby('nhanvien.NV_MA')->get();

        
        $manager_nguoixuly = view('admin.all_nguoixuly')->with('all_nguoixuly', $all_nguoixuly);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_nguoixuly', $manager_nguoixuly); 
    }


}
