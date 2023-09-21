<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Frontend-----------------------------------------------------------------------------------------------

//Giao diện
Route::get('/','App\Http\Controllers\HomeController@index'); 
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index'); 
//Route::get('/danh-muc-san-pham/tat-ca', 'App\Http\Controllers\HomeController@all_product'); 
Route::get('/danh-muc-san-pham/tat-ca&{chuoi}', 'App\Http\Controllers\HomeController@all_product'); 

Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search'); 
Route::post('/loc-gia&{chuoidai}', 'App\Http\Controllers\HomeController@loc_gia'); 
//Danh mục loại nội thất
Route::get('/danh-muc-san-pham/{LNT_MA}&{chuoi}', 'App\Http\Controllers\CategoryProduct@show_category_home'); 
Route::get('/chi-tiet-san-pham/{NT_MA}', 'App\Http\Controllers\ProductController@detail_product'); 

Route::post('/danh-gia/{NT_MA}', 'App\Http\Controllers\ProductController@danh_gia'); 

//Login
Route::get('/dang-nhap','App\Http\Controllers\CostumerController@dang_nhap'); 
Route::get('/logout', 'App\Http\Controllers\CostumerController@logout'); 

Route::post('/costumer-check', 'App\Http\Controllers\CostumerController@trang_chu'); 

//Sign up
Route::post('/dang-ky', 'App\Http\Controllers\CostumerController@signup'); 

//Cart
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart'); 
Route::get('/delete-cart/{NT_MA}', 'App\Http\Controllers\CartController@delete_cart'); 

Route::post('/save-cart','App\Http\Controllers\CartController@save_cart'); 
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart'); 

//Location: Địa chỉ giao hàng
Route::get('/dia-chi-giao-hang','App\Http\Controllers\CostumerController@all_location'); 
Route::get('/them-dia-chi-giao-hang','App\Http\Controllers\CostumerController@add_location'); 
Route::get('/sua-dia-chi-giao-hang/{DCGH_MA}', 'App\Http\Controllers\CostumerController@edit_location');   
Route::get('/xoa-dia-chi-giao-hang/{DCGH_MA}', 'App\Http\Controllers\CostumerController@delete_location'); 

Route::post('/save-location', 'App\Http\Controllers\CostumerController@save_location'); 
Route::post('/update-location/{DCGH_MA}', 'App\Http\Controllers\CostumerController@update_location'); 

//Đơn đặt hàng
Route::get('/show-all-bill','App\Http\Controllers\CartController@show_all_bill'); 
Route::get('/show-detail-bill/{DDH_MA}','App\Http\Controllers\CartController@show_detail_bill'); 
Route::get('/show-detail-order','App\Http\Controllers\CartController@show_detail_order'); 
Route::get('/huy-don/{DDH_MA}','App\Http\Controllers\CartController@cancel_order'); 

Route::post('/order','App\Http\Controllers\CartController@order'); 
Route::post('/search-in-order', 'App\Http\Controllers\CartController@search_in_order'); 

//Account
Route::get('/tai-khoan', 'App\Http\Controllers\CostumerController@show_account'); 
Route::get('/cap-nhat-tai-khoan', 'App\Http\Controllers\CostumerController@edit_account'); 
Route::get('/doi-mat-khau', 'App\Http\Controllers\CostumerController@change_password_account'); 

Route::post('/update-tai-khoan', 'App\Http\Controllers\CostumerController@update_account'); 
Route::post('/update-mat-khau', 'App\Http\Controllers\CostumerController@update_password_account'); 
//---------------------------------------------------------------------------------------------------------









//Backend---------------------------------------------------------------------------------------------------

//Giao diện --All
Route::get('/admin', 'App\Http\Controllers\AdminController@index'); 
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard'); 
Route::get('/log-out', 'App\Http\Controllers\AdminController@logout'); 

Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard'); 

//Category Product: Loại nội thất
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product'); 
Route::get('/edit-category-product/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@edit_category_product'); 
Route::get('/delete-category-product/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@delete_category_product'); 
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');  

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product'); 
Route::post('/update-category-product/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@update_category_product'); 

//Brand Product: Xưởng chế tác
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product'); 
Route::get('/edit-brand-product/{XCT_MA}', 'App\Http\Controllers\BrandProduct@edit_brand_product'); 
Route::get('/delete-brand-product/{XCT_MA}', 'App\Http\Controllers\BrandProduct@delete_brand_product'); 
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product'); 

Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product'); 
Route::post('/update-brand-product/{XCT_MA}', 'App\Http\Controllers\BrandProduct@update_brand_product'); 

