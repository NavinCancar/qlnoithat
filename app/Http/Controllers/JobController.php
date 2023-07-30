<?php
//Chức vụ
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;

class JobController extends Controller
{//Backend--Only chủ cửa hàng-------------------------------------------------------

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

    public function add_chucvu(){
        $this->AuthLoginChu();
        return view('admin.add_chucvu');
    }

    public function all_chucvu(){
        $this->AuthLoginChu();
        $all_chucvu = DB::table('chuc_vu')->paginate(10);
        $manager_chucvu = view('admin.all_chucvu')->with('all_chucvu', $all_chucvu);
                
        $count_chucvu = DB::table('chuc_vu')->count('CV_MA');
        Session::put('count_chucvu',$count_chucvu);
        return view('admin-layout')->with('admin.all_chucvu', $manager_chucvu);
    }

    public function save_chucvu(Request $request){
        $this->AuthLoginChu();
        $data = array();
        //$data['CV_MA'] = $request->ma_product_desc;
        $data['CV_TEN'] = $request->chucvu_product_name;

        DB::table('chuc_vu')->insert($data);
        Session::put('message','Thêm chức vụ thành công');
        return Redirect::to('add-chucvu');
    }

    public function edit_chucvu($CV_MA){
        $this->AuthLoginChu();
        $edit_chucvu = DB::table('chuc_vu')->where('CV_MA',$CV_MA)->get();
        $manager_chucvu = view('admin.edit_chucvu')->with('edit_chucvu', $edit_chucvu);
        return view('admin-layout-detail')->with('admin.edit_chucvu', $manager_chucvu);
    }

    public function update_chucvu(Request $request, $CV_MA){
        $this->AuthLoginChu();
        $data = array();
        //$data['CV_MA'] = $request->ma_product_desc;
        $data['CV_TEN'] = $request->chucvu_product_name;
        DB::table('chuc_vu')->where('CV_MA',$CV_MA)->update($data);
        Session::put('message','Cập nhật chức vụ thành công');
        return Redirect::to('all-chucvu');
    }

    public function delete_chucvu($CV_MA){
        $this->AuthLoginChu();
        DB::table('chuc_vu')->where('CV_MA',$CV_MA)->delete();
        Session::put('message','Xóa chức vụ thành công');
        return Redirect::to('all-chucvu');
    }
}

