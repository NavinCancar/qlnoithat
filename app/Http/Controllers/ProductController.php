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
        $brand_product = DB::table('nha_xuat_ban')->orderby('NXB_MA')->get();
        $lang_product = DB::table('ngon_ngu')->orderby('NN_MA')->get();
        return view('admin.add_product')->with('brand_product', $brand_product)->with('lang_product', $lang_product);

    }
    public function all_product(){ //Hien thi tat ca
        $this->AuthLogin();

        $all_product = DB::table('sach')
        ->join('nha_xuat_ban','nha_xuat_ban.NXB_MA','=','sach.NXB_MA')
        ->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->orderby('SACH_MA','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
                
        $count_product = DB::table('sach')->count('SACH_MA');
        Session::put('count_product',$count_product);
        return view('admin-layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request){//thêm sách
        $this->AuthLogin();
        $data = array();
        //$data['SACH_MA'] = $request->product_desc;
        $data['SACH_TEN'] = $request->SACH_TEN;
        $data['SACH_MOTA'] = $request->SACH_MOTA;
        $data['SACH_GIA'] = $request->SACH_GIA;
        $data['SACH_CHIETKHAU'] = $request->SACH_CHIETKHAU;
        $data['SACH_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        $data['SACH_NGAYTAO'] =  Carbon::now('Asia/Ho_Chi_Minh');
        $data['SACH_SOTRANG'] = $request->SACH_SOTRANG;
        $data['SACH_ISBN'] = $request->SACH_ISBN;
        $data['NXB_MA'] = $request->NXB_MA;
        $data['NN_MA'] = $request->NN_MA;

        DB::table('sach')->insert($data);
        Session::put('message','Thêm sách thành công');
        return Redirect::to('add-product');


    }

    public function edit_product($SACH_MA){
        $this->AuthLogin();
        $brand_product = DB::table('nha_xuat_ban')->orderby('NXB_MA')->get();
        $lang_product = DB::table('ngon_ngu')->orderby('NN_MA')->get();
        $edit_product = DB::table('sach')->where('SACH_MA',$SACH_MA)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('brand_product',$brand_product)->with('lang_product',$lang_product);
        return view('admin-layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $SACH_MA){
        $this->AuthLogin();
        $data = array();
        //$data['SACH_MA'] = $request->product_desc;
        $data['SACH_TEN'] = $request->SACH_TEN;
        $data['SACH_MOTA'] = $request->SACH_MOTA;
        $data['SACH_GIA'] = $request->SACH_GIA;
        $data['SACH_CHIETKHAU'] = $request->SACH_CHIETKHAU;
        $data['SACH_NGAYCAPNHAT'] =  Carbon::now('Asia/Ho_Chi_Minh');
        $data['SACH_SOTRANG'] = $request->SACH_SOTRANG;
        $data['SACH_ISBN'] = $request->SACH_ISBN;
        $data['NXB_MA'] = $request->NXB_MA;
        $data['NN_MA'] = $request->NN_MA;
        DB::table('sach')->where('SACH_MA',$SACH_MA)->update($data);
        Session::put('message','Cập nhật sách thành công');
        return Redirect::to('all-product');

    }

    public function delete_product($SACH_MA){
        $this->AuthLogin();
        DB::table('sach')->where('SACH_MA',$SACH_MA)->delete();
        Session::put('message','Xóa sách thành công');
        return Redirect::to('all-product');

    }
    //Chi Tiet San Pham
    public function detail_product($SACH_MA){
        $all_category_product = DB::table('the_loai_sach')->get();

        $details_product = DB::table('sach')
        ->join('nha_xuat_ban','nha_xuat_ban.NXB_MA','=','sach.NXB_MA')
        ->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        -> join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        //->join('cua_sach', 'sach.SACH_MA', '=', 'cua_sach.SACH_MA')
        //->join('the_loai_sach', 'the_loai_sach.TLS_MA', '=', 'cua_sach.TLS_MA')
        //->join('co_tac_gia', 'sach.SACH_MA', '=', 'co_tac_gia.SACH_MA')
        //->join('tac_gia', 'tac_gia.TG_MA', '=', 'co_tac_gia.TG_MA')
        //->orderby('sach.SACH_NGAYTAO','desc')
        ->where('sach.SACH_MA', $SACH_MA)->get();

        $category_product = DB::table('sach')
        ->join('cua_sach', 'sach.SACH_MA', '=', 'cua_sach.SACH_MA')
        ->join('the_loai_sach', 'the_loai_sach.TLS_MA', '=', 'cua_sach.TLS_MA')
        ->where('sach.SACH_MA', $SACH_MA)->get();

        $author_product = DB::table('sach')
        ->join('co_tac_gia', 'sach.SACH_MA', '=', 'co_tac_gia.SACH_MA')
        ->join('tac_gia', 'tac_gia.TG_MA', '=', 'co_tac_gia.TG_MA')
        ->where('sach.SACH_MA', $SACH_MA)->get();

        foreach($category_product as $key => $value){
            $TLS_MA = $value->TLS_MA;
        }

        $related_product = DB::table('sach')
        ->join('nha_xuat_ban','nha_xuat_ban.NXB_MA','=','sach.NXB_MA')
        ->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
        ->join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->join('cua_sach', 'sach.SACH_MA', '=', 'cua_sach.SACH_MA')
        ->join('the_loai_sach', 'the_loai_sach.TLS_MA', '=', 'cua_sach.TLS_MA')
        ->join('co_tac_gia', 'sach.SACH_MA', '=', 'co_tac_gia.SACH_MA')
        ->join('tac_gia', 'tac_gia.TG_MA', '=', 'co_tac_gia.TG_MA')
        ->where('the_loai_sach.TLS_MA', $TLS_MA)
        ->whereNotIn('sach.SACH_MA', [$SACH_MA])
        ->limit(4)->get();

        //Show đánh giá cũ
        $danh_gia = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
        ->where('SACH_MA', $SACH_MA)->orderby('DG_MA','desc')->get();

        $countdg = DB::table('danh_gia')
        ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
        ->where('SACH_MA', $SACH_MA)->count();

        Session::put('countdg',$countdg);

        //Cho phép nhập đánh giá mới
        $KH_MA = Session::get('KH_MA');
        Session::put('kh',$KH_MA);
        
        $binh_luan=  DB::table('khach_hang')
        ->join('don_dat_hang','khach_hang.KH_MA','=','don_dat_hang.KH_MA')
        ->join('chi_tiet_trang_thai','chi_tiet_trang_thai.DDH_MA','=','don_dat_hang.DDH_MA')
        ->join('chi_tiet_don_dat_hang','chi_tiet_don_dat_hang.DDH_MA','=','don_dat_hang.DDH_MA')
        ->where('TT_MA', 5)
        ->where('SACH_MA', $SACH_MA)->get();
        
        //Số lượng tồn

        $ddh = DB::table('chi_tiet_don_dat_hang')
            ->where('SACH_MA', $SACH_MA)->sum('CTDDH_SOLUONG');
        Session::put('ban',$ddh);

        $nhap = DB::table('chi_tiet_lo_nhap')
            ->where('SACH_MA', $SACH_MA)->sum('CTLN_SOLUONG');
        $xuat = DB::table('chi_tiet_lo_xuat')
            ->where('SACH_MA', $SACH_MA)->sum('CTLX_SOLUONG');

        Session::put('ton',$nhap-$xuat-$ddh);

        return view('pages.product.show_details_product')->with('category', $all_category_product)
        ->with('product_detail', $details_product)
        ->with('product_relate', $related_product)
        ->with('category_product', $category_product)
        ->with('author_product', $author_product)
        ->with('binh_luan', $binh_luan)
        ->with('danh_gia', $danh_gia);


        /*echo '<pre>';
        print_r ($binh_luan);
        echo '</pre>';*/
    }

        //Tìm kiếm sản phẩm
        public function search_product(Request $request){

            $keywords = $request ->keywords_submit;
    
            $all_category_product = DB::table('the_loai_sach')->get();
    
            $all_product = DB::table('sach')
            ->join('nha_xuat_ban','nha_xuat_ban.NXB_MA','=','sach.NXB_MA')
            ->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
            ->orderby('SACH_MA','desc')->get();
    
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
    
            return view('admin.search_product')->with('category', $all_category_product)
            ->with('search_product', $search_product)
            ->with('all_product', $all_product);
        }

        public function danh_gia(Request $request, $SACH_MA){

            //Cho phép nhập đánh giá mới
            $KH_MA = Session::get('KH_MA');
            $check= DB::table('danh_gia')->where('KH_MA',$KH_MA)->where('SACH_MA',$SACH_MA)->delete();
            
            $data = array();
            //$data['SACH_MA'] = $request->product_desc;
            $data['KH_MA'] = $KH_MA;
            $data['SACH_MA'] = $SACH_MA;
            $data['DG_NOIDUNG'] = $request->DG_NOIDUNG;
            $data['DG_DIEM'] = $request->DG_DIEM;
            $data['DG_THOIGIAN'] =  Carbon::now('Asia/Ho_Chi_Minh');
            DB::table('danh_gia')->insert($data);
            Session::put('message','Cập nhật sách thành công');
            return Redirect::to('chi-tiet-san-pham/'.$SACH_MA);

            /*echo '<pre>';
            print_r ($binh_luan);
            echo '</pre>';*/
        }

        public function ton_kho(){ //Hien thi tat ca
            $this->AuthLogin();
    
            $all_product = DB::table('sach')
            ->join('nha_xuat_ban','nha_xuat_ban.NXB_MA','=','sach.NXB_MA')
            ->join('ngon_ngu','ngon_ngu.NN_MA','=','sach.NN_MA')
            ->orderby('SACH_MA','desc')->get();
            $manager_product = view('admin.dashboard.ton_kho')->with('all_product', $all_product);

            $count_product = DB::table('sach')->count('SACH_MA');
            Session::put('count_product',$count_product);
            return view('admin-layout')->with('admin.dashboard.ton_kho', $manager_product);
        }
}