//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product'); 
Route::get('/edit-product/{NT_MA}', 'App\Http\Controllers\ProductController@edit_product'); 
Route::get('/delete-product/{NT_MA}', 'App\Http\Controllers\ProductController@delete_product'); 
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product'); //--All 
Route::get('/phan-theo-loai/{LNT_MA}', 'App\Http\Controllers\ProductController@show_category_product'); //--All 
Route::get('/product-detail/{NT_MA}', 'App\Http\Controllers\ProductController@product_detail'); 
Route::get('/delete-image/{HANT_MA}', 'App\Http\Controllers\ProductController@delete_image'); 

Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product'); 
Route::post('/update-product/{NT_MA}', 'App\Http\Controllers\ProductController@update_product'); 
Route::post('/search-product', 'App\Http\Controllers\ProductController@search_product'); //--All 
Route::post('/update-image/{NT_MA}', 'App\Http\Controllers\ProductController@update_image'); 

//Employee
Route::get('/change-password', 'App\Http\Controllers\EmployeeController@change_password'); //--All 
Route::get('/show-employee', 'App\Http\Controllers\EmployeeController@show_employee'); //--All 
Route::get('/add-employee', 'App\Http\Controllers\EmployeeController@add_employee'); 
Route::get('/edit-employee/{NV_MA}', 'App\Http\Controllers\EmployeeController@edit_employee'); //--All 
Route::get('/delete-employee/{NV_MA}', 'App\Http\Controllers\EmployeeController@delete_employee'); 
Route::get('/all-employee', 'App\Http\Controllers\EmployeeController@all_employee'); 

Route::post('/save-employee', 'App\Http\Controllers\EmployeeController@save_employee'); 
Route::post('/update-employee/{NV_MA}', 'App\Http\Controllers\EmployeeController@update_employee'); //--All 
Route::post('/update-password', 'App\Http\Controllers\EmployeeController@update_password'); //--All 

//Lô nhập --+KKho
Route::get('/add-lonhap', 'App\Http\Controllers\ImportController@add_lonhap'); 
Route::get('/edit-lonhap/{LN_MA}', 'App\Http\Controllers\ImportController@edit_lonhap'); 
Route::get('/delete-lonhap/{LN_MA}', 'App\Http\Controllers\ImportController@delete_lonhap'); 
Route::get('/all-lonhap', 'App\Http\Controllers\ImportController@all_lonhap'); 

Route::post('/save-lonhap', 'App\Http\Controllers\ImportController@save_lonhap'); 
Route::post('/update-lonhap/{LN_MA}', 'App\Http\Controllers\ImportController@update_lonhap'); 

//Chi tiết lô nhập
Route::get('/show-chitiet-lonhap/{LN_MA}', 'App\Http\Controllers\ImportController@show_chitiet_lonhap'); 
Route::get('/add-chitiet-lonhap/{LN_MA}', 'App\Http\Controllers\ImportController@add_chitiet_lonhap'); 
Route::get('/edit-chitiet-lonhap/lo={LN_MA}&nothat={NT_MA}', 'App\Http\Controllers\ImportController@edit_chitiet_lonhap'); 
Route::get('/delete-chitiet-lonhap/lo={LN_MA}&nothat={NT_MA}', 'App\Http\Controllers\ImportController@delete_chitiet_lonhap'); 

Route::post('/save-chitiet-lonhap/{LN_MA}', 'App\Http\Controllers\ImportController@save_chitiet_lonhap'); 
Route::post('/update-chitiet-lonhap/lo={LN_MA}&nothat={NT_MA}', 'App\Http\Controllers\ImportController@update_chitiet_lonhap'); 

//Lô xuất
Route::get('/add-loxuat', 'App\Http\Controllers\ExportController@add_loxuat'); 
Route::get('/edit-loxuat/{LX_MA}', 'App\Http\Controllers\ExportController@edit_loxuat'); 
Route::get('/delete-loxuat/{LX_MA}', 'App\Http\Controllers\ExportController@delete_loxuat'); 
Route::get('/all-loxuat', 'App\Http\Controllers\ExportController@all_loxuat'); 

Route::post('/save-loxuat', 'App\Http\Controllers\ExportController@save_loxuat'); 
Route::post('/update-loxuat/{LX_MA}', 'App\Http\Controllers\ExportController@update_loxuat'); 

//Chi tiết lô xuất
Route::get('/show-chitiet-loxuat/{LX_MA}', 'App\Http\Controllers\ExportController@show_chitiet_loxuat'); 
Route::get('/add-chitiet-loxuat/{LX_MA}', 'App\Http\Controllers\ExportController@add_chitiet_loxuat');  
Route::get('/edit-chitiet-loxuat/lo={LX_MA}&nothat={NT_MA}', 'App\Http\Controllers\ExportController@edit_chitiet_loxuat'); 
Route::get('/delete-chitiet-loxuat/lo={LX_MA}&nothat={NT_MA}', 'App\Http\Controllers\ExportController@delete_chitiet_loxuat'); 

Route::post('/save-chitiet-loxuat/{LX_MA}', 'App\Http\Controllers\ExportController@save_chitiet_loxuat'); 
Route::post('/update-chitiet-loxuat/lo={LX_MA}&nothat={NT_MA}', 'App\Http\Controllers\ExportController@update_chitiet_loxuat'); 

