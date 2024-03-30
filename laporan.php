<h3>LAPORAN DATA PENERIMA BANTUAN</h3>
<hr>



<div class="col-md-6 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Laporan berdasarkan tanggal
        </div>
        <div class="panel-body">
        <form method="post" class="form-laporan" target="_blank" action="tampil_laporan.php">
        	<div class="form-group input-group" style="margin-bottom: 10px;">
        	<table>
        		<tr>
        			<td>Tanggal :&nbsp;</td>
        			<td><input type="text" id="tglmulai" name="tglmulai" class="form-control datepicker" required/></td>
        			<td>&nbsp;s/d&nbsp;</td>
        			<td><input type="text" id="tglakhir" name="tglakhir" class="form-control datepicker" required/></td>
        		</tr>
        	</table>
            </div>
        <center><button class="btn btn-primary" id="filter_tgl" name="filter_tgl" type="submit"><i class="fa fa-book"></i> Tampilkan</button></center>
        </form>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Laporan berdasarkan pencarian kata kunci
        </div>
        <div class="panel-body">
            <form method="post" target="_blank" action="tampil_laporan.php">
        	<div class="form-group input-group" style="margin-bottom: 10px;">
                <input type="text" class="form-control" id="carilaporan" name="carilaporan" placeholder="Masukkan kata kunci">
                <span class="input-group-btn">
                    <button class="btn btn-default btn_katakunci" type="button"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <center><button class="btn btn-primary" id="filter_keyword" name="filter_keyword"><i class="fa fa-book"></i> Tampilkan</button></center>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>

<script>
    $(document).ready(function () {
        document.getElementById("btn_laporan").classList.add('active-menu');
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    $(".form-laporann").submit(function(event){
        event.preventDefault();
        window.open('tampil_laporan.php','_blank');
        var filter1 = {
            attr        : 'filter_tgl',
            tglawal     : $('input[name=tglmulai]').val(),
            tglakhir    : $('input[name=tglakhir]').val()
        };
        $.ajax({
            method: "POST",
            url : "tampil_laporan.php",
            data: filter1,
            success: function(data){
                
            }
        })
    });
</script>