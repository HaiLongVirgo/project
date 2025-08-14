<?php

// dữ liệu của danh mục
class AdminDanhMuc{
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAllDanhMuc(){ // tạo hàm lấy tất cả danh mục
        try{
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }
    public function insertDanhMuc($ten_danh_muc, $mo_ta){ // tạo hàm thêm danh mục
        try{
            $sql = 'INSERT INTO danh_mucs (ten_danh_muc, mo_ta) VALUES (:ten_danh_muc, :mo_ta)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
               ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta,
            ]);
            return true;
        } catch(Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }
    public function getDatailDanhMuc($id){ // hàm chi tiết danh mục
        try{
            $sql = 'SELECT * FROM danh_mucs WHERE  id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
               ':id' => $id
            ]);
            return $stmt->fetch();
        } catch(Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }
        public function updateDanhMuc($id, $ten_danh_muc, $mo_ta){  // hàm cập nhật danh mục
        try{
            $sql = 'UPDATE danh_mucs SET `ten_danh_muc` = :ten_danh_muc, `mo_ta` = :mo_ta WHERE `id` = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta,
                ':id' => $id,
            ]);
            return true;
        } catch(Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }
    public function destroyDanhMuc($id){ // hàm xóa danh mục
        try{
            $sql = 'DELETE FROM danh_mucs WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch(Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }
}
?>