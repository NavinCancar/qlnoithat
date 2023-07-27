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
        $nvien = DB::table('nhan_vien')->orderby('NV_MA')->get(); 
        //$lang_product = DB::table('ngon_ngu')->orderby('NN_MA')->get(); 
        return view('admin.add_lonhap')->with('nvien', $nvien);
        //->with('nvien_product', $nvien_product); 

    }
    public function all_lonhap(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_lonhap = DB::table('lo_nhap')
        ->join('nhan_vien','nhan_vien.NV_MA','=','lo_nhap.NV_MA')
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
        
        $nvien = DB::table('nhan_vien')->orderby('NV_MA')->get();
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

    //Chi tiết
    public function show_chitiet_lonhap($LN_MA){
        $this->AuthLogin();
        
        $nvien = DB::table('nhan_vien')->orderby('NV_MA')->get();
        $edit_lonhap = DB::table('lo_nhap')->where('LN_MA',$LN_MA)->get();   
        $all_chitiet_lonhap = DB::table('chi_tiet_lo_nhap')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_lo_nhap.NT_MA')
        ->join('lo_nhap','lo_nhap.LN_MA','=','chi_tiet_lo_nhap.LN_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('lo_nhap.LN_MA',$LN_MA)
        ->orderby('noi_that.NT_MA')->get();
        
        $manager_lonhap = view('admin.show_chitiet_lonhap')->with('nvien', $nvien)->with('edit_lonhap', $edit_lonhap)
        ->with('all_chitiet_lonhap',$all_chitiet_lonhap);
        
        return view('admin-layout')->with('admin.edit_lonhap', $manager_lonhap);
    }

    public function add_chitiet_lonhap($LN_MA){ 
        $this->AuthLogin(); 
        $lo=DB::table('lo_nhap')->where('LN_MA',$LN_MA)->get();
    
        return view('admin.add_chitiet_lonhap')->with('lo', $lo); 
    }

    public function save_chitiet_lonhap(Request $request, $LN_MA){
        $this->AuthLogin();
        $data = array();
        $data['LN_MA'] = $LN_MA; 
        $data['NT_MA'] = $request->mant_product_name; 
        $data['CTLN_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLN_GIA'] = $request->gia_product_name; 

        $check=DB::table('chi_tiet_lo_nhap')
        ->where('LN_MA', $LN_MA)->where('NT_MA', $request->mant_product_name)->count();

        if($check!=0){
            Session::put('message','Nội thất đã được thêm rồi, vui lòng chọn nội thất khác!');
            return Redirect::to('add-chitiet-lonhap/'.$LN_MA);
        }

        DB::table('chi_tiet_lo_nhap')->insert($data);
        Session::put('message','Thêm chi tiết lô nhập thành công');
        return Redirect::to('show-chitiet-lonhap/'.$LN_MA);
    }

    public function edit_chitiet_lonhap($LN_MA, $NT_MA){
        $noithat = DB::table('noi_that')->orderby('NT_MA')->get(); 
        $lonhap_product = DB::table('lo_nhap')->orderby('LN_MA')->get(); 
        $edit_lonhap = DB::table('chi_tiet_lo_nhap')->where('LN_MA',$LN_MA)->where('NT_MA',$NT_MA)->get();
        $manager_product = view('admin.edit_chitiet_lonhap')->with('edit_lonhap', $edit_lonhap)->with('noithat',$noithat)->with('lonhap_product',$lonhap_product);
        return view('admin-layout')->with('admin.edit_chitiet_lonhap', $manager_product);
    }

    public function update_chitiet_lonhap(Request $request, $LN_MA, $NT_MA){
        $this->AuthLogin();
        $data = array();
        //$data['LN_MA'] = $request->product_desc; 
        //$data['NT_MA'] = $request->product_desc; 
        $data['CTLN_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLN_GIA'] = $request->gia_product_name;

        DB::table('chi_tiet_lo_nhap')->where('LN_MA',$LN_MA)->where('NT_MA',$NT_MA)->update($data);
        Session::put('message','Cập nhật chi tiết lô nhập thành công');
       return Redirect::to('show-chitiet-lonhap/'.$LN_MA);
    }

    public function delete_chitiet_lonhap($LN_MA, $NT_MA){
        $this->AuthLogin();
        DB::table('chi_tiet_lo_nhap')->where('LN_MA',$LN_MA)->where('NT_MA',$NT_MA)->delete();
        Session::put('message','Xóa chi tiết lô nhập thành công');
        return Redirect::to('show-chitiet-lonhap/'.$LN_MA);
    }
}
