<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;

class CategoryProduct extends Controller
{
    //Frontend-----------------------------------------------------------
    // Danh mục sản phẩm trang chủ
    public function show_category_home($LNT_MA){
        $all_category_product = DB::table('loai_noi_that')->get();

        $category_by_id = DB::table('noi_that')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->join('loai_noi_that', 'loai_noi_that.LNT_MA', '=', 'noi_that.LNT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('loai_noi_that.LNT_MA', $LNT_MA)
        ->orderby('noi_that.NT_NGAYTAO','desc')->paginate(12);;

        $category_name = DB::table('loai_noi_that')->where('loai_noi_that.LNT_MA', $LNT_MA )->get();
       /* echo '<pre>';
        print_r ($category_by_id);
        echo '</pre>';*/

        return view('pages.category.show_category')->with('category', $all_category_product)
        ->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }


    //Backend--Only chủ cửa hàng---------------------------------------------
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

    //Loại nội thất
    public function add_category_product(){
        $this->AuthLoginChu();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLoginChu();
        $all_category_product = DB::table('loai_noi_that')->paginate(10);
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
                
        $count_category_product = DB::table('loai_noi_that')->count('LNT_MA');
        Session::put('count_category_product',$count_category_product);
        return view('admin-layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLoginChu();
        $data = array();
        //$data['LNT_MA'] = $request->category_product_desc;
        $data['LNT_TEN'] = $request->category_product_name;

        DB::table('loai_noi_that')->insert($data);
        Session::put('message','Thêm loại nội thất thành công');
        return Redirect::to('add-category-product');
    }

    public function edit_category_product($LNT_MA){
        $this->AuthLoginChu();
        $edit_category_product = DB::table('loai_noi_that')->where('LNT_MA',$LNT_MA)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin-layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $LNT_MA){
        $this->AuthLoginChu();
        $data = array();
        //$data['LNT_MA'] = $request->category_product_desc;
        $data['LNT_TEN'] = $request->category_product_name;
        DB::table('loai_noi_that')->where('LNT_MA',$LNT_MA)->update($data);
        Session::put('message','Cập nhật loại nội thất thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($LNT_MA){
        $this->AuthLoginChu();
        DB::table('loai_noi_that')->where('LNT_MA',$LNT_MA)->delete();
        Session::put('message','Xóa loại nội thất thành công');
        return Redirect::to('all-category-product');
    }
}

