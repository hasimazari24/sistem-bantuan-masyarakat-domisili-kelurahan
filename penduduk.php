<h3>DATA PENDUDUK <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus fa-1x"></i> Tambah data</button></h3>
<hr>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables_penduduk" style="width:100%;max-width: 1000px;" id="dataTables_penduduk" name="dataTables_penduduk">
        <thead>
            <tr>
                <th style="width:auto;">No</th>
                <th style="width:auto;">NIK</th>
                <th style="width:auto;">No. KK</th>
                <th style="width:auto;">Nama</th>
                <th style="width:auto;">Alamat KK/KTP</th>
                <th style="width:auto;">Alamat Domisili</th>
                <th style="width:auto;">No. Telp</th>
                <th style="width:10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            $ambil = $koneksi->query("SELECT * FROM tb_penduduk ORDER BY lastupdated DESC");
            while ($pecah = $ambil->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['nik']; ?></td>
                    <td><?php echo $pecah['nokk']; ?></td>
                    <td><?php echo $pecah['nama_penduduk']; ?></td>
                    <td class="center"><?php echo $pecah['alamat_ktp']; ?></td>
                    <td class="center"><?php echo $pecah['alamat_domisili']; ?></td>
                    <td class="center"><?php echo $pecah['telp']; ?></td>
                    <td align="center">
                        <button class="btn btn-info btn-sm edit_penduduk" data-id="<?php echo $pecah['id_penduduk']; ?>"><i class="fa fa-edit fa-sm"></i></button>
                        <button class="btn btn-danger btn-sm hapus_penduduk" name="hapus" id="hapus" data-id="<?php echo $pecah['id_penduduk']; ?>"><i class="fa fa-trash fa-sm"></i></button>
                    </td>
                </tr>
            <?php
                $nomor++;
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="form-add">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Penduduk</h4>
                </div>
                <div class="modal-body">
                    <table border="0" width="100%">
                        <thead style="visible:false;">
                            <tr>
                                <th style="width:auto;"></th>
                                <th style="width:25px;"></th>
                                <th style="width:70%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label>NIK</label></td>
                                <td align="center">:</td>
                                <td style="padding-bottom: 10px;padding-top: 10px;">
                                    <input class="form-control" name="nik" id="nik" type="text" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>No. KK</label></td>
                                <td align="center">:</td>
                                <td style="padding-bottom: 10px;padding-top: 10px;">
                                    <input class="form-control" name="nokk" id="nokk" type="text" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Nama Lengkap</label></td>
                                <td align="center">:</td>
                                <td style="padding-bottom: 10px;padding-top: 10px;">
                                    <input class="form-control" name="nama" id="nama" type="text" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Alamat KK/KTP</label></td>
                                <td align="center">:</td>
                                <td style="padding-bottom: 10px;padding-top: 10px;">
                                    <textarea class="form-control" name="alamatktp" id="alamatktp" rows="2" style="resize: none;" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Alamat Domisili</label></td>
                                <td align="center">:</td>
                                <td style="padding-bottom: 10px;padding-top: 10px;">
                                    <textarea class="form-control" name="alamatdomisili" id="alamatdomisili" rows="2" style="resize: none;" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label>No. Telp</label></td>
                                <td align="center">:</td>
                                <td style="padding-bottom: 10px;padding-top: 10px;">
                                    <input class="form-control" name="telp" id="telp" type="number">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="simpan_penduduk" id="simpan_penduduk"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Data Penduduk</h4>
                </div>
                <div class="modal-body">
                    <table border="0" width="100%">
                        <thead style="visible:false;">
                            <tr>
                                <th style="width:auto;"></th>
                                <th style="width:25px;"></th>
                                <th style="width:70%;"></th>
                            </tr>
                        </thead>
                        <tbody class="tableview_edit">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Yakin Hapus Data ini ?</h4>
                </div>
                <div class="modal-body data_hapus">

                </div>
                <div class="modal-footer">
                    <button style="float:left;" class="btn btn-default close-modal" data-dismiss="modal">Tidak</button>
                    <button style="float:right;" class="btn btn-danger hapus_penduduk_ok"><i class="fa fa-trash"></i> Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script>
    document.getElementById("btn_penduduk").classList.add('active-menu');
    $(document).ready(function() {
        $("#form-add").submit(function(event) {
            event.preventDefault();
            var tambahpenduduk = {
                'attr': 'tambahpenduduk',
                'nik': $('input[name=nik]').val(),
                'nokk': $('input[name=nokk]').val(),
                'nama': $('input[name=nama]').val(),
                'alamatktp': $('textarea[name=alamatktp]').val(),
                'alamatdomisili': $('textarea[name=alamatdomisili]').val(),
                'telp': $('input[name=telp]').val()
            };
            $.ajax({
                url: "function.php",
                method: "POST",
                data: tambahpenduduk,
                success: function(data) {
                    $(".notifContent").html(data)
                    $(".modalNotif").modal('show')
                }
            });
            $('.close-modal').click();
            $('#modalTambah form')[0].reset();
            return false;
        })


        $('.edit_penduduk').click(function() {
            var data_id = $(this).attr('data-id');
            var attr = "edit_view_penduduk";
            $.ajax({
                method: "POST",
                url: "function.php",
                data: {
                    attr: attr,
                    data_id: data_id
                },
                success: function(data) {
                    $(".tableview_edit").html(data);
                    $("#modalEdit").modal('show')

                }
            })
            return false;
        });

        $('.hapus_penduduk').click(function() {
            var data_id = $(this).attr('data-id');
            var attr = "hapus_view_penduduk";
            $.ajax({
                method: "POST",
                url: "function.php",
                data: {
                    attr: attr,
                    data_id: data_id
                },
                success: function(data) {
                    $(".data_hapus").html(data);
                    $("#modalHapus").modal('show')
                }
            })
            return false;
        });

        $('.hapus_penduduk_ok').click(function() {
            var data_id = document.getElementById("id_pen_hps").value;
            var attr = "hapus_penduduk";
            $.ajax({
                method: "POST",
                url: "function.php",
                data: {
                    attr: attr,
                    data_id: data_id
                },
                success: function(data) {
                    $(".notifContent").html(data)
                    $(".modalNotif").modal('show')
                }
            })
            $('.close-modal').click();
            return false;
        });

    });
    $(".form-edit").submit(function(event) {
        event.preventDefault();
        var editpenduduk = {
            'attr': 'edit_save_penduduk',
            'idpenduduk': $('input[name=id_pen]').val(),
            'nik_edit': $('input[name=nik_edit]').val(),
            'nokk_edit': $('input[name=nokk_edit]').val(),
            'nama_edit': $('input[name=nama_edit]').val(),
            'alamatktp_edit': $('textarea[name=alamatktp_edit]').val(),
            'alamatdomisili_edit': $('textarea[name=alamatdomisili_edit]').val(),
            'telp_edit': $('input[name=telp_edit]').val()
        };
        $.ajax({
            url: "function.php",
            method: "POST",
            data: editpenduduk,
            success: function(data) {
                $(".notifContent").html(data)
                $(".modalNotif").modal('show')
            }
        });
        $('.close-modal').click();
        return false;
    });
</script>