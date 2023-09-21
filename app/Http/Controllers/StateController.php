<?php
//Chức vụ
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;
//Check unique cách mới
class StateController extends Controller
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

    public function add_trangthai(){
        $this->AuthLoginChu();
        return view('admin.add_trangthai');
    }

    public function all_trangthai(){
        $this->AuthLoginChu();
        $all_trangthai = DB::table('trang_thai')->orderby('TT_MA')->paginate(10);
        $manager_trangthai = view('admin.all_trangthai')->with('all_trangthai', $all_trangthai);
                
        $count_trangthai = DB::table('trang_thai')->count('TT_MA');
        Session::put('count_trangthai',$count_trangthai);
        return view('admin-layout')->with('admin.all_trangthai', $manager_trangthai);
    }

    public function save_trangthai(Request $request){
        $this->AuthLoginChu();
        $data = array();
        $data['TT_TEN'] = $request->trangthai_name;

        //Kiểm tra unique
        $check_unique = DB::table('trang_thai')->where('TT_TEN', '=', $data['TT_TEN'])->first();

        if ($check_unique) {
            Session::put('message','Tên trạng thái không thể trùng');
            return Redirect::to('add-trangthai');
        }

        DB::table('trang_thai')->insert($data);
        Session::put('message','Thêm trạng thái đơn đặt hàng thành công');
        return Redirect::to('add-trangthai');

    }

    public function edit_trangthai($TT_MA){
        $this->AuthLoginChu();
        $edit_trangthai = DB::table('trang_thai')->where('TT_MA',$TT_MA)->get();
        $manager_trangthai = view('admin.edit_trangthai')->with('edit_trangthai', $edit_trangthai);
        return view('admin-layout-detail')->with('admin.edit_trangthai', $manager_trangthai);
    }

    public function update_trangthai(Request $request, $TT_MA){
        $this->AuthLoginChu();
        $data = array();
        //$data['TT_MA'] = $request->trangthai_desc;
        $data['TT_TEN'] = $request->trangthai_name;

        //Kiểm tra unique
        $check_unique = DB::table('trang_thai')->where('TT_TEN', '=', $data['TT_TEN'])->first();

        if ($check_unique) {
            Session::put('message','Tên trạng thái không thể trùng');
            return Redirect::to('all-trangthai');
        }

        DB::table('trang_thai')->where('TT_MA',$TT_MA)->update($data);
        Session::put('message','Cập nhật trạng thái thành công');
        return Redirect::to('all-trangthai');
    }

    public function delete_trangthai($TT_MA){
        $this->AuthLoginChu();

        $checkforeign = DB::table('trang_thai')
        ->join('don_dat_hang','trang_thai.TT_MA','=','don_dat_hang.TT_MA')
        ->where('trang_thai.TT_MA',$TT_MA)->count();

        if($checkforeign != 0){
            Session::put('message','Có đơn hàng tồn tại vào trạng thái này, trạng thái này này không thể xoá');
            return Redirect::to('all-trangthai');
        }

        DB::table('trang_thai')->where('TT_MA',$TT_MA)->delete();
        Session::put('message','Xóa trạng thái thành công');
        return Redirect::to('all-trangthai');
    }
}

