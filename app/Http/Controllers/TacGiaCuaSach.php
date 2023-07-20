<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class TacGiaCuaSach extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_tacgia_cuasach(){ 
        $this->AuthLogin(); 
         
        $sach = DB::table('sach')->orderby('SACH_MA')->get(); 
        $tacgia = DB::table('tac_gia')->orderby('TG_MA')->get(); 
        return view('admin.add_tacgia_cuasach')->with('sach', $sach)->with('tacgia', $tacgia); 

       
    }

    
    public function all_tacgia_cuasach(){ //Hien thi tat ca lo nhap
        $this->AuthLogin(); 

        $all_tacgia_cuasach = DB::table('co_tac_gia')
        ->join('sach','sach.SACH_MA','=','co_tac_gia.SACH_MA')
        ->join('tac_gia','tac_gia.TG_MA','=','co_tac_gia.TG_MA')
        //->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->orderby('co_tac_gia.SACH_MA')->get();

        
        $manager_tacgia_cuasach = view('admin.all_tacgia_cuasach')->with('all_tacgia_cuasach', $all_tacgia_cuasach);
        //->with('all_lonhap', $all_lonhap);
        return view('admin-layout')->with('admin.all_tacgia_cuasach', $manager_tacgia_cuasach); 
    }

    public function save_tacgia_cuasach(Request $request){//thêm lô nhập 
        $this->AuthLogin();
        $data = array();

        $data['SACH_MA'] = $request->sach; 
        $data['TG_MA'] = $request->tacgia; 
       
        DB::table('co_tac_gia')->insert($data);
        Session::put('message','Thêm tác giả của sách thành công');
        return Redirect::to('add-tacgia-cuasach');


    }

    public function edit_tacgia_cuasach($SACH_MA, $TG_MA){
        $this->AuthLogin();
        
        $sach = DB::table('sach')->orderby('SACH_MA')->get();
        $tacgia = DB::table('tac_gia')->orderby('TG_MA')->get();
        $edit_tacgia_cuasach = DB::table('co_tac_gia')->where('SACH_MA',$SACH_MA)->where('TG_MA',$TG_MA)->get();       
        $manager_tacgia_cuasach = view('admin.edit_tacgia_cuasach')->with('edit_tacgia_cuasach', $edit_tacgia_cuasach)->with('sach', $sach)->with('tacgia',$tacgia);
        //->with('nvien_product',$nvien_product);
        
        return view('admin-layout')->with('admin.edit_tacgia_cuasach', $manager_tacgia_cuasach);

    }

    public function update_tacgia_cuasach(Request $request, $SACH_MA, $TG_MA){
        $this->AuthLogin();
        $data = array();
        $data['SACH_MA'] = $request->sach;
        $data['TG_MA'] = $request->tacgia;
       
         

        DB::table('co_tac_gia')->where('SACH_MA',$SACH_MA)->where('TG_MA',$TG_MA)->update($data);
        Session::put('message','Cập nhật tác giả của sách thành công');
        return Redirect::to('all-tacgia-cuasach');

    }

    public function delete_tacgia_cuasach($SACH_MA, $TG_MA){
        $this->AuthLogin();
        DB::table('co_tac_gia')->where('SACH_MA',$SACH_MA)->where('TG_MA',$TG_MA)->delete();
        Session::put('message','Xóa tác giả của sách thành công');
        return Redirect::to('all-tacgia-cuasach');

    }

}
