<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{//Backend-------------------------------------------------------

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

    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){

        }else{
            return Redirect::to('admin')->send();
        }
    }

    //--All

    public function change_password(){
        $this->AuthLogin();
        return view('admin.dashboard.change_password');
    }

    public function show_employee(){
        $this->AuthLogin();
        $NV_MA = Session::get('NV_MA');
        $position = DB::table('CHUC_VU')->orderby('CV_MA')->get(); 
        $edit_employee = DB::table('nhan_vien')->where('NV_MA',$NV_MA)->get();
        $manager_employee = view('admin.dashboard.show_employee')->with('edit_employee', $edit_employee)->with('position',$position);
        return view('admin-layout')->with('admin.dashboard.show_employee', $manager_employee);
    }

    public function edit_employee($NV_MA){
        $this->AuthLogin();
        $NV_MA_get = Session::get('NV_MA');
        $CV_MA_get = DB::table('nhan_vien')->where('NV_MA',$NV_MA_get)->first();
        if($NV_MA_get!=$NV_MA&&$CV_MA_get->CV_MA!=1){
            /*echo '<pre>';
            print_r ($CV_MA_get->CV_MA);
            echo '</pre>';*/
            return Redirect::to('dashboard')->send();  
        }else{
            $position = DB::table('CHUC_VU')->orderby('CV_MA')->get(); 
            $edit_employee = DB::table('nhan_vien')->where('NV_MA',$NV_MA)->get();
            Session::put('NV_MA_get',$NV_MA_get);
            Session::put('CV_MA_get',$CV_MA_get->CV_MA);
            $manager_employee = view('admin.dashboard.edit_employee')->with('edit_employee', $edit_employee)->with('position',$position);
            return view('admin-layout')->with('admin.dashboard.edit_employee', $manager_employee);
        }    
    }

    public function update_employee(Request $request, $NV_MA){
        $this->AuthLogin();
        $data = array();
        $data['NV_HOTEN'] = $request->NV_HOTEN;
        //$data['NV_DUONGDAN'] = $request->NV_DUONGDAN;  
        if($request->CV_MA) $data['CV_MA'] = $request->CV_MA;
        if($request->NV_MATKHAU) $data['NV_MATKHAU'] = $request->NV_MATKHAU;
        $data['NV_SODIENTHOAI'] = $request->NV_SODIENTHOAI;
        $data['NV_DIACHI'] = $request->NV_DIACHI;
        $data['NV_NGAYSINH'] = $request->NV_NGAYSINH;
        $data['NV_GIOITINH'] = $request->NV_GIOITINH;
        $data['NV_EMAIL'] = $request->NV_EMAIL;

        $get_image= $request->file('NV_DUONGDANANHDAIDIEN');
        if($get_image){
            $new_image =  $NV_MA.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images/nhanvien',$new_image);
            $data['NV_DUONGDANANHDAIDIEN'] = $new_image;
        }
        /*echo '<pre>';
        print_r ($get_image);
        echo '</pre>';*/
        DB::table('nhan_vien')->where('NV_MA',$NV_MA)->update($data);
        Session::put('message','Cập nhật nhân viên thành công');
        return Redirect::to('all-employee');
    }

    public function update_password(Request $request){
        $this->AuthLogin();
        $data = array();
        $NV_MA = Session::get('NV_MA');
        $NV= DB::table('nhan_vien')->where('NV_MA',$NV_MA)->first();
        if ($NV->NV_MATKHAU!=$request->NV_MATKHAUCU){
            Session::put('message','Mật khẩu cũ sai, vui lòng kiểm tra lại!');
            return Redirect::to('change-password');
        }
        if ($request->NV_MATKHAUMOI1!=$request->NV_MATKHAUMOI2){
            Session::put('message','Mật khẩu nhập lại sai, vui lòng kiểm tra lại!');
            return Redirect::to('change-password');
        }
        if ($request->NV_MATKHAUMOI1==$request->NV_MATKHAUCU){
            Session::put('message','Mật khẩu cũ và mật khẩu mới phải khác nhau, vui lòng kiểm tra lại!');
            return Redirect::to('change-password');
        }
        $data['NV_MATKHAU'] = $request->NV_MATKHAUMOI1;

        DB::table('nhan_vien')->where('NV_MA',$NV_MA)->update($data);
        Session::put('message','Đổi mật khẩu thành công');
        return Redirect::to('change-password');
    }

    //--Only chủ cửa hàng

    public function add_employee(){
        $this->AuthLoginChu();
        $position = DB::table('CHUC_VU')->orderby('CV_MA')->get(); 
        return view('admin.dashboard.add_employee')->with('position', $position);
    }

    public function all_employee(){
        $this->AuthLoginChu();

        $all_employee = DB::table('nhan_vien')
        ->join('chuc_vu','nhan_vien.CV_MA','=','chuc_vu.CV_MA')
        ->orderby('NV_MA','desc')->paginate(10);
        $manager_employee = view('admin.dashboard.all_employee')->with('all_employee', $all_employee);
                
        $count_employee = DB::table('nhan_vien')->count('NV_MA');
        Session::put('count_employee',$count_employee);
        return view('admin-layout')->with('admin.dashboard.all_employee', $manager_employee);
    }

    public function save_employee(Request $request){
        $this->AuthLoginChu();
        $data = array();
        $data['NV_HOTEN'] = $request->NV_HOTEN;
        //$data['NV_DUONGDAN'] = $request->NV_DUONGDAN;  
        $data['CV_MA'] = $request->CV_MA;
        $data['NV_SODIENTHOAI'] = $request->NV_SODIENTHOAI;
        $data['NV_DIACHI'] = $request->NV_DIACHI;
        $data['NV_MATKHAU'] = rand(1000,1999);
        $data['NV_NGAYSINH'] = $request->NV_NGAYSINH;
        $data['NV_GIOITINH'] = $request->NV_GIOITINH;
        $data['NV_EMAIL'] = $request->NV_EMAIL;
        $data['NV_DUONGDANANHDAIDIEN'] = 'macdinh.png';
        DB::table('nhan_vien')->insert($data);

        $NV=DB::table('nhan_vien')->where('NV_SODIENTHOAI', $request->NV_SODIENTHOAI)->orderby('NV_MA', 'desc')->first();
        $ma_nv=$NV->NV_MA;
        $get_image= $request->file('NV_DUONGDANANHDAIDIEN');
        if($get_image){
            $new_image =  $ma_nv.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images/nhanvien',$new_image);
            $data['NV_DUONGDANANHDAIDIEN'] = $new_image;
            DB::table('nhan_vien')->where('NV_MA', $ma_nv)->update($data);
        }
        
        Session::put('message','Thêm nhân viên thành công');
        return Redirect::to('add-employee');
    }

    public function delete_employee($NV_MA){
        $this->AuthLoginChu();
        DB::table('nhan_vien')->where('NV_MA',$NV_MA)->delete();
        Session::put('message','Xóa nhân viên thành công');
        return Redirect::to('all-employee');
    }
}
