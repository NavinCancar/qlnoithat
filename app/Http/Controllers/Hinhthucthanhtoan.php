<?php
//Chức vụ
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;

class Hinhthucthanhtoan extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_hinhthuc_thanhtoan(){
        $this->AuthLogin();
        return view('admin.add_hinhthuc_thanhtoan');

    }

    public function all_hinhthuc_thanhtoan(){ //Hien thi tat ca
        $this->AuthLogin();
        $all_hinhthuc_thanhtoan = DB::table('hinh_thuc_thanh_toan')->get();
        $manager_hinhthuc_thanhtoan = view('admin.all_hinhthuc_thanhtoan')->with('all_hinhthuc_thanhtoan', $all_hinhthuc_thanhtoan);
                
        $count_hinhthuc_thanhtoan = DB::table('hinh_thuc_thanh_toan')->count('HTTT_MA');
        Session::put('count_hinhthuc_thanhtoan',$count_hinhthuc_thanhtoan);
        return view('admin-layout')->with('admin.all_hinhthuc_thanhtoan', $manager_hinhthuc_thanhtoan);
    }

    public function save_hinhthuc_thanhtoan(Request $request){//thêm thể loại sách
        $this->AuthLogin();
        $data = array();
        //$data['HTTT_MA'] = $request->hinhthuc_thanhtoan_desc;
        $data['HTTT_TEN'] = $request->hinhthuc_thanhtoan_name;

        DB::table('hinh_thuc_thanh_toan')->insert($data);
        Session::put('message','Thêm hình thức thanh toán đơn đặt hàng thành công');
        return Redirect::to('add-hinhthu-thanhtoan');


    }

    public function edit_hinhthuc_thanhtoan($HTTT_MA){
        $this->AuthLogin();
        $edit_hinhthuc_thanhtoan = DB::table('hinh_thuc_thanh_toan')->where('HTTT_MA',$HTTT_MA)->get();
        $manager_hinhthuc_thanhtoan = view('admin.edit_hinhthuc_thanhtoan')->with('edit_hinhthuc_thanhtoan', $edit_hinhthuc_thanhtoan);
        return view('admin-layout')->with('admin.edit_hinhthuc_thanhtoan', $manager_hinhthuc_thanhtoan);
    }

    public function update_hinhthuc_thanhtoan(Request $request, $HTTT_MA){
        $this->AuthLogin();
        $data = array();
        //$data['HTTT_MA'] = $request->hinhthuc_thanhtoan_desc;
        $data['HTTT_TEN'] = $request->hinhthuc_thanhtoan_name;
        DB::table('hinh_thuc_thanh_toan')->where('HTTT_MA',$HTTT_MA)->update($data);
        Session::put('message','Cập nhật hình thức thanh toán thành công');
        return Redirect::to('all-hinhthu-thanhtoan');

    }

    public function delete_hinhthuc_thanhtoan($HTTT_MA){
        $this->AuthLogin();
        DB::table('hinh_thuc_thanh_toan')->where('HTTT_MA',$HTTT_MA)->delete();
        Session::put('message','Xóa hình thức thanh toán thành công');
        return Redirect::to('all-hinhthu-thanhtoan');

    }

    // Danh mục sản phẩm trang chủ
    public function show_category_home($TLS_MA){
        $all_category_product = DB::table('the_loai_sach')->get();

        $category_by_id = DB::table('sach')

        ->join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->join('cua_sach', 'sach.SACH_MA', '=', 'cua_sach.SACH_MA')
        ->join('the_loai_sach', 'the_loai_sach.TLS_MA', '=', 'cua_sach.TLS_MA')

        ->orderby('sach.SACH_NGAYTAO','desc')
        ->where('the_loai_sach.TLS_MA', $TLS_MA)
        ->get();

        $category_name = DB::table('the_loai_sach')->where('the_loai_sach.TLS_MA', $TLS_MA )->get();
       /* echo '<pre>';
        print_r ($category_by_id);
        echo '</pre>';*/

        return view('pages.category.show_category')->with('category', $all_category_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name);
    }

}

