<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class Loxuat extends Controller 
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_loxuat(){ 
        $this->AuthLogin(); 
        $nvien = DB::table('nhanvien')->orderby('NV_MA')->get(); 
        return view('admin.add_loxuat')->with('nvien', $nvien);

    }
    public function all_loxuat(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_loxuat = DB::table('lo_xuat')
        ->join('nhanvien','nhanvien.NV_MA','=','lo_xuat.NV_MA')
        //->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->orderby('LX_MA','desc')->get();
        $manager_loxuat = view('admin.all_loxuat')->with('all_loxuat', $all_loxuat);
        return view('admin-layout')->with('admin.all_loxuat', $manager_loxuat); 
    }

    public function save_loxuat(Request $request){//thêm lô nhập 
        $this->AuthLogin();
        $data = array();
        //$data['LX_MA'] = $request->product_desc; 
        //$data['LX_MA'] = $request->malx_product_name; 
        $data['NV_MA'] = $request->manv_product_name; 
        $data['LX_NGAYXUAT'] = $request->ngayxuat_product_name; 
        $data['LX_NOIDUNG'] = $request->noidung_product_name; 
        //$data['SACH_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        //$data['SACH_NGAYTAO'] =  Carbon::now('Asia/Ho_Chi_Minh');
        //$data['SACH_SOTRANG'] = $request->SACH_SOTRANG;
        //$data['SACH_ISBN'] = $request->SACH_ISBN;
        //$data['NXB_MA'] = $request->NXB_MA;
        //$data['NN_MA'] = $request->NN_MA;

        DB::table('lo_xuat')->insert($data);
        Session::put('message','Thêm lô thành công');
        return Redirect::to('add-loxuat');


    }

    public function edit_loxuat($LX_MA){
        $this->AuthLogin();
        
        $nvien = DB::table('nhanvien')->orderby('NV_MA')->get();
        $edit_loxuat = DB::table('lo_xuat')->where('LX_MA',$LX_MA)->get();       
        $manager_loxuat = view('admin.edit_loxuat')->with('nvien', $nvien)->with('edit_loxuat',$edit_loxuat);
        //->with('nvien_product',$nvien_product);
        return view('admin-layout')->with('admin.edit_loxuat', $manager_loxuat);

    }

    public function update_loxuat(Request $request, $LX_MA){
        $this->AuthLogin();
        $data = array();
        $data['LX_MA'] = $request->malx_product_name;
        $data['NV_MA'] = $request->manv_product_name;
        $data['LX_NGAYXUAT'] = $request->ngayxuat_product_name;
        $data['LX_NOIDUNG'] = $request->noidung_product_name;
        DB::table('lo_xuat')->where('LX_MA',$LX_MA)->update($data);
        Session::put('message','Cập nhật lô xuất thành công');
        return Redirect::to('all-loxuat');

    }

    public function delete_loxuat($LX_MA){
        $this->AuthLogin();
        DB::table('lo_xuat')->where('LX_MA',$LX_MA)->delete();
        Session::put('message','Xóa lô xuất thành công');
        return Redirect::to('all-loxuat');

    }
}
