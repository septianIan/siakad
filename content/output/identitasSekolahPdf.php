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
					<div style="width:99%;height:10%;margin:15 0 0 4;text-align:center;font-size:24px;">
						LAPORAN<br>
						HASIL PENCAPAIAN KOMPETENSI PESERTA DIDIK<br>
						SMP MUHAMMADIYAH 9 BOJONEGORO
					</div>
					<div style="width:99%;height:72%;margin:100 0 0 4;font-size:24px;">
						<table style="margin:10 0 0 100;font-size:18px;">
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Nama Sekolah</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">SMP Muhammadiyah 9 Bojonegoro</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">NPSN / NSS</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">20577759 / 20.4.05.05.01.150</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Alamat Sekolah</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">Jalan Teuku Umar No.48</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;"> </td>
								<td style="width:20px;text-align:center;"> </td>
								<td style="width:375px;">Bojonegoro</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;"> </td>
								<td style="width:20px;text-align:center;"> </td>
								<td style="width:375px;">
									Kode Pos : 62111
									Telp : (0353)885403
								</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Kelurahan / Desa</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">Kadipaten</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Kecamatan</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">Bojonegoro</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Kota / Kabupaten</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">Bojonegoro</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Provinsi</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">Jawa Timur</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Website</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">www.smpmuh9-bjn.sch.id</td>
							</tr>
							<tr style="height:40px;border:none;">
								<td style="width:200px;">Email</td>
								<td style="width:20px;text-align:center;">:</td>
								<td style="width:375px;">smpm9bojonegoro@yahoo.com</td>
							</tr>
						</table>
					</div>
				</body>
			</html>
		<?
	}

	$filename="Identitas_Sekolah_Raport.pdf";
	
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