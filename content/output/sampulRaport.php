<?	
	session_start();

	include("../../kernel/version.php");
	include("../../secure/function.php");
	date_default_timezone_set('Asia/Jakarta');

	$uri = $_SERVER['REQUEST_URI'];
	$decode = decode($uri);
	
	if(empty($_SESSION['nama']) or $_SESSION['nama'] == "")
	{
		?>
			<script type="text/javascript">
				alert("Anda harus login dengan akun anda.");
				window.location = "../../index.php";
			</script>
		<?
	}

	else
	{
		$detailSiswa = mysql_query("select * from m_siswa where id='$decode[id]'");
		$a_detailSiswa = mysql_fetch_array($detailSiswa);

		$namaSekolah = mysql_query("select * from m_param where param='namaSekolah'");
		$a_namaSekolah = mysql_fetch_array($namaSekolah);
		$alamatSekolah = mysql_query("select * from m_param where param='alamatSekolah'");
		$a_alamatSekolah = mysql_fetch_array($alamatSekolah);
		$telpSekolah = mysql_query("select * from m_param where param='telpSekolah'");
		$a_telpSekolah = mysql_fetch_array($telpSekolah);
		$webSekolah = mysql_query("select * from m_param where param='webSekolah'");
		$a_webSekolah = mysql_fetch_array($webSekolah);
		$emailSekolah = mysql_query("select * from m_param where param='emailSekolah'");
		$a_emailSekolah = mysql_fetch_array($emailSekolah);
		$semester = mysql_query("select * from m_param where param='semester'");
		$a_semester = mysql_fetch_array($semester);
		$thnAjaran = mysql_query("select * from m_param where param='thnAjaran'");
		$a_thnAjaran = mysql_fetch_array($thnAjaran);
		?>	
			<html>
				<head>
					<meta charset="utf-8">
					<link rel="shortcut icon" href="../../images/Icon/Pad.png" type="image/png"/>
					<title>Sampul Raport <?echo $a_detailSiswa['nama']?></title>

					<link rel="stylesheet" href="../../css/fontFace.css">
					<link rel="stylesheet" href="../../css/css.css">
					<link rel="stylesheet" href="../../css/style.css">

					<style media="print" type="text/css">
						#action0
						{
							display:none;
						}
						
						#action1
						{
							display:none;
						}

						#action2
						{
							display:none;
						}
					</style>

					<?
						function bulan($z)
						{
							if($z == "01")
								$bulan = "Januari";
							elseif($z == "02")
								$bulan = "Februari";
							elseif($z == "03")
								$bulan = "Maret";
							elseif($z == "04")
								$bulan = "April";
							elseif($z == "05")
								$bulan = "Mei";
							elseif($z == "06")
								$bulan = "Juni";
							elseif($z == "07")
								$bulan = "Juli";
							elseif($z == "08")
								$bulan = "Agustus";
							elseif($z == "09")
								$bulan = "September";
							elseif($z == "10")
								$bulan = "Oktober";
							elseif($z == "11")
								$bulan = "November";
							elseif($z == "12")
								$bulan = "Desember";
							else
								$bulan = "Tidak diketahui";

							return $bulan;
						}
					?>
				</head>

				<body style="font-family:'tahoma';font-size:12px;overflow-x:hidden;">
					<div style="width:1.5cm;height:1cm;border:Solid 2px dodgerblue;position:fixed;margin:400 0 0 -15;background:#efefef;font-size:10px;" id="action0">
						<a href="sampulRaportPdf.php?<?echo paramEncrypt('id='.$decode['id'])?>"  title="Simpan PDF">
							<img src="../../images/Icon/pdfSmall.png" width="30" height="30" style="margin:0 0 0 15;" title="Simpan PDF">
						</a>
					</div>
					<div style="width:1.5cm;height:1cm;border:Solid 2px dodgerblue;position:fixed;margin:450 0 0 -15;background:#efefef;font-size:10px;" id="action1">
						<a href="javascript:void()" onclick="javascript:window.close();">
							<img src="../../images/Extras/Close.png" width="30" height="30" style="margin:0 0 0 15;" title="Tutup">
						</a>
					</div>
					<div style="width:1.5cm;height:1cm;border:Solid 2px dodgerblue;position:fixed;margin:500 0 0 -15;background:#efefef;font-size:10px;" id="action2">
						<a href="javascript:void()" onclick="javascript:window.print();">
							<img src="../../images/StartMenu/Printer.png" width="30" height="30" style="margin:0 0 0 15;" title="Cetak Data">
						</a>
					</div>
					<div style="width:21cm;height:29.70cm;border:solid 2px #ccc;border:solid 1px black;">
						<div style="width:99%;height:10%;margin:15 0 0 4;text-align:center;font-size:24px;">
							LAPORAN<br>
							HASIL PENCAPAIAN KOMPETENSI PESERTA DIDIK<br>
							SMP MUHAMMADIYAH 9 BOJONEGORO
						</div>
						<div style="width:99%;height:22%;margin:50 0 0 4;text-align:center;font-size:24px;">
							<img src="../../images/Pic/logo.png" width="250" height="230">
						</div>
						
						<div style="width:99%;height:30%;margin:25 0 0 4;text-align:center;font-size:18px;">
							<b>Nama Peserta Didik:</b><br>
							<div style="width:500px;height:25px;border:solid 1px black;margin:10 0 0 140;text-transform:uppercase;font-size:18px;border-radius:5px;padding:5 0 5 0;">
								<?echo $a_detailSiswa['nama']?>
							</div>
							<br><br><br>
							<b>No.Induk/NISN:</b><br>
							<div style="width:500px;height:25px;border:solid 1px black;margin:10 0 0 140;text-transform:uppercase;font-size:18px;border-radius:5px;padding:5 0 5 0;">
								<?echo $a_detailSiswa['noInduk']." / ".$a_detailSiswa['nisn']?>
							</div>
						</div>
						
						<div style="width:99%;height:5%;margin:250 0 0 4;text-align:center;font-size:20px;">
							KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br>
							REPUBLIK INDONESIA
						</div>
					</div>
				</body>
			</html>
		<?
	}
?>

