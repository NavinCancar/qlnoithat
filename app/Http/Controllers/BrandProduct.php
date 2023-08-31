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
    
    //xưởng chế tác
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
        $all_brand_product = DB::table('xuong_che_tac')->paginate(10);
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        
        $count_brand_product = DB::table('xuong_che_tac')->count('XCT_MA');
        Session::put('count_brand_product',$count_brand_product);
        return view('admin-layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLoginChu();
        $data = array();
        //$data['XCT_MA'] = $request->brand_product_id;
        $data['XCT_TEN'] = $request->brand_product_name;
        $data['XCT_SODIENTHOAI'] = $request->brand_product_phone;
        $data['XCT_DIACHI'] = $request->brand_product_address;
        $data['XCT_EMAIL'] = $request->brand_product_email;
        
        //Kiểm tra unique
        $check_unique = DB::table('xuong_che_tac')->get();
        foreach($check_unique as $key => $unique){
            if(strtolower($unique->XCT_SODIENTHOAI)==strtolower($request->brand_product_phone)){
                Session::put('message','Số điện thoại xưởng chế tác không thể trùng');
                return Redirect::to('add-brand-product');
            }
            if(strtolower($unique->XCT_EMAIL)==strtolower($request->brand_product_email)){
                Session::put('message','Email xưởng chế tác không thể trùng');
                return Redirect::to('add-brand-product');
            }
        }
        
        DB::table('xuong_che_tac')->insert($data);
        Session::put('message','Thêm xưởng chế tác thành công');
        return Redirect::to('add-brand-product');
    }

    public function edit_brand_product($XCT_MA){
        $this->AuthLoginChu();
        $edit_brand_product = DB::table('xuong_che_tac')->where('XCT_MA',$XCT_MA)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin-layout-detail')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $XCT_MA){
        $this->AuthLoginChu();
        $data = array();
        //$data['tên trong csdl'] = $request->phần name trong form nhập;

        //$data['XCT_MA'] = $request->brand_product_id;
        $data['XCT_TEN'] = $request->brand_product_name; 
        $data['XCT_SODIENTHOAI'] = $request->brand_product_phone;
        $data['XCT_DIACHI'] = $request->brand_product_address;
        $data['XCT_EMAIL'] = $request->brand_product_email;

        //Kiểm tra unique
        $check_unique = DB::table('xuong_che_tac')->get();
        foreach($check_unique as $key => $unique){
            if($unique->XCT_MA!=$XCT_MA && strtolower($unique->XCT_SODIENTHOAI)==strtolower($request->brand_product_phone)){
                Session::put('message','Số điện thoại xưởng chế tác không thể trùng');
                return Redirect::to('all-brand-product');
            }
            if($unique->XCT_MA!=$XCT_MA && strtolower($unique->XCT_EMAIL)==strtolower($request->brand_product_email)){
                Session::put('message','Email xưởng chế tác không thể trùng');
                return Redirect::to('all-brand-product');
            }
        }
        
        DB::table('xuong_che_tac')->where('XCT_MA',$XCT_MA)->update($data);
        Session::put('message','Cập nhật xưởng chế tác thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($XCT_MA){
        $this->AuthLoginChu();

        $checkforeign = DB::table('xuong_che_tac')
        ->join('noi_that','xuong_che_tac.XCT_MA','=','noi_that.XCT_MA')
        ->where('xuong_che_tac.XCT_MA',$XCT_MA)->count();

        if($checkforeign != 0){
            Session::put('message','Có nội thất thuộc xưởng chế tác này, xưởng chế tác này không thể xoá');
            return Redirect::to('all-brand-product');
        }

        DB::table('xuong_che_tac')->where('XCT_MA',$XCT_MA)->delete();
        Session::put('message','Xóa xưởng chế tác thành công');
        return Redirect::to('all-brand-product');
    }
}
