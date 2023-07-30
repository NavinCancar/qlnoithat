<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class ExportController extends Controller 
{//Backend--Chủ cửa hàng + Kiểm kho-------------------------------------------------------
    
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        $CV_MA = DB::table('nhan_vien')->where('NV_MA',$NV_MA)->first();
        if($NV_MA){
            if($CV_MA->CV_MA != 1 && $CV_MA->CV_MA != 2){
                return Redirect::to('dashboard')->send();
            }
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_loxuat(){ 
        $this->AuthLogin(); 
        $nvien = DB::table('nhan_vien')->orderby('NV_MA')->get(); 
        return view('admin.add_loxuat')->with('nvien', $nvien);

    }
    public function all_loxuat(){
        $this->AuthLogin(); 

        $all_loxuat = DB::table('lo_xuat')
        ->join('nhan_vien','nhan_vien.NV_MA','=','lo_xuat.NV_MA')
        ->orderby('LX_MA','desc')->paginate(10);
        $count_loxuat = DB::table('lo_xuat')
        ->join('nhan_vien','nhan_vien.NV_MA','=','lo_xuat.NV_MA')->count();
        Session::put('count_loxuat',$count_loxuat);
        $manager_loxuat = view('admin.all_loxuat')->with('all_loxuat', $all_loxuat);
        return view('admin-layout')->with('admin.all_loxuat', $manager_loxuat); 
    }

    public function save_loxuat(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['NV_MA'] = $request->manv_product_name; 
        $data['LX_NGAYXUAT'] = $request->ngayxuat_product_name; 
        $data['LX_NOIDUNG'] = $request->noidung_product_name; 

        DB::table('lo_xuat')->insert($data);
        Session::put('message','Thêm lô thành công');
        
        $Lo=DB::table('lo_xuat')-> where('NV_MA',$request->manv_product_name)->orderby('LX_MA','desc')->first();
        $LX_MA=$Lo->LX_MA;
        return Redirect::to('show-chitiet-loxuat/'.$LX_MA);
    }

    public function edit_loxuat($LX_MA){
        $this->AuthLogin();
        
        $nvien = DB::table('nhan_vien')->orderby('NV_MA')->get();
        $edit_loxuat = DB::table('lo_xuat')->where('LX_MA',$LX_MA)->get();       
        $manager_loxuat = view('admin.edit_loxuat')->with('nvien', $nvien)->with('edit_loxuat',$edit_loxuat);
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
        DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->delete();
        DB::table('lo_xuat')->where('LX_MA',$LX_MA)->delete();
        
        Session::put('message','Xóa lô xuất thành công');
        return Redirect::to('all-loxuat');
    }

    //Chi tiết
    public function show_chitiet_loxuat($LX_MA){
        $this->AuthLogin();
        
        $nvien = DB::table('nhan_vien')->orderby('NV_MA')->get();
        $edit_loxuat = DB::table('lo_xuat')->where('LX_MA',$LX_MA)->get();   
        $all_chitiet_loxuat = DB::table('chi_tiet_lo_xuat')
        ->join('noi_that','noi_that.NT_MA','=','chi_tiet_lo_xuat.NT_MA')
        ->join('lo_xuat','lo_xuat.LX_MA','=','chi_tiet_lo_xuat.LX_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('lo_xuat.LX_MA',$LX_MA)
        ->orderby('noi_that.NT_MA')->get();
        
        $manager_loxuat = view('admin.show_chitiet_loxuat')->with('nvien', $nvien)->with('edit_loxuat', $edit_loxuat)
        ->with('all_chitiet_loxuat',$all_chitiet_loxuat);
        
        return view('admin-layout')->with('admin.edit_loxuat', $manager_loxuat);
    }

    public function add_chitiet_loxuat($LX_MA){ 
        $this->AuthLogin(); 
        $lo=DB::table('lo_xuat')->where('LX_MA',$LX_MA)->get();
        return view('admin.add_chitiet_loxuat')->with('lo', $lo); 
    }

    public function save_chitiet_loxuat(Request $request, $LX_MA){
        $this->AuthLogin();
        $data = array();
        $data['LX_MA'] = $LX_MA; 
        $data['NT_MA'] = $request->mant_product_name; 
        $data['CTLX_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLX_GIA'] = $request->gia_product_name; 
    
        //Check mã đã nhập
        $check=DB::table('chi_tiet_lo_xuat')
        ->where('LX_MA', $LX_MA)->where('NT_MA', $request->mant_product_name)->count();

        if($check!=0){
            Session::put('message','Nội thất đã được thêm rồi, vui lòng chọn nội thất khác!');
            return Redirect::to('add-chitiet-loxuat/'.$LX_MA);
        }

        //Check mã tồn tại
        $check=DB::table('noi_that')->where('NT_MA', $request->mant_product_name)->count();

        if($check!=1){
            Session::put('message','Nội thất không tồn tại trong hệ thống, vui lòng kiểm tra lại!');
            return Redirect::to('add-chitiet-loxuat/'.$LX_MA);
        }

        //Check số lượng tồn
        $ddh = DB::table('chi_tiet_don_dat_hang')
        ->join('don_dat_hang','chi_tiet_don_dat_hang.DDH_MA','=','don_dat_hang.DDH_MA')
        ->where('TT_MA', '!=', 5)
        ->where('NT_MA', $request->mant_product_name)->sum('CTDDH_SOLUONG');

        $nhap = DB::table('chi_tiet_lo_nhap')
            ->where('NT_MA', $request->mant_product_name)->sum('CTLN_SOLUONG');
        $xuat = DB::table('chi_tiet_lo_xuat')
            ->where('NT_MA', $request->mant_product_name)->sum('CTLX_SOLUONG');

        if ($nhap-$xuat-$ddh<$request->soluong_product_name){
            Session::put('message','Số lượng nhập lớn hơn số lượng tồn, nội thất chỉ còn tồn: '.$nhap-$xuat-$ddh);
            return Redirect::to('add-chitiet-loxuat/'.$LX_MA);
        }

        if ($nhap-$xuat-$ddh-$request->soluong_product_name==0){
            DB::table('chi_tiet_gio_hang')->where('NT_MA', $request->mant_product_name)->delete();
        }

        DB::table('chi_tiet_lo_xuat')->insert($data);
        Session::put('message','Thêm chi tiết lô xuất thành công');
        return Redirect::to('show-chitiet-loxuat/'.$LX_MA);
    }

    public function edit_chitiet_loxuat($LX_MA, $NT_MA){
        $this->AuthLogin();
        $noithat = DB::table('noi_that')->orderby('NT_MA')->get(); 
        $loxuat_product = DB::table('lo_xuat')->orderby('LX_MA')->get(); 
        $edit_loxuat = DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->where('NT_MA',$NT_MA)->get();
        $manager_product = view('admin.edit_chitiet_loxuat')->with('edit_loxuat', $edit_loxuat)->with('noithat',$noithat)->with('loxuat_product',$loxuat_product);
        return view('admin-layout')->with('admin.edit_chitiet_loxuat', $manager_product);
    }

    public function update_chitiet_loxuat(Request $request, $LX_MA, $NT_MA){
        $this->AuthLogin();
        $data = array();
        //$data['LX_MA'] = $request->product_desc; 
        //$data['NT_MA'] = $request->product_desc; 
        $data['CTLX_SOLUONG'] = $request->soluong_product_name; 
        $data['CTLX_GIA'] = $request->gia_product_name;

        DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->where('NT_MA',$NT_MA)->update($data);
        Session::put('message','Cập nhật chi tiết lô xuất thành công');
       return Redirect::to('show-chitiet-loxuat/'.$LX_MA);
    }

    public function delete_chitiet_loxuat($LX_MA, $NT_MA){
        $this->AuthLogin();
        DB::table('chi_tiet_lo_xuat')->where('LX_MA',$LX_MA)->where('NT_MA',$NT_MA)->delete();
        Session::put('message','Xóa chi tiết lô xuất thành công');
        return Redirect::to('show-chitiet-loxuat/'.$LX_MA);
    }
}

