<?php
use App\Http\Controllers\adminController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;





//---------------------------------------------USER---------------------------------------------------
//Welcome page
Route::get('thong-tin',function(){
	return view('Userpage.addInfomation')->middleware('loadbanner');
});
Route::get('/', 'homeController@welcome' )->name('homepage')->middleware('loadbanner');

// user info
Route::get('/infomation/{id}','homeController@viewInfomation')->middleware('checkAuth')->middleware('loadbanner');
Route::post('edit_infomation/{id}','homeController@editInfomation')->middleware('checkAuth');
Route::get('updatePass/{id}','homeController@updatePass')->middleware('checkAuth')->middleware('loadbanner');
Route::post('editPass/{id}','homeController@editPass')->middleware('checkAuth');
Route::get('changeEmail/{id}','homeController@changeEmail')->middleware('checkAuth');
Route::get('listorder','homeController@listorder')->middleware('checkAuth')->middleware('loadbanner');
Route::post('addInfomation/{id}','loginController@addInfomation');
Route::get('cancelinfo','homeController@cancelinfo');
//--------User register------//
Route::get('/register','registerController@index')->middleware('loadbanner');
Route::post('/getregister','registerController@getregister');
Route::post('/registerForApi','registerController@registerForApi');
//--------User Login------//
Route::get('login','homeController@login' )->name('loginpage')->middleware('loadbanner');
Route::post('/checklogin','loginController@userlogin');
Route::get('logout','homeController@logout')->middleware('loadbanner');
// User forgot password
// 
Route::get('forgotPassword','homeController@forgotPassword')->middleware('loadbanner');
Route::post('sendCodeGetAcc','loginController@sendCodeGetAcc');
Route::get('changepassword/{id?}','loginController@changepassword')->middleware('loadbanner');
Route::post('newpass/{id}','loginController@newpass');
//---

// verify-email
Route::get('verify-email/{id}',[homeController::class,'verifyemail'])->middleware('loadbanner');
Route::get('sendcode',[homeController::class,'sendcode'])->middleware('loadbanner');
Route::post('verifycode','homeController@verifycode');
//---

// Login gg & facebook api
Route::get('google','loginController@loginGoogle')->middleware('loadbanner');
Route::get('googleredirect','loginController@googleredirect');
Route::get('facebook','loginController@loginFacebook');
Route::get('facebookredirect','loginController@facebookredirect');
//---

// -------Product -----------//
Route::get('/product','homeController@product' )->name('productpage')->middleware('loadbanner');
	//search
Route::get('findpro','homeController@findpro')->middleware('loadbanner');
Route::post('advancedSearch','homeController@advancedSearch')->middleware('loadbanner');
	//
Route::get('proinfo/{id}','homeController@proinfo')->middleware('loadbanner');
Route::get('checkSerialpage','homeController@checkSerialpage')->middleware('loadbanner');;
Route::get('checkSerial','homeController@checkSerial')->middleware('loadbanner');;
Route::post('compare','homeController@compare')->middleware('loadbanner');;
//---

//--comment
Route::post('addcomment/{id}','homeController@addcomment');
Route::get('deletecomment/{id}','homeController@deletecomment');
//---

//
//--------User cart------//
//
//cart
Route::get('/checkout','homeController@checkout' )->middleware('loadbanner');
//
//add to cart
Route::get('save-cart/{id}',[cartController::class,'savecart']);
Route::post('save-cart2/{id}','cartController@savecart2');
Route::get('changeQuanty/increase/{id}','cartController@changeQuantyIncrease');
Route::get('changeQuanty/decrease/{id}','cartController@changeQuantyDecrease');
//
//
//remove item
Route::get('destroy-cart','cartController@destroy');
Route::get('remove-item/{id}','cartController@removeitem');
//
//
//create order 
Route::get('order','homeController@order')->middleware('checkAuth')->middleware('loadbanner');
Route::post('gocheckout/{id}','cartController@gocheckout')->middleware('checkAuth')->middleware('loadbanner');;
Route::get('sendmail','cartController@sendmail');

//redirect after pay
		Route::get('paymentsuccess','cartController@resultpayment')->name('resultpayment');
		//
// 
// ----

//------ Voucher---------//
Route::post('checkvoucher','homeController@checkvoucher')->name('checkvoucher');
Route::get('clearVoucher',function(){
	Session::forget('vcMa');
	Session::flash('success','Đã gỡ áp dụng voucher !');
	return Redirect()->back();
});
//---

