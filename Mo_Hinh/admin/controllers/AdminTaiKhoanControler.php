<?php

// quản lý tài khoản
class AdminTaiKhoanControler
{
    public $modelTaiKhoan;
    public $modelDonhang;
    public $modelSanPham;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonhang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);

        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuantri.php';

        deleteSessionError();
    }

    public function postAddQuanTri()
    {
        //Hàm này dùng để xử lí thêm dữ liệu
        //    kiểm tra xem dữ liệu có phải submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';

            // tạo một mảng trống để chưa dữ liệu
            $error = [];
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Tên không được để trống';
            }
            if (empty($email)) {
                $error['email'] = 'Email không được để trống';
            }

            $_SESSION['error'] = $error;
            // nếu ko có lỗi thì tiến hành thêm them tài khoản
            if (empty($error)) {
                //  nếu không có lỗi thì tiến hành thêm them tài khoản

                $password = password_hash('123456', PASSWORD_BCRYPT); // Mật khẩu mặc định
                $ngay_sinh = date('Y-m-d');
                $so_dien_thoai = '';
                $dia_chi = '';
                // khai báo chức vụ id
                $chuc_vu_id = 1;

                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id, $ngay_sinh, $so_dien_thoai, $dia_chi);
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // Trả về form và lỗi
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }

    public function formEditQuanTri()
    {
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        require_once './views/taikhoan/quantri/editquantri.php';

        deleteSessionError();
    }
    public function postEditQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';


            // tạo một mảng trống để chưa dữ liệu
            $error = [];
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $error['email'] = 'Email không được để trống';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'Vui lòng chọn trạng thái';
            }

            $_SESSION['error'] = $error;


            // nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($error)) {
                // nếu không có lỗi thì tiến hành thêm sản phẩm
                $this->modelTaiKhoan->updateTaiKhoan(
                    $quan_tri_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $trang_thai
                );
                // xử lí thêm album ánh sản phẩm img_array

                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                // Trả về form và lỗi
                // đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
    public function resetpassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        $password = password_hash('123456', PASSWORD_BCRYPT);
        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
        if ($status && $tai_khoan['chuc_vu_id'] == 1) {
            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        } elseif ($status && $tai_khoan['chuc_vu_id'] == 2) {
            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        } else {
            var_dump('Lỗi khi reset tài khoản');
        }
    }
    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);

        require_once './views/taikhoan/khachhang/listkhachhang.php';
    }
    public function formEditKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        require_once './views/taikhoan/khachhang/editkhachhang.php';

        deleteSessionError();
    }
    public function postEditKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';


            // tạo một mảng trống để chưa dữ liệu
            $error = [];
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $error['email'] = 'Email không được để trống';
            }
            if (empty($ngay_sinh)) {
                $error['ngay_sinh'] = 'Vui lòng chọn ngày sinh';
            }
            if (empty($gioi_tinh)) {
                $error['gioi_tinh'] = 'Vui lòng chọn giới tính';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'Vui lòng chọn trạng thái';
            }

            $_SESSION['error'] = $error;


            // nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($error)) {
                // nếu không có lỗi thì tiến hành thêm sản phẩm
                $this->modelTaiKhoan->updatekhachHang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai
                );
                // xử lí thêm album ánh sản phẩm img_array

                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                // Trả về form và lỗi
                // đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function deltailKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        $listDonHang = $this->modelDonhang->getDonHangFormKhachHang($id_khach_hang);
        $listbinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);
        require_once './views/taikhoan/khachhang/detailkhachhang.php';
    }
    public function formLogin()
    {
        require_once './views/auth/formlogin.php';
        deleteSessionError();
    }
    

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Lấy email password gửi lên từ form
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            //Xử lý thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email,$password);
            var_dump($user);
            die();
            if($user == $email){ //Trường hợp đăng nhập thành công
                
                //Lưu thông tin vào session
                $_SESSION['user_admin'] = $user;
                header('Location:' . BASE_URL_ADMIN );
                exit();
            } else{
                //Lỗi thì lưu vào session
                $_SESSION['error'] = $user;

                $_SESSION['flash'] = true;
                header('Location:' . BASE_URL_ADMIN . '?act=login-admin');
            }
        }
    }
    public function logout()
    {
        if(isset($_SESSION['user_admin'])){
            unset($_SESSION['user_admin']);
            header('Location:' . BASE_URL_ADMIN . '?act=login-admin');
            exit();
        }
    }
    public function formEditCaNhanQuanTri()
    {
        $email = $_SESSION['user_admin'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanformEmail($email);
        require_once './views/taikhoan/caNhan/editCaNhan.php';
        deleteSessionError();
    }

    public function postEditMatKhauCaNhan()
    {
        // var_dump($_POST);die;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];



            // Lấy thông tin user từ session
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_admin']);
            $checkPass = password_verify($old_pass, $user['mat_khau']);
            if (!$checkPass) {
                $error['old_pass'] = 'Mật khẩu người dùng không đúng';
            }
            if ($new_pass !== $confirm_pass) {
                $error['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
            }
            if (empty($old_pass)) {
                $error['old_pass'] = 'Vui lòng điền trường dữ liệu này';
            }
            if (empty($new_pass)) {
                $error['new_pass'] = 'Vui lòng điền trường dữ liệu này';
            }
            if (empty($confirm_pass)) {
                $error['confirm_pass'] = 'Vui lòng điền trường dữ liệu này';
            }

            $_SESSION['error'] = $error;

            if (!$error) {
                // Thực hiện đổi mật khẩu
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
                if ($status) {
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                    $_SESSION['flash'] = true;
                    header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                    exit();
                }
            } else {
                // nếu lỗi thì lưu lỗi vào session 

                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                exit();
            }
        }
    }
}
?>