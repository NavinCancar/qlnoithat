<?php
//Tác giả
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class TacgiaProduct extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_tacgia_product(){
        $this->AuthLogin();
        return view('admin.add_tacgia_product');

    }

    public function all_tacgia_product(){
        $this->AuthLogin();
        $all_tacgia_product = DB::table('tac_gia')->orderby('TG_MA','desc')->get();
                
        $count_tacgia_product = DB::table('tac_gia')->count('TG_MA');
        Session::put('count_tacgia_product',$count_tacgia_product);
        $manager_brand_product = view('admin.all_tacgia_product')->with('all_tacgia_product', $all_tacgia_product);
        return view('admin-layout')->with('admin.all_tacgia_product', $manager_brand_product);
    }

    public function save_tacgia_product(Request $request){
        $this->AuthLogin();
        $data = array();
        //$data['TG_MA'] = $request->tacgia_product_id;
        $data['TG_HOTEN'] = $request->tacgia_product_name;
        $data['TG_BUTDANH'] = $request->tacgia_product_butdanh;
        $data['TG_NGAYSINH'] = $request->tacgia_product_date;
        $data['TG_GIOITINH'] = $request->tacgia_product_gioitinh;

        DB::table('tac_gia')->insert($data);
        Session::put('message','Thêm tác giả thành công');
        return Redirect::to('add-tacgia-product');


    }

    public function edit_tacgia_product($TG_MA){
        $this->AuthLogin();
        $edit_tacgia_product = DB::table('tac_gia')->where('TG_MA',$TG_MA)->get();
        $manager_tacgia_product = view('admin.edit_tacgia_product')->with('edit_tacgia_product', $edit_tacgia_product);
        return view('admin-layout')->with('admin.edit_tacgia_product', $manager_tacgia_product);
    }

    public function update_tacgia_product(Request $request, $TG_MA){
        $this->AuthLogin();
        $data = array();
        //$data['tên trong csdl'] = $request->phần name trong form nhập;

        //$data['TG_MA'] = $request->tacgia_product_id;
        $data['TG_HOTEN'] = $request->tacgia_product_name; 
        $data['TG_BUTDANH'] = $request->tacgia_product_butdanh;
        $data['TG_NGAYSINH'] = $request->tacgia_product_date;
        $data['TG_GIOITINH'] = $request->tacgia_product_gioitinh;
        DB::table('tac_gia')->where('TG_MA',$TG_MA)->update($data);
        Session::put('message','Cập nhật tác giả thành công');
        return Redirect::to('all-tacgia-product');

    }

    public function delete_tacgia_product($TG_MA){
        $this->AuthLogin();
        DB::table('tac_gia')->where('TG_MA',$TG_MA)->delete();
        Session::put('message','Xóa tác giả thành công');
        return Redirect::to('all-tacgia-product');

    }
}