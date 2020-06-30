<?
	include("../../kernel/version.php");
	include("../../secure/function.php");

	$uri = $_SERVER['REQUEST_URI'];
	$decode = decode($uri);
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../../images/Icon/Pad.png" type="image/png"/>
		<title>CETAK DATA SISWA</title>

		<?
			function bulan($a)
			{
				if($a == "01")
					$bulan = "Januari";
				elseif($a == "02")
					$bulan = "Februari";
				elseif($a == "03")
					$bulan = "Maret";
				elseif($a == "04")
					$bulan = "April";
				elseif($a == "05")
					$bulan = "Mei";
				elseif($a == "06")
					$bulan = "Juni";
				elseif($a == "07")
					$bulan = "Juli";
				elseif($a == "08")
					$bulan = "Agustus";
				elseif($a == "09")
					$bulan = "September";
				elseif($a == "10")
					$bulan = "Oktober";
				elseif($a == "11")
					$bulan = "November";
				elseif($a == "12")
					$bulan = "Desember";
				else
					$bulan = "Unknown";

				return $bulan;
			}
		?>

		<style media="print" type="text/css">
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

	<body style="font-family:'Tahoma';font-size:14px;">
		<div style="width:1.5cm;height:1cm;border:Solid 2px dodgerblue;position:fixed;margin:400 0 0 -15;background:#efefef;font-size:10px;" id="action1">
				<a href="dataSiswaPdf.php?<?echo paramEncrypt('id='.$decode['id'])?>"  title="Simpan PDF">
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
			<div style="width:100%;height:5%;text-align:Center;font-size:18px;margin:10 0 0 0;">
				KETERANGAN TENTANG PESERTA DIDIK
			</div>
			<div style="width:100%;height:92%;text-align:Center;font-size:14px;">
				<?
					$selDetail = mysql_query("select * from m_siswa where id='$decode[id]'");
					$a_selDetail = mysql_fetch_array($selDetail);
				?>
				<table style="margin:10 10 10 10;font-size:14px;">
					<tr>
						<td style="width:50px;text-align:Center;">1.</td>
						<td style="width:250px;">Nama Lengkap</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['nama']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">2.</td>
						<td style="width:250px;">No.Induk</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['noInduk']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">3.</td>
						<td style="width:250px;">NISN</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['nisn']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">4.</td>
						<td style="width:250px;">Tempat Tanggal Lahir</td>
						<td style="width:50px;text-align:Center;">:</td>
						<?
							$pecahTgl = explode("-",$a_selDetail['tglLahir']);
						?>
						<td style="width:450px;"><?echo $a_selDetail['tempatLahir'].", ".$pecahTgl[2]."-".$pecahTgl[1]."-".$pecahTgl[0]?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">5.</td>
						<td style="width:250px;">Jenis Kelamin</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;">
							<?
								if($a_selDetail['jenisKelamin'] == "P")
									echo "Perempuan";
								else
									echo "Laki-laki";
							?>
						</td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">6.</td>
						<td style="width:250px;">Agama</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['agama']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">7.</td>
						<td style="width:250px;">Status Dalam Keluarga</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['statusKeluarga']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">8.</td>
						<td style="width:250px;">Anak ke</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['anakKe']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">9.</td>
						<td style="width:250px;">Alamat peserta didik</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['alamat']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">Telepon</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['noTelp']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">10.</td>
						<td style="width:250px;">Sekolah Asal</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['sekolahAsal']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">11.</td>
						<td style="width:250px;">Diterima di sekolah ini</td>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:450px;"></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">Di kelas</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['diterimaKelas']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">Tanggal</td>
						<td style="width:50px;text-align:Center;">:</td>
						<?
							$pecahTglTerima = explode("-", $a_selDetail['tglTerima']);
						?>
						<td style="width:450px;"><?echo $pecahTglTerima[2]."-".$pecahTglTerima[1]."-".$pecahTglTerima[0]?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">12.</td>
						<td style="width:250px;">Nama orang tua</td>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:450px;"></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">a.Ayah</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['ayah']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">b.Ibu</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['ibu']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">13.</td>
						<td style="width:250px;">Alamat orang tua</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['alamatOrtu']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">14.</td>
						<td style="width:250px;">Telepon orang tua</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['noTelpOrtu']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">15.</td>
						<td style="width:250px;">Pekerjaan orang tua</td>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:450px;"></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">a.Ayah</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['pekerjaanAyah']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;"></td>
						<td style="width:250px;">b.Ibu</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['pekerjaanIbu']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">16.</td>
						<td style="width:250px;">Nama wali</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['namaWali']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">17.</td>
						<td style="width:250px;">Alamat wali</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['alamatWali']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">18.</td>
						<td style="width:250px;">Telepon wali</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['noTelpWali']?></td>
					</tr>
					<tr>
						<td style="width:50px;text-align:Center;">19.</td>
						<td style="width:250px;">Pekerjaan wali</td>
						<td style="width:50px;text-align:Center;">:</td>
						<td style="width:450px;"><?echo $a_selDetail['pekerjaanWali']?></td>
					</tr>
				</table>

				<div style="width:3cm;height:4cm;border:Solid 2px black;float:left;margin:30 0 0 210;">
					<br><br><br>Pas Foto<br>3x4
				</div>

				<div style="width:8cm;height:4cm;float:right;margin:30 125 0 0;text-align:center;">
					Bojonegoro, <?echo $pecahTglTerima[2]." ".bulan($pecahTglTerima[1])." ".$pecahTglTerima[0]?><br>
					KEPALA SMP MUHAMMADIYAH 9 BOJONEGORO
					<br><br><br><br><br><br>
					<?
						$selKepsek = mysql_query("select * from m_param where param='kepalaSekolah'");
						$a_selKepsek = mysql_fetch_array($selKepsek);
						echo "(".$a_selKepsek['value'].")";
					?>
				</div>
			</div>
		</div>
	</body>
</html>