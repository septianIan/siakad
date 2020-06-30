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
					<title>Raport UAS Deskripsi <?echo $a_detailSiswa['nama']?></title>

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
							width:200px;
							height:100px;
							margin:20 0 20 -80;
							text-align:left;
							font-family:'Tahoma';
							font-size:11px;
						}

						#header1
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:-40 0 0 530;
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

						function konversiHuruf($a)
						{
							if(0 <= $a and $a < 1)
								$huruf = "D-";
							elseif(1 <= $a and $a <= 1.17)
								$huruf = "D";
							elseif(1.17 < $a and $a <= 1.5)
								$huruf = "D";
							elseif(1.5 < $a and $a <= 1.83)
								$huruf = "C-";
							elseif(1.83 < $a and $a <= 2.17)
								$huruf = "C";
							elseif(2.17 < $a and $a <= 2.5)
								$huruf = "C+";
							elseif(2.5 < $a and $a <= 2.83)
								$huruf = "B-";
							elseif(2.83 < $a and $a <= 3.17)
								$huruf = "B";
							elseif(3.17 < $a and $a <= 3.5)
								$huruf = "B+";
							elseif(3.5 < $a and $a <= 3.83)
								$huruf = "A-";
							elseif(3.83 < $a and $a <= 4)
								$huruf = "A";
							else
								$huruf = "Null";

							return $huruf;
						}

						function konversiPredikat($b)
						{
							if($b == "A+")
								$predikat = "SB";
							elseif($b == "A")
								$predikat = "SB";
							elseif($b == "A-")
								$predikat = "SB";
							elseif($b == "B+")
								$predikat = "B";
							elseif($b == "B")
								$predikat = "B";
							elseif($b == "B-")
								$predikat = "B";
							elseif($b == "C+")
								$predikat = "C";
							elseif($b == "C")
								$predikat = "C";
							elseif($b == "C-")
								$predikat = "C";
							elseif($b == "D+")
								$predikat = "K";
							elseif($b == "D")
								$predikat = "K";
							elseif($b == "D-")
								$predikat = "K";
							else
								$predikat = "Null";

							return $predikat;
						}

						function konversiKeterangan($c)
						{
							if($c == "A+")
								$keterangan = "SANGAT";
							elseif($c == "A")
								$keterangan = "SANGAT";
							elseif($c == "A-")
								$keterangan = "SANGAT";
							elseif($c == "B+")
								$keterangan = "SUDAH";
							elseif($c == "B")
								$keterangan = "SUDAH";
							elseif($c == "B-")
								$keterangan = "SUDAH";
							elseif($c == "C+")
								$keterangan = "CUKUP";
							elseif($c == "C")
								$keterangan = "CUKUP";
							elseif($c == "C-")
								$keterangan = "CUKUP";
							elseif($c == "D+")
								$keterangan = "KURANG";
							elseif($c == "D")
								$keterangan = "KURANG";
							elseif($c == "D-")
								$keterangan = "KURANG";
							else
								$keterangan = "Null";

							return $keterangan;
						}
						
						function konversiSaranKeterangan($c)
						{
							if($c == "A+")
								$keterangan = "perlu dipertahankan";
							elseif($c == "A")
								$keterangan = "perlu dipertahankan";
							elseif($c == "A-")
								$keterangan = "perlu dipertahankan";
							elseif($c == "B+")
								$keterangan = "perlu ditingkatkan";
							elseif($c == "B")
								$keterangan = "perlu ditingkatkan";
							elseif($c == "B-")
								$keterangan = "perlu ditingkatkan";
							elseif($c == "C+")
								$keterangan = "sangat perlu ditingkatkan";
							elseif($c == "C")
								$keterangan = "sangat perlu ditingkatkan";
							elseif($c == "C-")
								$keterangan = "sangat perlu ditingkatkan";
							elseif($c == "D+")
								$keterangan = "sangat perlu ditingkatkan dan memerlukan pembinaan";
							elseif($c == "D")
								$keterangan = "sangat perlu ditingkatkan dan memerlukan pembinaan";
							elseif($c == "D-")
								$keterangan = "sangat perlu ditingkatkan dan memerlukan pembinaan";
							else
								$keterangan = "Null";

							return $keterangan;
						}
						
						function finalResult($c)
						{
							if($c == "A+")
								$result = "A";
							elseif($c == "A")
								$result = "A";
							elseif($c == "A-")
								$keterangan = $result = "A";
							elseif($c == "B+")
								$result = "B";
							elseif($c == "B")
								$result = "B";
							elseif($c == "B-")
								$result = "B";
							elseif($c == "C+")
								$result = "C";
							elseif($c == "C")
								$result = "C";
							elseif($c == "C-")
								$result = "C";
							elseif($c == "D+")
								$result = "D";
							elseif($c == "D")
								$result = "D";
							elseif($c == "D-")
								$result = "D";
							else
								$result = "Null";

							return $result;
						}

						function konversiKeteranganKeterampilan($c)
						{
							if($c == "A+")
								$keterangan = "SANGAT BAIK";
							elseif($c == "A")
								$keterangan = "SANGAT BAIK";
							elseif($c == "A-")
								$keterangan = "SANGAT BAIK";
							elseif($c == "B+")
								$keterangan = "SUDAH BAIK";
							elseif($c == "B")
								$keterangan = "SUDAH BAIK";
							elseif($c == "B-")
								$keterangan = "SUDAH BAIK";
							elseif($c == "C+")
								$keterangan = "CUKUP";
							elseif($c == "C")
								$keterangan = "CUKUP";
							elseif($c == "C-")
								$keterangan = "CUKUP";
							elseif($c == "D+")
								$keterangan = "KURANG";
							elseif($c == "D")
								$keterangan = "KURANG";
							else
								$keterangan = "Null";

							return $keterangan;
						}

						function konversiKeteranganSikap($c)
						{
							if($c == "SB")
								$keterangan = "SANGAT BAIK";
							elseif($c == "B")
								$keterangan = "BAIK";
							elseif($c == "C")
								$keterangan = "CUKUP";
							elseif($c == "K")
								$keterangan = "KURANG";
							else
								$keterangan = "Null";

							return $keterangan;
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
					<img src="../../images/Pic/logo.png" style="float:left;margin:5 0 0 30;" width="80" height="80">
					<div style="width:15cm;height:2cm;float:left;margin:10 0 0 40;text-align:center;">
						<font style="font-size:20px;text-transform:uppercase;"><?echo $a_namaSekolah['value']?></font><br>
						<font style="font-size:18px;text-transform:uppercase;">LAPORAN PENILAIAN HASIL BELAJAR AKHIR SEMESTER</font><br>
						<font style="font-size:12px;"><?echo $a_alamatSekolah['value']." Telp:".$a_telpSekolah['value']?></font><br>
						<font style="font-size:12px;"><?echo $a_webSekolah['value']." Email:".$a_emailSekolah['value']?></font><br>
					</div>
						
					<table id="header">
						<tr style="border:none;height:15px;">
							<td style="width:100px;">NAMA SISWA</td>
							<td style="width:10px;">:</td>
							<td style="width:350px;text-transform:uppercase;">
								<?
									echo $a_detailSiswa['nama'];
								?>
							</td>
						</tr>
						<tr style="border:none;height:15px;">
							<td style="width:100px;">NO.INDUK</td>
							<td style="width:10px;">:</td>
							<td style="width:350px;">
								<?
									echo $a_detailSiswa['noInduk'];
								?>
							</td>
						</tr>
						<tr style="border:none;height:15px;">
							<td style="width:100px;">KELAS</td>
							<td style="width:10px;">:</td>
							<td style="width:350px;">
								<?
									echo $a_detailSiswa['kelas'];
								?>
							</td>
						</tr>
					</table>
				
					<table id="header1">
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
						<tr style="border:none;height:15px;">
							<td style="width:100px;">JENIS</td>
							<td style="width:10px;">:</td>
							<td style="width:50px;text-transform:uppercase;">
								DESKRIPSI
							</td>
						</tr>
					</table>
					
					<table style="margin:0 20 0 20;font-size:12px;">
						<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
							<td style="width:50px;border:solid 1px #ccc;">NO</td>
							<td style="width:150px;border:solid 1px #ccc;">MATA PELAJARAN</td>
							<td style="width:150px;border:solid 1px #ccc;">KOMPETENSI</td>
							<td style="width:325px;border:solid 1px #ccc;">CATATAN</td>
						</tr>
						<?
							$no = 1;
							$selMapel = mysql_query("select distinct(kelompok) as kelompok from m_pelajaran where $a_detailSiswa[kelas]='1' and uas='1' order by kelompok asc");
							while($a_selMapel = mysql_fetch_array($selMapel))
							{
								if($a_selMapel['kelompok'] == "Mulok")
									$kelompok = "Mulok Wajib";
								else
									$kelompok = $a_selMapel['kelompok'];

								?>
									<tr style="text-transform:uppercase;">
										<td colspan="4" style="border:solid 1px #ccc;background:#efefef;"><?echo $kelompok?></td>
									</tr>
								<?

								$selPelajaran = mysql_query("select * from m_pelajaran where kelompok='$a_selMapel[kelompok]' and $a_detailSiswa[kelas]='1' and uas='1' order by pelajaran asc");
								while($a_selPelajaran = mysql_fetch_array($selPelajaran))
								{
									?>
										<tr style="vertical-align:middle;">
											<td rowspan="3" style="width:50px;border:solid 1px #ccc;text-align:center;">
												<?
													echo $no;
												?>
											</td>
											<td rowspan="3" style="width:150px;border:solid 1px #ccc;">
												<?
													echo "<b>".$a_selPelajaran['pelajaran']."</b><br>";
														
													//gurupelajaran
													$guruPengajar = mysql_query("select * from m_gurupelajaran where pelajaran='$a_selPelajaran[pelajaran]' and kelas='$a_detailSiswa[kelas]'");
													$a_guruPengajar = mysql_fetch_array($guruPengajar);
													
													echo "<font style='font-size:10px;'><i>".$a_guruPengajar['nama']."</i></font>"
												?>
											</td>
											<td style="width:150px;border:solid 1px #ccc;">
												Pengetahuan
											</td>
											<td style="width:250px;border:solid 1px #ccc;font-style:italic;">
												<?
													$replace = str_replace(" ", "_", $a_selPelajaran['pelajaran']);
													$tablePengetahuan = $replace.$a_detailSiswa['kelas']."Pengetahuan";

													$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tablePengetahuan'");
													$a_cekTable = mysql_fetch_array($cekTable);

													if($a_cekTable['jumTable'] != 0)
													{
														/*$mak = mysql_query("select max(nilai) as maksimal from $tablePengetahuan where noInduk='$a_detailSiswa[noInduk]' and urutan!='0' and nilai!='0'");
														$a_mak = mysql_fetch_array($mak);

														$upper = "";
														$detailPengetahuan = mysql_query("select * from $tablePengetahuan where noInduk='$a_detailSiswa[noInduk]' and nilai='$a_mak[maksimal]' and urutan!='0'");
														while($a_detailPengetahuan = mysql_fetch_array($detailPengetahuan))
														{
															$upper = $upper."[".$a_detailPengetahuan['tag']." ".$a_detailPengetahuan['materi']."]";
														}

														$min = mysql_query("select min(nilai) as minimal from $tablePengetahuan where noInduk='$a_detailSiswa[noInduk]' and urutan!='0' and nilai!='0'");
														$a_min = mysql_fetch_array($min);

														$lower = "";
														$lowerPengetahuan = mysql_query("select * from $tablePengetahuan where noInduk='$a_detailSiswa[noInduk]' and nilai='$a_min[minimal]' and urutan!='0'");
														while($a_lowerPengetahuan = mysql_fetch_array($lowerPengetahuan))
														{
															$lower = $lower."[".$a_lowerPengetahuan['tag']." ".$a_lowerPengetahuan['materi']."]";
														}

														$skala4Upper = @(($a_mak['maksimal']/100)*4);
														$skala4Lower = @(($a_min['minimal']/100)*4);
														$konversiHurufUpper = konversiHuruf($skala4Upper);
														$konversiHurufLower = konversiHuruf($skala4Lower);
														$konversiKeteranganUpper = konversiKeterangan($konversiHurufUpper);
														$konversiKeteranganLower = konversiKeterangan($konversiHurufLower);
														
														if($konversiKeteranganUpper == $konversiKeteranganLower)
														{
															echo "Secara umum ".$konversiKeteranganUpper." memahami semua materi";
														}
														
														else
														{
															echo $konversiKeteranganUpper." memahami tentang <b>".$upper."</b>, namun perlu ditingkatkan tentang pemahaman <b>".$lower."</b>";
														}
														*/
														
														$nilai = "";
														$sumMateri = "";
														$selMateri = mysql_query("select distinct(materi) as materi from $tablePengetahuan where noInduk='$a_detailSiswa[noInduk]' and urutan!='0'");
														while($a_selMateri = mysql_fetch_array($selMateri))
														{
															$jum = 0;
															$jumNilai = 0;
															$materiRow = mysql_real_escape_string($a_selMateri['materi']);
															
															$selRow = mysql_query("select * from $tablePengetahuan where noInduk='$a_detailSiswa[noInduk]' and urutan!='0' and materi='$materiRow' and tag!='R'");
															while($a_selRow = mysql_fetch_array($selRow))
															{
																$jum = $jum + 1;
																$jumNilai = $jumNilai + $a_selRow['nilai'];
															}
															$rataNilai = @($jumNilai / $jum);
															$skala4 = @(($rataNilai/100)*4);
															$huruf = konversiHuruf($skala4);
															
															$sumMateri = $sumMateri."|".$materiRow;
															$nilai = $nilai."|".$huruf;
														}
														
														$pecahMateri = explode("|",$sumMateri);
														$pecahNilai = explode("|",$nilai);
														
														//echo "<pre>";
														//print_r($pecahMateri)."<br>";
														//print_r($pecahNilai)."<br>";
														//echo "</pre>";
														
														if(count($pecahNilai) == 1)
														{
															echo "-";
														}
														
														else
														{
															$compareMak = 4;
															$nilaiMak = "";
															$materiMak = "";
															for($a=1;$a<=(count($pecahNilai)-1);$a++)
															{
																$makHuruf = $pecahNilai[$a];
																
																if($makHuruf == "A")
																	$skorMak = 4;
																elseif($makHuruf == "A-")
																	$skorMak = 3.75;
																elseif($makHuruf == "B+")
																	$skorMak = 3.5;
																elseif($makHuruf == "B")
																	$skorMak = 3.25;
																elseif($makHuruf == "B-")
																	$skorMak = 3;
																elseif($makHuruf == "C+")
																	$skorMak = 2.75;
																elseif($makHuruf == "C")
																	$skorMak = 2.5;
																elseif($makHuruf == "C-")
																	$skorMak = 2.25;
																elseif($makHuruf == "D+")
																	$skorMak = 2;
																elseif($makHuruf == "D")
																	$skorMak = 1.75;
																elseif($makHuruf == "D-")
																	$skorMak = 1.5;
																else
																	$skorMak = 0;
																	
																if($skorMak < $compareMak)
																{
																	$compareMak = $skorMak;
																	$nilaiMak = $makHuruf;
																	$materiMak = "[".$pecahMateri[$a]."]";
																}
																
																else
																{
																	if($skorMak == $compareMak)
																	{
																		$compareMak = $compareMak;
																		$nilaiMak = $makHuruf;
																		$materiMak = $materiMak."[".$pecahMateri[$a]."]";
																	}
																	
																	else
																	{
																		$compareMak = $compareMak;
																		$nilaiMak = $nilaiMak;
																		$materiMak = $materiMak;
																	}
																}
															}
															//echo $materiMak." ".$nilaiMak." ".$compareMak."<br>";
															
															$compareMin = 0;
															$nilaiMin = "A";
															$materiMin = "";
															for($b=1;$b<=(count($pecahNilai)-1);$b++)
															{
																$minHuruf = $pecahNilai[$b];
																
																if($minHuruf == "A")
																	$skorMin = 4;
																elseif($minHuruf == "A-")
																	$skorMin = 3.75;
																elseif($minHuruf == "B+")
																	$skorMin = 3.5;
																elseif($minHuruf == "B")
																	$skorMin = 3.25;
																elseif($minHuruf == "B-")
																	$skorMin = 3;
																elseif($minHuruf == "C+")
																	$skorMin = 2.75;
																elseif($minHuruf == "C")
																	$skorMin = 2.5;
																elseif($minHuruf == "C-")
																	$skorMin = 2.25;
																elseif($minHuruf == "D+")
																	$skorMin = 2;
																elseif($minHuruf == "D")
																	$skorMin = 1.75;
																elseif($minHuruf == "D-")
																	$skorMin = 1.5;
																else
																	$skorMin = 0;
																	
																if($skorMin > $compareMin)
																{
																	$compareMin = $skorMin;
																	$nilaiMin = $minHuruf;
																	$materiMin = "[".$pecahMateri[$b]."]";
																}
																
																else
																{
																	if($skorMin == $compareMin)
																	{
																		$compareMin = $compareMin;
																		$nilaiMin = $minHuruf;
																		$materiMin = $materiMin."[".$pecahMateri[$b]."]";
																	}
																	
																	else
																	{
																		$compareMin = $compareMin;
																		$nilaiMin = $nilaiMin;
																		$materiMin = $materiMin;
																	}
																}
															}
															
															$konversiUpper = konversiKeterangan($nilaiMin);
															$konversiLower = konversiKeterangan($nilaiMak);
															
															$finalResultUpper = finalResult($nilaiMin);
															$finalResultLower = finalResult($nilaiMak);
															
															$saranLower = konversiSaranKeterangan($nilaiMak);
															
															//echo $nilaiMak." ".$nilaiMin;
															//echo $finalResultLower." ".$finalResultUpper." ";
															if($finalResultUpper == $finalResultLower)
															{
																echo "Secara umum ".$konversiUpper." memahami keseluruhan materi pembelajaran, sehingga ".$saranLower;
															}
															
															else
															{
																echo $konversiUpper." memahami tentang <b>".$materiMin."</b> , namun dalam <b>".$materiMak."</b> ".$saranLower;
															}
														}
													}

													else
													{
														echo "-";
													}
												?>
											</td>
										</tr>
										<tr style="vertical-align:middle;">
											<td style="width:150px;border:solid 1px #ccc;">
												Keterampilan
											</td>
											<td style="width:250px;border:solid 1px #ccc;font-style:italic;">
												<?
													$tableKeterampilan = $replace.$a_detailSiswa['kelas']."Keterampilan";

													$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableKeterampilan'");
													$a_cekTable = mysql_fetch_array($cekTable);

													if($a_cekTable['jumTable'] != 0)
													{
														$mak = mysql_query("select max(nilai) as maksimal from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and nilai!='0'");
														$a_mak = mysql_fetch_array($mak);

														$upper = "";
														$detailKeterampilan = mysql_query("select * from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and nilai='$a_mak[maksimal]'");
														while($a_detailKeterampilan = mysql_fetch_array($detailKeterampilan))
														{
															$upper = $upper."[".$a_detailKeterampilan['tag']." ".$a_detailKeterampilan['materi']."]";
														}

														$min = mysql_query("select min(nilai) as minimal from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and nilai!='0'");
														$a_min = mysql_fetch_array($min);

														$lower = "";
														$lowerKeterampilan = mysql_query("select * from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and nilai='$a_min[minimal]'");
														while($a_lowerKeterampilan = mysql_fetch_array($lowerKeterampilan))
														{
															$lower = $lower."[".$a_lowerKeterampilan['tag']." ".$a_lowerKeterampilan['materi']."]";
														}

														$skala4Upper = @(($a_mak['maksimal']/100)*4);
														$skala4Lower = @(($a_min['minimal']/100)*4);
														$konversiHuruf = konversiHuruf($skala4Upper);
														$konversiLower = konversiHuruf($skala4Lower);
														$finalResultUpper = finalResult($konversiHuruf);
														$finalResultLower = finalResult($konversiLower);
														
														$konversiKeteranganKeterampilan = konversiKeteranganKeterampilan($konversiHuruf);
														$konversiKeteranganKeterampilanLower = konversiKeteranganKeterampilan($konversiLower);
														$konversiSaranLower = konversiSaranKeterangan($konversiLower);
														
														//echo $finalResultUpper." ".$finalResultLower;
														//echo $konversiHuruf." ".$konversiLower;
														if($upper == "")
														{
															echo "-";
														}
														
														else
														{
															if($finalResultUpper == $finalResultLower)
															{
																echo "Secara umum pemahaman tentang keterampilan ".$konversiKeteranganKeterampilan.", sehingga ".$konversiSaranLower;
															}
															
															else
															{
																echo "<b>".$upper."</b> ".$konversiKeteranganKeterampilan." , namun dalam melakukan <b>".$lower."</b> ".$konversiSaranLower;
															}
														}
													}

													else
													{
														echo "-";
													}
												?>
											</td>
										</tr>
										<tr style="vertical-align:middle;">
											<td style="width:150px;border:solid 1px #ccc;">
												Sikap Spiritual&Sosial
											</td>
											<td style="width:250px;border:solid 1px #ccc;font-style:italic;">
												<?
													$tableSikap = $replace.$a_detailSiswa['kelas']."Sikap";

													$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableSikap'");
													$a_cekTable = mysql_fetch_array($cekTable);

													if($a_cekTable['jumTable'] != 0)
													{
														$awal = "";
														$namaSikap = "";
														$rataSikap = mysql_query("select distinct(sikap) as rataSikap from $tableSikap order by markerSikap asc");
														while($a_rataSikap = mysql_fetch_array($rataSikap))
														{
															$nilai = 0;
															$jum = 0;
															$devidenNilai = mysql_query("select distinct(tag) as devidenNilai from $tableSikap order by marker asc");
															while($a_devidenNilai = mysql_fetch_array($devidenNilai))
															{
																$nilaiRata = mysql_query("select sum(nilai) as naruto from $tableSikap where sikap='$a_rataSikap[rataSikap]' and tag='$a_devidenNilai[devidenNilai]' and noInduk='$a_detailSiswa[noInduk]'");
																$a_nilaiRata = mysql_fetch_array($nilaiRata);

																$sumRata = mysql_query("select count(*) as kakashi from $tableSikap where sikap='$a_rataSikap[rataSikap]' and tag='$a_devidenNilai[devidenNilai]' and noInduk='$a_detailSiswa[noInduk]'");
																$a_sumRata = mysql_fetch_array($sumRata);

																$nilai = $nilai + $a_nilaiRata['naruto'];
																$jum = $jum + $a_sumRata['kakashi'];
															}

															$rataRata = @($nilai/$jum);
															$awal = $awal.",".$rataRata;
															$namaSikap = $namaSikap.",".$a_rataSikap['rataSikap'];
														}

														$input = explode(",", $awal);
														$nama = explode(",", $namaSikap);
														
														$mayoritas = "";
														for($r=1;$r<(count($input));$r++)
														{
															$NSkala4 = @(($input[$r]/100)*4);
															$huruf = konversiHuruf($NSkala4);
															$predikat = konversiPredikat($huruf);
															$mayoritas = $mayoritas.",".$predikat;
														}

														$major = explode(",", $mayoritas);

														$count = array_count_values($major);
														$keys = array_keys($count);
														$countKeys = count($keys);

														//CONTROLLER
														//echo "<pre>";
														//print_r($count);
														//print_r($keys);
														//print_r($major);
														//print_r($nama);
														//echo "</pre>";

														//SIKAP PALING BANYAK
														$pembanding = 0;
														for($r=1;$r<$countKeys;$r++)
														{
															$sikapCur = $keys[$r];
															$jumCur = $count[$keys[$r]];

															if($jumCur > $pembanding)
															{
																$pembanding = $jumCur;
																$sikapCur1 = $sikapCur;
															}

															elseif($jumCur == $pembanding)
															{
																if($sikapCur == "SB")
																	$bobotCur = 4;
																elseif($sikapCur == "B")
																	$bobotCur = 3;
																elseif($sikapCur == "C")
																	$bobotCur = 2;
																else
																	$bobotCur = 1;

																if($sikapCur1 == "SB")
																	$bobotCur1 = 4;
																elseif($sikapCur1 == "SB")
																	$bobotCur1 = 3;
																elseif($sikapCur1 == "C")
																	$bobotCur1 = 2;
																else
																	$bobotCur1 = 1;

																if($bobotCur > $bobotCur1)
																	$sikapCur1 = $sikapCur;
																else
																	$sikapCur1 = $sikapCur1;
															}

															else
															{
																//nothing
															}
														}
														//echo "Mayoritas = ".$sikapCur1." sejumlah ".$pembanding."<br>";

														//SIKAP PALING SEDIKIT
														$pembandingMin = 100;
														for($r=1;$r<$countKeys;$r++)
														{
															$sikapMin = $keys[$r];
															$jumMin = $count[$keys[$r]];

															if($jumMin < $pembanding)
															{
																$pembandingMin = $jumMin;
																$sikapMin1 = $sikapMin;
															}

															elseif($jumMin == $pembandingMin)
															{
																if($sikapMin == "SB")
																	$bobotMin = 4;
																elseif($sikapMin == "B")
																	$bobotMin = 3;
																elseif($sikapMin == "C")
																	$bobotMin = 2;
																else
																	$bobotMin = 1;

																if($sikapMin1 == "SB")
																	$bobotMin1 = 4;
																elseif($sikapMin1 == "SB")
																	$bobotMin1 = 3;
																elseif($sikapMin1 == "C")
																	$bobotMin1 = 2;
																else
																	$bobotMin1 = 1;

																if($bobotMin < $bobotMin1)
																	$sikapMin1 = $sikapMin;
																else
																	$sikapMin1 = $sikapMin1;
															}

															else
															{
																//nothing
															}
														}
														//echo "Minoritas = ".$sikapMin1." sejumlah ".$pembandingMin."<br>";

														//SIKAP PALING JELEK
														$pembandingJ = 5;
														$sikapJ = "";
														for($rJ=1;$rJ<$countKeys;$rJ++)
														{
															$sikapMinJ = $keys[$rJ];

															if($sikapMinJ == "SB")
																$bobot = 4;
															elseif($sikapMinJ == "B")
																$bobot = 3;
															elseif($sikapMinJ == "C")
																$bobot = 2;
															else
																$bobot = 1;

															if($bobot < $pembandingJ)
															{
																$pembandingJ = $bobot;
																$sikapJ = $sikapMinJ;
															}

															else
															{
																$pembandingJ = $pembandingJ;
																$sikapJ = $sikapJ;
															}
														}
														//echo "Sikap paling jelek = ".$sikapJ."<br>";

														//SIKAP PALING BAGUS
														$pembandingB = 0;
														$sikapB = "";
														for($rB=1;$rB<$countKeys;$rB++)
														{
															$sikapMinB = $keys[$rB];

															if($sikapMinB == "SB")
																$bobotB = 4;
															elseif($sikapMinB == "B")
																$bobotB = 3;
															elseif($sikapMinB == "C")
																$bobotB = 2;
															else
																$bobotB = 1;

															if($bobotB > $pembandingB)
															{
																$pembandingB = $bobotB;
																$sikapB = $sikapMinB;
															}

															else
															{
																$pembandingB = $pembandingB;
																$sikapB = $sikapB;
															}
														}
														//echo "Sikap paling bagus = ".$sikapB."<br>";

														//MAKE DECISION
														if($sikapB == $sikapJ)
														{
															if($sikapB == "SB" and $sikapJ == "SB")
																$lanjut = "perlu dipertahankan";
															elseif($sikapB == "B" and $sikapJ == "B")
																$lanjut = "perlu ditingkatkan";
															elseif($sikapB == "C" and $sikapJ == "C")
																$lanjut = "sangat perlu ditingkatkan";
															else
																$lanjut = "sangat perlu pembinaan";

															echo "Secara umum kemampuan sikap spiritual dan sosial ".konversiKeteranganSikap($sikapB).", sehingga ".$lanjut;
														}

														else
														{
															if($sikapCur1 == $sikapJ)
															{
																$tingkat = "";
																for($t=1;$t<count($major);$t++)
																{
																	if($major[$t] == $sikapB)
																		$tingkat = $tingkat."[".$nama[$t]."]";
																	else
																	{
																		//nothing
																	}
																}

																if($sikapB == "SB")
																	$lanjut = "perlu dipertahankan";
																elseif($sikapB == "B")
																	$lanjut = "perlu ditingkatkan";
																elseif($sikapB == "C")
																	$lanjut = "sangat perlu ditingkatkan";
																else
																	$lanjut = "sangat perlu pembinaan";

																echo "Secara umum kemampuan sikap spiritual dan sosial ".konversiKeteranganSikap($sikapCur1).", namun untuk <b>".$tingkat."</b> ".konversiKeteranganSikap($sikapB)." sehingga ".$lanjut;
															}

															else
															{
																$tingkat = "";
																for($t=1;$t<count($major);$t++)
																{
																	if($major[$t] == $sikapJ)
																		$tingkat = $tingkat."[".$nama[$t]."]";
																	else
																	{
																		//nothing
																	}
																}

																if($sikapJ == "SB")
																	$lanjut = "perlu dipertahankan";
																elseif($sikapJ == "B")
																	$lanjut = "perlu ditingkatkan";
																elseif($sikapJ == "C")
																	$lanjut = "sangat perlu ditingkatkan";
																else
																	$lanjut = "sangat perlu pembinaan";

																echo "Secara umum kemampuan sikap spiritual dan sosial ".konversiKeteranganSikap($sikapCur1).", namun untuk <b>".$tingkat."</b> ".$lanjut;
															}
														}
													}

													else
													{
														echo "-";
													}
												?>
											</td>
										</tr>
									<?
									$no = $no + 1;	
								}
							}
						?>
					</table>

					<div style="width:200px;height:15px;margin:30 0 0 30;font-size:12px;float:left;">
						Orang Tua / Wali Murid
						<br><br><br><br>
						<font style="color:white;">af</font>(..........................)
						<div style="width:200px;height:15px;margin:-60 0 0 370;font-size:12px;text-align:center;float:right;">
							<!--Bojonegoro, <?//echo date(d)." ".bulan(date(m))." ".date(Y)?><br>-->
							Bojonegoro, 20 Desember 2014<br>
							Wali Kelas
							<br><br><br><br>
							<?echo $_SESSION['nama']?>
						</div>
					</div>
				</body>
			</html>
		<?
	}

	$filename="Raport_UAS_Deskripsi_".$a_detailSiswa['nama']."_".$a_detailSiswa['kelas'].".pdf";
	
	$content = ob_get_clean();
	require_once('html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','A4','en', false, 'UTF-8',array(5, 0, 0, 0));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>