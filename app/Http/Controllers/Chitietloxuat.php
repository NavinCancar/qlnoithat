<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class Chitietloxuat extends Controller 
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_chitiet_loxuat(){ 
        $this->AuthLogin(); 

        $sach = DB::table('sach')->orderby('SACH_MA')->get(); 
        $loxuat_product = DB::table('lo_xuat')->orderby('LX_MA')->get(); 
        return view('admin.add_chitiet_loxuat')->with('sach', $sach)->with('loxuat_product', $loxuat_product); 

        

    }
    public function all_chitiet_loxuat(){ //Hien thi tat ca lo xuat
        $this->AuthLogin(); 
        
        $all_chitiet_loxuat = DB::table('chi_tiet_lo_xuat')
        ->join('sach','sach.SACH_MA','=','chi_tiet_lo_xuat.SACH_MA')
        ->join('lo_xuat','lo_xuat.LX_MA','=','chi_tiet_lo_xuat.LX_MA')
        ->orderby('lo_xuat.LX_MA','desc')->get();
        $manager_chitiet_loxuat = view('admin.all_chitiet_loxuat')->with('all_chitiet_loxuat', $all_chitiet_loxuat);
        return view('admin-layout')->with('admin.all_chitiet_loxuat', $manager_chitiet_loxuat); 

    }

    public function save_chitiet_loxuat(Request $request){//thêm lô xuất
        $this->AuthLogin();
        $data = array();
        $data['LX_MA'] = $request->loxuat_product_name; 
        $data['SACH_MA'] = $request->masach_product_name; 
        $data['CTLX_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLX_GIA'] = $request->gia_product_name; 

        DB::table('chi_tiet_lo_xuat')->insert($data);
        Session::put('message','Thêm chi tiết lô thành công');
        return Redirect::to('add-chitiet-loxuat');


    }

    public function edit_chitiet_loxuat($LX_MA, $SACH_MA){
        $sach = DB::table('sach')->orderby('SACH_MA')->get(); 
        $loxuat_product = DB::table('lo_xuat')->orderby('LX_MA')->get(); 
        $edit_loxuat = DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->where('SACH_MA',$SACH_MA)->get();
        $manager_product = view('admin.edit_chitiet_loxuat')->with('edit_loxuat', $edit_loxuat)->with('sach',$sach)->with('loxuat_product',$loxuat_product);
        return view('admin-layout')->with('admin.edit_chitiet_loxuat', $manager_product);

        
        

    }

    public function update_chitiet_loxuat(Request $request, $LX_MA, $SACH_MA){
        $this->AuthLogin();
        $data = array();
        //$data['LX_MA'] = $request->product_desc; 
        //$data['SACH_MA'] = $request->product_desc; 
        $data['CTLX_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLX_GIA'] = $request->gia_product_name;

        DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->where('SACH_MA',$SACH_MA)->update($data);
        Session::put('message','Cập nhật chi tiết lô xuất thành công');
        return Redirect::to('all-chitiet-loxuat');

    }

    public function delete_chitiet_loxuat($LX_MA, $SACH_MA){
        $this->AuthLogin();
        DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->where('SACH_MA',$SACH_MA)->delete();
        Session::put('message','Xóa chi tiết lô xuất thành công');
        return Redirect::to('all-chitiet-loxuat');

    }
}