<?php
//Chức vụ
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;

class Chucvu extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_chucvu(){
        $this->AuthLogin();
        return view('admin.add_chucvu');

    }

    public function all_chucvu(){ //Hien thi tat ca
        $this->AuthLogin();
        $all_chucvu = DB::table('chuc_vu')->get();
        $manager_chucvu = view('admin.all_chucvu')->with('all_chucvu', $all_chucvu);
                
        $count_chucvu = DB::table('chuc_vu')->count('CV_MA');
        Session::put('count_chucvu',$count_chucvu);
        return view('admin-layout')->with('admin.all_chucvu', $manager_chucvu);
    }

    public function save_chucvu(Request $request){//thêm thể loại sách
        $this->AuthLogin();
        $data = array();
        //$data['CV_MA'] = $request->ma_product_desc;
        $data['CV_TEN'] = $request->chucvu_product_name;

        DB::table('chuc_vu')->insert($data);
        Session::put('message','Thêm chức vụ thành công');
        return Redirect::to('add-chucvu');


    }

    public function edit_chucvu($CV_MA){
        $this->AuthLogin();
        $edit_chucvu = DB::table('chuc_vu')->where('CV_MA',$CV_MA)->get();
        $manager_chucvu = view('admin.edit_chucvu')->with('edit_chucvu', $edit_chucvu);
        return view('admin-layout')->with('admin.edit_chucvu', $manager_chucvu);
    }

    public function update_chucvu(Request $request, $CV_MA){
        $this->AuthLogin();
        $data = array();
        //$data['CV_MA'] = $request->ma_product_desc;
        $data['CV_TEN'] = $request->chucvu_product_name;
        DB::table('chuc_vu')->where('CV_MA',$CV_MA)->update($data);
        Session::put('message','Cập nhật chức vụ thành công');
        return Redirect::to('all-chucvu');

    }

    public function delete_chucvu($CV_MA){
        $this->AuthLogin();
        DB::table('chuc_vu')->where('CV_MA',$CV_MA)->delete();
        Session::put('message','Xóa chức vụ thành công');
        return Redirect::to('all-chucvu');

    }
}

