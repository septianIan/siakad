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
					<title>Raport UAS Capaian <?echo $a_detailSiswa['nama']?></title>

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
							if($t == "A" or $t == "A+" or $t == "A-")
								$predikat = "Sangat Baik";
							elseif($t == "B" or $t == "B+" or $t == "B-")
								$predikat = "Baik";
							elseif($t == "C" or $t == "C+" or $t == "C-")
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
						<a href="raportUASCapaianPdf.php?<?echo paramEncrypt('id='.$decode['id'])?>"  title="Simpan PDF">
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
							<div style="width:400px;height:60px;float:left;margin:10 0 0 20;">
								<table style="font-size:12px;">
									<tr style="border:none;height:15px;">
										<td style="width:100px;">NAMA SISWA</td>
										<td style="width:10px;">:</td>
										<td style="width:400px;text-transform:uppercase;">
											<?
												echo $a_detailSiswa['nama'];
											?>
										</td>
									</tr>
									<tr style="border:none;height:15px;">
										<td style="width:100px;">NO.INDUK</td>
										<td style="width:10px;">:</td>
										<td style="width:400px;">
											<?
												echo $a_detailSiswa['noInduk'];
											?>
										</td>
									</tr>
									<tr style="border:none;height:15px;">
										<td style="width:100px;">KELAS</td>
										<td style="width:10px;">:</td>
										<td style="width:400px;">
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
									<tr style="border:none;height:15px;">
										<td style="width:100px;">JENIS</td>
										<td style="width:10px;">:</td>
										<td style="width:50px;text-transform:uppercase;">
											CAPAIAN
										</td>
									</tr>
								</table>
							</div>
							<div style="clear:both;"></div>

							<table style="margin:10 20 0 20;font-size:12px;">
								<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td rowspan="2" style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
									<td rowspan="2" style="width:250px;border-right:solid 1px #ccc;">MATA PELAJARAN</td>
									<td rowspan="2" style="width:150px;border-right:solid 1px #ccc;">PENGETAHUAN<br>(KI 3)</td>
									<td rowspan="2" style="width:150px;border-right:solid 1px #ccc;">KETERAMPILAN<br>(KI 4)</td>
									<td colspan="2" style="width:300px;border-right:solid 1px #ccc;">SIKAP SPIRITUAL & SOSIAL<br>(KI 1 & KI 2)</td>
								</tr>
								<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td style="width:150px;border-right:solid 1px #ccc;">DALAM MAPEL<br>SB/B/C/K</td>
									<td style="width:150px;border-right:solid 1px #ccc;">ANTAR MAPEL<br>DESKRIPSI</td>
								</tr>
								<?
									$jumSpan = 0;
									$jumAntar = 0;
									$rowAntar = 0;
									$selRowspan = mysql_query("select distinct(kelompok) as kelompok from m_pelajaran where $a_detailSiswa[kelas]='1' and uas='1' order by kelompok asc");
									while($a_selRowspan = mysql_fetch_array($selRowspan))
									{
										$selPelajaran = mysql_query("select * from m_pelajaran where kelompok='$a_selRowspan[kelompok]' and $a_detailSiswa[kelas]='1' and uas='1' order by pelajaran asc");
										while($a_selPelajaran = mysql_fetch_array($selPelajaran))
										{
											$replace1 = str_replace(" ", "_", $a_selPelajaran['pelajaran']);
											$tableSikap1 = $replace1.$a_detailSiswa['kelas']."Sikap";

											$cekTable1 = mysql_query("select count(*) as jumTable1 from information_schema.tables where table_schema='siakad' and table_name='$tableSikap1'");
											$a_cekTable1 = mysql_fetch_array($cekTable1);

											if($a_cekTable1['jumTable1'] != 0)
											{
												$core1 = 0;
												$jumCore1 = 0;
												$selJenis1 = mysql_query("select distinct(tag) as jenis1 from $tableSikap1 where noInduk='$a_detailSiswa[noInduk]'");
												while($a_selJenis1 = mysql_fetch_array($selJenis1))
												{
													$jumNilai1 = mysql_query("select sum(nilai) as jumSikap1 from $tableSikap1 where noInduk='$a_detailSiswa[noInduk]' and tag='$a_selJenis1[jenis1]'");
													$a_jumNilai1 = mysql_fetch_array($jumNilai1);

													$row1 = mysql_query("select count(*) as rowSikap1 from $tableSikap1 where noInduk='$a_detailSiswa[noInduk]' and tag='$a_selJenis1[jenis1]'");
													$a_row1 = mysql_fetch_array($row1);

													$jum1 = @($a_jumNilai1['jumSikap1'] / $a_row1['rowSikap1']);

													$core1 = $core1 + $jum1;
													$jumCore1 = $jumCore1 + 1;
												}
												
												$NA1 = @($core1 / $jumCore1);
											}

											else
											{
												$NA1 = 0;
											}

											$jumSpan = $jumSpan + 1;
											$jumAntar = $jumAntar + $NA1;
											$rowAntar = $rowAntar + 1;
										}
										$jumSpan = $jumSpan + 1;
									}
									$jumSpan = $jumSpan + 1;
								?>

								<tr style="height:1px;">
									<td style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#ccc;"></td>
									<td style="border-right:solid 1px #ccc;background:#ccc;"></td>
									<td style="border-right:solid 1px #ccc;background:#ccc;"></td>
									<td style="border-right:solid 1px #ccc;background:#ccc;"></td>
									<td style="border-right:solid 1px #ccc;background:#ccc;"></td>
									<td rowspan="<?echo $jumSpan?>" style="border-right:solid 1px #ccc;font-style:italic;">
										<?
											$antar = @($jumAntar / $rowAntar);
											$skala41 = round(@(($antar/100)*4),2);
											$hurufAntar = konversiHuruf($skala41);
											$predikatAntar = konversiPredikat($hurufAntar);

											if($predikatAntar == "SB")
											{
												$ketAntar = "SANGAT BAIK";
												$saran = " sehingga perlu dipertahankan";
											}

											elseif($predikatAntar == "B")
											{
												$ketAntar = "BAIK";
												$saran = " sehingga perlu ditingkatkan";	
											}

											elseif($predikatAntar == "C")
											{
												$ketAntar = "CUKUP";
												$saran = " sehingga sangat perlu ditingkatkan";	
											}

											elseif($predikatAntar == "K")
											{
												$ketAntar = "KURANG";
												$saran = " sehingga sangat perlu pembinaan lebih lanjut";	
											}
											echo "Secara umum kemampuan sikap spiritual dan sosial <b>".$ketAntar."</b> ".$saran;
										?>
									</td>
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
											<tr style="height:15px;text-transform:uppercase;">
												<td colspan="5" style="width:250px;border-right:solid 1px #ccc;background:#efefef;border-left:solid 1px #ccc;"><?echo $kelompok?></td>
											</tr>
										<?

										$selPelajaran = mysql_query("select * from m_pelajaran where kelompok='$a_selMapel[kelompok]' and $a_detailSiswa[kelas]='1' and uas='1' order by pelajaran asc");
										while($a_selPelajaran = mysql_fetch_array($selPelajaran))
										{
											?>
												<tr style="height:15px;">
													<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
														<?
															echo $no;
														?>
													</td>
													<td style="width:250px;border-right:solid 1px #ccc;">
														<?
															echo "<b>".$a_selPelajaran['pelajaran']."</b><br>";
															
															//guru pelajaran
															$guruPengajar = mysql_query("select * from m_gurupelajaran where pelajaran='$a_selPelajaran[pelajaran]' and kelas='$a_detailSiswa[kelas]'");
															$a_guruPelajaran = mysql_fetch_array($guruPengajar);
															
															echo " <font style='font-size:10px;'><i>".$a_guruPelajaran['nama']."</i></font>";
														?>
													</td>
													<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
														<?
															$replace = str_replace(" ", "_", $a_selPelajaran['pelajaran']);
															$tablePelajaran = $replace.$a_detailSiswa['kelas']."Pengetahuan";

															$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tablePelajaran'");
															$a_cekTable = mysql_fetch_array($cekTable);

															if($a_cekTable['jumTable'] != 0)
															{
																$tugas = 0;
																$jumTugas = 0;
																$selTugas = mysql_query("select * from $tablePelajaran where noInduk='$a_detailSiswa[noInduk]' and tag='T'");
																while($a_selTugas = mysql_fetch_array($selTugas))
																{
																	$tugas = $tugas + $a_selTugas['nilai'];
																	$jumTugas = $jumTugas + 1;
																}

																$UH = 0;
																$jumUH = 0;
																$selUH = mysql_query("select * from $tablePelajaran where noInduk='$a_detailSiswa[noInduk]' and tag='UH'");
																while($a_selUH = mysql_fetch_array($selUH))
																{
																	$cekRemidi = mysql_query("select * from $tablePelajaran where noInduk='$a_detailSiswa[noInduk]' and tag='R' and urutan='$a_selUH[urutan]'");
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
																$selUTS = mysql_query("select * from $tablePelajaran where noInduk='$a_detailSiswa[noInduk]' and tag='UTS'");
																while($a_selUTS = mysql_fetch_array($selUTS))
																{
																	$uts = $uts + $a_selUTS['nilai'];
																	$jumUts = $jumUts + 1;
																}

																$uas = 0;
																$jumUas = 0;
																$selUAS = mysql_query("select * from $tablePelajaran where noInduk='$a_detailSiswa[noInduk]' and tag='UAS'");
																while($a_selUAS = mysql_fetch_array($selUAS))
																{
																	$uas = $uas + $a_selUAS['nilai'];
																	$jumUas = $jumUas + 1;
																}

																$nilaiT = @($tugas / $jumTugas);
																$nilaiUH = @($UH / $jumUH);
																$nilaiUTS = @($uts / $jumUts);
																$nilaiUAS = @($uas / $jumUas);

																$NH = @(($nilaiT + $nilaiUH)/2);
																$NA = round(@(((2*$NH) + $nilaiUTS + $nilaiUAS)/4),2);

																$skala4 = round((@($NA/100)*4),2);
																echo $skala4." / ".konversiHuruf($skala4);
															}

															else
															{
																echo "-";
															}
														?>
													</td>
													<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
														<?
															$tableKeterampilan = $replace.$a_detailSiswa['kelas']."Keterampilan";

															$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableKeterampilan'");
															$a_cekTable = mysql_fetch_array($cekTable);

															if($a_cekTable['jumTable'] != 0)
															{
																$praktek = 0;
																$jumPraktek = 0;
																$selPraktek = mysql_query("select * from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and tag='Praktek'");
																while($a_selPraktek = mysql_fetch_array($selPraktek))
																{
																	$praktek = $praktek + $a_selPraktek['nilai'];
																	$jumPraktek = $jumPraktek + 1;
																}

																$project = 0;
																$jumProject = 0;
																$selProject = mysql_query("select * from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and tag='Project'");
																while($a_selProject = mysql_fetch_array($selProject))
																{
																	$project = $project + $a_selProject['nilai'];
																	$jumProject = $jumProject + 1;
																}

																$porto = 0;
																$jumPorto = 0;
																$selPorto = mysql_query("select * from $tableKeterampilan where noInduk='$a_detailSiswa[noInduk]' and tag='Portofolio'");
																while($a_selPorto = mysql_fetch_array($selPorto))
																{
																	$porto = $porto + $a_selPorto['nilai'];
																	$jumPorto = $jumPorto + 1;
																}

																$nilaiPraktek = @($praktek / $jumPraktek);
																$nilaiProject = @($project / $jumProject);
																$nilaiPorto = @($porto / $jumPorto);

																$NAKet = round(@(($nilaiPraktek + $nilaiProject + $nilaiPorto)/3),2);

																$skala4 = round((@($NAKet/100)*4),2);
																echo $skala4." / ".konversiHuruf($skala4);
															}

															else
															{
																echo "-";
															}	
														?>
													</td>
													<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
														<?
															$tableSikap = $replace.$a_detailSiswa['kelas']."Sikap";

															$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableSikap'");
															$a_cekTable = mysql_fetch_array($cekTable);

															if($a_cekTable['jumTable'] != 0)
															{
																$core = 0;
																$jumCore = 0;
																$selSikap = mysql_query("select distinct(sikap) as sikap from $tableSikap where noInduk='$a_detailSiswa[noInduk]' order by marker asc");
																while($a_selSikap = mysql_fetch_array($selSikap))
																{
																	$jumTag = 0;
																	$rowTag = 0;
																	$selTag = mysql_query("select distinct(tag) as jenis from $tableSikap where noInduk='$a_detailSiswa[noInduk]' and sikap='$a_selSikap[sikap]'");
																	while($a_selTag = mysql_fetch_array($selTag))
																	{
																		$select = mysql_query("select sum(nilai) as nilai from $tableSikap where noInduk='$a_detailSiswa[noInduk]' and tag='$a_selTag[jenis]' and sikap='$a_selSikap[sikap]'");
																		$a_select = mysql_fetch_array($select);

																		$row = mysql_query("select count(*) as row from $tableSikap where noInduk='$a_detailSiswa[noInduk]' and tag='$a_selTag[jenis]' and sikap='$a_selSikap[sikap]'");
																		$a_row = mysql_fetch_array($row);

																		$rataTag = @($a_select['nilai'] / $a_row['row']);
																		$jumTag = $jumTag + $rataTag;
																		$rowTag = $rowTag + 1;
																	}
																	$core = $core + @($jumTag / $rowTag);
																	$jumCore = $jumCore + 1;
																}

																$NA = @($core / $jumCore);
																$skala4 = round(@(($NA/100)*4),2);
																$huruf = konversiHuruf($skala4);
																echo $skala4." / ".konversiPredikat($huruf);
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

							<br>
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

							<div style="float:left;margin:20 0 0 10;">
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
								Orang Tua / Wali Murid
								<br><br><br><br><br>
								(..........................)
							</div>

							<div style="width:200px;height:100px;float:right;font-size:12px;margin:33 20 0 0;text-align:Center;">
								<!--Bojonegoro, <?//echo date(d)." ".bulan(date(m))." ".date(Y)?><br>-->
								Bojonegoro, 20 Desember 2014<br>
								Wali Kelas
								<br><br><br><br><br>
								<?echo $_SESSION['nama']?>
							</div>
						</div>
					</div>
				</body>
			</html>
		<?
	}
?>

