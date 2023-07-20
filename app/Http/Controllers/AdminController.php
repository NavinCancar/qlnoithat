<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

class AdminController extends Controller
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
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
    	return view('admin-login');
    }

    public function show_dashboard(){
        $this->AuthLogin();

        //Các mini box
        //Tổng đơn hàng
        $ddh = DB::table('don_dat_hang')->count();
        Session::put('SO_DDH',$ddh);

        //Đơn hàng chưa xử lý
        /*SELECT c.*, t.*
        from trang_thai t JOIN (SELECT c1.DDH_MA ddh, c1.TT_MA tt
                                from chi_tiet_trang_thai c1 join (SELECT ddh_ma, max(cttt_ngaycapnhat)cap_nhat
                                                                    from chi_tiet_trang_thai GROUP BY ddh_ma) c2 on c1.ddh_ma = c2.ddh_ma
                                WHERE c1.CTTT_NGAYCAPNHAT = c2.cap_nhat) c on t.TT_MA = c.tt
        WHERE t.TT_TEN='Da dat hang nhung chua xu ly';
        $ddh_cxl1 = DB::table('chi_tiet_trang_thai')
        ->select('ddh_ma', 'max(cttt_ngaycapnhat) cap_nhat')
        ->groupby('ddh_ma')->get();

        $ddh_cxl2 = DB::table('chi_tiet_trang_thai c1')
        ->select('c1.DDH_MA ddh', 'c1.TT_MA tt')
        ->join(DB::raw('(' . $ddh_cxl1->toSql() . ') c2'), 'c1.ddh_ma', '=', 'c2.ddh_ma')
        ->where('c1.CTTT_NGAYCAPNHAT', '=', 'c2.cap_nhat');

        $ddh_cxl = DB::table('trang_thai t')
        ->select('c.*', 't.*')
        ->join(DB::raw('(' . $ddh_cxl2->toSql() . ') c'), 't.TT_MA', '=', 'c.tt')
        ->where('t.TT_TEN', '=', 'Da dat hang nhung chua xu ly')->count();

        $query = DB::table('trang_thai as t') ->select('c.', 't.')
        ->join(DB::raw('(SELECT c1.DDH_MA ddh, c1.TT_MA tt from chi_tiet_trang_thai c1 join (SELECT ddh_ma, max(cttt_ngaycapnhat) cap_nhat from chi_tiet_trang_thai GROUP BY ddh_ma) c2 on c1.ddh_ma = c2.ddh_ma
        WHERE c1.CTTT_NGAYCAPNHAT = c2.cap_nhat) c'),'t.TT_MA', '=', 'c.tt')
        ->where('t.TT_TEN', 'Da dat hang nhung chua xu ly') ->get();

        $ddh_cxl = DB::table('trang_thai as t') ->select('c.*', 't.*')
        ->join(DB::raw('(SELECT c1.DDH_MA ddh, c1.TT_MA tt from chi_tiet_trang_thai c1
                        join (SELECT ddh_ma, max(cttt_ngaycapnhat) cap_nhat from chi_tiet_trang_thai
                        GROUP BY ddh_ma) c2 on c1.ddh_ma = c2.ddh_ma
                        WHERE c1.CTTT_NGAYCAPNHAT = c2.cap_nhat) c'),'t.TT_MA', '=', 'c.tt')
        ->where('t.TT_TEN', 'Đã đặt hàng nhưng chưa xử lý')->count();*/

        $ddh_cxl = DB::table('don_dat_hang')
        ->join('chi_tiet_trang_thai','don_dat_hang.DDH_MA','=','chi_tiet_trang_thai.DDH_MA')
        ->where('chi_tiet_trang_thai.TT_MA', 1)->count();

        Session::put('SO_DDH_CXL',$ddh_cxl);

        //Số người dùng
        $users = DB::table('khach_hang')->count();
        Session::put('SO_NGUOI_DUNG',$users);

        //Số nhân viên
        $emp = DB::table('nhanvien')->count();
        Session::put('SO_NHAN_VIEN',$emp);

        //Doanh thu
        /*$result = DB::table('don_dat_hang as d')
            ->join(DB::raw('(SELECT c.*, t.*
                            FROM trang_thai t
                            JOIN (SELECT c1.DDH_MA ddh, c1.TT_MA tt
                                  FROM chi_tiet_trang_thai c1
                                  JOIN (SELECT ddh_ma, max(cttt_ngaycapnhat)cap_nhat
                                        FROM chi_tiet_trang_thai
                                        GROUP BY ddh_ma) c2
                                  ON c1.ddh_ma = c2.ddh_ma
                                  WHERE c1.CTTT_NGAYCAPNHAT = c2.cap_nhat) c
                            ON t.TT_MA = c.tt
                            WHERE t.TT_TEN = "Da thanh toan") c'), 'd.DDH_MA', '=', 'c.ddh')
            ->select(DB::raw('SUM(d.ddh_tongtien)'))
            ->get(); 

            $ddh_dtt = DB::table('don_dat_hang as d')
            ->join(DB::raw('(SELECT c.*, t.*
                            from trang_thai t JOIN (SELECT c1.DDH_MA ddh, c1.TT_MA tt
                                    from chi_tiet_trang_thai c1 join (SELECT ddh_ma, max(cttt_ngaycapnhat)cap_nhat
                            from chi_tiet_trang_thai GROUP BY ddh_ma) c2 on c1.ddh_ma = c2.ddh_ma
                            WHERE c1.CTTT_NGAYCAPNHAT = c2.cap_nhat) c on t.TT_MA = c.tt
                            WHERE t.TT_TEN="Đã thanh toán") c'), 'd.ddh_ma', '=', 'c.ddh')->sum('ddh_tongtien');*/

            $ddh_dtt = DB::table('don_dat_hang')
            ->join('chi_tiet_trang_thai','don_dat_hang.DDH_MA','=','chi_tiet_trang_thai.DDH_MA')
            ->where('chi_tiet_trang_thai.TT_MA', 5)->sum('ddh_tongtien');

            $ctlx = DB::table('chi_tiet_lo_xuat')->sum('CTLX_GIA');

            Session::put('DOANH_THU_L',$ctlx);
            Session::put('DOANH_THU_S',$ddh_dtt);

            $danh_gia = DB::table('danh_gia')
            ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')
            ->orderby('DG_MA','desc')->get();

            $countdg = DB::table('danh_gia')
            ->join('khach_hang','khach_hang.KH_MA','=','danh_gia.KH_MA')->count();
    
            Session::put('countdg',$countdg);
            
    	return view('admin.dashboard')->with('danh_gia',$danh_gia);
    }

    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('nhanvien')->where('NV_EMAIL', $admin_email)->where('NV_MATKHAU', $admin_password)->first();
        /*echo '<pre>';
        print_r ($result);
        echo '</pre>';
        return view('admin.dashboard'); */
         if($result){
          /* $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }*/
            Session::put('NV_HOTEN',$result->NV_HOTEN);
            Session::put('NV_MA',$result->NV_MA);
            Session::put('NV_DUONGDANANHDAIDIEN',$result->NV_DUONGDANANHDAIDIEN);
            return Redirect::to('/dashboard');
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản sai. Vui lòng nhập lại!');
                return Redirect::to('/admin');
        }
    }

    public function logout(Request $request){
        $this->AuthLogin();
        Session::put('NV_HOTEN',null);
        Session::put('NV_MA',null);
        Session::put('NV_DUONGDANANHDAIDIEN',null);
        return Redirect::to('/admin');
    }

    //Thống kê
    public function thong_ke(){
        $this->AuthLogin();

        $dayprev=Carbon::now('Asia/Ho_Chi_Minh')->subMonths(3);
        $daynow=Carbon::now('Asia/Ho_Chi_Minh');
        //echo $dayprev .";". $daynow;

        Session::put('TGBDau', $dayprev);
        Session::put('TGKThuc', $daynow);

        /*
        SELECT s.*, c.* FROM sach s JOIN chi_tiet_don_dat_hang c on s.SACH_MA = c.SACH_MA 
        JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA
        WHERE d.DDH_NGAYDAT BETWEEN '2023-02-01' AND '2023-03-21' 
        GROUP by s.SACH_MA HAVING SUM(ctddh_soluong) = (SELECT max(tongsoluong) FROM (SELECT c.SACH_MA, SUM(ctddh_soluong) tongsoluong FROM chi_tiet_don_dat_hang c JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA WHERE d.DDH_NGAYDAT BETWEEN '2023-02-01' AND '2023-03-21' GROUP BY (c.SACH_MA)) sum_sach);

        $query = DB::table('sach as s')
           ->join('chi_tiet_don_dat_hang as c', 's.SACH_MA', '=', 'c.SACH_MA')
           ->join('don_dat_hang as d', 'c.DDH_MA', '=', 'd.DDH_MA')
           ->select('s.*', 'c.*')
           ->whereBetween('d.DDH_NGAYDAT', ['2023-02-01', '2023-03-21'])
           ->groupBy('s.SACH_MA')
           ->havingRaw('SUM(ctddh_soluong) = (SELECT max(tongsoluong) FROM (SELECT c.SACH_MA, SUM(ctddh_soluong) tongsoluong FROM chi_tiet_don_dat_hang c JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA WHERE d.DDH_NGAYDAT BETWEEN '2023-02-01' AND '2023-03-21' GROUP BY (c.SACH_MA)) sum_sach)')
           ->get();
        
        $sachbannhieu = DB::table('sach as s')
        ->join('chi_tiet_don_dat_hang as c', 's.SACH_MA', '=', 'c.SACH_MA')
        ->join('don_dat_hang as d', 'c.DDH_MA', '=', 'd.DDH_MA')
        ->select('s.*', 'c.*')
        ->whereBetween('d.DDH_NGAYDAT', [$dayprev, $dayprev])
        ->groupBy('s.SACH_MA')
        ->havingRaw("SUM(ctddh_soluong) = (SELECT max(tongsoluong) FROM (SELECT c.SACH_MA, SUM(ctddh_soluong) tongsoluong FROM chi_tiet_don_dat_hang c JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA WHERE d.DDH_NGAYDAT BETWEEN '".$dayprev."' AND '".$daynow."' GROUP BY (c.SACH_MA)) sum_sach)")
        ->get();

        $sachbannhieu = DB::table('sach as s')
        ->join('chi_tiet_don_dat_hang as c', 's.SACH_MA', '=', 'c.SACH_MA')
        ->join('don_dat_hang as d', 'c.DDH_MA', '=', 'd.DDH_MA')
        ->select('s.*', 'c.*')
        ->whereBetween('d.DDH_NGAYDAT', ['2023-02-01', '2023-03-21'])
        ->groupBy('s.SACH_MA')
        ->havingRaw('SUM(ctddh_soluong) = (SELECT max(tongsoluong) FROM (SELECT c.SACH_MA, SUM(ctddh_soluong) tongsoluong FROM chi_tiet_don_dat_hang c JOIN don_dat_hang d on c.DDH_MA = d.DDH_MA WHERE d.DDH_NGAYDAT BETWEEN "2023-02-01" AND "2023-03-21" GROUP BY (c.SACH_MA)) sum_sach)')
        ->get();

        echo '<pre>';
        print_r ($sachbannhieu);
        echo '</pre>';*/
        return view('admin.dashboard.thong_ke');
    }

    //Liệt kê các đơn hàng

    public function all_order(){
        $this->AuthLogin();

        $all_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('sach','sach.SACH_MA','=','chi_tiet_don_dat_hang.SACH_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')->get();
        $manager_order = view('admin.all_order')->with('all_DDH', $all_DDH);

        $count_order = DB::table('don_dat_hang')->count('DDH_MA');
        Session::put('count_order',$count_order);
        return view('admin-layout')->with('admin.all_order', $manager_order);
    }

        //Tất cả trạng thái
    public function all_status(){

        $all_status = DB::table('trang_thai')->get();

        $all_DDH=  DB::table('don_dat_hang')
        ->join('chi_tiet_trang_thai', 'don_dat_hang.DDH_MA', '=', 'chi_tiet_trang_thai.DDH_MA')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'chi_tiet_trang_thai.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')->get();


        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('sach','sach.SACH_MA','=','chi_tiet_don_dat_hang.SACH_MA')->get();

        $count_order = DB::table('don_dat_hang')->count('DDH_MA');
        Session::put('count_order',$count_order);

        return view('admin.all_order')
        ->with('all_status', $all_status)
        ->with('all_DDH', $all_DDH)
        ->with('group_DDH', $group_DDH);
    }
        //Danh mục trạng thái
    public function show_status_order($TT_MA){

        $all_status = DB::table('trang_thai')->get();

        $status_by_id = DB::table('don_dat_hang')
        ->join('chi_tiet_trang_thai', 'don_dat_hang.DDH_MA', '=', 'chi_tiet_trang_thai.DDH_MA')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'chi_tiet_trang_thai.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')
        ->where('trang_thai.TT_MA', $TT_MA)->get();

        $status_count = DB::table('don_dat_hang')
        ->join('chi_tiet_trang_thai', 'don_dat_hang.DDH_MA', '=', 'chi_tiet_trang_thai.DDH_MA')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'chi_tiet_trang_thai.TT_MA')
        ->orderby('don_dat_hang.DDH_MA','desc')
        ->where('trang_thai.TT_MA', $TT_MA)->count();
        Session::put('status_count',$status_count);

        $status_name = DB::table('trang_thai')->where('trang_thai.TT_MA', $TT_MA )->get();

        $all_DDH=  DB::table('don_dat_hang')->orderby('don_dat_hang.DDH_MA','desc')->get();


        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('sach','sach.SACH_MA','=','chi_tiet_don_dat_hang.SACH_MA')->get();


        return view('admin.show_status_order')
        ->with('all_status', $all_status)
        ->with('id_status', $status_by_id)
        ->with('status_name', $status_name)
        ->with('all_DDH', $all_DDH)
        ->with('group_DDH', $group_DDH);
    }

    //Tìm kiếm sản phẩm trong tất cả các đơn đặt hàng
    public function search_all_order(Request $request){
        $this->AuthLogin();

        $all_status = DB::table('trang_thai')->get();

        $keywords = $request ->keywords_submit;

        $all_DDH=  DB::table('don_dat_hang')
        //->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        //->join('sach','sach.SACH_MA','=','chi_tiet_don_dat_hang.SACH_MA')
        ->join('chi_tiet_trang_thai', 'don_dat_hang.DDH_MA', '=', 'chi_tiet_trang_thai.DDH_MA')
        ->join('trang_thai', 'trang_thai.TT_MA', '=', 'chi_tiet_trang_thai.TT_MA')
        //->where('sach.SACH_MA', 'like', '%'.$keywords.'%')
        ->where('don_dat_hang.DDH_MA', '=', $keywords)
        ->orderby('don_dat_hang.DDH_MA','desc')->get();

        $group_DDH = DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.DDH_MA','=','chi_tiet_don_dat_hang.DDH_MA')
        ->join('sach','sach.SACH_MA','=','chi_tiet_don_dat_hang.SACH_MA')->get();

        return view('admin.search_all_order')
        ->with('all_status', $all_status)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH);
    }

    //Xem chi tiết đơn hàng
    public function show_detail($DDH_MA){
        $all_category_product = DB::table('the_loai_sach')->get();
        $all_DDH=  DB::table('don_dat_hang')
        ->join('khach_hang','khach_hang.KH_MA','=','don_dat_hang.KH_MA')
        ->join('dia_chi_giao_hang','dia_chi_giao_hang.DCGH_MA','=','don_dat_hang.DCGH_MA')
        ->join('hinh_thuc_thanh_toan','hinh_thuc_thanh_toan.HTTT_MA','=','don_dat_hang.HTTT_MA')
        ->join('xa_phuong','dia_chi_giao_hang.XP_MA','=','xa_phuong.XP_MA')
        ->join('huyen_quan','huyen_quan.HQ_MA','=','xa_phuong.HQ_MA')
        ->join('tinh_thanh_pho','huyen_quan.TTP_MA','=','tinh_thanh_pho.TTP_MA')
        ->where('don_dat_hang.DDH_MA', $DDH_MA)->get();


        $group_DDH = DB::table('chi_tiet_don_dat_hang')
        ->join('sach','sach.SACH_MA','=','chi_tiet_don_dat_hang.SACH_MA')
        ->join('hinh_anh_sach','sach.SACH_MA','=','hinh_anh_sach.SACH_MA')
        ->where('chi_tiet_don_dat_hang.DDH_MA', $DDH_MA)->get();

        $TT_MA = Session::get('TT_MA');

        $all_status = DB::table('trang_thai')
        ->where('trang_thai.TT_MA', $TT_MA)
        ->get();

        return view('admin.show_detail')->with('category', $all_category_product)
        ->with('all_DDH', $all_DDH)->with('group_DDH', $group_DDH)
        ->with('all_status', $all_status);

    }
    
    public function thong_ke_tg(Request $request){
        $this->AuthLogin();
        $homnay=Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->TGBDau && $request->TGKThuc && $request->TGBDau<=$request->TGKThuc && $request->TGKThuc<=$homnay ){
            Session::put('TGBDau', $request->TGBDau);
            Session::put('TGKThuc', $request->TGKThuc);
            return view('admin.dashboard.thong_ke');
        }
        
        Session::put('message','Xin kiểm tra lại dữ liệu đầu vào');
        return view('admin.dashboard.thong_ke');
    }

    //Phí ship (select_location nằm ở CostumerController)
    public function show_feeship(){
        $this->AuthLoginChu();
        $count_feeship = DB::table('xa_phuong')->count('XP_MA');
        Session::put('count_feeship',$count_feeship);
        $dc = DB::table('tinh_thanh_pho')
        ->join('huyen_quan','tinh_thanh_pho.TTP_MA','=','huyen_quan.TTP_MA')
        ->join('xa_phuong','xa_phuong.HQ_MA','=','huyen_quan.HQ_MA')->get();
        return view('admin.dashboard.show_feeship')->with('dc',$dc);
    }
    
    public function edit_feeship($XP_MA){
        $this->AuthLoginChu();
        $dc = DB::table('tinh_thanh_pho')
        ->join('huyen_quan','tinh_thanh_pho.TTP_MA','=','huyen_quan.TTP_MA')
        ->join('xa_phuong','xa_phuong.HQ_MA','=','huyen_quan.HQ_MA')
        ->where('xa_phuong.XP_MA','=',$XP_MA)->get();
        return view('admin.dashboard.edit_feeship')->with('dc',$dc);
    }

    public function update_feeship(Request $request, $XP_MA){
        $this->AuthLoginChu();
        $data = array();
        $data['XP_CHIPHIGIAOHANG'] = $request->XP_CHIPHIGIAOHANG;
        DB::table('xa_phuong')->where('XP_MA',$XP_MA)->update($data);
        Session::put('message','Cập nhật phí ship thành công');
        return Redirect::to('show_feeship');
    }
}
