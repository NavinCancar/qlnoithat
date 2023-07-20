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
        $NV_MA_get = Session::get('NV_MA');

        $trangthai = DB::table('TRANG_THAI')->get(); 
        $nhanvienxl = DB::table('NHANVIEN')-> orderby('NV_MA','desc')->get(); 
        $edit_order = DB::table('chi_tiet_trang_thai')->where('DDH_MA',$DDH_MA)->get();
        Session::put('NV_MA_get',$NV_MA_get);
        $manager_order = view('admin.dashboard.update_status_order')->with('edit_order', $edit_order)
        ->with('trangthai',$trangthai)->with('nhanvienxl',$nhanvienxl);
        return view('admin-layout')->with('admin.dashboard.update_status_order', $manager_order);
    }

    public function update_status(Request $request, $DDH_MA, $TT_MA){
        $this->AuthLogin();
        $NV_MA = Session::get('NV_MA');

        $data = array();
        $data['DDH_MA'] = $request->DDH_MA;
        $data['TT_MA'] = $request->TT_MA;
        $data['CTTT_NGAYCAPNHAT'] = Carbon::now('Asia/Ho_Chi_Minh');
        $data['CTTT_GHICHU'] =  $request->CTTT_GHICHU;
        DB::table('chi_tiet_trang_thai')->insert($data);


        $data2 = array();
        $data2['DDH_MA'] = $request->DDH_MA;
        $data2['TT_MA'] = $request->TT_MA;
        $data2['NV_MA'] = $NV_MA;
        DB::table('duoc_quan_ly_boi')->insert($data2);

        
        
        if($request->TT_MABD==1){
            $data3 = array();
            $data3['DDH_MA'] = $request->DDH_MA;
            $data3['NV_MA'] = $request->NVXL_MA;
            DB::table('duoc_xu_ly')->insert($data3);
            /*echo '<pre>';
            print_r ($data);
            print_r ($data2);
            print_r ($data3);
            echo '</pre>';*/
        }
        

        DB::table('duoc_quan_ly_boi')->where('TT_MA', $request->TT_MABD)->where('DDH_MA', $request->DDH_MA)->delete();
        DB::table('chi_tiet_trang_thai')->where('TT_MA', $request->TT_MABD)->where('DDH_MA', $request->DDH_MA)->delete();
        Session::put('message','Cập nhật trạng thái đơn đặt hàng thành công');
        return Redirect::to('/trang-thai/tat-ca');
    }

    public function all_lktt_trangthaiddh(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_lktt_trangthaiddh = DB::table('duoc_quan_ly_boi')
        ->join('nhanvien','nhanvien.NV_MA','=','duoc_quan_ly_boi.NV_MA')
        ->join('trang_thai','trang_thai.TT_MA','=','duoc_quan_ly_boi.TT_MA')
        ->orderby('nhanvien.NV_MA')->get();

        
        $manager_lktt_trangthaiddh = view('admin.all_lktt_trangthaiddh')->with('all_lktt_trangthaiddh', $all_lktt_trangthaiddh);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_lktt_trangthaiddh', $manager_lktt_trangthaiddh); 
    }

    public function all_nguoixuly(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_nguoixuly = DB::table('duoc_xu_ly')
        ->join('nhanvien','nhanvien.NV_MA','=','duoc_xu_ly.NV_MA')
        
        ->orderby('nhanvien.NV_MA')->get();

        
        $manager_nguoixuly = view('admin.all_nguoixuly')->with('all_nguoixuly', $all_nguoixuly);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_nguoixuly', $manager_nguoixuly); 
    }


}
