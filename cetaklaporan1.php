<?php
include('fpdf/pdf_mc_table.php');
include('koneksi.php');
//error_reporting(0);
$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->Image('assets/img/logo.jpg',10,10,24);

$pdf->Cell(20);
$pdf->SetFont('Times','B',18);
$pdf->Cell(0,8,'PEMERINTAH KOTA SURAKARTA',0,1,'C');
$pdf->Cell(20);
$pdf->SetFont('Times','B',18);
$pdf->Cell(0,8,'KECAMATAN SERENGAN',0,1,'C');
$pdf->Cell(20);
$pdf->SetFont('Times','B',24);
$pdf->Cell(0,9,'KELURAHAN KRATONAN',0,1,'C');
$pdf->Cell(20);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,'Alamat : Jl. Pringgodani No. 32 Joyodiningratan RT 005 RW 005',0,1,'C');

$pdf->SetLineWidth(1);
$pdf->Line(10,47,200,47);
$pdf->SetLineWidth(0);
$pdf->Line(10,48,200,48);

$pdf->Cell(0,8,'',0,1);
date_default_timezone_set('Asia/Jakarta');
$tgl = date("d-m-Y");
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,'Tanggal : '.$tgl,0,1,'L');

$pdf->SetFont('Times','B',15);
$pdf->Cell(0,8,'LAPORAN PENERIMAAN BANTUAN',0,1,'C');

$pdf->Cell(10,5,'',0,1);

$pdf->SetFont('Times','B',11);

$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(34,8,'NIK',1,0,'C');
$pdf->Cell(38,8,'Nama Penerima',1,0,'C');
$pdf->Cell(40,8,'Alamat KTP/KK',1,0,'C');
$pdf->Cell(40,8,'Alamat Domisili',1,0,'C');
$pdf->Cell(29,8,'Jenis Bantuan',1,1,'C');

$pdf->SetFont('Times','',11);
$pdf->SetWidths(Array(10,34,38,40,40,29));
$pdf->SetAligns(Array('C','','','','',''));
$pdf->SetLineHeight(7);

if(isset($_POST['tglmulai']) && isset($_POST['tglakhir'])){
    $tglmulai = $_POST['tglmulai'];
    $tglakhir = $_POST['tglakhir'];
    $nomor=1;
    $items = array();
    $ambil=$koneksi->query("SELECT pnb.id_penerimabantuan,pd.nik,pd.nama_penduduk,pd.alamat_ktp,pd.alamat_domisili,jnb.nama_jenisbantuan,pnb.keterangan FROM tb_penduduk pd JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan WHERE pnb.lastupdated BETWEEN '$tglmulai' AND '$tglakhir' ORDER BY pnb.lastupdated DESC");
    while($item=$ambil->fetch_assoc()){
    	$pdf->Row(Array(
    		$nomor,
    		$item['nik'],
    		$item['nama_penduduk'],
    		$item['alamat_ktp'],
    		$item['alamat_domisili'],
    		$item['nama_jenisbantuan'],
    	));$nomor++;
    }
    $pdf->Output('Laporan-Penerimaan-Bantuan-'.$tgl.'.pdf','I');
}elseif (isset($_POST['kunci'])) {
	$kunci = $_POST['kunci'];
	$nomor=1;
	$ambil=$koneksi->query("SELECT pnb.id_penerimabantuan,pd.nik,pd.nama_penduduk,pd.alamat_ktp,pd.alamat_domisili,jnb.nama_jenisbantuan,pnb.keterangan FROM tb_penduduk pd JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan WHERE pd.nik like '%$kunci%' OR pd.nama_penduduk like '%$kunci%' OR pd.alamat_ktp like '%$kunci%' OR pd.alamat_domisili like '%$kunci%' OR jnb.nama_jenisbantuan like '%$kunci%' ORDER BY pnb.lastupdated DESC");
	while($item=$ambil->fetch_assoc()){
    	$pdf->Row(Array(
    		$nomor,
    		$item['nik'],
    		$item['nama_penduduk'],
    		$item['alamat_ktp'],
    		$item['alamat_domisili'],
    		$item['nama_jenisbantuan'],
    	));$nomor++;
    }
    $pdf->Output('Laporan-Penerimaan-Bantuan-'.$tgl.'.pdf','I');
}