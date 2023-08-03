<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{//Backend--Only chủ cửa hàng-------------------------------------------------------
    
    //Nhà cung cấp
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

    public function add_brand_product(){
        $this->AuthLoginChu();
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLoginChu();
        $all_brand_product = DB::table('nha_cung_cap')->paginate(10);
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        
        $count_brand_product = DB::table('nha_cung_cap')->count('NCC_MA');
        Session::put('count_brand_product',$count_brand_product);
        return view('admin-layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLoginChu();
        $data = array();
        //$data['NCC_MA'] = $request->brand_product_id;
        $data['NCC_TEN'] = $request->brand_product_name;
        $data['NCC_SODIENTHOAI'] = $request->brand_product_phone;
        $data['NCC_DIACHI'] = $request->brand_product_address;
        $data['NCC_EMAIL'] = $request->brand_product_email;
        
        //Kiểm tra unique
        $check_unique = DB::table('nha_cung_cap')->get();
        foreach($check_unique as $key => $unique){
            if(strtolower($unique->NCC_SODIENTHOAI)==strtolower($request->brand_product_phone)){
                Session::put('message','Số điện thoại nhà cung cấp không thể trùng');
                return Redirect::to('add-brand-product');
            }
            if(strtolower($unique->NCC_EMAIL)==strtolower($request->brand_product_email)){
                Session::put('message','Email nhà cung cấp không thể trùng');
                return Redirect::to('add-brand-product');
            }
        }
        
        DB::table('nha_cung_cap')->insert($data);
        Session::put('message','Thêm nhà cung cấp thành công');
        return Redirect::to('add-brand-product');
    }

    public function edit_brand_product($NCC_MA){
        $this->AuthLoginChu();
        $edit_brand_product = DB::table('nha_cung_cap')->where('NCC_MA',$NCC_MA)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin-layout-detail')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $NCC_MA){
        $this->AuthLoginChu();
        $data = array();
        //$data['tên trong csdl'] = $request->phần name trong form nhập;

        //$data['NCC_MA'] = $request->brand_product_id;
        $data['NCC_TEN'] = $request->brand_product_name; 
        $data['NCC_SODIENTHOAI'] = $request->brand_product_phone;
        $data['NCC_DIACHI'] = $request->brand_product_address;
        $data['NCC_EMAIL'] = $request->brand_product_email;

        //Kiểm tra unique
        $check_unique = DB::table('nha_cung_cap')->get();
        foreach($check_unique as $key => $unique){
            if($unique->NCC_MA!=$NCC_MA && strtolower($unique->NCC_SODIENTHOAI)==strtolower($request->brand_product_phone)){
                Session::put('message','Số điện thoại nhà cung cấp không thể trùng');
                return Redirect::to('all-brand-product');
            }
            if($unique->NCC_MA!=$NCC_MA && strtolower($unique->NCC_EMAIL)==strtolower($request->brand_product_email)){
                Session::put('message','Email nhà cung cấp không thể trùng');
                return Redirect::to('all-brand-product');
            }
        }
        
        DB::table('nha_cung_cap')->where('NCC_MA',$NCC_MA)->update($data);
        Session::put('message','Cập nhật nhà cung cấp thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($NCC_MA){
        $this->AuthLoginChu();
        DB::table('nha_cung_cap')->where('NCC_MA',$NCC_MA)->delete();
        Session::put('message','Xóa nhà cung cấp thành công');
        return Redirect::to('all-brand-product');
    }
}
