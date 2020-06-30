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
							width:10cm;
							height:5cm;
							float:right;
							margin:10 0 20 20;
							text-align:left;
							font-family:'Tahoma';
							font-size:12px;
						}

						#header1
						{
							width:10cm;
							height:5cm;
							float:right;
							margin:-50 0 0 550;
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
					?>
				</head>

				<body style="font-family:'tahoma';font-size:12px;overflow-x:hidden;">
					<div style="width:19.5cm;height:26.5cm;">
						<div style="height:12%;width:98%;margin:0 0 0 8;">
							<img src="../../images/Pic/logo.png" style="float:left;margin:5 0 0 30;" width="80" height="80">
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

						<div style="clear:both;"></div>

						<table style="margin:30 20 0 15;font-size:10px;">
							<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:20px;">
								<td rowspan="2" style="width:30px;border:solid 1px #ccc;border-left:solid 1px #ccc;font-size:9px;">NO</td>
								<td rowspan="2" style="width:200px;border:solid 1px #ccc;font-size:9px;">MATA PELAJARAN</td>
								<td rowspan="2" style="width:30px;border:solid 1px #ccc;font-size:9px;">KKM</td>
								<td colspan="3" style="border:solid 1px #ccc;font-size:9px;">T.OBSERVASI</td>
								<td colspan="3" style="border:solid 1px #ccc;font-size:9px;">T.PROYEK</td>
								<td colspan="3" style="border:solid 1px #ccc;font-size:9px;">T.TERSTRUKTUR</td>
								<td colspan="6" style="border:solid 1px #ccc;font-size:9px;">NILAI UH</td>
								<td rowspan="2" style="width:20px;border:solid 1px #ccc;font-size:9px;">UTS</td>
							</tr>
							<tr style="text-align:Center;font-weight:bold;background:#b0e0e6;height:10px;">
								<?
									for($a=1;$a<=3;$a++)
									{
										?>
											<td style="width:20px;border:solid 1px #ccc;font-size:9px;">
												<?
													echo "TO".$a;
												?>
											</td>			
										<?
									}
									
									for($a=1;$a<=3;$a++)
									{
										?>
											<td style="width:20px;border:solid 1px #ccc;font-size:9px;">
												<?
													echo "TP".$a;
												?>
											</td>			
										<?
									}
									
									for($a=1;$a<=3;$a++)
									{
										?>
											<td style="width:20px;border:solid 1px #ccc;font-size:9px;">
												<?
													echo "TT".$a;
												?>
											</td>			
										<?
									}
									
									for($b=1;$b<=3;$b++)
									{
										?>
											<td style="width:20px;border:solid 1px #ccc;font-size:9px;">
												<?
													echo "UH".$b;
												?>
											</td>
											<td style="width:20px;border:solid 1px #ccc;font-size:9px;">
												<?
													echo "R".$b;
												?>
											</td>
										<?
									}
								?>
							</tr>
							<?
								$no = 1;
								$selPelajaran = mysql_query("select * from m_pelajaran where $a_detailSiswa[kelas]='1' and uts='1' order by urutanCetak asc");
								while($a_selPelajaran = mysql_fetch_array($selPelajaran))
								{
									$replace = str_replace(" ", "_", $a_selPelajaran['pelajaran']);
									$table = $replace.$a_detailSiswa['kelas'];
									?>
										<tr style="height:15px;">
											<td style="width:30px;border:solid 1px #ccc;text-align:center;">
												<?
													echo $no;
												?>
											</td>
											<td style="width:160px;border:solid 1px #ccc;">
												<?
													echo $a_selPelajaran['display'];
												?>
											</td>
											<td style="width:30px;border:solid 1px #ccc;text-align:Center;">
												<?
													$selKKM = mysql_query("select * from m_kkm where pelajaran='$a_selPelajaran[pelajaran]' and kelas='$a_detailSiswa[kelas]'");
													$a_selKKM = mysql_fetch_array($selKKM);
													
													if(empty($a_selKKM['kkm']))
														echo "<font style='font-style:italic'>Null</font>";
													else
														echo $a_selKKM['kkm'];
												?>
											</td>
											<?
												//TUGAS OBSERVASI
												for($a=1;$a<=3;$a++)
												{
													?>
														<td style="width:20px;border:solid 1px #ccc;text-align:Center;">
															<?
																$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																$a_cekTable = mysql_fetch_array($cekTable);

																if($a_cekTable['jumTable'] != 0)
																{
																	$selTugas = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='TO' and urutan='$a'");
																	$a_selTugas = mysql_fetch_array($selTugas);

																	if($a_selTugas['nilai'] == "0")
																		echo "0";
																	elseif($a_selTugas['nilai'] == "")
																		echo "-";
																	else
																		echo $a_selTugas['nilai'];
																}

																else
																{
																	echo "-";
																}
															?>
														</td>			
													<?
												}
												
												//TUGAS PROYEK
												for($a=1;$a<=3;$a++)
												{
													?>
														<td style="width:20px;border:solid 1px #ccc;text-align:Center;">
															<?
																$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																$a_cekTable = mysql_fetch_array($cekTable);

																if($a_cekTable['jumTable'] != 0)
																{
																	$selTugas = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='TP' and urutan='$a'");
																	$a_selTugas = mysql_fetch_array($selTugas);

																	if($a_selTugas['nilai'] == "0")
																		echo "0";
																	elseif($a_selTugas['nilai'] == "")
																		echo "-";
																	else
																		echo $a_selTugas['nilai'];
																}

																else
																{
																	echo "-";
																}
															?>
														</td>			
													<?
												}
												
												//TUGAS TERSTRUKUR
												for($a=1;$a<=3;$a++)
												{
													?>
														<td style="width:20px;border:solid 1px #ccc;text-align:Center;">
															<?
																$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																$a_cekTable = mysql_fetch_array($cekTable);

																if($a_cekTable['jumTable'] != 0)
																{
																	$selTugas = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='TT' and urutan='$a'");
																	$a_selTugas = mysql_fetch_array($selTugas);

																	if($a_selTugas['nilai'] == "0")
																		echo "0";
																	elseif($a_selTugas['nilai'] == "")
																		echo "-";
																	else
																		echo $a_selTugas['nilai'];
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
														<td style="width:20px;border:solid 1px #ccc;text-align:Center;">
															<?
																$cekTableUH = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
																$a_cekTableUH = mysql_fetch_array($cekTableUH);

																if($a_cekTableUH['jumTable'] != 0)
																{
																	$selUH = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UH' and urutan='$b'");
																	$a_selUH = mysql_fetch_array($selUH);

																	if($a_selUH['nilai'] == "0")
																		echo "0";
																	elseif($a_selUH['nilai'] == "")
																		echo "-";
																	else
																		echo $a_selUH['nilai'];
																}

																else
																{
																	echo "-";
																}
															?>
														</td>
														<td style="width:20px;border:solid 1px #ccc;text-align:Center;">
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
											<td style="width:20px;border:solid 1px #ccc;text-align:Center;">
												<?
													$cekTableUTS = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
													$a_cekTableUTS = mysql_fetch_array($cekTableUTS);

													if($a_cekTableUTS['jumTable'] != 0)
													{
														$selUTS = mysql_query("select * from $table where noInduk='$a_detailSiswa[noInduk]' and tag='UTS'");
														$a_selUTS = mysql_fetch_array($selUTS);

														if($a_selUTS['nilai'] == "0")
															echo "0";
														elseif($a_selUTS['nilai'] == "")
															echo "-";
														else
															echo $a_selUTS['nilai'];
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
							?>
						</table>

						<br><br>
						<font style="font-size:12px;margin:0 0 0 20;font-weight:bold;">PENGEMBANGAN DIRI</font>
						<table style="font-size:12px;margin:5 20 0 20;">
							<tr style="text-align:center;font-weight:bold;background:#b0e0e6;height:20px;">
								<td style="width:50px;border:solid 1px #ccc;">NO</td>
								<td style="width:305px;border:solid 1px #ccc;">JENIS KEGIATAN</td>
								<td style="width:150px;border:solid 1px #ccc;">PREDIKAT</td>
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
											<td style="width:50px;border:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
												<?
													echo $number;
												?>
											</td>
											<td style="width:305px;border:solid 1px #ccc;">
												<?
													echo $a_ekstra['ekstra'];
												?>
											</td>
											<td style="width:150px;border:solid 1px #ccc;text-align:Center;">
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
											<td style="width:305px;border:solid 1px #ccc;">
									
											</td>
											<td style="width:150px;border:solid 1px #ccc;text-align:Center;">
									
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

						<br><br>
						<font style="font-size:12px;margin:0 0 0 20;font-weight:bold;">KETIDAKHADIRAN</font>
						<table style="font-size:12px;margin:5 20 0 20;">
							<?
								$tidakhadir = mysql_query("select * from tbl_absen where noInduk='$a_detailSiswa[noInduk]' and kelas='$a_detailSiswa[kelas]'");
								$a_tidakhadir = mysql_fetch_array($tidakhadir);
							?>
							<tr style="text-align:center;font-weight:bold;background:#b0e0e6;height:20px;">
								<td style="width:50px;border:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:460px;border:solid 1px #ccc;">ALASAN</td>
								<td style="width:150px;border:solid 1px #ccc;">LAMA</td>
							</tr>
							<tr style="height:15px;">
								<td style="width:50px;border:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">1</td>
								<td style="width:460px;border:solid 1px #ccc;">Ijin</td>
								<td style="width:150px;border:solid 1px #ccc;text-align:center;">
									<?
										if(empty($a_tidakhadir['ijin']))
											echo "- Hari";
										else
											echo $a_tidakhadir['ijin']." Hari";
									?>
								</td>
							</tr>
							<tr style="height:15px;">
								<td style="width:50px;border:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">2</td>
								<td style="width:460px;border:solid 1px #ccc;">Sakit</td>
								<td style="width:150px;border:solid 1px #ccc;text-align:center;">
									<?
										if(empty($a_tidakhadir['sakit']))
											echo "- Hari";
										else
											echo $a_tidakhadir['sakit']." Hari";
									?>
								</td>
							</tr>
							<tr style="height:15px;">
								<td style="width:50px;border:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">3</td>
								<td style="width:460px;border:solid 1px #ccc;">Tanpa Keterangan</td>
								<td style="width:150px;border:solid 1px #ccc;text-align:center;">
									<?
										if(empty($a_tidakhadir['alpha']))
											echo "- Hari";
										else
											echo $a_tidakhadir['alpha']." Hari";
									?>
								</td>
							</tr>
						</table>

						<div style="width:200px;height:100px;float:left;margin:50 0 0 20;font-size:12px;text-align:center;">
							Orang Tua / Wali Murid
							<br><br><br><br><br>
							(..........................)
						</div>

						<div id="signature">
							Bojonegoro, 8 Oktober 2016<?//echo date(d)." ".bulan(date(m))." ".date(Y)?><br>
							Wali Kelas <?echo $a_detailSiswa['kelas']?>
							<br><br><br><br><br>
							<?echo $_SESSION['nama']?>
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
		$html2pdf = new HTML2PDF('P','A4','en', false, 'UTF-8',array(5, 5, 5, 5));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>