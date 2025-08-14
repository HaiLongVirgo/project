<!-- header -->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Quản lí danh sách đơn hàng: <?=$donHang['ma_don_hang']?></h1>
                </div>
                <div class="col-sm-2">
                    <form action="" method="post">
                        <select name="" id="" class="form-group">
                            <?php foreach($listTrangThaiDonHang as $key=>$trangThai) { ?> 
                            <option 
                            <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : ''?>
                            <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : ''?>
                             value="<?=$trangThai['id']?>"><?=$trangThai['ten_trang_thai']?></option>
                            <?php } ?>
                        </select>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php 
                      if($donHang['trang_thai_id'] == 1){
                        $colorAlerts = 'primary';
                      }elseif($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9){
                        $colorAlerts = 'warning';
                      }else{
                        $colorAlerts = 'danger';
                      }
                     ?>
                    <div class="alert alert-<?=$colorAlerts?>" role="alert">
                        Đơn hàng: <?=$donHang['ten_trang_thai']?>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Shop Mô Hình LongnhPH60038
                                    <small class="float-right">Ngày đặt: <?=formatDate($donHang['ngay_dat'])?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Thông tin người đặt: 
                                <address>
                                    <strong><?=$donHang['ho_ten']?></strong><br>
                                    Email: <?=$donHang['email']?><br>
                                    Số điện thoại: <?=$donHang['so_dien_thoai']?><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Người Nhận
                                <address>
                                    <strong><?=$donHang['ten_nguoi_nhan']?></strong><br>
                                    Email: <?=$donHang['email_nguoi_nhan']?><br>
                                    Số điện thoại: <?=$donHang['sdt_nguoi_nhan']?><br>
                                    Địa chỉ: <?=$donHang['dia_chi_nguoi_nhan']?><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Mã đơn hàng: <?=$donHang['ma_don_hang']?></b><br>
                                <br>
                                <b>Tổng tiền: </b> <?=$donHang['tong_tien']?><br>
                                <b>Ghi chú: </b> <?=$donHang['ghi_chu']?><br>
                                <b>Thanh toán: </b> <?=$donHang['ten_phuong_thuc']?>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <!-- /.col -->
                             
                            <div class="col-6">
                                <p class="lead">Ngày đặt hàng: <?=$donHang['ngay_dat']?></p>

                                <div class="table-responsive">
                                    <table class="table">
                                        
                                        <tr>
                                            <th style="width:50%">Thành tiền:</th>
                                            <td><?=$donHang['tong_tien']?></td>
                                        </tr>
                                        <tr>
                                            <th>Vận chuyển:</th>
                                            <td>20.000</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td><?=$donHang['tong_tien'] + 20000?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-5" style="margin-left: 100px;">
                    <a href="<?= BASE_URL_ADMIN .'?act=don-hang'?>" class="btn btn-secondary">Quay lại</a>
                </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- endfooter -->


<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- Code injected by live-server -->
</body>

</html>