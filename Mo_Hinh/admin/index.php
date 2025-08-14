<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhmucControler.php';
require_once './controllers/AdminSanPhamControler.php';
require_once './controllers/AdminDonHangControler.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanControler.php';

// Require toàn bộ file Models
require_once  './models/AdminDanhMuc.php';
require_once  './models/AdminSanPham.php';
require_once  './models/AdminDonHang.php';
require_once  './models/AdminTaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';

// if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin') {
//     checkLoginAdmin();
// }

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongKeController())->home(),
    // Trang chủ
    'danh-muc' => (new AdminDanhmucControler())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhmucControler())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhmucControler())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhmucControler())->formEditDanhMuc(),
    'sua-danh-muc' => (new AdminDanhmucControler())->postEditDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhmucControler())->deleteDanhMuc(),

    // route sản phẩm
    'san-pham' => (new AdminSanPhamControler())->danhSachSanPham(),
    'form-them-san-pham' => (new AdminSanPhamControler())->formAddSanPham(),
    'them-san-pham' => (new AdminSanPhamControler())->postAddSanPham(),
    'form-sua-san-pham' => (new AdminSanPhamControler())->formEditSanPham(),
    'sua-san-pham' => (new AdminSanPhamControler())->postEditSanPham(),
    'sua-album-san-pham' => (new AdminSanPhamControler())->postEditAnhSanPham(),
    'xoa-san-pham' => (new AdminSanPhamControler())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamControler())->detailSanPham(),
    // route bình luânh
    'update-trang-thai-binh-luan' => (new AdminSanPhamControler())->updateTrangThaiBinhLuan(),

    // route quản lí đơn hàng
    'don-hang' => (new AdminDonHangControler())->danhSachDonHang(),
    'form-sua-don-hang' => (new AdminDonHangControler())->formEditDonHang(),
    'sua-don-hang' => (new AdminDonHangControler())->postEditDonHang(),
    'chi-tiet-don-hang' => (new AdminDonHangControler())->detailDonHang(),
    // route quản lý tài khoản
    // route quản lí tài khoản quản trị
    'list-tai-khoan-quan-tri' => (new AdminTaiKhoanControler())->danhSachQuanTri(),
    'form-them-quan-tri' => (new AdminTaiKhoanControler())->formAddQuanTri(),
    'them-quan-tri' => (new AdminTaiKhoanControler())->postAddQuanTri(),
    'form-sua-quan-tri' => (new AdminTaiKhoanControler())->formEditQuanTri(),
    'sua-quan-tri' => (new AdminTaiKhoanControler())->postEditQuanTri(),
    // route reset password tài khoản
    'reset-password' => (new AdminTaiKhoanControler())->resetpassword(),
    // quản lý tài khoản khách hàng
    'list-tai-khoan-khach-hang' => (new AdminTaiKhoanControler())->danhSachKhachHang(),
    'form-sua-khach-hang' => (new AdminTaiKhoanControler())->formEditKhachHang(),
    'sua-khach-hang' => (new AdminTaiKhoanControler())->postEditKhachHang(),
    'chi-tiet-khach-hang' => (new AdminTaiKhoanControler())->deltailKhachHang(),
    // route quản lí tài khoản cá nhân(quản trị)
    'form-sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanControler())->formEditCaNhanQuanTri(),
    'sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanControler())->postEditQuanTri(),
    'sua-mat-khau-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanControler())->postEditMatKhauCaNhan(),
    // route auth
    'login-admin' => (new AdminTaiKhoanControler())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanControler())->login(),
    // 'logout-admin' => (new AdminTaiKhoanControler())->logout(),
};
