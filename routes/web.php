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

//Frontend
Route::get('/','App\Http\Controllers\HomeController@index'); ///
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index'); ///
Route::get('/danh-muc-san-pham/tat-ca', 'App\Http\Controllers\HomeController@all_product'); ///
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search'); ///

//Home Product Categories
Route::get('/danh-muc-san-pham/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@show_category_home'); ///
Route::get('/chi-tiet-san-pham/{NT_MA}', 'App\Http\Controllers\ProductController@detail_product'); ///

Route::post('/danh-gia/{NT_MA}', 'App\Http\Controllers\ProductController@danh_gia');

//Login
Route::get('/dang-nhap','App\Http\Controllers\CostumerController@dang_nhap'); ///
Route::get('/logout', 'App\Http\Controllers\CostumerController@logout'); ///
Route::post('/costumer-check', 'App\Http\Controllers\CostumerController@trang_chu'); ///

//Sign up
Route::post('/dang-ky', 'App\Http\Controllers\CostumerController@signup'); ///

//Cart
//Route::post('/update-cart-quantity','App\Http\Controllers\CartController@update_cart_quantity');
//Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::get('/delete-cart/{NT_MA}', 'App\Http\Controllers\CartController@delete_cart');

//Location: Địa chỉ giao hàng
Route::get('/dia-chi-giao-hang','App\Http\Controllers\CostumerController@all_location');
Route::get('/them-dia-chi-giao-hang','App\Http\Controllers\CostumerController@add_location');
Route::get('/sua-dia-chi-giao-hang/{DCGH_MA}', 'App\Http\Controllers\CostumerController@edit_location');
Route::get('/xoa-dia-chi-giao-hang/{DCGH_MA}', 'App\Http\Controllers\CostumerController@delete_location');

Route::post('/select-location', 'App\Http\Controllers\CostumerController@select_location');
Route::post('/save-location', 'App\Http\Controllers\CostumerController@save_location');
Route::post('/update-location/{DCGH_MA}', 'App\Http\Controllers\CostumerController@update_location');

//Don dat hang
Route::get('/show-all-bill','App\Http\Controllers\CartController@show_all_bill');
Route::get('/show-detail-bill/{DDH_MA}','App\Http\Controllers\CartController@show_detail_bill');
Route::get('/show-detail-order','App\Http\Controllers\CartController@show_detail_order');
Route::post('/order','App\Http\Controllers\CartController@order');
Route::post('/search-in-order', 'App\Http\Controllers\CartController@search_in_order');

//Account
Route::get('/tai-khoan', 'App\Http\Controllers\CostumerController@show_account'); ///
Route::get('/cap-nhat-tai-khoan', 'App\Http\Controllers\CostumerController@edit_account'); ///

Route::post('/update-tai-khoan', 'App\Http\Controllers\CostumerController@update_account'); ///
//---------------------------------------------------



//Backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/log-out', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

//Category Product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{LNT_MA}', 'App\Http\Controllers\CategoryProduct@update_category_product');

//Brand Product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{NXB_MA}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{NXB_MA}', 'App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');

Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{NXB_MA}', 'App\Http\Controllers\BrandProduct@update_brand_product');

//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{NT_MA}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{NT_MA}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');

Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{NT_MA}', 'App\Http\Controllers\ProductController@update_product');
Route::post('/search-product', 'App\Http\Controllers\ProductController@search_product');

//Product Image
Route::get('/add-product-image', 'App\Http\Controllers\ImageProductController@add_product_image');
Route::get('/edit-product-image/{HAS_MA}', 'App\Http\Controllers\ImageProductController@edit_product_image');
Route::get('/delete-product-image/{HAS_MA}', 'App\Http\Controllers\ImageProductController@delete_product_image');
Route::get('/all-product-image', 'App\Http\Controllers\ImageProductController@all_product_image');

Route::post('/save-product-image', 'App\Http\Controllers\ImageProductController@save_product_image');
Route::post('/update-product-image/{HAS_MA}', 'App\Http\Controllers\ImageProductController@update_product_image');


//Product tacgia
Route::get('/add-tacgia-product', 'App\Http\Controllers\TacgiaProduct@add_tacgia_product');
Route::get('/edit-tacgia-product/{TG_MA}', 'App\Http\Controllers\TacgiaProduct@edit_tacgia_product');
Route::get('/delete-tacgia-product/{TG_MA}', 'App\Http\Controllers\TacgiaProduct@delete_tacgia_product');
Route::get('/all-tacgia-product', 'App\Http\Controllers\TacgiaProduct@all_tacgia_product');

Route::post('/save-tacgia-product', 'App\Http\Controllers\TacgiaProduct@save_tacgia_product');
Route::post('/update-tacgia-product/{TG_MA}', 'App\Http\Controllers\TacgiaProduct@update_tacgia_product');

