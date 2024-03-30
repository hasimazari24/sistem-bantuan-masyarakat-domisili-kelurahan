<?php
session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$lastupdated = date("Y-m-d H:i:s");

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $ambil = $koneksi->query("SELECT * FROM tb_user WHERE username='$_POST[username]'");
    $data = $ambil->fetch_assoc();
    $ygcocok = $ambil->num_rows;
    if ($ygcocok >= 1 && password_verify($_POST["password"], $data["password"])) {
        $_SESSION["user"] = $data;
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p>
                <h1>LOGIN BERHASIL</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="index.php" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
        //$ubahstatus=$koneksi->query("UPDATE tb_user SET session=session+1 WHERE id_user='$id_user'");
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p>
                <h1>LOGIN GAGAL</h1>
                <i>Periksa kembali username dan password dengan benar!</i></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahpenduduk') {
    $ceknik = $koneksi->query("SELECT * FROM tb_penduduk where nik='$_POST[nik]'");
    $nikcek = $ceknik->num_rows;
    if ($nikcek > 0) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p>
                <h1>GAGAL SIMPAN DATA</h1></p>
                <i>NOTE : NIK sudah ada di Data Penduduk</i>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    } else {
        $ambil = $koneksi->query("INSERT INTO tb_penduduk (nik,nokk,nama_penduduk,alamat_ktp, alamat_domisili,telp,lastupdated) VALUES ('$_POST[nik]','$_POST[nokk]','$_POST[nama]','$_POST[alamatktp]','$_POST[alamatdomisili]','$_POST[telp]','$lastupdated')");
        if ($ambil) {
            echo '
            <div class="modal-body">
                <center>
                    <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                    <p><h1>BERHASIL DISIMPAN</h1></p>
                </center>
            </div>
            <div class="modal-footer">
                <center><a href="?page=datapenduduk" type="button" class="btn btn-primary btn-lg">OK</a>
            </div>';
        } else {
            echo '
            <div class="modal-body">
                <center>
                    <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                    <p>
                    <h1>GAGAL SIMPAN DATA</h1></p>
                </center>
            </div>
            <div class="modal-footer">
                <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
            </div>';
        }
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_penduduk') {
    error_reporting(0);
    $id_penduduk = $_POST['data_id'];
    $ambil = $koneksi->query("SELECT * FROM tb_penduduk WHERE id_penduduk='$id_penduduk'");
    $data = $ambil->fetch_assoc();
?>
    <tr>
        <td><input type="hidden" class="form-control" name="id_pen" id="id_pen" type="text" value="<?php echo $data['id_penduduk']; ?>"></td>
    </tr>
    <tr>
        <td><label>NIK</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="nik_edit" id="nik_edit" type="text" value="<?php echo $data['nik']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>No. KK</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="nokk_edit" id="nokk_edit" type="text" value="<?php echo $data['nokk']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Nama Lengkap</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="nama_edit" id="nama_edit" type="text" value="<?php echo $data['nama_penduduk']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Alamat KK/KTP</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <textarea class="form-control" name="alamatktp_edit" id="alamatktp_edit" rows="2" style="resize: none;"><?php echo $data['alamat_ktp']; ?></textarea>
        </td>
    </tr>
    <tr>
        <td><label>Alamat Domisili</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <textarea class="form-control" name="alamatdomisili_edit" id="alamatdomisili_edit" rows="2" style="resize: none;"><?php echo $data['alamat_domisili']; ?></textarea>
        </td>
    </tr>
    <tr>
        <td><label>No. Telp</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="telp_edit" id="telp_edit" type="text" value="<?php echo $data['telp']; ?>">
        </td>
    </tr> -->
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_penduduk') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $ubah = $koneksi->query("UPDATE tb_penduduk SET nik='$_POST[nik_edit]',nokk='$_POST[nokk_edit]',nama_penduduk='$_POST[nama_edit]',alamat_ktp='$_POST[alamatktp_edit]', alamat_domisili='$_POST[alamatdomisili_edit]',telp='$_POST[telp_edit]',lastupdated='$lastupdated' WHERE id_penduduk='$_POST[idpenduduk]'");
    //$ubah=$koneksi->query("UPDATE tb_penduduk SET nik='$noktp',nokk='$nokk',nama_penduduk='$namapen',alamat_ktp='$akk',alamat_domisili='$adom',telp='$telp' WHERE id_penduduk='".$id_penduduk."'");

    if ($ubah) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIUBAH</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=datapenduduk" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL UBAH DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_view_penduduk') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penduduk = $_POST['data_id'];
    $ambil = $koneksi->query("SELECT * FROM tb_penduduk WHERE id_penduduk='$id_penduduk'");
    $data = $ambil->fetch_assoc();
?>
    <table border="0" width="100%">
        <thead style="visible:false;">
            <tr>
                <th style="width:auto;"></th>
                <th style="width:25px;"></th>
                <th style="width:70%;"></th>
            </tr>
        </thead>
        <tbody class>
            <tr>
                <td><input type="hidden" class="form-control" name="id_pen_hps" id="id_pen_hps" type="text" value="<?php echo $data['id_penduduk']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Penduduk</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['nama_penduduk'] ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['nik'] ?></td>
            </tr>
            <tr>
                <td>Alamat KTP/KK</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['alamat_ktp'] ?></td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;padding-top: 5px;">Domisili</td>
                <td>:</td>
                <td><?php echo $data['alamat_domisili'] ?></td>
            </tr>
        </tbody>
    </table>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_penduduk') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penduduk = $_POST['data_id'];
    $hapus = $koneksi->query("DELETE FROM tb_penduduk WHERE id_penduduk='$id_penduduk'");
    $cek = $koneksi->query("SELECT * FROM tb_penerimabantuan WHERE id_penduduk='$id_penduduk'");
    $hasilcek = $cek->num_rows;
    if ($hapus) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIHAPUS</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="index.php?page=datapenduduk" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL HAPUS DATA</h1></p>';
        if ($hasilcek > 0) {
            echo '<i>NOTE : Data Penduduk tersebut sudah ada di data penerima bantuan. Silahkan hapus terlebih dahulu di Data Penerima Bantuan</i>';
        }
        echo '
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahpenerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $simpan = $koneksi->query("INSERT INTO tb_penerimabantuan (id_penduduk,id_jenisbantuan,keterangan,lastupdated) VALUES ('$_POST[id_penduduk_penerima]','$_POST[id_jenisbantuan]','$_POST[keterangan]','$lastupdated' )");
    $restok_jenis = $koneksi->query("UPDATE tb_jenisbantuan SET jumlah_bantuan=jumlah_bantuan-1 WHERE id_jenisbantuan = '$_POST[id_jenisbantuan]'");
    if ($simpan) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DISIMPAN</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=datapenerimabantuan" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL SIMPAN DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penerimabantuan = $_POST['id_penerimabantuan'];
    $ambil = $koneksi->query("SELECT pnb.id_penerimabantuan,pdk.id_penduduk,pdk.nik,pdk.nama_penduduk,pdk.alamat_ktp,pdk.alamat_domisili,jnb.id_jenisbantuan,pnb.keterangan FROM tb_penerimabantuan pnb JOIN tb_penduduk pdk ON pnb.id_penduduk = pdk.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan=jnb.id_jenisbantuan WHERE pnb.id_penerimabantuan ='$id_penerimabantuan'");
    $data = $ambil->fetch_assoc();
?>
    <tr>
        <td colspan="3">
            <div class="form-group input-group" style="margin-bottom: 10px;">
                <input type="text" class="form-control" id="carinik" name="carinik" placeholder="cari dan pilih data penduduk">
                <span class="input-group-btn">
                    <button class="btn btn-default btn_caripenduduk_edit" type="button" data-toggle="modal" data-target="#modalCari"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </td>
    </tr>
    <tr style="display:none;">
        <td><label>ID</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="id_penerimaedit" name="id_penerimaedit" type="text" disabled value="<?php echo $data['id_penerimabantuan']; ?>">
        </td>
    </tr>
    <tr style="display:none;">
        <td><label>ID_penduduk</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="id_penduduk_penerimaedit" name="id_penduduk_penerimaedit" type="text" disabled value="<?php echo $data['id_penduduk']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>NIK</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="nik_penerimaedit" name="nik_penerimaedit" type="text" value="<?php echo $data['nik']; ?>" disabled>
        </td>
    </tr>
    <tr>
        <td><label>Nama Lengkap</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="nama_penerimaedit" name="nama_penerimaedit" type="text" value="<?php echo $data['nama_penduduk']; ?>" disabled>
        </td>
    </tr>
    <tr>
        <td><label>Alamat KK/KTP</label></td>
        <td align="center">:</td>
        <td style="padding-bottom:10px;padding-top: 10px;">
            <textarea class="form-control" name="alamatktp_penerimaedit" id="alamatktp_penerimaedit" rows="2" style="resize: none;" disabled><?php echo $data['alamat_ktp']; ?></textarea>
        </td>
    </tr>
    <tr>
        <td><label>Alamat Domisili</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <textarea class="form-control" name="alamatdomisili_penerimaedit" id="alamatdomisili_penerimaedit" rows="2" style="resize: none;" disabled><?php echo $data['alamat_domisili']; ?></textarea>
        </td>
    </tr>
    <tr>
        <td><label>Jenis Bantuan</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <select class="form-control" name="id_jenisbantuanedit" id="id_jenisbantuanedit">
                <option disabled>--Pilih jenis bantuan--</option>
                <?php
                $ambil = $koneksi->query("SELECT * FROM tb_jenisbantuan where jumlah_bantuan > 0");
                while ($pecah = $ambil->fetch_assoc()) { ?>
                    <option value="<?php echo $pecah["id_jenisbantuan"]; ?>" <?php if ($pecah["id_jenisbantuan"] == $data["id_jenisbantuan"]) {
                                                                                    echo 'selected="selected"';
                                                                                }
                                                                                ?>>
                        <?php echo $pecah['nama_jenisbantuan']; ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><label>Keterangan</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="keterangan_edit" name="keterangan_edit" value="<?php echo $data['keterangan']; ?>" type="text">
        </td>
    </tr>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $idpenduduk = $_POST['id_penduduk'];
    $idpenerima = $_POST['id_penerimabantuan'];
    $idjenis = $_POST['id_jenisbantuan'];
    $keterangan = $_POST['keterangan'];

    $cekjenis = $koneksi->query("SELECT id_jenisbantuan FROM tb_penerimabantuan WHERE id_penerimabantuan='$idpenerima'");
    $jenis = $cekjenis->fetch_assoc();
    $idj = $jenis['id_jenisbantuan'];
    if ($idjenis != $idj) {
        $restok_jenis = $koneksi->query("UPDATE tb_jenisbantuan SET jumlah_bantuan=jumlah_bantuan-1 WHERE id_jenisbantuan = '$idjenis'");
        $restok_jenis2 = $koneksi->query("UPDATE tb_jenisbantuan SET jumlah_bantuan=jumlah_bantuan+1 WHERE id_jenisbantuan = '$idj'");
    }
    $ubah = $koneksi->query("UPDATE tb_penerimabantuan SET id_penduduk='$idpenduduk',id_jenisbantuan='$idjenis',keterangan='$keterangan',lastupdated='$lastupdated' WHERE id_penerimabantuan='$idpenerima'");


    if ($ubah) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIUBAH</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=datapenerimabantuan" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL UBAH DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_view_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penerimabantuan = $_POST['data_id'];
    $ambil = $koneksi->query("SELECT pnb.id_penerimabantuan,pdk.nama_penduduk,pdk.nik,jnb.nama_jenisbantuan FROM tb_penerimabantuan pnb JOIN tb_penduduk pdk ON pnb.id_penduduk=pdk.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan WHERE pnb.id_penerimabantuan='$id_penerimabantuan'");
    $data = $ambil->fetch_assoc();
?>
    <table border="0" width="100%">
        <thead style="visible:false;">
            <tr>
                <th style="width:auto;"></th>
                <th style="width:25px;"></th>
                <th style="width:70%;"></th>
            </tr>
        </thead>
        <tbody class>
            <tr>
                <td><input type="hidden" class="form-control" name="id_penerima_hps" id="id_penerima_hps" type="text" value="<?php echo $data['id_penerimabantuan']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Penduduk</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['nama_penduduk'] ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['nik'] ?></td>
            </tr>
            <tr>
                <td>Jenis Bantuan</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['nama_jenisbantuan'] ?></td>
            </tr>
        </tbody>
    </table>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penerimabantuan = $_POST['data_id'];
    $hapus = $koneksi->query("DELETE FROM tb_penerimabantuan WHERE id_penerimabantuan='$id_penerimabantuan'");
    if ($hapus) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIHAPUS</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="index.php?page=datapenerimabantuan" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL HAPUS DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahbantuan') {
    $simpan = $koneksi->query("INSERT INTO tb_jenisbantuan (nama_jenisbantuan,jumlah_bantuan,satuan,keterangan,lastupdated) VALUES ('$_POST[nama_bantuan]','$_POST[jml_bantuan]','$_POST[satuan]','$_POST[ket_bantuan]','$lastupdated' )");
    if ($simpan) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DISIMPAN</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p>
                <h1>GAGAL SIMPAN DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_jenis') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    // $id_penerimabantuan = $_POST[id_penerimabantuan];
    $ambil = $koneksi->query("SELECT * FROM tb_jenisbantuan WHERE id_jenisbantuan ='$_POST[id_jenis]'");
    $data = $ambil->fetch_assoc();
?>

    <tr style="display:none;">
        <td><label>ID</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="id_jenisedit" name="id_jenisedit" type="text" disabled value="<?php echo $data['id_jenisbantuan']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Nama Bantuan</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="nama_bantuanedit" id="nama_bantuanedit" type="text" value="<?php echo $data['nama_jenisbantuan']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Jumlah Bantuan</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="jml_bantuanedit" id="jml_bantuanedit" type="number" value="<?php echo $data['jumlah_bantuan']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Satuan</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="satuanedit" id="satuanedit" type="text" value="<?php echo $data['satuan']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Keterangan</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <textarea class="form-control" name="ket_bantuanedit" id="ket_bantuanedit" rows="2" style="resize: none;"><?php echo $data['keterangan']; ?></textarea>
        </td>
    </tr>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_jenis') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $ubah = $koneksi->query("UPDATE tb_jenisbantuan SET nama_jenisbantuan='$_POST[nama_jenis]',jumlah_bantuan='$_POST[jmlh_jenis]',satuan='$_POST[satuan_jenis]',keterangan='$_POST[keterangan]',lastupdated='$lastupdated' WHERE id_jenisbantuan='$_POST[id_jenis]'");

    if ($ubah) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIUBAH</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL UBAH DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_view_jenis') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_jenisbantuan = $_POST['id_jenisb'];
    $ambil = $koneksi->query("SELECT * FROM tb_jenisbantuan WHERE id_jenisbantuan='$id_jenisbantuan'");
    $data = $ambil->fetch_assoc();
?>
    <table border="0" width="100%">
        <thead style="visible:false;">
            <tr>
                <th style="width:auto;"></th>
                <th style="width:25px;"></th>
                <th style="width:70%;"></th>
            </tr>
        </thead>
        <tbody class>
            <tr>
                <td><input type="hidden" class="form-control" name="id_jenis_hps" id="id_jenis_hps" type="text" value="<?php echo $data['id_jenisbantuan']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Jenis Bantuan</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['nama_jenisbantuan'] ?></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['jumlah_bantuan'] ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td style="padding-bottom: 5px;padding-top: 5px;"><?php echo $data['keterangan'] ?></td>
            </tr>
        </tbody>
    </table>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_jenis_ok') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_jenisbantuan = $_POST['data_id'];
    $hapus = $koneksi->query("DELETE FROM tb_jenisbantuan WHERE id_jenisbantuan='$id_jenisbantuan'");
    $cek = $koneksi->query("SELECT * FROM tb_jenisbantuan WHERE id_jenisbantuan='$id_jenisbantuan'");
    $hasilcek = $cek->num_rows;
    if ($hapus) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIHAPUS</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="index.php?page=dataadmin" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL HAPUS DATA</h1></p>';
        if ($hasilcek > 0) {
            echo '<i>NOTE : Data jenis bantuan telah digunakan di Data Penerima Bantuan. Silahkan hapus terlebih dahulu di Data Penerima Bantuan</i>';
        }
        echo '
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahuser') {
    $hashed_pass = password_hash($_POST['pass_user'], PASSWORD_DEFAULT);
    $simpanuser = $koneksi->query("INSERT INTO tb_user (nama_user,username,password,id_role,lastupdated) VALUES ('$_POST[nama_user]','$_POST[username_user]','$hashed_pass','$_POST[id_role]','$lastupdated' )");
    if ($simpanuser) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DISIMPAN</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p>
                <h1>GAGAL SIMPAN DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_user') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_user = $_POST['id_user'];
    $ambil = $koneksi->query("SELECT * FROM tb_user WHERE id_user ='$id_user'");
    $data = $ambil->fetch_assoc();
?>
    <tr style="display:none;">
        <td><label>ID</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" id="id_useredit" name="id_useredit" type="text" disabled value="<?php echo $data['id_user']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Nama Lengkap</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="nama_useredit" id="nama_useredit" type="text" required value="<?php echo $data['nama_user']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Username</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="username_useredit" id="username_useredi" type="text" required value="<?php echo $data['username']; ?>">
        </td>
    </tr>
    <tr>
        <td><label>Password</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <input class="form-control" name="pass_useredit" id="pass_useredit" type="text" placeholder="Masukkan password baru">
        </td>
    </tr>
    <tr>
        <td><label>Hak Akses</label></td>
        <td align="center">:</td>
        <td style="padding-bottom: 10px;padding-top: 10px;">
            <select class="form-control" name="hakakses_edit" id="hakakses_edit">
                <option disabled>--Pilih Hak Akses--</option>
                <?php
                $ambil = $koneksi->query("SELECT * FROM tb_role ORDER BY nama_role ASC");
                while ($pecah = $ambil->fetch_assoc()) { ?>
                    <option value="<?php echo $pecah["id_role"]; ?>" required <?php if ($pecah["id_role"] == $data["id_role"]) {
                                                                                    echo 'selected="selected"';
                                                                                }
                                                                                ?>>
                        <?php echo $pecah['nama_role']; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_user') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    if (!empty($_POST['pass_user'])) {
        $hashed_pass = password_hash($_POST['pass_user'], PASSWORD_DEFAULT);
        $ubah = $koneksi->query("UPDATE tb_user SET nama_user='$_POST[nama_user]',username='$_POST[username_user]',password='$hashed_pass',id_role='$_POST[hakakses]',lastupdated='$lastupdated' WHERE id_user='$_POST[id_user]'");
    } else {
        $ubah = $koneksi->query("UPDATE tb_user SET nama_user='$_POST[nama_user]',username='$_POST[username_user]',id_role='$_POST[hakakses]',lastupdated='$lastupdated' WHERE id_user='$_POST[id_user]'");
    }

    if ($ubah) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIUBAH</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL UBAH DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_user_ok') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $hapus = $koneksi->query("DELETE FROM tb_user WHERE id_user='$_POST[idusr]'");
    if ($hapus) {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-check-circle fa-5x" style="color: green;"></i>
                <p><h1>BERHASIL DIHAPUS</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><a href="index.php?page=dataadmin" type="button" class="btn btn-primary btn-lg">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body">
            <center>
                <i class="fa fa-times-circle fa-5x" style="color: red;"></i>
                <p><h1>GAGAL HAPUS DATA</h1></p>
            </center>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button></center>
        </div>';
    }
}

?>