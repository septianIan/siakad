<?	
	session_start();
	ob_start();

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
					<title>Raport UAS <?echo $a_detailSiswa['nama']?></title>

					<link rel="stylesheet" href="../../css/fontFace.css">
					<link rel="stylesheet" href="../../css/css.css">
					<link rel="stylesheet" href="../../css/style.css">

					<style media="print" type="text/css">
						table
						{
							background-color: transparent;
							border-collapse: collapse;
							border-spacing: 0;
						}

						tr
						{
							border:solid 1px #ccc;
						}

						#header
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:10 0 20 20;
							text-align:left;
							font-family:'Tahoma';
							font-size:11px;
						}

						#header1
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:-45 0 0 550;
							text-align:left;
							font-family:'Tahoma';
							font-size:11px;
						}

						#sikap
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:-55 0 0 310;
							text-align:left;
							font-family:'Tahoma';
							font-size:12px;
						}

						#signature
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:-115 0 0 550;
							text-align:center;
							font-family:'Tahoma';
							font-size:12px;
						}
					</style>

					<?
						function predikatEkstra($t)
						{
							if($t == "A")
								$predikat = "Sangat Baik";
							elseif($t == "B")
								$predikat = "Baik";
							elseif($t == "C")
								$predikat = "Cukup";
							else
								$predikat = "Buruk";

							return $predikat;
						}

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

						function Terbilang($x)
						{
							$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
							if ($x < 12)
								return " " . $abil[$x];
							elseif ($x < 20)
								return Terbilang($x - 10) . " Belas";
							elseif ($x < 100)
								return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
							elseif ($x < 200)
								return " Seratus" . Terbilang($x - 100);
							elseif ($x < 1000)
								return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
							elseif ($x < 2000)
								return " Seribu" . Terbilang($x - 1000);
							elseif ($x < 1000000)
								return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
							elseif ($x < 1000000000)
								return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
						}
					?>
				</head>

				<body style="font-family:'tahoma';font-size:12px;overflow-x:hidden;">
					<div style="width:21cm;height:29.70cm;">
						<div style="width:99%;height:10%;margin:15 0 0 4;text-align:center;font-size:24px;">
							LAPORAN<br>
							HASIL PENCAPAIAN KOMPETENSI PESERTA DIDIK<br>
							SMP MUHAMMADIYAH 9 BOJONEGORO
						</div>
						<div style="width:99%;height:22%;margin:50 0 0 4;text-align:center;font-size:24px;">
							<img src="../../images/Pic/logo.png" width="250" height="230">
						</div>
						
						<div style="width:99%;height:30%;margin:25 0 0 4;font-size:18px;">
							<div style="text-align:Center;"><b>Nama Peserta Didik:</b></div>
							<div style="width:500px;height:25px;border:solid 1px black;margin:10 0 0 120;text-transform:uppercase;font-size:18px;border-radius:5px;padding:5 0 5 0;float:left;text-align:center;">
								<?echo $a_detailSiswa['nama']?>
							</div>
							<br><br><br>
							<div style="text-align:center;"><b>No.Induk/NISN:</b></div>
							<div style="width:500px;height:25px;border:solid 1px black;margin:10 0 0 120;text-transform:uppercase;font-size:18px;border-radius:5px;padding:5 0 5 0;float:left;text-align:center;">
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

	$filename="Sampul_Raport_".$a_detailSiswa['nama']."_".$a_detailSiswa['kelas'].".pdf";
	
	$content = ob_get_clean();
	require_once('html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','A4','en', false, 'UTF-8',array(5, 5, 5, 5));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>