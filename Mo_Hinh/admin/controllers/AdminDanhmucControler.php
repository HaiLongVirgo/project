<?php
// Trang Danh Mục
class AdminDanhmucControler
{
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc()   // danh sách danh mục
    {

        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/ListDanhMuc.php';
    }
    public function formAddDanhMuc() // thêm danh mục
    {
        //Hàm này dùng để hiển thị form nhập
        require_once './views/danhmuc/addDanhMuc.php';
        deleteSessionError();
    }
    public function postAddDanhMuc() // đẩy danh mục lên
    {
        //Hàm này dùng để xử lí thêm dữ liệu
        //    kiểm tra xem dữ liệu có phải submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // tạo một mảng trống để chưa dữ liệu
            $error = [];
            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            $_SESSION['error'] = $error;
            // nếu ko có lỗi thì tiến hành thêm danh mục
            if (empty($error)) {
                // nếu không có lỗi thì tiến hành thêm danh mục
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                // Trả về form và lỗi
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-them-danh-muc');
                exit();
            }
        }
    }
    public function formEditDanhMuc()  // chỉnh sửa danh mục
    {
        //Hàm này dùng để hiển thị form nhập
        // lấy ra thông tin của danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDatailDanhMuc($id);
        if ($danhMuc) {
            require_once './views/danhmuc/editDanhMuc.php';
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
    public function postEditDanhMuc() // dẩy danh mục lên
    {
        //Hàm này dùng để xử lí thêm dữ liệu
        //    kiểm tra xem dữ liệu có phải submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tạo một mảng trống để chưa dữ liệu
            $error = [];
            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }

            // nếu ko có lỗi thì tiến hành sửa danh mục
            if (empty($error)) {
                // nếu không có lỗi thì tiến hành sửa danh mục
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                // Trả về form và lỗi
                $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }
    public function deleteDanhMuc()
    {
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDatailDanhMuc($id);
        if ($danhMuc) {
            // code xóa
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
    }
}
?>