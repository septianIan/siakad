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
		?>	
			<html>
				<head>
					<meta charset="utf-8">
					<link rel="shortcut icon" href="../../images/Icon/Pad.png" type="image/png"/>
					<title>Lembar Identitas Sekolah</title>

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
				</head>

				<body style="font-family:'tahoma';font-size:12px;overflow-x:hidden;">
					<div style="width:1.5cm;height:1cm;border:Solid 2px dodgerblue;position:fixed;margin:400 0 0 -15;background:#efefef;font-size:10px;" id="action0">
						<a href="identitasSekolahPdf.php"  title="Simpan PDF">
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
						<div style="width:99%;height:72%;margin:100 0 0 4;text-align:center;font-size:24px;">
							<table style="margin:10 0 0 100;font-size:18px;">
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Nama Sekolah</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">SMP Muhammadiyah 9 Bojonegoro</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">NPSN / NSS</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">20577759 / 20.4.05.05.01.150</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Alamat Sekolah</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">Jalan Teuku Umar No.48</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;"> </td>
									<td style="width:20px;text-align:center;"> </td>
									<td style="width:375px;">Bojonegoro</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;"> </td>
									<td style="width:20px;text-align:center;"> </td>
									<td style="width:375px;">
										Kode Pos : 62111&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Telp : (0353)885403
									</td>
								</tr>
								<tr style="height30px;border:none;">
									<td style="width:200px;">Kelurahan / Desa</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">Kadipaten</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Kecamatan</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">Bojonegoro</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Kota / Kabupaten</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">Bojonegoro</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Provinsi</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">Jawa Timur</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Website</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">www.smpmuh9-bjn.sch.id</td>
								</tr>
								<tr style="height:30px;border:none;">
									<td style="width:200px;">Email</td>
									<td style="width:20px;text-align:center;">:</td>
									<td style="width:375px;">smpm9bojonegoro@yahoo.com</td>
								</tr>
							</table>
						</div>
					</div>
				</body>
			</html>
		<?
	}
?>

