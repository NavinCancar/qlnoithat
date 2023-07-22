<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){
        $all_category_product = DB::table('loai_noi_that')->get();

        $all_product = DB::table('noi_that') -> join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->orderby('noi_that.NT_NGAYTAO','desc')->limit(8)->get();
        $exp_product = DB::table('noi_that') -> join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->orderby('noi_that.NT_GIA','desc')->limit(8)->get();
        $cheap_product = DB::table('noi_that') -> join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->orderby('noi_that.NT_GIA')->limit(8)->get();
        return view('pages.home')->with('category', $all_category_product)->with('all_product', $all_product)
        ->with('exp_product', $exp_product)->with('cheap_product', $cheap_product);
    }

    public function all_product(){

        $all_category_product = DB::table('loai_noi_that')->get();

        $all_product = DB::table('noi_that') 
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->orderby('noi_that.NT_NGAYTAO','desc')->limit(16)->get();
        return view('pages.show-all-product')->with('category', $all_category_product)->with('all_product', $all_product);
    }
    
    //Tìm kiếm sản phẩm
    public function search(Request $request){

        $keywords = $request ->keywords_submit;

        $all_category_product = DB::table('loai_noi_that')->get();

        $search_product = DB::table('noi_that')
        ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('noi_that.NT_TEN', 'like', '%'.$keywords.'%')
        ->orWhere('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('nha_cung_cap.NCC_TEN', 'like', '%'.$keywords.'%')
        ->get();

        return view('pages.product.search')->with('category', $all_category_product)
        ->with('search_product', $search_product);
    }
}