//Employee
Route::get('/show-employee', 'App\Http\Controllers\EmployeeController@show_employee');
Route::get('/add-employee', 'App\Http\Controllers\EmployeeController@add_employee');
Route::get('/edit-employee/{NV_MA}', 'App\Http\Controllers\EmployeeController@edit_employee');
Route::get('/delete-employee/{NV_MA}', 'App\Http\Controllers\EmployeeController@delete_employee');
Route::get('/all-employee', 'App\Http\Controllers\EmployeeController@all_employee');

Route::post('/save-employee', 'App\Http\Controllers\EmployeeController@save_employee');
Route::post('/update-employee/{NV_MA}', 'App\Http\Controllers\EmployeeController@update_employee');

//lonhap
Route::get('/add-lonhap', 'App\Http\Controllers\Lonhap@add_lonhap');
Route::get('/edit-lonhap/{LN_MA}', 'App\Http\Controllers\Lonhap@edit_lonhap');
Route::get('/delete-lonhap/{LN_MA}', 'App\Http\Controllers\Lonhap@delete_lonhap');
Route::get('/all-lonhap', 'App\Http\Controllers\Lonhap@all_lonhap');

Route::post('/save-lonhap', 'App\Http\Controllers\Lonhap@save_lonhap');
Route::post('/update-lonhap/{LN_MA}', 'App\Http\Controllers\Lonhap@update_lonhap');

//chitiet lonhap
Route::get('/add-chitiet-lonhap', 'App\Http\Controllers\Chitietlonhap@add_chitiet_lonhap');
Route::get('/edit-chitiet-lonhap/lo={LN_MA}&sach={NT_MA}', 'App\Http\Controllers\Chitietlonhap@edit_chitiet_lonhap');
Route::get('/delete-chitiet-lonhap/lo={LN_MA}&sach={NT_MA}', 'App\Http\Controllers\Chitietlonhap@delete_chitiet_lonhap');
Route::get('/all-chitiet-lonhap', 'App\Http\Controllers\Chitietlonhap@all_chitiet_lonhap');

Route::post('/save-chitiet-lonhap', 'App\Http\Controllers\Chitietlonhap@save_chitiet_lonhap');
Route::post('/update-chitiet-lonhap/lo={LN_MA}&sach={NT_MA}', 'App\Http\Controllers\Chitietlonhap@update_chitiet_lonhap');

//lonxuat
Route::get('/add-loxuat', 'App\Http\Controllers\Loxuat@add_loxuat');
Route::get('/edit-loxuat/{LX_MA}', 'App\Http\Controllers\Loxuat@edit_loxuat');
Route::get('/delete-loxuat/{LX_MA}', 'App\Http\Controllers\Loxuat@delete_loxuat');
Route::get('/all-loxuat', 'App\Http\Controllers\Loxuat@all_loxuat');

Route::post('/save-loxuat', 'App\Http\Controllers\Loxuat@save_loxuat');
Route::post('/update-loxuat/{LX_MA}', 'App\Http\Controllers\Loxuat@update_loxuat');

//chitiet loxuat
Route::get('/add-chitiet-loxuat', 'App\Http\Controllers\Chitietloxuat@add_chitiet_loxuat');
Route::get('/edit-chitiet-loxuat/lo={LX_MA}&sach={NT_MA}', 'App\Http\Controllers\Chitietloxuat@edit_chitiet_loxuat');
Route::get('/delete-chitiet-loxuat/lo={LX_MA}&sach={NT_MA}', 'App\Http\Controllers\Chitietloxuat@delete_chitiet_loxuat');
Route::get('/all-chitiet-loxuat', 'App\Http\Controllers\Chitietloxuat@all_chitiet_loxuat');

Route::post('/save-chitiet-loxuat', 'App\Http\Controllers\Chitietloxuat@save_chitiet_loxuat');
Route::post('/update-chitiet-loxuat/lo={LX_MA}&sach={NT_MA}', 'App\Http\Controllers\Chitietloxuat@update_chitiet_loxuat');

//Thống kê
Route::get('/thong-ke', 'App\Http\Controllers\AdminController@thong_ke');
Route::post('/thong-ke-thoi-gian', 'App\Http\Controllers\AdminController@thong_ke_tg');

//Đơn đặt hàng
//Route::get('/liet-ke-don-hang', 'App\Http\Controllers\AdminController@liet_ke_dh');
Route::get('/trang-thai/tat-ca', 'App\Http\Controllers\AdminController@all_status');
Route::get('/danh-muc-trang-thai/{TT_MA}', 'App\Http\Controllers\AdminController@show_status_order');
Route::post('/search-all-order', 'App\Http\Controllers\AdminController@search_all_order');
Route::get('/show-detail/{DDH_MA}','App\Http\Controllers\AdminController@show_detail');

//Trạng thái đơn đặt hàng
Route::get('/update-status-order/{DDH_MA}', 'App\Http\Controllers\OrderController@update_status_order');
Route::post('/update_status/ddh={DDH_MA}&tt={TT_MA}', 'App\Http\Controllers\OrderController@update_status');

