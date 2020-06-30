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
					<div style="width:100%;height:5%;text-align:Center;font-size:18px;margin:10 0 0 0;">
						KETERANGAN TENTANG PESERTA DIDIK
					</div>
					<div style="width:100%;height:92%;font-size:14px;">
						<?
							$selDetail = mysql_query("select * from m_siswa where id='$decode[id]'");
							$a_selDetail = mysql_fetch_array($selDetail);
						?>
						<table style="margin:10 10 10 10;font-size:14px;">
							<tr>
								<td style="width:50px;text-align:Center;">1.</td>
								<td style="width:150px;">Nama Lengkap</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['nama']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">2.</td>
								<td style="width:150px;">No.Induk</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['noInduk']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">3.</td>
								<td style="width:150px;">NISN</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['nisn']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">4.</td>
								<td style="width:150px;">Tempat Tanggal Lahir</td>
								<td style="width:50px;text-align:Center;">:</td>
								<?
									$pecahTgl = explode("-",$a_selDetail['tglLahir']);
								?>
								<td style="width:450px;"><?echo $a_selDetail['tempatLahir'].", ".$pecahTgl[2]."-".$pecahTgl[1]."-".$pecahTgl[0]?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">5.</td>
								<td style="width:150px;">Jenis Kelamin</td>
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
								<td style="width:150px;">Agama</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['agama']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">7.</td>
								<td style="width:150px;">Status Dalam Keluarga</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['statusKeluarga']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">8.</td>
								<td style="width:150px;">Anak ke</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['anakKe']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">9.</td>
								<td style="width:150px;">Alamat peserta didik</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['alamat']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">Telepon</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['noTelp']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">10.</td>
								<td style="width:150px;">Sekolah Asal</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['sekolahAsal']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">11.</td>
								<td style="width:150px;">Diterima di sekolah ini</td>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:450px;"></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">Di kelas</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['diterimaKelas']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">Tanggal</td>
								<td style="width:50px;text-align:Center;">:</td>
								<?
									$pecahTglTerima = explode("-", $a_selDetail['tglTerima']);
								?>
								<td style="width:450px;"><?echo $pecahTglTerima[2]."-".$pecahTglTerima[1]."-".$pecahTglTerima[0]?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">12.</td>
								<td style="width:150px;">Nama orang tua</td>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:450px;"></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">a.Ayah</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['ayah']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">b.Ibu</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['ibu']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">13.</td>
								<td style="width:150px;">Alamat orang tua</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['alamatOrtu']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">14.</td>
								<td style="width:150px;">Telepon orang tua</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['noTelpOrtu']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">15.</td>
								<td style="width:150px;">Pekerjaan orang tua</td>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:450px;"></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">a.Ayah</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['pekerjaanAyah']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;"></td>
								<td style="width:150px;">b.Ibu</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['pekerjaanIbu']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">16.</td>
								<td style="width:150px;">Nama wali</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['namaWali']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">17.</td>
								<td style="width:150px;">Alamat wali</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['alamatWali']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">18.</td>
								<td style="width:150px;">Telepon wali</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['noTelpWali']?></td>
							</tr>
							<tr>
								<td style="width:50px;text-align:Center;">19.</td>
								<td style="width:150px;">Pekerjaan wali</td>
								<td style="width:50px;text-align:Center;">:</td>
								<td style="width:450px;"><?echo $a_selDetail['pekerjaanWali']?></td>
							</tr>
						</table>

						<div style="width:90px;height:120px;border:Solid 2px black;float:left;margin:50 0 0 250;text-align:center;">
							<br><br><br>Pas Foto<br>3x4
						</div>

						<div style="width:6cm;height:4cm;margin:-120 0 0 360;text-align:center;">
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
				</body>
			</html>
		<?
	}

	$filename="Data_siswa_".$a_detailSiswa['nama']."_".$a_detailSiswa['kelas'].".pdf";
	
	$content = ob_get_clean();
	require_once('html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','A4','en', false, 'UTF-8',array(0, 0, 0, 0));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>