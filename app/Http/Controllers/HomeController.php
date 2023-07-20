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

        $all_category_product = DB::table('the_loai_sach')->get();

        /*$all_product = DB::table('sach') ->orderby('SACH_MA','desc')->limit(1)->get();

        $all_product_image = DB::table('hinh_anh_sach')
        ->join('sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->orderby('HAS_MA','desc')->get();

    	return view('pages.home')->with('category', $all_category_product)->with('all_product', $all_product)
        ->with('product_image', $all_product_image);*/
        $all_product = DB::table('sach') -> join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->orderby('sach.SACH_NGAYTAO','desc')->limit(12)->get();
        $exp_product = DB::table('sach') -> join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->orderby('sach.SACH_GIA','desc')->limit(12)->get();
        $cheap_product = DB::table('sach') -> join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->orderby('sach.SACH_GIA')->limit(12)->get();
        return view('pages.home')->with('category', $all_category_product)->with('all_product', $all_product)
        ->with('exp_product', $exp_product)->with('cheap_product', $cheap_product);
    }

    public function all_product(){

        $all_category_product = DB::table('the_loai_sach')->get();

        $all_product = DB::table('sach') -> join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->orderby('sach.SACH_NGAYTAO','desc')->limit(16)->get();
        return view('pages.show-all-product')->with('category', $all_category_product)->with('all_product', $all_product);
    }
    
    //Tìm kiếm sản phẩm
    public function search(Request $request){

        $keywords = $request ->keywords_submit;

        $all_category_product = DB::table('the_loai_sach')->get();

        $search_product = DB::table('sach')
        ->join('nha_xuat_ban','nha_xuat_ban.NXB_MA','=','sach.NXB_MA')
        ->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->join('co_tac_gia', 'sach.SACH_MA', '=', 'co_tac_gia.SACH_MA')
        ->join('tac_gia', 'tac_gia.TG_MA', '=', 'co_tac_gia.TG_MA')
        ->where('sach.SACH_TEN', 'like', '%'.$keywords.'%')
        ->orWhere('sach.SACH_MOTA', 'like', '%'.$keywords.'%')
        ->orWhere('nha_xuat_ban.NXB_TEN', 'like', '%'.$keywords.'%')
        ->orWhere('tac_gia.TG_HOTEN', 'like', '%'.$keywords.'%')
        ->get();

        return view('pages.product.search')->with('category', $all_category_product)
        ->with('search_product', $search_product);
    }
}
