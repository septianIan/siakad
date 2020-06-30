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
					<title>Raport UAS <?echo $a_detailSiswa['nama']?></title>

					<link rel="stylesheet" href="../../css/fontFace.css">
					<link rel="stylesheet" href="../../css/css.css">
					<link rel="stylesheet" href="../../css/style.css">

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
					<div style="width:1.5cm;height:1cm;border:Solid 2px dodgerblue;position:fixed;margin:400 0 0 -15;background:#efefef;font-size:10px;" id="action1">
						<a href="raportUAS9Pdf.php?<?echo paramEncrypt('id='.$decode['id'])?>"  title="Simpan PDF">
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

					<div style="width:19.5cm;height:26.5cm;">
						<div style="height:10%;width:98%;margin:0 0 0 8;border-bottom:Solid 1px black;">
							<div style="width:80px;height:80px;margin:10 0 0 50;float:left;">
								<img src="../../images/Pic/logo.png" width="80" height="80">
							</div>
							<div style="width:500px;height:90px;float:left;margin:10 0 0 0;text-align:center;">
								<font style="font-size:20px;text-transform:uppercase;"><?echo $a_namaSekolah['value']?></font><br>
								<font style="font-size:18px;text-transform:uppercase;">LAPORAN PENILAIAN HASIL BELAJAR AKHIR SEMESTER</font><br>
								<font style="font-size:12px;"><?echo $a_alamatSekolah['value']." Telp:".$a_telpSekolah['value']?></font><br>
								<font style="font-size:12px;"><?echo $a_webSekolah['value']." Email:".$a_emailSekolah['value']?></font><br>
							</div>
						</div>
						<div style="height:89%;width:98%;margin:0 0 0 8;font-size:12px;">
							<div style="width:300px;height:60px;float:left;margin:10 0 0 20;">
								<table style="font-size:12px;">
									<tr style="border:none;height:15px;">
										<td style="width:100px;">NAMA SISWA</td>
										<td style="width:10px;">:</td>
										<td style="width:190px;text-transform:uppercase;">
											<?
												echo $a_detailSiswa['nama'];
											?>
										</td>
									</tr>
									<tr style="border:none;height:15px;">
										<td style="width:100px;">NO.INDUK</td>
										<td style="width:10px;">:</td>
										<td style="width:190px;">
											<?
												echo $a_detailSiswa['noInduk'];
											?>
										</td>
									</tr>
									<tr style="border:none;height:15px;">
										<td style="width:100px;">KELAS</td>
										<td style="width:10px;">:</td>
										<td style="width:190px;">
											<?
												echo $a_detailSiswa['kelas'];
											?>
										</td>
									</tr>
								</table>
							</div>
							<div style="width:200px;height:60px;float:right;margin:10 10 0 0;">
								<table style="font-size:12px;">
									<tr style="border:none;height:15px;">
										<td style="width:100px;">SEMESTER</td>
										<td style="width:10px;">:</td>
										<td style="width:50px;text-transform:uppercase;">
											<?
												echo $a_semester['value'];
											?>
										</td>
									</tr>
									<tr style="border:none;height:15px;">
										<td style="width:100px;">THN.AJARAN</td>
										<td style="width:10px;">:</td>
										<td style="width:50px;text-transform:uppercase;">
											<?
												echo $a_thnAjaran['value'];
											?>
										</td>
									</tr>
								</table>
							</div>
							<div style="clear:both;"></div>

							<table style="margin:10 20 0 20;font-size:12px;">
								<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td rowspan="2" style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
									<td rowspan="2" style="width:250px;border-right:solid 1px #ccc;">MATA PELAJARAN</td>
									<td rowspan="2" style="width:50px;border-right:solid 1px #ccc;">KKM</td>
									<td colspan="2" style="width:200px;border-right:solid 1px #ccc;">NILAI</td>
									<td rowspan="2" style="width:150px;border-right:solid 1px #ccc;">DESKRIPSI</td>
								</tr>
								<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td style="width:50px;border-right:solid 1px #ccc;">ANGKA</td>
									<td style="width:150px;border-right:solid 1px #ccc;">HURUF</td>
								</tr>
								<?
									$no = 1;
									$tot = 0;
									$pembagi = 0;
									$selPelajaran = mysql_query("select distinct(trigger9) as trigger9 from m_pelajaran where $a_detailSiswa[kelas]='1' and uas='1' order by urutanCetak asc");
									while($a_selPelajaran = mysql_fetch_array($selPelajaran))
									{
										$kkm = 0;
										$NA = 0;
										$dividen = 0;
										$pelajaranTrigger = mysql_query("select * from m_pelajaran where trigger9='$a_selPelajaran[trigger9]' and $a_detailSiswa[kelas]='1' and uas='1'");
										while($a_pelajaranTrigger = mysql_fetch_array($pelajaranTrigger))
										{
											$replace = str_replace(" ", "_", $a_pelajaranTrigger['pelajaran']);
											$table = $replace.$a_detailSiswa['kelas'];
											
											//KKM
											$selKKM = mysql_query("select * from m_kkm where pelajaran='$a_pelajaranTrigger[pelajaran]' and kelas='$a_detailSiswa[kelas]'");
											$a_selKKM = mysql_fetch_array($selKKM);
											
											if(empty($a_selKKM['kkm']))
												$kkm = $kkm + 0;
											else
												$kkm = $kkm + $a_selKKM['kkm'];
												
											$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
											$a_cekTable = mysql_fetch_array($cekTable);

											if($a_cekTable['jumTable'] != 0)
											{
												$tugas = 0;
												$jumTugas = 0;
												$selTugas = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='T'");
												while($a_selTugas = mysql_fetch_array($selTugas))
												{
													$tugas = $tugas + $a_selTugas['nilai'];
													$jumTugas = $jumTugas + 1;
												}

												$UH = 0;
												$jumUH = 0;
												$selUH = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UH'");
												while($a_selUH = mysql_fetch_array($selUH))
												{
													$cekRemidi = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='R' and urutan='$a_selUH[urutan]'");
													$a_cekRemidi = mysql_fetch_array($cekRemidi);

													if($a_cekRemidi['nilai'] == 0)
													{
														$UH = $UH + $a_selUH['nilai'];
														$jumUH = $jumUH + 1;
													}

													else
													{
														$UH = $UH + $a_cekRemidi['nilai'];
														$jumUH = $jumUH + 1;
													}
												}

												$uts = 0;
												$jumUts = 0;
												$selUTS = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UTS'");
												while($a_selUTS = mysql_fetch_array($selUTS))
												{
													$uts = $uts + $a_selUTS['nilai'];
													$jumUts = $jumUts + 1;
												}

												$uas = 0;
												$jumUas = 0;
												$selUAS = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UAS'");
												while($a_selUAS = mysql_fetch_array($selUAS))
												{
													$uas = $uas + $a_selUAS['nilai'];
													$jumUas = $jumUas + 1;
												}

												$nilaiT = @($tugas / $jumTugas);
												$nilaiUH = @($UH / $jumUH);
												$nilaiUTS = @($uts / $jumUts);
												$nilaiUAS = @($uas / $jumUas);

												$NH = @(((2*$nilaiT) + $nilaiUH)/3);
												$nAkhir = round(@(((2*$NH) + $nilaiUTS + $nilaiUAS)/4),2);
												$NA = $NA + $nAkhir;
											}

											else
											{
												$NA = $NA + 0;
											}
											$dividen = $dividen + 1;
										}
										$kkmFinal = @($kkm/$dividen);
										$NAFinal = round(@($NA/$dividen));
										?>
											<tr style="height:15px;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
													<?
														echo $no;
													?>
												</td>
												<td style="width:250px;border-right:solid 1px #ccc;">
													<?
														//echo $a_selPelajaran['trigger9'];
														$display = mysql_query("select * from m_pelajaran where trigger9='$a_selPelajaran[trigger9]'");
														$a_display = mysql_fetch_array($display);
														echo $a_display['display9'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $kkmFinal;
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $NAFinal;
													?>
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo Terbilang($NAFinal);
													?>
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														if($NAFinal == "0")
														{
															echo "-";
														}

														else
														{
															if($NAFinal == $kkmFinal)
															{
																echo "Tercapai";
															}

															elseif($NAFinal < $kkmFinal)
															{
																echo "Belum Tercapai";
															}

															elseif($NAFinal > $kkmFinal)
															{
																echo "Terlampaui";
															}

															else
															{
																echo "-";
															}
														}
													?>
												</td>
											</tr>
										<?
										$no=$no+1;
										$tot = $tot + $NAFinal;
										$pembagi = $pembagi + 1;
									}
								?>
								<tr style="height:15px;">
									<td colspan="3" style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;text-align:right;font-style:italic;">Jumlah&nbsp;&nbsp;</td>
									<td style="width:50px;border-right:solid 1px #ccc;text-align:center;"><?echo $tot?></td>
									<td style="background:#efefef;border-right:solid 1px #ccc;"></td>
									<td style="background:#efefef;border-right:solid 1px #ccc;"></td>
								</tr>
								<tr style="height:15px;">
									<td colspan="3" style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;text-align:right;font-style:italic;">Rata-rata&nbsp;&nbsp;</td>
									<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
										<?
											$rata = round(@($tot / $pembagi),2);
											echo $rata;
										?>
									</td>
									<td style="background:#efefef;border-right:solid 1px #ccc;"></td>
									<td style="background:#efefef;border-right:solid 1px #ccc;"></td>
								</tr>
							</table>

							<br><br>
							<font style="font-size:12px;margin:0 0 0 20;font-weight:bold;">PENGEMBANGAN DIRI</font>
							<table style="font-size:12px;margin:5 20 0 20;">
								<tr style="text-align:center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
									<td style="width:350px;border-right:solid 1px #ccc;">JENIS KEGIATAN</td>
									<td style="width:150px;border-right:solid 1px #ccc;">PREDIKAT</td>
									<td style="width:150px;border-right:solid 1px #ccc;">KETERANGAN</td>
								</tr>
								<?
									$number = 1;
									$nama = mysql_real_escape_string($a_detailSiswa['nama']);
									$ekstra = mysql_query("select * from tbl_pesertaekstra where noInduk='$a_detailSiswa[noInduk]' order by ekstra asc");
									while($a_ekstra = mysql_fetch_array($ekstra))
									{
										?>
											<tr style="height:15px;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
													<?
														echo $number;
													?>
												</td>
												<td style="width:350px;border-right:solid 1px #ccc;">
													<?
														echo $a_ekstra['ekstra'];
													?>
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $a_ekstra['UAS'];
													?>
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo predikatEkstra($a_ekstra['UAS']);
													?>
												</td>
											</tr>
										<?
										$number = $number+1;
									}

									if($number == 1)
									{
										?>
											<tr style="height:15px;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
										
												</td>
												<td style="width:350px;border-right:solid 1px #ccc;">
										
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
										
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
										
												</td>
											</tr>
										<?
									}

									else
									{
										//nothing
									}
								?>								
							</table>

							<div style="float:left;margin:20 0 0 0;">
								<font style="font-size:12px;margin:0 0 0 20;font-weight:bold;">AKHLAK & KEPRIBADIAN</font>
								<table style="font-size:12px;margin:5 20 0 20;">
									<?
										$akhlak = mysql_query("select * from tbl_akhlak where noInduk='$a_detailSiswa[noInduk]' and kelas='$a_detailSiswa[kelas]'");
										$a_akhlak = mysql_fetch_array($akhlak);
									?>
									<tr style="height:15px;">
										<td style="width:150px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">Akhlak</td>
										<td style="width:100px;border-right:solid 1px #ccc;text-align:center;"><?echo $a_akhlak['akhlak']?></td>
									</tr>
									<tr style="height:15px;">
										<td style="width:150px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">Kepribadian</td>
										<td style="width:100px;border-right:solid 1px #ccc;text-align:center;"><?echo $a_akhlak['kepribadian']?></td>
									</tr>
								</table>
							</div>

							<div style="float:left;margin:20 0 0 0;">
								<font style="font-size:12px;margin:0 0 0 20;font-weight:bold;">KETIDAKHADIRAN</font>
								<table style="font-size:12px;margin:5 20 0 10;">
									<?
										$tidakhadir = mysql_query("select * from tbl_absen where noInduk='$a_detailSiswa[noInduk]' and kelas='$a_detailSiswa[kelas]'");
										$a_tidakhadir = mysql_fetch_array($tidakhadir);
									?>
									<tr style="text-align:center;font-weight:bold;background:#b0e0e6;height:20px;">
										<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
										<td style="width:175px;border-right:solid 1px #ccc;">ALASAN</td>
										<td style="width:150px;border-right:solid 1px #ccc;">LAMA</td>
									</tr>
									<tr style="height:15px;">
										<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">1</td>
										<td style="width:100px;border-right:solid 1px #ccc;">Ijin</td>
										<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
											<?
												if(empty($a_tidakhadir['ijin1']))
													echo "- Hari";
												else
													echo $a_tidakhadir['ijin1']." Hari"
											?>
										</td>
									</tr>
									<tr style="height:15px;">
										<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">2</td>
										<td style="width:100px;border-right:solid 1px #ccc;">Sakit</td>
										<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
											<?
												if(empty($a_tidakhadir['sakit1']))
													echo "- Hari";
												else
													echo $a_tidakhadir['sakit1']." Hari"
											?>
										</td>
									</tr>
									<tr style="height:15px;">
										<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">3</td>
										<td style="width:100px;border-right:solid 1px #ccc;">Tanpa Keterangan</td>
										<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
											<?
												if(empty($a_tidakhadir['alpha1']))
													echo "- Hari";
												else
													echo $a_tidakhadir['alpha1']." Hari"
											?>
										</td>
									</tr>
								</table>
							</div>
							<div style="clear:both;"></div>

							<div style="width:200px;height:100px;float:left;margin:50 0 0 20;font-size:12px;text-align:center;">
								Mengetahui<br>
								Orang Tua / Wali Murid
								<br><br><br><br><br>
								(..........................)
							</div>
							
							<div style="width:200px;height:100px;float:left;margin:50 0 0 20;font-size:12px;text-align:center;">
								<br>
								Wali Kelas
								<br><br><br><br><br>
								( <?echo $_SESSION['nama']?> )
							</div>

							<div style="width:250px;height:180px;float:right;font-size:12px;margin:10 23 0 0;text-align:Left;border:solid 1px black;padding:3 3 3 3;font-weight:bold;">
								<?
									if($a_detailSiswa['kelas'] == "9A" or $a_detailSiswa['kelas'] == "9B")
									{
										?>
											Keputusan:<br>
											Berdasarkan hasil yang dicapai pada semester 1 dan 2, maka siswa ini ditetapkan<br>
											Lulus / Tidak Lulus<br>
											Bojonenegoro, 10 Juni 2015<br>
											<div style="width:245;text-align:center;">
												Kepala Sekolah
												<br><br><br><br><br>
												(H.Pakih,S.Pd)
											</div>
										<?
									}
									
									else
									{
										?>
											Keputusan:<br>
											Berdasarkan hasil yang dicapai pada semester 1 dan 2, maka siswa ini ditetapkan<br>
											Naik ke kelas
											<?
												if($a_detailSiswa['kelas'] == "7A" or $a_detailSiswa['kelas'] == "7B")
													echo "VIII (Delapan)";
												elseif($a_detailSiswa['kelas'] == "8A" or $a_detailSiswa['kelas'] == "8B")
													echo "IX (Sembilan)";
												else
													echo "";
											?><br>
											Tinggal di kelas
											<?
												if($a_detailSiswa['kelas'] == "7A" or $a_detailSiswa['kelas'] == "7B")
													echo "VII (Tujuh)";
												elseif($a_detailSiswa['kelas'] == "8A" or $a_detailSiswa['kelas'] == "8B")
													echo "VIII (Delapan)";
												else
													echo "";
											?><br>
											Bojonenegoro, 13 Juni 2015<br>
											<div style="width:245;text-align:center;">
												Kepala Sekolah
												<br><br><br><br><br>
												(H.Pakih,S.Pd)
											</div>
										<?
									}
								?>
							</div>
						</div>
					</div>
				</body>
			</html>
		<?
	}
?>

