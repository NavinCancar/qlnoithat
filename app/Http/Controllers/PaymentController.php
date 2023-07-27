<?php
//Chức vụ
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;

class PaymentController extends Controller
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

    public function add_hinhthuc_thanhtoan(){
        $this->AuthLoginChu();
        return view('admin.add_hinhthuc_thanhtoan');
    }

    public function all_hinhthuc_thanhtoan(){
        $this->AuthLoginChu();
        $all_hinhthuc_thanhtoan = DB::table('hinh_thuc_thanh_toan')->get();
        $manager_hinhthuc_thanhtoan = view('admin.all_hinhthuc_thanhtoan')->with('all_hinhthuc_thanhtoan', $all_hinhthuc_thanhtoan);
                
        $count_hinhthuc_thanhtoan = DB::table('hinh_thuc_thanh_toan')->count('HTTT_MA');
        Session::put('count_hinhthuc_thanhtoan',$count_hinhthuc_thanhtoan);
        return view('admin-layout')->with('admin.all_hinhthuc_thanhtoan', $manager_hinhthuc_thanhtoan);
    }

    public function save_hinhthuc_thanhtoan(Request $request){
        $this->AuthLoginChu();
        $data = array();
        //$data['HTTT_MA'] = $request->hinhthuc_thanhtoan_desc;
        $data['HTTT_TEN'] = $request->hinhthuc_thanhtoan_name;

        DB::table('hinh_thuc_thanh_toan')->insert($data);
        Session::put('message','Thêm hình thức thanh toán đơn đặt hàng thành công');
        return Redirect::to('add-hinhthuc-thanhtoan');
    }

    public function edit_hinhthuc_thanhtoan($HTTT_MA){
        $this->AuthLoginChu();
        $edit_hinhthuc_thanhtoan = DB::table('hinh_thuc_thanh_toan')->where('HTTT_MA',$HTTT_MA)->get();
        $manager_hinhthuc_thanhtoan = view('admin.edit_hinhthuc_thanhtoan')->with('edit_hinhthuc_thanhtoan', $edit_hinhthuc_thanhtoan);
        return view('admin-layout')->with('admin.edit_hinhthuc_thanhtoan', $manager_hinhthuc_thanhtoan);
    }

    public function update_hinhthuc_thanhtoan(Request $request, $HTTT_MA){
        $this->AuthLoginChu();
        $data = array();
        //$data['HTTT_MA'] = $request->hinhthuc_thanhtoan_desc;
        $data['HTTT_TEN'] = $request->hinhthuc_thanhtoan_name;
        DB::table('hinh_thuc_thanh_toan')->where('HTTT_MA',$HTTT_MA)->update($data);
        Session::put('message','Cập nhật hình thức thanh toán thành công');
        return Redirect::to('all-hinhthuc-thanhtoan');
    }

    public function delete_hinhthuc_thanhtoan($HTTT_MA){
        $this->AuthLoginChu();
        DB::table('hinh_thuc_thanh_toan')->where('HTTT_MA',$HTTT_MA)->delete();
        Session::put('message','Xóa hình thức thanh toán thành công');
        return Redirect::to('all-hinhthuc-thanhtoan');
    }
}

