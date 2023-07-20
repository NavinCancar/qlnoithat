<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class Chitietlonhap extends Controller 
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_chitiet_lonhap(){ 
        $this->AuthLogin(); 

        $sach = DB::table('sach')->orderby('SACH_MA')->get(); 
        $lonhap_product = DB::table('lo_nhap')->orderby('LN_MA')->get(); 
        return view('admin.add_chitiet_lonhap')->with('sach', $sach)->with('lonhap_product', $lonhap_product); 

        

    }
    public function all_chitiet_lonhap(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 
        
        $all_chitiet_lonhap = DB::table('chi_tiet_lo_nhap')
        ->join('sach','sach.SACH_MA','=','chi_tiet_lo_nhap.SACH_MA')
        ->join('lo_nhap','lo_nhap.LN_MA','=','chi_tiet_lo_nhap.LN_MA')
        ->orderby('lo_nhap.LN_MA','desc')->get();
        $manager_chitiet_lonhap = view('admin.all_chitiet_lonhap')->with('all_chitiet_lonhap', $all_chitiet_lonhap);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_chitiet_lonhap', $manager_chitiet_lonhap); 

    }

    public function save_chitiet_lonhap(Request $request){//thêm lô nhập 
        $this->AuthLogin();
        $data = array();
        $data['LN_MA'] = $request->lonhap_product_name; 
        $data['SACH_MA'] = $request->masach_product_name; 
        $data['CTLN_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLN_GIA'] = $request->gia_product_name; 

        DB::table('chi_tiet_lo_nhap')->insert($data);
        Session::put('message','Thêm chi tiết lô thành công');
        return Redirect::to('add-chitiet-lonhap');


    }

    public function edit_chitiet_lonhap($LN_MA, $SACH_MA){
        $sach = DB::table('sach')->orderby('SACH_MA')->get(); 
        $lonhap_product = DB::table('lo_nhap')->orderby('LN_MA')->get(); 
        $edit_lonhap = DB::table('chi_tiet_lo_nhap')->where('LN_MA',$LN_MA)->where('SACH_MA',$SACH_MA)->get();
        $manager_product = view('admin.edit_chitiet_lonhap')->with('edit_lonhap', $edit_lonhap)->with('sach',$sach)->with('lonhap_product',$lonhap_product);
        return view('admin-layout')->with('admin.edit_chitiet_lonhap', $manager_product);

    }

    public function update_chitiet_lonhap(Request $request, $LN_MA, $SACH_MA){
        $this->AuthLogin();
        $data = array();
        //$data['LN_MA'] = $request->product_desc; 
        //$data['SACH_MA'] = $request->product_desc; 
        $data['CTLN_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLN_GIA'] = $request->gia_product_name;

        DB::table('chi_tiet_lo_nhap')->where('LN_MA',$LN_MA)->where('SACH_MA',$SACH_MA)->update($data);
        Session::put('message','Cập nhật chi tiết lô nhập thành công');
        return Redirect::to('all-chitiet-lonhap');

    }

    public function delete_chitiet_lonhap($LN_MA, $SACH_MA){
        $this->AuthLogin();
        DB::table('chi_tiet_lo_nhap')->where('LN_MA',$LN_MA)->where('SACH_MA',$SACH_MA)->delete();
        Session::put('message','Xóa chi tiết lô nhập thành công');
        return Redirect::to('all-chitiet-lonhap');

    }
}