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
    //Frontend------------------------------------------------------------------------

    public function index(){
        $all_category_product = DB::table('loai_noi_that')->get();

        $hot_product = DB::table('noi_that')
        ->join(DB::raw('(select `noi_that`.`NT_MA`, sum(`chi_tiet_don_dat_hang`.`CTDDH_SOLUONG`) as soluongban from `noi_that` 
                        inner join `chi_tiet_don_dat_hang` on `chi_tiet_don_dat_hang`.`NT_MA` = `noi_that`.`NT_MA` 
                        inner join `don_dat_hang` on `don_dat_hang`.`DDH_MA` = `chi_tiet_don_dat_hang`.`DDH_MA` 
                        where `don_dat_hang`.`TT_MA` != 5 group by `noi_that`.`NT_MA`) j'), 
                'j.NT_MA', '=', 'noi_that.NT_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->orderby('soluongban','desc')->limit(8)->get();
        /*echo '<pre>';
        print_r ($hot_product);
        echo '</pre>';

        select `noi_that`.`NT_MA`, sum(`chi_tiet_don_dat_hang`.`CTDDH_SOLUONG`) from `noi_that` 
        inner join `chi_tiet_don_dat_hang` on `chi_tiet_don_dat_hang`.`NT_MA` = `noi_that`.`NT_MA` 
        inner join `don_dat_hang` on `don_dat_hang`.`DDH_MA` = `chi_tiet_don_dat_hang`.`DDH_MA` 
        where `don_dat_hang`.`TT_MA` != 5 group by `noi_that`.`NT_MA`;*/
        
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
        ->with('hot_product', $hot_product)->with('exp_product', $exp_product)->with('cheap_product', $cheap_product);
    }

    public function all_product($chuoi){
        $all_category_product = DB::table('loai_noi_that')->get();
        if($chuoi=="thap-len-cao"){
            $all_product = DB::table('noi_that') 
            ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
            ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
            ->orderby('noi_that.NT_GIA')->paginate(12);
        }
        else if($chuoi=="cao-xuong-thap"){
            $all_product = DB::table('noi_that') 
            ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
            ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
            ->orderby('noi_that.NT_GIA','desc')->paginate(12);
        }
        else if($chuoi=="cu-nhat"){
            $all_product = DB::table('noi_that') 
            ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
            ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
            ->orderby('noi_that.NT_NGAYTAO')->paginate(12);
        }
        else{
            $all_product = DB::table('noi_that') 
            ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
            ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
            ->orderby('noi_that.NT_NGAYTAO','desc')->paginate(12);
        }
        Session::put('chuoi_gia',$chuoi);
        return view('pages.show-all-product')->with('category', $all_category_product)->with('all_product', $all_product);
    }
    
    public function loc_gia(Request $request, $chuoidai){
        Session::put('GiaThapNhat',$request ->GiaThapNhat);
        Session::put('GiaCaoNhat',$request ->GiaCaoNhat);
        return Redirect::to('danh-muc-san-pham/'.$chuoidai);
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
        ->where('nha_cung_cap.NCC_TEN', 'like', '%'.$keywords.'%')->get();

        return view('pages.product.search')->with('category', $all_category_product)
        ->with('search_product', $search_product);
    }
}
