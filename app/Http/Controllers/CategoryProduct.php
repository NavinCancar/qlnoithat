<?php
//Loại nội thất
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');

    }

    public function all_category_product(){ //Hien thi tat ca
        $this->AuthLogin();
        $all_category_product = DB::table('loai_noi_that')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
                
        $count_category_product = DB::table('loai_noi_that')->count('LNT_MA');
        Session::put('count_category_product',$count_category_product);
        return view('admin-layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){//Thêm loại nội thất
        $this->AuthLogin();
        $data = array();
        //$data['LNT_MA'] = $request->category_product_desc;
        $data['LNT_TEN'] = $request->category_product_name;

        DB::table('loai_noi_that')->insert($data);
        Session::put('message','Thêm loại nội thất thành công');
        return Redirect::to('add-category-product');
    }

    public function edit_category_product($LNT_MA){
        $this->AuthLogin();
        $edit_category_product = DB::table('loai_noi_that')->where('LNT_MA',$LNT_MA)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin-layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $LNT_MA){
        $this->AuthLogin();
        $data = array();
        //$data['LNT_MA'] = $request->category_product_desc;
        $data['LNT_TEN'] = $request->category_product_name;
        DB::table('loai_noi_that')->where('LNT_MA',$LNT_MA)->update($data);
        Session::put('message','Cập nhật loại nội thất thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($LNT_MA){
        $this->AuthLogin();
        DB::table('loai_noi_that')->where('LNT_MA',$LNT_MA)->delete();
        Session::put('message','Xóa loại nội thất thành công');
        return Redirect::to('all-category-product');

    }

    // Danh mục sản phẩm trang chủ
    public function show_category_home($LNT_MA){
        $all_category_product = DB::table('loai_noi_that')->get();

        $category_by_id = DB::table('noi_that')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->join('loai_noi_that', 'loai_noi_that.LNT_MA', '=', 'noi_that.LNT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('loai_noi_that.LNT_MA', $LNT_MA)
        ->orderby('noi_that.NT_NGAYTAO','desc')
        ->get();

        $category_name = DB::table('loai_noi_that')->where('loai_noi_that.LNT_MA', $LNT_MA )->get();
       /* echo '<pre>';
        print_r ($category_by_id);
        echo '</pre>';*/

        return view('pages.category.show_category')->with('category', $all_category_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name);
    }

}

