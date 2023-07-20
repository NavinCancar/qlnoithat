<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class Lonhap extends Controller 
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_lonhap(){ 
        $this->AuthLogin(); 
        $nvien = DB::table('nhanvien')->orderby('NV_MA')->get(); 
        //$lang_product = DB::table('ngon_ngu')->orderby('NN_MA')->get(); 
        return view('admin.add_lonhap')->with('nvien', $nvien);
        //->with('nvien_product', $nvien_product); 

    }
    public function all_lonhap(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_lonhap = DB::table('lo_nhap')
        ->join('nhanvien','nhanvien.NV_MA','=','lo_nhap.NV_MA')
        //->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->orderby('LN_MA','desc')->get();
        $manager_lonhap = view('admin.all_lonhap')->with('all_lonhap', $all_lonhap);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_lonhap', $manager_lonhap); 
    }

    public function save_lonhap(Request $request){//thêm lô nhập 
        $this->AuthLogin();
        $data = array();
        //$data['LN_MA'] = $request->product_desc; 
        //$data['LN_MA'] = $request->maln_product_name; 
        $data['NV_MA'] = $request->manv_product_name; 
        $data['LN_NGAYNHAP'] = $request->ngaynhap_product_name; 
        $data['LN_NOIDUNG'] = $request->noidung_product_name; 
        //$data['SACH_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        //$data['SACH_NGAYTAO'] =  Carbon::now('Asia/Ho_Chi_Minh');
        //$data['SACH_SOTRANG'] = $request->SACH_SOTRANG;
        //$data['SACH_ISBN'] = $request->SACH_ISBN;
        //$data['NXB_MA'] = $request->NXB_MA;
        //$data['NN_MA'] = $request->NN_MA;

        DB::table('lo_nhap')->insert($data);
        Session::put('message','Thêm lô thành công');
        return Redirect::to('add-lonhap');


    }

    public function edit_lonhap($LN_MA){
        $this->AuthLogin();
        
        $nvien = DB::table('nhanvien')->orderby('NV_MA')->get();
        $edit_lonhap = DB::table('lo_nhap')->where('LN_MA',$LN_MA)->get();       
        $manager_lonhap = view('admin.edit_lonhap')->with('nvien', $nvien)->with('edit_lonhap', $edit_lonhap);
        //->with('nvien_product',$nvien_product);
        
        return view('admin-layout')->with('admin.edit_lonhap', $manager_lonhap);

    }

    public function update_lonhap(Request $request, $LN_MA){
        $this->AuthLogin();
        $data = array();
        $data['LN_MA'] = $request->maln_product_name;
        $data['NV_MA'] = $request->manv_product_name;
        $data['LN_NGAYNHAP'] = $request->ngaynhap_product_name;
        $data['LN_NOIDUNG'] = $request->noidung_product_name;
        DB::table('lo_nhap')->where('LN_MA',$LN_MA)->update($data);
        Session::put('message','Cập nhật lô nhập thành công');
        return Redirect::to('all-lonhap');

    }

    public function delete_lonhap($LN_MA){
        $this->AuthLogin();
        DB::table('lo_nhap')->where('LN_MA',$LN_MA)->delete();
        Session::put('message','Xóa lô nhập thành công');
        return Redirect::to('all-lonhap');

    }
}
