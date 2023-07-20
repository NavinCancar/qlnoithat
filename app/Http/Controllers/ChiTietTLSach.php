<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ChiTietTLSach extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_cttheloai_cuasach(){ 
        $this->AuthLogin(); 
         
        $MASACH = DB::table('sach')->orderby('SACH_MA')->get(); 
        $TLS_MA = DB::table('the_loai_sach')->orderby('TLS_MA')->get(); 
        return view('admin.add_cttheloai_cuasach')->with('MASACH', $MASACH)->with('TLS_MA', $TLS_MA); 

       
    }

    
    public function all_cttheloai_cuasach(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_cttheloai_cuasach = DB::table('cua_sach')
        ->join('sach','sach.SACH_MA','=','cua_sach.SACH_MA')
        ->join('the_loai_sach','the_loai_sach.TLS_MA','=','cua_sach.TLS_MA')
        //->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->orderby('sach.SACH_MA')->get();

        
        $manager_cttheloai_cuasach = view('admin.all_cttheloai_cuasach')->with('all_cttheloai_cuasach', $all_cttheloai_cuasach);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_cttheloai_cuasach', $manager_cttheloai_cuasach); 
    }

    public function save_cttheloai_cuasach(Request $request){//thêm lô nhập 
        $this->AuthLogin();
        $data = array();
        //$data['LN_MA'] = $request->product_desc; 
        //$data['LN_MA'] = $request->maln_product_name; 
        $data['SACH_MA'] = $request->MASACH; 
        $data['TLS_MA'] = $request->TLS_MA; 
         
        //$data['SACH_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        //$data['SACH_NGAYTAO'] =  Carbon::now('Asia/Ho_Chi_Minh');
        //$data['SACH_SOTRANG'] = $request->SACH_SOTRANG;
        //$data['SACH_ISBN'] = $request->SACH_ISBN;
        //$data['NXB_MA'] = $request->NXB_MA;
        //$data['NN_MA'] = $request->NN_MA;

        DB::table('cua_sach')->insert($data);
        Session::put('message','Thêm chi tiết thể loại sách thành công');
        return Redirect::to('add-cttheloai-cuasach');


    }

    public function edit_cttheloai_cuasach($SACH_MA, $TLS_MA){
        $this->AuthLogin();
        
        $sach = DB::table('sach')->orderby('SACH_MA')->get();
        $theloai = DB::table('the_loai_sach')->orderby('TLS_MA')->get();
        $edit_cttheloai_cuasach = DB::table('cua_sach')->where('SACH_MA',$SACH_MA)->where('TLS_MA',$TLS_MA)->get();       
        $manager_cttheloai_cuasach = view('admin.edit_cttheloai_cuasach')->with('edit_cttheloai_cuasach', $edit_cttheloai_cuasach)->with('sach', $sach)->with('theloai', $theloai);
        //->with('nvien_product',$nvien_product);
        
        return view('admin-layout')->with('admin.edit_cttheloai_cuasach', $manager_cttheloai_cuasach);

    }

    public function update_cttheloai_cuasach(Request $request, $SACH_MA, $TLS_MA){
        $this->AuthLogin();
        $data = array();
        $data['SACH_MA'] = $request->sach;
        $data['TLS_MA'] = $request->theloai;
        
        
        DB::table('cua_sach')->where('SACH_MA',$SACH_MA)->where('TLS_MA',$TLS_MA)->update($data);
        Session::put('message','Cập nhật chi tiết thể loại của sách thành công');
        return Redirect::to('all-cttheloai-cuasach');

    }

    public function delete_cttheloai_cuasach($SACH_MA, $TLS_MA){
        $this->AuthLogin();
        DB::table('cua_sach')->where('SACH_MA',$SACH_MA)->where('TLS_MA',$TLS_MA)->delete();
        Session::put('message','Xóa chi tiết thể loại của sách thành công');
        return Redirect::to('all-cttheloai-cuasach');

    }

}
