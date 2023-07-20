<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function AuthLoginChu(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            if($NV_MA != 1){
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

    public function add_employee(){
        $this->AuthLoginChu();
        $position = DB::table('CHUC_VU')->orderby('CV_MA')->get(); 
        return view('admin.dashboard.add_employee')->with('position', $position);

    }
    public function all_employee(){ //Hien thi tat ca
        $this->AuthLoginChu();

        $all_employee = DB::table('nhanvien')
        ->join('chuc_vu','nhanvien.CV_MA','=','chuc_vu.CV_MA')
        ->orderby('NV_MA','desc')->get();
        $manager_employee = view('admin.dashboard.all_employee')->with('all_employee', $all_employee);
                
        $count_employee = DB::table('nhanvien')->count('NV_MA');
        Session::put('count_employee',$count_employee);
        return view('admin-layout')->with('admin.dashboard.all_employee', $manager_employee);
    }

    public function save_employee(Request $request){//thêm nhân viên
        $this->AuthLogin();
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
        $get_image= $request->file('NV_DUONGDANANHDAIDIEN');
        if($get_image){
            /*$get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $name_image
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['employee'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');*/
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images/nhanvien',$new_image);
            $data['NV_DUONGDANANHDAIDIEN'] = $new_image;
        }
        else {
            $data['NV_DUONGDANANHDAIDIEN'] = 'macdinh.png';
        }

        //echo '<pre>';
        //print_r ($data);
        //echo '</pre>';

        DB::table('nhanvien')->insert($data);
        Session::put('message','Thêm nhân viên thành công');
        return Redirect::to('add-employee');
    }

    public function edit_employee($NV_MA){
        $this->AuthLogin();
        $NV_MA_get = Session::get('NV_MA');
        if($NV_MA_get!=$NV_MA&&$NV_MA_get!=1){
            return Redirect::to('dashboard')->send();  
        }else{
            $position = DB::table('CHUC_VU')->orderby('CV_MA')->get(); 
            $edit_employee = DB::table('nhanvien')->where('NV_MA',$NV_MA)->get();
            Session::put('NV_MA_get',$NV_MA_get);
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
        
        $data['NV_SODIENTHOAI'] = $request->NV_SODIENTHOAI;
        $data['NV_DIACHI'] = $request->NV_DIACHI;
        //$data['NV_MATKHAU'] = rand(1000,1999);
        $data['NV_NGAYSINH'] = $request->NV_NGAYSINH;
        $data['NV_GIOITINH'] = $request->NV_GIOITINH;
        $data['NV_EMAIL'] = $request->NV_EMAIL;
        $get_image= $request->file('NV_DUONGDANANHDAIDIEN');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images/nhanvien',$new_image);
            $data['NV_DUONGDANANHDAIDIEN'] = $new_image;
        }

        /*echo '<pre>';
        print_r ($get_image);
        echo '</pre>';*/

        DB::table('nhanvien')->where('NV_MA',$NV_MA)->update($data);
        Session::put('message','Cập nhật nhân viên thành công');
        return Redirect::to('all-employee');

    }

    public function delete_employee($NV_MA){
        $this->AuthLogin();
        DB::table('nhanvien')->where('NV_MA',$NV_MA)->delete();
        Session::put('message','Xóa nhân viên thành công');
        return Redirect::to('all-employee');

    }

    public function show_employee(){
        $this->AuthLogin();
        $NV_MA = Session::get('NV_MA');
        $position = DB::table('CHUC_VU')->orderby('CV_MA')->get(); 
        $edit_employee = DB::table('nhanvien')->where('NV_MA',$NV_MA)->get();
        $manager_employee = view('admin.dashboard.show_employee')->with('edit_employee', $edit_employee)->with('position',$position);
        return view('admin-layout')->with('admin.dashboard.show_employee', $manager_employee);
    }

}
