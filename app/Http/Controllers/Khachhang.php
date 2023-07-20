<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class Khachhang extends Controller 
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function all_khachhang(){ //Hien thi tat ca khach hang
        $this->AuthLogin(); 
        $all_khachhang = DB::table('khach_hang')
        ->join('gio_hang','gio_hang.GH_MA','=','khach_hang.GH_MA')
        ->orderby('khach_hang.KH_MA','desc')->get();
        $manager_khachhang = view('admin.all_khachhang')->with('all_khachhang', $all_khachhang);
        return view('admin-layout')->with('admin.all_khachhang', $manager_khachhang); 
    }


}