//Tồn kho
Route::get('/ton-kho', 'App\Http\Controllers\ProductController@ton_kho'); 

Route::post('/kiem-tra-ton-kho', 'App\Http\Controllers\ProductController@kiem_tra_ton_kho'); 

//Thống kê 
Route::get('/thong-ke', 'App\Http\Controllers\AdminController@thong_ke'); 

Route::post('/thong-ke-thoi-gian', 'App\Http\Controllers\AdminController@thong_ke_tg'); 

//Đơn đặt hàng --+BHang
Route::get('/trang-thai/tat-ca', 'App\Http\Controllers\OrderController@all_status'); 
Route::get('/danh-muc-trang-thai/{TT_MA}', 'App\Http\Controllers\OrderController@show_status_order'); 
Route::get('/show-detail/{DDH_MA}','App\Http\Controllers\OrderController@show_detail'); 
Route::get('/print-bill/{DDH_MA}','App\Http\Controllers\OrderController@print_bill'); 

Route::post('/search-all-order', 'App\Http\Controllers\OrderController@search_all_order'); 

//Trạng thái đơn đặt hàng --+BHang
Route::get('/update-status-order/{DDH_MA}', 'App\Http\Controllers\OrderController@update_status_order'); 

Route::post('/update_status/ddh={DDH_MA}&tt={TT_MA}', 'App\Http\Controllers\OrderController@update_status'); 

//Đánh giá --+BHang
Route::get('/danh-gia', 'App\Http\Controllers\OrderController@all_comment'); 
Route::get('/delete-danhgia/{DG_MA}', 'App\Http\Controllers\OrderController@delete_comment'); 

//Phí ship
Route::get('/show_feeship', 'App\Http\Controllers\AdminController@show_feeship'); 
Route::get('/edit_feeship/{TTP_MA}', 'App\Http\Controllers\AdminController@edit_feeship'); 

Route::post('/update_feeship/{TTP_MA}', 'App\Http\Controllers\AdminController@update_feeship'); 

//Chức vụ
Route::get('/add-chucvu', 'App\Http\Controllers\JobController@add_chucvu'); 
Route::get('/edit-chucvu/{CV_MA}', 'App\Http\Controllers\JobController@edit_chucvu'); 
Route::get('/delete-chucvu/{CV_MA}', 'App\Http\Controllers\JobController@delete_chucvu'); 
Route::get('/all-chucvu', 'App\Http\Controllers\JobController@all_chucvu'); 

Route::post('/save-chucvu', 'App\Http\Controllers\JobController@save_chucvu'); 
Route::post('/update-chucvu/{CV_MA}', 'App\Http\Controllers\JobController@update_chucvu'); 

//Hình thức thanh toán
Route::get('/add-hinhthuc-thanhtoan', 'App\Http\Controllers\PaymentController@add_hinhthuc_thanhtoan'); 
Route::get('/edit-hinhthuc-thanhtoan/{HTTT_MA}', 'App\Http\Controllers\PaymentController@edit_hinhthuc_thanhtoan'); 
Route::get('/delete-hinhthuc-thanhtoan/{HTTT_MA}', 'App\Http\Controllers\PaymentController@delete_hinhthuc_thanhtoan'); 
Route::get('/all-hinhthuc-thanhtoan', 'App\Http\Controllers\PaymentController@all_hinhthuc_thanhtoan'); 

Route::post('/save-hinhthuc-thanhtoan', 'App\Http\Controllers\PaymentController@save_hinhthuc_thanhtoan'); 
Route::post('/update-hinhthuc-thanhtoan/{HTTT_MA}', 'App\Http\Controllers\PaymentController@update_hinhthuc_thanhtoan'); 

//Trạng thái
Route::get('/add-trangthai', 'App\Http\Controllers\StateController@add_trangthai'); 
Route::get('/edit-trangthai/{TT_MA}', 'App\Http\Controllers\StateController@edit_trangthai'); 
Route::get('/delete-trangthai/{TT_MA}', 'App\Http\Controllers\StateController@delete_trangthai'); 
Route::get('/all-trangthai', 'App\Http\Controllers\StateController@all_trangthai'); 

Route::post('/save-trangthai', 'App\Http\Controllers\StateController@save_trangthai'); 
Route::post('/update-trangthai/{TT_MA}', 'App\Http\Controllers\StateController@update_trangthai'); 

//Khách hàng
Route::get('/all-khachhang', 'App\Http\Controllers\CostumerController@all_khachhang'); 
Route::get('/show-detail-costumer/{KH_MA}', 'App\Http\Controllers\CostumerController@show_khachhang'); 

//Ngưng bán sp bằng cách tạo lô xuất để xoá hết hàng

//Báo cáo doanh thu
//Ql vận đơn giao hàng

