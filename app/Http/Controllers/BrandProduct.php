<?php
//nhà cung cấp
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');

    }

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('nha_cung_cap')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        
        $count_brand_product = DB::table('nha_cung_cap')->count('NCC_MA');
        Session::put('count_brand_product',$count_brand_product);
        return view('admin-layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        //$data['NCC_MA'] = $request->brand_product_id;
        $data['NCC_TEN'] = $request->brand_product_name;
        $data['NCC_SODIENTHOAI'] = $request->brand_product_phone;
        $data['NCC_DIACHI'] = $request->brand_product_address;
        $data['NCC_EMAIL'] = $request->brand_product_email;
        

        DB::table('nha_cung_cap')->insert($data);
        Session::put('message','Thêm nhà cung cấp thành công');
        return Redirect::to('add-brand-product');


    }

    public function edit_brand_product($NCC_MA){
        $this->AuthLogin();
        $edit_brand_product = DB::table('nha_cung_cap')->where('NCC_MA',$NCC_MA)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin-layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $NCC_MA){
        $this->AuthLogin();
        $data = array();
        //$data['tên trong csdl'] = $request->phần name trong form nhập;

        //$data['NCC_MA'] = $request->brand_product_id;
        $data['NCC_TEN'] = $request->brand_product_name; 
        $data['NCC_SODIENTHOAI'] = $request->brand_product_phone;
        $data['NCC_DIACHI'] = $request->brand_product_address;
        $data['NCC_EMAIL'] = $request->brand_product_email;
        DB::table('nha_cung_cap')->where('NCC_MA',$NCC_MA)->update($data);
        Session::put('message','Cập nhật nhà cung cấp thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($NCC_MA){
        $this->AuthLogin();
        DB::table('nha_cung_cap')->where('NCC_MA',$NCC_MA)->delete();
        Session::put('message','Xóa nhà cung cấp thành công');
        return Redirect::to('all-brand-product');

    }
}
