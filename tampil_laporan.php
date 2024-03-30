<?php
session_start();

include "koneksi.php";


if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Penerima Bantuan</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<section class="konten">
<div class="container">
<div class="row">
    <div class="col-md-12">
    <div class="table-responsive">
        <form method="post" action="cetaklaporan1.php">
            <p><button class="btn btn-success btn-lg" id="export_pdf" name="export_pdf">Export to PDF</button></p>
        <table class="table table-striped table-bordered table-hover" style="max-width: auto;">
            <thead>
                <tr>
                    <th style="width:auto;">No</th>
                    <th style="width:auto;">NIK</th>
                    <th style="width:auto;">Nama</th>
                    <th style="width:auto;">Alamat KK/KTP</th>
                    <th style="width:auto;">Alamat Domisili</th>
                    <th style="width:15%;">Jenis Bantuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nomor=1;
                    if(isset($_POST['filter_tgl'])){
                        $tglmulai = $_POST['tglmulai'];
                        $tglakhir = $_POST['tglakhir'];
                        ?> 
                        <input type="hidden" value="<?php echo $tglmulai;?>" name="tglmulai" id="tglmulai"><input type="hidden" value="<?php echo $tglakhir;?>" name="tglakhir" id="tglakhir"> 
                        <?php
                        if(empty($tglmulai) || empty($tglakhir)){
                        //jika data tanggal kosong
                        ?>
                        <script language="JavaScript">
                            alert('Tanggal Awal dan Tanggal Akhir Harap di Isi!');
                        </script>
                        <?php
                        }else{
                        $ambil=$koneksi->query("SELECT pnb.id_penerimabantuan,pd.nik,pd.nama_penduduk,pd.alamat_ktp,pd.alamat_domisili,jnb.nama_jenisbantuan,pnb.keterangan FROM tb_penduduk pd JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan WHERE pnb.lastupdated BETWEEN '$tglmulai' AND '$tglakhir' ORDER BY pnb.lastupdated DESC");
                    while($pecah=$ambil->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $pecah['nik'];?></td>
                        <td><?php echo $pecah['nama_penduduk'];?></td>
                        <td><?php echo $pecah['alamat_ktp'];?></td>
                        <td><?php echo $pecah['alamat_domisili'];?></td>
                        <td><?php echo $pecah['nama_jenisbantuan'];?></td>
                    </tr>
                <?php 
                    $nomor++;}}
                }elseif(isset($_POST['filter_keyword'])){
                    $kunci = $_POST['carilaporan'];
                    ?> <input type="hidden" value="<?php echo $kunci;?>" name="kunci" id="kunci"> <?php
                    $ambil=$koneksi->query("SELECT pnb.id_penerimabantuan,pd.nik,pd.nama_penduduk,pd.alamat_ktp,pd.alamat_domisili,jnb.nama_jenisbantuan,pnb.keterangan FROM tb_penduduk pd JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan WHERE pd.nik like '%$kunci%' OR pd.nama_penduduk like '%$kunci%' OR pd.alamat_ktp like '%$kunci%' OR pd.alamat_domisili like '%$kunci%' OR jnb.nama_jenisbantuan like '%$kunci%' ORDER BY pnb.lastupdated DESC");
                    while($pecah=$ambil->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $pecah['nik'];?></td>
                        <td><?php echo $pecah['nama_penduduk'];?></td>
                        <td><?php echo $pecah['alamat_ktp'];?></td>
                        <td><?php echo $pecah['alamat_domisili'];?></td>
                        <td><?php echo $pecah['nama_jenisbantuan'];?></td>
                    </tr>
                <?php 
                    $nomor++;}}
                ?>
            </tbody>
        </table>
        </form>
    </div>
</div>
</div>
</div>
</section>
</body>
</html>