//Liet ke thong tin trang thai ddh
Route::get('/all-lktt-trangthaiddh', 'App\Http\Controllers\OrderController@all_lktt_trangthaiddh');
Route::get('/all-nguoixuly', 'App\Http\Controllers\OrderController@all_nguoixuly');

//Phí ship
Route::get('/show_feeship', 'App\Http\Controllers\AdminController@show_feeship');
Route::get('/edit_feeship/{XP_MA}', 'App\Http\Controllers\AdminController@edit_feeship');
Route::post('/update_feeship/{XP_MA}', 'App\Http\Controllers\AdminController@update_feeship');

// chuc vu 
Route::get('/add-chucvu', 'App\Http\Controllers\Chucvu@add_chucvu');
Route::get('/edit-chucvu/{CV_MA}', 'App\Http\Controllers\Chucvu@edit_chucvu');
Route::get('/delete-chucvu/{CV_MA}', 'App\Http\Controllers\Chucvu@delete_chucvu');
Route::get('/all-chucvu', 'App\Http\Controllers\Chucvu@all_chucvu');

Route::post('/save-chucvu', 'App\Http\Controllers\Chucvu@save_chucvu');
Route::post('/update-chucvu/{CV_MA}', 'App\Http\Controllers\Chucvu@update_chucvu');

// hinh thuc thanh toan
Route::get('/add-hinhthu-thanhtoan', 'App\Http\Controllers\Hinhthucthanhtoan@add_hinhthuc_thanhtoan');
Route::get('/edit-hinhthu-thanhtoan/{HTTT_MA}', 'App\Http\Controllers\Hinhthucthanhtoan@edit_hinhthuc_thanhtoan');
Route::get('/delete-hinhthu-thanhtoan/{HTTT_MA}', 'App\Http\Controllers\Hinhthucthanhtoan@delete_hinhthuc_thanhtoan');
Route::get('/all-hinhthu-thanhtoan', 'App\Http\Controllers\Hinhthucthanhtoan@all_hinhthuc_thanhtoan');

Route::post('/save-hinhthu-thanhtoan', 'App\Http\Controllers\Hinhthucthanhtoan@save_hinhthuc_thanhtoan');
Route::post('/update-hinhthu-thanhtoan/{HTTT_MA}', 'App\Http\Controllers\Hinhthucthanhtoan@update_hinhthuc_thanhtoan');

//khachhang
Route::get('/add-khachhang', 'App\Http\Controllers\Khachhang@add_khachhang');
Route::get('/edit-khachhang/{KH_MA}', 'App\Http\Controllers\Khachhang@edit_khachhang');
Route::get('/delete-khachhang/{KH_MA}', 'App\Http\Controllers\Khachhang@delete_khachhang');
Route::get('/all-khachhang', 'App\Http\Controllers\Khachhang@all_khachhang');

//tacgia cuasach

Route::get('/add-tacgia-cuasach', 'App\Http\Controllers\TacGiaCuaSach@add_tacgia_cuasach');
Route::get('/edit-tacgia-cuasach/sach={NT_MA}&tacgia={TG_MA}', 'App\Http\Controllers\TacGiaCuaSach@edit_tacgia_cuasach');
Route::get('/delete-tacgia-cuasach/sach={NT_MA}&tacgia={TG_MA}', 'App\Http\Controllers\TacGiaCuaSach@delete_tacgia_cuasach');
Route::get('/all-tacgia-cuasach', 'App\Http\Controllers\TacGiaCuaSach@all_tacgia_cuasach');

Route::post('/save-tacgia-cuasach', 'App\Http\Controllers\TacGiaCuaSach@save_tacgia_cuasach');
Route::post('/update-tacgia-cuasach/sach={NT_MA}&tacgia={TG_MA}', 'App\Http\Controllers\TacGiaCuaSach@update_tacgia_cuasach');

//theloai cuasach
Route::get('/add-cttheloai-cuasach', 'App\Http\Controllers\ChiTietTLSach@add_cttheloai_cuasach');
Route::get('/edit-cttheloai-cuasach/sach={NT_MA}&theloai={LNT_MA}', 'App\Http\Controllers\ChiTietTLSach@edit_cttheloai_cuasach');
Route::get('/delete-cttheloai-cuasach/sach={NT_MA}&theloai={LNT_MA}', 'App\Http\Controllers\ChiTietTLSach@delete_cttheloai_cuasach');
Route::get('/all-cttheloai-cuasach', 'App\Http\Controllers\ChiTietTLSach@all_cttheloai_cuasach');

Route::post('/save-cttheloai-cuasach', 'App\Http\Controllers\ChiTietTLSach@save_cttheloai_cuasach');
Route::post('/update-cttheloai-cuasach/sach={NT_MA}&theloai={LNT_MA}', 'App\Http\Controllers\ChiTietTLSach@update_cttheloai_cuasach');

//ton kho
Route::get('/ton-kho', 'App\Http\Controllers\ProductController@ton_kho');