//Wishlist
Route::get('wishlist','homeController@wishlist')->middleware('loadbanner');
Route::get('addtowishlist/{id}',[homeController::class,'addtowishlist'])->middleware('loadbanner');
//--Đơn hàng--//
Route::get('huy-don/{id}','homeController@huyDon');
//--Tin tức-->
Route::get('danh-sach-tin-tuc','homeController@viewTintuc')->middleware('loadbanner');
Route::get('chi-tiet-tin-tuc/{id}','homeController@tintucInfo')->middleware('loadbanner');
//--Thông tin banner--//
Route::get('chi-tiet-banner/{id}','homeController@bannerInfo')->middleware('loadbanner');
//--add Email tin tức--//
Route::get('add-email-tin-tuc/{id}','homeController@addEmailTintuc');
//---------------------------------------------END USER--------------------------------------------//

Route::get('t',function(){
	return view('admin.emailtangvoucher');
});



//---------------------------------------------ADMIN----------------------------------------------------//
//--------Admin Login------//

Route::get('/adLogin','adminController@adLoginView')->name('loginAdmin');
Route::post('/checkLogin','adminController@checkLogin');
Route::get('/adLogout','adminController@logout');
Route::get('/loiXoa','adminController@viewLoiXoa');

//Middeware group - phân quyền kiểm tra admin
Route::group(['middleware'=>'checkAdmin'], function(){
	
	Route::group(['middleware'=>'per1'], function(){
		Route::get('admin','adminController@index');
		Route::get('/adNhanvien','adminController@viewNhanvien');
		Route::get('/adKhachhang','adminController@viewKhachhang');
		Route::get('/adSanpham','adminController@viewSanpham');
		Route::get('/motasanpham/{id}','adminController@viewMotaSanpham');
		Route::get('/adLoai','adminController@viewLoai');
		Route::get('/adThuonghieu','adminController@viewThuonghieu');
		Route::get('/adNhucau','adminController@viewNhucau');
		Route::get('/adKhuyenmai','adminController@viewKhuyenmai');
		Route::get('/adBanner/{trang}/{vitri}','adminController@viewBanner');
		Route::get('adNhacungcap','adminController@adviewNhacungcap');
		Route::get('tin-tuc','adminController@viewTintuc');

		// Phuong thuc thanh toan
		Route::get('ptthanhtoanpage','adminController@ptthanhtoanpage');
		Route::post('updatepayment','adminController@updatepayment');
		Route::get('changePaymentStatus/{id}','adminController@changePaymentStatus');

			//tknganhang
			Route::get('deletetknh/{id}','adminController@deletetknh');
			Route::get('themtknh','adminController@themtknhpage');
			Route::post('themtk','adminController@themtknh');
		

		//--------Admin Manage View------//
		//--Nhân viên--//
		Route::get('/themnhanvien','adminController@themAdmin');
		Route::post('/checkAddAdmin','adminController@adCheckAddAdmin');
		Route::get('/deleteAdmin/{id}','adminController@adDeleteAdmin');
		Route::get('/updateAdmin/{id}','adminController@adUpdateAdmin');
		Route::post('/editAdmin/{id}','adminController@editAdmin');

		//--Khách hàng--//
		Route::get('/themkhachhang','adminController@themKhachhang');
		Route::post('/checkAddKhachhang','adminController@adCheckAddKhachhang');
		Route::get('/deleteKhachhang/{id}','adminController@adDeleteKhachhang');
		Route::get('/updateKhachhang/{id}','adminController@adUpdateKhachhang');
		Route::post('/editKhachhang/{id}','adminController@editKhachhang');
		Route::get('khoa-khach-hang/{id}','adminController@khoaKH');
		//--Sản phẩm--//
		Route::get('/themsanpham','adminController@themSanpham');
		Route::post('/checkAddSanpham','adminController@adCheckAddSanpham');
		Route::get('/deleteSanpham/{id}','adminController@adDeleteSanpham');
		Route::get('/updateSanpham/{id}','adminController@adUpdateSanpham');
		Route::post('/editSanpham/{id}','adminController@editSanpham');
		Route::post('/themhinh','adminController@addHinhSanpham');
		Route::get('/editHinhStt/{tenhinh}/{id}','adminController@editStatusHinh');
		Route::get('/xoahinh/{tenhinh}/{id}','adminController@deleteHinhSanpham');
		Route::post('/editMota/{id}','adminController@editMota');
		Route::get('/loiThemHinhSP','adminController@viewLoiThemHinhSP');
		Route::get('an-hien-sp/{id}','adminController@sanphamHienAn');

		//--Loai--//

		Route::post('/checkAddLoai','adminController@adCheckAddLoai');
		Route::post('editLoai/{id}','adminController@editLoai');
		Route::get('/deleteLoai/{id}',[adminController::class,'adDeleteLoai']);

		//--Nhu cầu --//

		Route::get('/checkAddNhucau','adminController@adCheckAddNhucau');
		Route::get('/deleteNhucau/{id}','adminController@adDeleteNhucau');
		Route::get('/editNhucau/{id}','adminController@editNhucau');
		//--Thương hiệu--//

		Route::get('/checkAddThuonghieu','adminController@adCheckAddThuonghieu');
		Route::get('/deleteThuonghieu/{id}','adminController@adDeleteThuonghieu');
		Route::get('/editThuonghieu/{id}','adminController@editThuonghieu');
		//--Banner--//
		Route::get('vi-tri-banner/{trang}','adminController@vitriBanner');
		Route::get('them-banner/{trang}/{id}','adminController@themBanner');
		Route::post('checkAddBanner/{trang}/{vitri}','adminController@adCheckAddBanner');
		Route::get('/deleteBanner/{id}','adminController@adDeleteBanner');
		Route::get('/showBanner/{id}','adminController@showBanner');

		//--Khuyến mãi--//
		Route::get('addKhuyenmaiPage','adminController@addKhuyenmaiPage');
		Route::post('/checkAddKhuyenmai','adminController@adCheckAddKhuyenmai');
		Route::get('/deleteKhuyenmai/{id}','adminController@adDeleteKhuyenmai');
		Route::get('suaKhuyenmaipage/{id}','adminController@suaKhuyenmaipage');
		Route::post('checkSuaKhuyenmai/{id}','adminController@suaKhuyenmai');
		Route::get('switchStatus/{id}','adminController@switchStatus');

		// Voucher
		Route::get('addVoucherpage','adminController@addVoucherpage');
		Route::post('checkAddVoucher','adminController@checkAddVoucher');
		Route::get('suaVoucherpage/{id}','adminController@suaVoucherpage');
		Route::post('checkSuaVoucher/{id}','adminController@checkSuaVoucher');
		Route::get('switchStatusVc/{id}','adminController@switchStatusVc');
		Route::get('adDeleteVoucher/{id}','adminController@adDeleteVoucher');
		Route::get('tangvoucherview','adminController@tangvoucherview');
		Route::post('tangvoucher','adminController@tangvoucher');

		// --Nhà cung cấp --//

		Route::get('adthemncc','adminController@adThemnccpage');
		Route::get('checkAddNcc','adminController@checkAddNcc');
		Route::get('deleteNhacungcap/{id}','adminController@deleteNhacungcap');
		Route::get('suaNhacungcappage/{id}','adminController@suaNhacungcappage');
		Route::post('checkSuaNhacungcap/{id}','adminController@suaNhacungcap');
			//--Lịch sử hoạt động --//
		Route::get('tim-kiem-lshd','adminController@timLSHD');
		

		//-----Khóa tài khoản----->
		Route::get('khoa-nv/{id}','adminController@khoaNhanvien');
		Route::get('mokhoa-nv/{id}','adminController@moKhoaNhanvien');

		//------Tin tức--------->
		Route::get('them-tin-tuc','adminController@themTintuc');
		Route::post('checkAddTT','adminController@adCheckAddTT');
		Route::get('cap-nhat-tin-tuc/{id}','adminController@adUpdateTintuc');
		Route::post('editTintuc/{id}','adminController@editTintuc');
		Route::get('xoa-tin-tuc/{id}',[adminController::class,'deleteTintuc']);

		Route::get('adVoucher','adminController@viewVoucher');
		Route::get('viewBLSP/{id}','adminController@viewBLSP');
		Route::get('lich-su-hoat-dong','adminController@viewLShoatdong');

		// Bao hanh //
		Route::get('adBaohanh','adminController@baohanhview');
		Route::get('addbaohanhview','adminController@addbaohanhview');
		Route::get('findproductSerial/{id}',[adminController::class,'findproductSerial']);
		Route::post('thembaohanh','adminController@thembaohanh');
		Route::get('xacnhantrahang/{id}','adminController@xacnhantrahang');
		// Thống kê //
		Route::post('searchThongke','adminController@searchThongke');
		Route::post('searchQuy','adminController@searchQuy');
	});

	Route::group(['middleware'=>'per2'], function(){
			//--------Chi tiết kho------//
			Route::get('/adKho','adminController@viewKho');
			Route::get('chi-tiet-kho/{id}','adminController@viewCTKho');
			//--------Chi tiết kho hỏng------//
			Route::get('/adKhohong','adminController@viewKhoHong');
			Route::get('chi-tiet-kho-hong/{id}','adminController@viewCTKhoHong');

		Route::get('/adBinhluan','adminController@viewBinhluan');
		//--------Admin Add Manage View------//
		////--Bình luận--//
		Route::get('chitietBLSP/{id}','adminController@chitietBLSP');
		//--Báo cáo tỏng--//
		Route::get('adBaocao','adminController@viewBcTong');
		Route::get('lap-bao-cao-tong','adminController@viewThemBcTong');
		Route::get('tim-bao-cao-tong','adminController@searchBaocao');
		Route::post('them-bao-cao-tong','adminController@adCheckAddBcTong');
		Route::get('chi-tiet-bao-cao-tong/{id}','adminController@chitietBctong');
		//--Báo cáo chi--//
		Route::get('bcChi','adminController@viewChi');
		Route::get('lap-bao-cao-chi','adminController@viewThemChi');
		Route::get('tim-bao-cao-chi','adminController@searchChi');
		Route::post('them-bao-cao-chi','adminController@adCheckAddChi');
		Route::get('chi-tiet-bao-cao-chi/{id}','adminController@chitietBcchi');
		//--Báo cáo thu --//
		Route::get('bcThu','adminController@viewThu');
		Route::get('lap-bao-cao-thu','adminController@viewThemThu');
		Route::get('tim-bao-cao-thu','adminController@searchThu');
		Route::post('them-bao-cao-thu','adminController@adCheckAddThu');
		Route::get('chi-tiet-bao-cao-thu/{id}','adminController@chitietBcthu');
		});
		

	Route::group(['middleware'=>'per3'], function(){
		Route::get('/adKhachhang','adminController@viewKhachhang');
		Route::get('/themkhachhang','adminController@themKhachhang');
		Route::post('/checkAddKhachhang','adminController@adCheckAddKhachhang');
		Route::get('don-hang','adminController@viewDonhang');
			//--Xử lý đơn mới--//
		Route::get('xu-ly-don-moi/{id}','adminController@viewXuLyDon');
			//--Đơn hàng--//
		Route::get('thong-tin-nhan-vien/{id}','adminController@nhanvienInfo');
		Route::post('giaohang/{id}','adminController@giaohang');
		Route::get('thanhtoan/{id}','adminController@thanhtoan');
		Route::get('xoa-don/{id}','adminController@xoadon');
			//--Phiếu nhập--//
		Route::get('quan-ly-phieu-nhap','adminController@viewQlPhieunhap');
		Route::get('lap-phieu-nhap','adminController@viewLapPhieuNhap');
		Route::post('addPhieuNhap','adminController@addPhieuNhap');
		Route::get('chi-tiet-phieu-nhap/{id}','adminController@viewCTPhieunhap');
		Route::get('chi-tiet-phieu-thu/{id}','adminController@viewCTDonhang');


		Route::get('chi-tiet-phieu-thu/{id}','adminController@viewCTDonhang');
		Route::get('taodonhangview','adminController@taodonhangview');
		Route::get('findPhoneNum/{sdt}',[adminController::class,'findPhoneNum']);
		Route::post('addDonhang','adminController@addDonhang');
		Route::post('acceptOrder','adminController@acceptOrder');
			//--Tách đơn--//
		Route::get('tach-don','adminController@viewTachdon');
		Route::get('xu-ly-tach-don/{id}','adminController@xuLyTachDon');
		Route::post('tien-hanh-tach-don/{id}','adminController@tienHanhTachDon');
			//--Hủy toàn đơn
		Route::get('huy-don-hang/{id}','adminController@huyToanDon');
			//--Cập nhật đơn hàng mới từ đơn hàng khách muốn đổi có sản phẩm hỏng vs bình thường--//
		Route::get('cap-nhat-don-hang-moi','adminController@tienHanhTachDon');
		});
			//-- Thông tin nhân viên--//
		Route::get('quan-ly-giao-hang/{id}','adminController@viewGiaohang');
		Route::get('thong-tin-nhan-vien/{id}','adminController@nhanvienInfo');
		//Route::get('lich-su-giao-hang','adminController@viewLSgiaohang');
	});




