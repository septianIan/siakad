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
					<title>Raport UTS <?echo $a_detailSiswa['nama']?></title>

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
							width:20cm;
							height:5cm;
							float:right;
							margin:15 0 0 20;
							text-align:left;
							font-family:'Tahoma';
							font-size:11px;
						}

						#header1
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:-45 0 0 850;
							text-align:left;
							font-family:'Tahoma';
							font-size:11px;
						}

						#sikap
						{
							width:500px;
							height:120px;
							float:left;
							margin:-115 0 0 525;
							text-align:left;
							font-family:'Tahoma';
							font-size:11px;
						}

						#signature
						{
							width:200px;;
							height:100px;
							border:Solid 1px black;
							float:left;
							margin:0 0 0 0;
							text-align:center;
							font-family:'Tahoma';
							font-size:11px;
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
					?>
				</head>

				<body style="font-family:'tahoma';font-size:12px;overflow-x:hidden;">
					<div style="width:26.5cm;height:19.5cm;margin:5 0 0 0;">
						<div style="height:12%;width:98%;margin:0 0 0 8;">
							<img src="../../images/Pic/logo.png" style="float:left;margin:5 0 0 200;" width="80" height="80">
							<div style="width:15cm;height:2cm;float:left;margin:10 0 0 10;text-align:center;">
								<font style="font-size:20px;text-transform:uppercase;"><?echo $a_namaSekolah['value']?></font><br>
								<font style="font-size:18px;text-transform:uppercase;">LAPORAN PENILAIAN HASIL BELAJAR TENGAH SEMESTER</font><br>
								<font style="font-size:12px;"><?echo $a_alamatSekolah['value']." Telp:".$a_telpSekolah['value']?></font><br>
								<font style="font-size:12px;"><?echo $a_webSekolah['value']." Email:".$a_emailSekolah['value']?></font><br>
							</div>
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
						</table>

						<table style="margin:20 20 0 20;font-size:11px;">
							<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
								<td rowspan="3" style="width:30px;border:solid 1px #ccc;">NO</td>
								<td rowspan="3" style="width:150px;border:solid 1px #ccc;">MATA PELAJARAN</td>
								<td colspan="9" style="border:solid 1px #ccc;">PENGETAHUAN</td>
								<td rowspan="3" style="width:35px;border:solid 1px #ccc;">UTS</td>
								<td colspan="9" style="border:solid 1px #ccc;text-align:center;">KETERAMPILAN</td>
								<td colspan="2" style="border:solid 1px #ccc;">SIKAP</td>
							</tr>
							<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
								<td colspan="3" style="border:solid 1px #ccc;">TUGAS</td>
								<td colspan="6" style="border:solid 1px #ccc;">ULANGAN HARIAN</td>
								<td colspan="3" style="border:solid 1px #ccc;">PRAKTEK</td>
								<td colspan="3" style="border:solid 1px #ccc;">PROJECT</td>
								<td colspan="3" style="border:solid 1px #ccc;">PORTOFOLIO</td>
								<td rowspan="2" style="width:40px;border-right:solid 1px #ccc;font-size:10px;">DALAM<br>MAPEL<br>SB/B/C/K</td>
								<td rowspan="2" style="width:50px;border-right:solid 1px #ccc;font-size:10px;">ANTAR<br>MAPEL<br>DESKRIPSI</td>
							</tr>
							<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
								<?
									for($a=1;$a<=3;$a++)
									{
										?>
											<td style="width:30px;border:solid 1px #ccc;">
												<?
													echo "T".$a;
												?>
											</td>			
										<?
									}
									for($b=1;$b<=3;$b++)
									{
										?>
											<td style="width:30px;border:solid 1px #ccc;">
												<?
													echo "UH".$b;
												?>
											</td>
											<td style="width:30px;border:solid 1px #ccc;">
												<?
													echo "R".$b;
												?>
											</td>
										<?
									}

									for($c=1;$c<=3;$c++)
									{
										?>
											<td style="width:30px;border:solid 1px #ccc;">
												<?
													echo "Prk.".$c;
												?>
											</td>			
										<?
									}

									for($d=1;$d<=3;$d++)
									{
										?>
											<td style="width:30px;border:solid 1px #ccc;">
												<?
													echo "Prj.".$d;
												?>
											</td>			
										<?
									}

									for($e=1;$e<=3;$e++)
									{
										?>
											<td style="width:30px;border:solid 1px #ccc;">
												<?
													echo "Prto.".$e;
												?>
											</td>			
										<?
									}
								?>
							</tr>
							<?
								$jumSpan = 0;
								$jumAntar = 0;
								$rowAntar = 0;
								$selRowspan = mysql_query("select distinct(kelompok) as kelompok from m_pelajaran where $a_detailSiswa[kelas]='1' and uts='1' order by kelompok asc");
								while($a_selRowspan = mysql_fetch_array($selRowspan))
								{
									$selPelajaran = mysql_query("select * from m_pelajaran where kelompok='$a_selRowspan[kelompok]' and $a_detailSiswa[kelas]='1' and uts='1' order by pelajaran asc");
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
								<td colspan="22" style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;"></td>
								<td rowspan="<?echo $jumSpan?>" style="border:solid 1px #ccc;font-style:italic;width:80px;font-size:11px;vertical-align:middle;">
									<?
										$antar = @($jumAntar / $rowAntar);
										$skala41 = round(@(($antar/100)*4),2);
										$hurufAntar = konversiHuruf($skala41);
										$predikatAntar = konversiPredikat($hurufAntar);

										if($predikatAntar == "SB")
										{
											$ketAntar = "SANGAT<br>BAIK";
											$saran = " sehingga<br>perlu dipertahankan";
										}

										elseif($predikatAntar == "B")
										{
											$ketAntar = "BAIK";
											$saran = " sehingga perlu<br>ditingkatkan";	
										}

										elseif($predikatAntar == "C")
										{
											$ketAntar = "CUKUP";
											$saran = " sehingga sangat<br>perlu ditingkatkan";	
										}

										elseif($predikatAntar == "K")
										{
											$ketAntar = "KURANG";
											$saran = " sehingga sangat<br>perlu pembinaan lebih lanjut";	
										}
										echo "Secara umum<br>kemampuan sikap<br>spiritual dan sosial<br><b>".$ketAntar."</b> ".$saran;
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
											<td colspan="22" style="width:250px;border-right:solid 1px #ccc;background:#efefef;border-left:solid 1px #ccc;"><?echo $kelompok?></td>
										</tr>
									<?
								
									$selPelajaran = mysql_query("select * from m_pelajaran where $a_detailSiswa[kelas]='1' and uts='1' and kelompok='$a_selMapel[kelompok]' order by pelajaran asc");
									while($a_selPelajaran = mysql_fetch_array($selPelajaran))
									{
										$replace = str_replace(" ", "_", $a_selPelajaran['pelajaran']);
										$table = $replace.$a_detailSiswa['kelas']."Pengetahuan";
										$tableSatu = $replace.$a_detailSiswa['kelas']."Keterampilan";
										?>
											<tr style="height:15px;">
												<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
													<?
														echo $no;
													?>
												</td>
												<td style="width:150px;border:solid 1px #ccc;">
													<?
														echo $a_selPelajaran['pelajaran'];
													?>
												</td>
												<?
													for($a=1;$a<=3;$a++)
													{
														?>
															<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
																<?
																	$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																	$a_cekTable = mysql_fetch_array($cekTable);

																	if($a_cekTable['jumTable'] != 0)
																	{
																		$selTugas = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='T' and urutan='$a'");
																		$a_selTugas = mysql_fetch_array($selTugas);
																		$r_selTugas = mysql_num_rows($selTugas);
																		
																		if($r_selTugas != 0)
																		{
																			echo $a_selTugas['nilai'];
																		}
																		
																		else
																		{
																			echo "-";
																		}
																	}

																	else
																	{
																		echo "-";
																	}
																?>
															</td>			
														<?
													}

													for($b=1;$b<=3;$b++)
													{
														?>
															<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
																<?
																	$cekTableUH = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																	$a_cekTableUH = mysql_fetch_array($cekTableUH);

																	if($a_cekTableUH['jumTable'] != 0)
																	{
																		$selUH = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UH' and urutan='$b'");
																		$a_selUH = mysql_fetch_array($selUH);
																		$r_selUH = mysql_num_rows($selUH);
																		
																		if($r_selUH != 0)
																		{
																			echo $a_selUH['nilai'];
																		}
																		
																		else
																		{
																			echo "-";
																		}
																	}

																	else
																	{
																		echo "-";
																	}
																?>
															</td>
															<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
																<?
																	$cekTableRemidi = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																	$a_cekTableRemidi = mysql_fetch_array($cekTableRemidi);

																	if($a_cekTableRemidi['jumTable'] != 0)
																	{
																		$selRemidi = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='R' and urutan='$b'");
																		$a_selRemidi = mysql_fetch_array($selRemidi);

																		if(empty($a_selRemidi['nilai']))
																			echo "-";
																		else
																			echo $a_selRemidi['nilai'];
																	}

																	else
																	{
																		echo "-";
																	}
																?>
															</td>			
														<?
													}
													
													?>
														<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
															<?
																$cekTableUTS = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																$a_cekTableUTS = mysql_fetch_array($cekTableUTS);

																if($a_cekTableUTS['jumTable'] != 0)
																{
																	$selUTS = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UTS'");
																	$a_selUTS = mysql_fetch_array($selUTS);
																	$r_selUTS = mysql_num_rows($selUTS);
																	
																	if($r_selUTS != 0)
																	{
																		echo $a_selUTS['nilai'];
																	}
																	
																	else
																	{
																		echo "-";
																	}
																}

																else
																{
																	echo "-";
																}
															?>
														</td>
													<?
													
													for($d=1;$d<=3;$d++)
													{
														?>
															<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
																<?
																	$cekTablePraktek = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableSatu'");
																	$a_cekTablePraktek = mysql_fetch_array($cekTablePraktek);

																	if($a_cekTablePraktek['jumTable'] != 0)
																	{
																		$selPraktek = mysql_query("select * from $tableSatu where noInduk='$a_detailSiswa[noInduk]' and tag='Praktek' and urutan='$d'");
																		$a_selPraktek = mysql_fetch_array($selPraktek);
																		$r_selPraktek = mysql_num_rows($selPraktek);
																		
																		if($r_selPraktek != 0)
																		{
																			echo $a_selPraktek['nilai'];
																		}
																		
																		else
																		{
																			echo "-";
																		}
																	}

																	else
																	{
																		echo "-";
																	}
																?>
															</td>
														<?
													}

													for($e=1;$e<=3;$e++)
													{
														?>
															<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
																<?
																	$cekTableProject = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableSatu'");
																	$a_cekTableProject = mysql_fetch_array($cekTableProject);

																	if($a_cekTableProject['jumTable'] != 0)
																	{
																		$selProject = mysql_query("select * from $tableSatu where noInduk='$a_detailSiswa[noInduk]' and tag='Project' and urutan='$e'");
																		$a_selProject = mysql_fetch_array($selProject);
																		$r_selProject = mysql_num_rows($selProject);
																		
																		if($r_selProject != 0)
																		{
																			echo $a_selProject['nilai'];
																		}
																		
																		else
																		{
																			echo "-";
																		}
																	}

																	else
																	{
																		echo "-";
																	}
																?>
															</td>
														<?
													}

													for($f=1;$f<=3;$f++)
													{
														?>
															<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
																<?
																	$cekTablePorto = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$tableSatu'");
																	$a_cekTablePorto = mysql_fetch_array($cekTablePorto);

																	if($a_cekTablePorto['jumTable'] != 0)
																	{
																		$selPorto = mysql_query("select * from $tableSatu where noInduk='$a_detailSiswa[noInduk]' and tag='Portofolio' and urutan='$f'");
																		$a_selPorto = mysql_fetch_array($selPorto);
																		$r_selPorto = mysql_num_rows($selPorto);
																		
																		if($r_selPorto != 0)
																		{
																			echo $a_selPorto['nilai'];
																		}
																		
																		else
																		{
																			echo "-";
																		}
																	}

																	else
																	{
																		echo "-";
																	}
																?>
															</td>
														<?
													}
												?>
												<td style="width:40px;border:solid 1px #ccc;text-align:center;font-size:11px;">
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
															echo $skala4."/".konversiPredikat($huruf);
														}

														else
														{
															echo "-";
														}	
													?>
												</td>
											</tr>
										<?
										$no=$no+1;
									}
								}
							?>
						</table>

						<div style="width:500px;height:120px;float:left;">
							<table style="font-size:11px;margin:5 10 0 20;">
								<tr>
									<td colspan="4"><b>PENGEMBANGAN DIRI</b></td>
								</tr>
								<tr style="text-align:center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td style="width:50px;border:solid 1px #ccc;">NO</td>
									<td style="width:150px;border:solid 1px #ccc;">JENIS KEGIATAN</td>
									<td style="width:100px;border:solid 1px #ccc;">PREDIKAT</td>
									<td style="width:150px;border:solid 1px #ccc;">KETERANGAN</td>
								</tr>
								<?
									$number = 1;
									$nama = mysql_real_escape_string($a_detailSiswa['nama']);
									$ekstra = mysql_query("select * from tbl_pesertaekstra where noInduk='$a_detailSiswa[noInduk]' order by ekstra asc");
									while($a_ekstra = mysql_fetch_array($ekstra))
									{
										?>
											<tr style="height:15px;">
												<td style="width:50px;border:solid 1px #ccc;text-align:Center;">
													<?
														echo $number;
													?>
												</td>
												<td style="width:150px;border:solid 1px #ccc;">
													<?
														echo $a_ekstra['ekstra'];
													?>
												</td>
												<td style="width:100px;border:solid 1px #ccc;text-align:Center;">
													<?
														echo $a_ekstra['UTS'];
													?>
												</td>
												<td style="width:150px;border:solid 1px #ccc;text-align:Center;">
													<?
														echo predikatEkstra($a_ekstra['UTS']);
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
												<td style="width:50px;border:solid 1px #ccc;text-align:Center;">
													
												</td>
												<td style="width:150px;border:solid 1px #ccc;">
													
												</td>
												<td style="width:100px;border:solid 1px #ccc;text-align:Center;">
													
												</td>
												<td style="width:150px;border:solid 1px #ccc;text-align:Center;">
													
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
						</div>

						<div id="sikap">
							<table style="font-size:11px;">
								<tr>
									<td colspan="3"><b>KETIDAKHADIRAN</b></td>
								</tr>
								<?
									$tidakhadir = mysql_query("select * from tbl_absen where noInduk='$a_detailSiswa[noInduk]' and kelas='$a_detailSiswa[kelas]'");
									$a_tidakhadir = mysql_fetch_array($tidakhadir);
								?>
								<tr style="text-align:center;font-weight:bold;background:#b0e0e6;height:20px;">
									<td style="width:50px;border:solid 1px #ccc;">NO</td>
									<td style="width:300px;border:solid 1px #ccc;">ALASAN</td>
									<td style="width:100px;border:solid 1px #ccc;">LAMA</td>
								</tr>
								<tr style="height:15px;">
									<td style="width:50px;border:solid 1px #ccc;text-align:center;">1</td>
									<td style="width:300px;border:solid 1px #ccc;">Ijin</td>
									<td style="width:100px;border:solid 1px #ccc;text-align:center;">
										<?
											if(empty($a_tidakhadir['ijin']))
												echo "- Hari";
											else
												echo $a_tidakhadir['ijin']." Hari";
										?>
									</td>
								</tr>
								<tr style="height:15px;">
									<td style="width:50px;border:solid 1px #ccc;text-align:center;">2</td>
									<td style="width:300px;border:solid 1px #ccc;">Sakit</td>
									<td style="width:100px;border:solid 1px #ccc;text-align:center;">
										<?
											if(empty($a_tidakhadir['sakit']))
												echo "- Hari";
											else
												echo $a_tidakhadir['sakit']." Hari";
										?>
									</td>
								</tr>
								<tr style="height:15px;">
									<td style="width:50px;border:solid 1px #ccc;text-align:center;">3</td>
									<td style="width:300px;border:solid 1px #ccc;">Tanpa Keterangan</td>
									<td style="width:100px;border:solid 1px #ccc;text-align:center;">
										<?
											if(empty($a_tidakhadir['alpha']))
												echo "- Hari";
											else
												echo $a_tidakhadir['alpha']." Hari";
										?>
									</td>
								</tr>
							</table>
						</div>

						<div style="border:Solid 1px #fff;width:1000px;height:150px;margin:-20 0 0 20;font-size:11px;text-align:center;">
								<font style="margin:30 0 0 -500;">
									Orang Tua / Wali Murid
								</font>
								<br><br><br><br><br>
								<font style="margin:30 0 0 -485;">
									(..........................)
								</font>
								
							<div style="width:200px;float:right;margin:-38 0 0 600;">
								Bojonegoro, <?echo date(d)." ".bulan(date(m))." ".date(Y)?><br>
								Wali Kelas <?echo $a_detailSiswa['kelas']?>
								<br><br><br><br><br>
								<?echo $_SESSION['nama']?>
							</div>
						</div>
					</div>
				</body>
			</html>
		<?
	}

	$filename="Raport_UTS_".$a_detailSiswa['nama']."_".$a_detailSiswa['kelas'].".pdf";
	
	$content = ob_get_clean();
	require_once('html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('L','A4','en', false, 'UTF-8',array(0, 0, 0, 0));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>

