<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AuthLogin(){
        $NV_MA = Session::get('NV_MA');
        if($NV_MA){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->AuthLogin();
        $brand_product = DB::table('nha_cung_cap')->orderby('NCC_MA')->get();
        $type_product = DB::table('loai_noi_that')->orderby('LNT_MA')->get();
        return view('admin.add_product')->with('brand_product', $brand_product)->with('type_product', $type_product);

    }
    public function all_product(){ //Hien thi tat ca
        $this->AuthLogin();

        $all_product = DB::table('noi_that')
        ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
        ->orderby('NT_MA','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
                
        $count_product = DB::table('noi_that')->count('NT_MA');
        Session::put('count_product',$count_product);
        return view('admin-layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request){//thêm sách
        $this->AuthLogin();
        $data = array();
        //$data['NT_MA'] = $request->product_desc;
        $data['NT_TEN'] = $request->NT_TEN;
        $data['NT_GIA'] = $request->NT_GIA;
        $data['NT_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        $data['NT_NGAYTAO'] =  Carbon::now('Asia/Ho_Chi_Minh');
        $data['NCC_MA'] = $request->NCC_MA;
        $data['NN_MA'] = $request->NN_MA;

        DB::table('noi_that')->insert($data);
        Session::put('message','Thêm sách thành công');
        return Redirect::to('add-product');


    }

    public function edit_product($NT_MA){
        $this->AuthLogin();
        $brand_product = DB::table('nha_cung_cap')->orderby('NCC_MA')->get();
        $lang_product = DB::table('ngon_ngu')->orderby('NN_MA')->get();
        $edit_product = DB::table('noi_that')->where('NT_MA',$NT_MA)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('brand_product',$brand_product)->with('lang_product',$lang_product);
        return view('admin-layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $NT_MA){
        $this->AuthLogin();
        $data = array();
        //$data['NT_MA'] = $request->product_desc;
        $data['NT_TEN'] = $request->NT_TEN;
        $data['NT_GIA'] = $request->NT_GIA;
        $data['NT_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        $data['NCC_MA'] = $request->NCC_MA;
        $data['NN_MA'] = $request->NN_MA;
        DB::table('noi_that')->where('NT_MA',$NT_MA)->update($data);
        Session::put('message','Cập nhật sách thành công');
        return Redirect::to('all-product');

    }

    public function delete_product($NT_MA){
        $this->AuthLogin();
        DB::table('noi_that')->where('NT_MA',$NT_MA)->delete();
        Session::put('message','Xóa sách thành công');
        return Redirect::to('all-product');

    }
    //Chi Tiet San Pham
    public function detail_product($NT_MA){
        $all_category_product = DB::table('loai_noi_that')->get();

        $another_img = DB::table('hinh_anh_noi_that')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'not like', '%-1%')
        ->where('NT_MA', $NT_MA)->orderby('hinh_anh_noi_that.HANT_DUONGDAN')->get();

        $details_product = DB::table('noi_that')
        ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
        ->join('loai_noi_that','loai_noi_that.LNT_MA','=','noi_that.LNT_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('noi_that.NT_MA', $NT_MA)->get();

        $LNT = DB::table('noi_that')->where('noi_that.NT_MA', $NT_MA)->first();
        $LNT_MA= $LNT->LNT_MA;

        $related_product = DB::table('noi_that')
        ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
        ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
        ->join('loai_noi_that', 'loai_noi_that.LNT_MA', '=', 'noi_that.LNT_MA')
        ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
        ->where('loai_noi_that.LNT_MA', $LNT_MA)
        ->whereNotIn('noi_that.NT_MA', [$NT_MA])
        ->limit(4)->get();

        //Show đánh giá cũ
        $danh_gia = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
        ->where('NT_MA', $NT_MA)->orderby('DG_MA','desc')->get();

        $countdg = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
        ->where('NT_MA', $NT_MA)->count();

        Session::put('countdg',$countdg);

        //Cho phép nhập đánh giá mới
        $KH_MA = Session::get('KH_MA');
        Session::put('kh',$KH_MA);
        
        $binh_luan=  DB::table('khach_hang')
        ->join('don_dat_hang','khach_hang.KH_MA','=','don_dat_hang.KH_MA')
        ->join('chi_tiet_don_dat_hang','chi_tiet_don_dat_hang.DDH_MA','=','don_dat_hang.DDH_MA')
        ->where('TT_MA', 4)
        ->where('NT_MA', $NT_MA)->get();
        
        //Số lượng tồn

        $ddh = DB::table('chi_tiet_don_dat_hang')
            ->where('NT_MA', $NT_MA)->sum('CTDDH_SOLUONG');
        Session::put('ban',$ddh);

        $nhap = DB::table('chi_tiet_lo_nhap')
            ->where('NT_MA', $NT_MA)->sum('CTLN_SOLUONG');
        $xuat = DB::table('chi_tiet_lo_xuat')
            ->where('NT_MA', $NT_MA)->sum('CTLX_SOLUONG');

        Session::put('ton',$nhap-$xuat-$ddh);

        return view('pages.product.show_details_product')->with('category', $all_category_product)
        ->with('product_detail', $details_product)->with('another_img', $another_img)
        ->with('product_relate', $related_product)->with('binh_luan', $binh_luan)->with('danh_gia', $danh_gia);


        /*echo '<pre>';
        print_r ($binh_luan);
        echo '</pre>';*/
    }

        //Tìm kiếm sản phẩm
        public function search_product(Request $request){

            $keywords = $request ->keywords_submit;
    
            $all_category_product = DB::table('loai_noi_that')->get();
    
            $all_product = DB::table('noi_that')
            ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
            ->orderby('NT_MA','desc')->get();
    
            $search_product = DB::table('noi_that')
            ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
            ->join('hinh_anh_noi_that','noi_that.NT_MA','=','hinh_anh_noi_that.NT_MA')
            ->where('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
            ->where('noi_that.NT_TEN', 'like', '%'.$keywords.'%')
            ->orWhere('hinh_anh_noi_that.HANT_DUONGDAN', 'like', '%-1%')
            ->where('nha_cung_cap.NCC_TEN', 'like', '%'.$keywords.'%')
            ->get();
    
            return view('admin.search_product')->with('category', $all_category_product)
            ->with('search_product', $search_product)
            ->with('all_product', $all_product);
        }

        public function danh_gia(Request $request, $NT_MA){

            //Cho phép nhập đánh giá mới
            $KH_MA = Session::get('KH_MA');
            $check= DB::table('danh_gia')->where('KH_MA',$KH_MA)->where('NT_MA',$NT_MA)->delete();
            
            $data = array();
            //$data['NT_MA'] = $request->product_desc;
            $data['KH_MA'] = $KH_MA;
            $data['NT_MA'] = $NT_MA;
            $data['DG_NOIDUNG'] = $request->DG_NOIDUNG;
            $data['DG_DIEM'] = $request->DG_DIEM;
            $data['DG_THOIGIAN'] =  Carbon::now('Asia/Ho_Chi_Minh');
            DB::table('danh_gia')->insert($data);
            Session::put('message','Cập nhật sách thành công');
            return Redirect::to('chi-tiet-san-pham/'.$NT_MA);

            /*echo '<pre>';
            print_r ($binh_luan);
            echo '</pre>';*/
        }

        public function ton_kho(){ //Hien thi tat ca
            $this->AuthLogin();
    
            $all_product = DB::table('noi_that')
            ->join('nha_cung_cap','nha_cung_cap.NCC_MA','=','noi_that.NCC_MA')
            ->orderby('NT_MA','desc')->get();
            $manager_product = view('admin.dashboard.ton_kho')->with('all_product', $all_product);

            $count_product = DB::table('noi_that')->count('NT_MA');
            Session::put('count_product',$count_product);
            return view('admin-layout')->with('admin.dashboard.ton_kho', $manager_product);
        }
}
