<?php
$ambil=$koneksi->query("SELECT COUNT(*) AS jumlah_penerima FROM tb_penerimabantuan");
   $data = $ambil->fetch_assoc();
?>
<div class="col-md-4 col-sm-4">
    <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-blue set-icon">
            <i class="fa fa-group"></i>
        </span>
        <div class="text-box">
            <div class="main-text">
                <?php echo $data['jumlah_penerima']; ?>
                <br>PENDUDUK
            </div>                            
            <hr>
            <p style="padding:0;color:#777;text-align: center;">Total Penerima Bantuan</p> 
        </div>
     </div>
</div>

<?php
$ambil2=$koneksi->query("SELECT COUNT(*) AS jumlah_bantuan FROM tb_jenisbantuan");
   $data2 = $ambil2->fetch_assoc();
?>
<div class="col-md-4 col-sm-4">
    <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-green set-icon">
            <i class="fa fa-table"></i>
        </span>
        <div class="text-box">
            <div class="main-text">
                <?php echo $data2['jumlah_bantuan']; ?>
                <br>BANTUAN
            </div>                            
            <hr>
            <p style="padding:0;color:#777;text-align: center;">Total Bantuan Tersedia</p> 
        </div>
     </div>
</div>

<?php
    $ambil3=$koneksi->query("SELECT COUNT(*) as pengguna FROM tb_user");
       $data3 = $ambil3->fetch_assoc();
?>
<div class="col-md-4 col-sm-4">
    <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-red set-icon">
            <i class="fa fa-user"></i>
        </span>
        <div class="text-box">
            <div class="main-text">
                <?php echo $data3['pengguna']; ?>
                <br>PENGGUNA
            </div>                            
            <hr>
            <p style="padding:0;color:#777;text-align: center;">Total pengguna sistem</p> 
        </div>
     </div>
</div>
<hr>

<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>

    <script>
        $(document).ready(function () {
            document.getElementById("btn_home").classList.add('active-menu');
        });
    </script>