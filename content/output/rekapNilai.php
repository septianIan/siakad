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
					<title>Rekap Nilai <?echo $decode['pelajaran']." ".$decode['kelas']?></title>
				</head>
				<body style="font-size:11px;font-family:'Tahoma';">
					<?
						$thnAjaran = mysql_query("select * from m_param where param='thnAjaran'");
						$a_thnAjaran = mysql_fetch_array($thnAjaran);
						
						$semester = mysql_query("select * from m_param where param='semester'");
						$a_semester = mysql_fetch_array($semester);
					?>
					<table style="font-size:12px;">
						<tr>
							<td style="width:1050px;" colspan="2">
								<img src="../../images/Pic/logo.png" width="50" height="50" style="margin:0 0 5 200;float:left;">
								<div style="width:500px;height:60px;float:left;margin:0 0 0 0;text-align:center;">
									<font style="font-size:16px;text-transform:uppercase;font-weight:bold;">REKAPITULASI NILAI <?echo $decode['pelajaran']." Kelas ".$decode['kelas']?></font><br>
									<font style="font-size:14px;font-weight:bold;">SMP Muhammadiyah 9 Bojonegoro</font><br>
									<font style="font-size:12px;"><?echo "Semester ".$a_semester['value']." Tahun Ajaran ".$a_thnAjaran['value']?></font>
								</div>
							</td>
						</tr>
						<tr>
							<td style="" colspan="2">
								<table style="font-size:12px;" cellspacing="0">
									<tr>
										<tr style="background:#b0e0e6;text-align:center;height:30px;font-weight:bold;">
											<td style="width:30px;border:solid 1px #000;">NO</td>
											<td style="width:50px;border:solid 1px #000;border-left:none;">INDUK</td>
											<td style="width:200px;border:solid 1px #000;border-left:none;">NAMA SISWA</td>
											<td style="width:30px;border:solid 1px #000;border-left:none;">KKM</td>
											<?
												$table = str_replace(" ","_",$decode['pelajaran']).$decode['kelas'];
												$tag = mysql_query("select distinct(tag) as tag from $table order by marker asc");
												while($a_tag = mysql_fetch_array($tag))
												{
													$urutan = mysql_query("select distinct(urutan) as urutan from $table where tag='$a_tag[tag]' order by urutan asc");
													while($a_urutan = mysql_fetch_array($urutan))
													{
														if($a_tag['tag'] != "R")
														{
															if($a_tag['tag'] == "UH")
															{
																?>
																	<td style="border:solid 1px #000;border-left:none;width:30px;">
																		<?
																			echo $a_tag['tag'].$a_urutan['urutan']
																		?>
																	</td>
																	<td style="border:solid 1px #000;border-left:none;width:30px;">
																		<?
																			echo "R ".$a_urutan['urutan']
																		?>
																	</td>
																<?
															}

															elseif($a_tag['tag'] == "UTS" or $a_tag['tag'] == "UAS")
															{
																?>
																	<td style="border:solid 1px #000;border-left:none;width:30px;">
																		<?
																			echo $a_tag['tag']
																		?>
																	</td>
																<?	
															}

															else
															{
																?>
																	<td style="border:solid 1px #000;border-left:none;width:30px;">
																		<?
																			echo $a_tag['tag'].$a_urutan['urutan']
																		?>
																	</td>
																<?	
															}
														}

														else
														{

														}
													}
												}
											?>
											<td style="border:solid 1px #000;border-left:none;width:30px;">RT</td>
											<td style="border:solid 1px #000;border-left:none;width:30px;">RUH</td>
											<td style="border:solid 1px #000;border-left:none;width:30px;">NH</td>
											<td style="border:solid 1px #000;border-left:none;width:30px;">NA</td>
											<td style="border:solid 1px #000;border-left:none;width:75px;">KET.</td>
										</tr>
										<?
											$number = 1;
											
											$selKkm = mysql_query("select * from m_kkm where pelajaran='$decode[pelajaran]' and kelas='$decode[kelas]'");
											$a_selKkm = mysql_fetch_array($selKkm);
											
											$murid = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
											while($a_murid = mysql_fetch_array($murid))
											{
												?>
													<tr style="background:#ffffff;">
														<td style="border:solid 1px #000;border-top:none;text-align:center;">
															<?
																echo $number
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																echo $a_murid['noInduk'];
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;">
															<?
																echo $a_murid['nama'];
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																echo $a_selKkm['kkm'];
															?>
														</td>
														<?	
															$nilaiT = 0;
															$jumT = 0;
															$nilaiUH = 0;
															$jumUH = 0;
															$nilaiUTS = 0;
															$jumUTS = 0;
															$nilaiUAS = 0;
															$jumUAS = 0;

															$tagNilai = mysql_query("select distinct(tag) as tag from $table order by marker asc");
															while($a_tagNilai = mysql_fetch_array($tagNilai))
															{
																$urutanNilai = mysql_query("select distinct(urutan) as urutan from $table where tag='$a_tagNilai[tag]' order by urutan asc");
																while($a_urutanNilai = mysql_fetch_array($urutanNilai))
																{
																	$nilaiTarget = mysql_query("select * from $table where noInduk='$a_murid[noInduk]' and tag='$a_tagNilai[tag]' and urutan='$a_urutanNilai[urutan]'");
																	$a_nilaiTarget = mysql_fetch_array($nilaiTarget);

																	if($a_tagNilai['tag'] != "R")
																	{
																		if($a_tagNilai['tag'] == "UH")
																		{
																			?>
																				<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
																					<?
																						if($a_nilaiTarget['nilai'] < $a_selKkm['kkm'])
																						{
																							echo "<font style='color:Red;'>".$a_nilaiTarget['nilai']."</font>";
																						}

																						else
																						{
																							echo "<font style='color:Black;'>".$a_nilaiTarget['nilai']."</font>";
																						}
																					?>
																				</td>
																			<?

																			$selectRemidi = mysql_query("select * from $table where tag='R' and urutan='$a_urutanNilai[urutan]' and noInduk='$a_murid[noInduk]'");
																			$a_selectRemidi = mysql_fetch_array($selectRemidi);
																			?>
																				<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
																					<?
																						echo $a_selectRemidi['nilai']
																					?>
																				</td>
																			<?

																			if(empty($a_selectRemidi['nilai']))
																			{
																				$nilaiUH = $nilaiUH + $a_nilaiTarget['nilai'];
																				$jumUH = $jumUH + 1;
																			}

																			else
																			{
																				$nilaiUH = $nilaiUH + $a_selectRemidi['nilai'];
																				$jumUH = $jumUH + 1;
																			}
																		}

																		else
																		{																			
																			?>
																				<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
																					<?
																						if($a_nilaiTarget['nilai'] < $a_selKkm['kkm'])
																						{
																							echo "<font style='color:Red;'>".$a_nilaiTarget['nilai']."</font>";
																						}

																						else
																						{
																							echo "<font style='color:Black;'>".$a_nilaiTarget['nilai']."</font>";
																						}
																					?>
																				</td>
																			<?

																			if($a_tagNilai['tag'] == "TO" or $a_tagNilai['tag'] == "TP" or $a_tagNilai['tag'] == "TT")
																			{
																				$nilaiT = $nilaiT + $a_nilaiTarget['nilai'];
																				$jumT = $jumT + 1;
																			}

																			elseif($a_tagNilai['tag'] == "UTS")
																			{
																				$nilaiUTS = $nilaiUTS + $a_nilaiTarget['nilai'];
																				$jumUTS = $jumUTS + 1;
																			}

																			elseif($a_tagNilai['tag'] == "UAS")
																			{
																				$nilaiUAS = $nilaiUAS + $a_nilaiTarget['nilai'];
																				$jumUAS = $jumUAS + 1;
																			}

																			else
																			{

																			}
																		}
																	}

																	else
																	{
																		//nothing
																	}
																}
															}
														?>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																//rata-rata tugas
																$rataT = round(@($nilaiT / $jumT),2);
																echo $rataT;
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																//rata-rata ulangan harian
																$rataUH = round(@($nilaiUH / $jumUH),2);
																echo $rataUH;
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																//NH -> Nilai Harian
																$nilaiHarian = round(@(((3*$rataT) + $rataUH) / 4),2);
																echo $nilaiHarian;
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																//NA -> Nilai Akhir
																$nilaiAkhir = round(@(((3*$nilaiHarian) + $nilaiUTS + (2*$nilaiUAS)) / 6),2);
																echo $nilaiAkhir;
															?>
														</td>
														<td style="border:solid 1px #000;border-top:none;border-left:none;text-align:center;">
															<?
																if($nilaiAkhir < $a_selKkm['kkm'])
																	echo "<font style='color:red;'>Blm.Tuntas</font>";
																else
																	echo "<font style='color:Green;'>Tuntas</font>";
															?>
														</td>
													</tr>
												<?
												$number = $number + 1;
											}
										?>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width:700px;"></td>
							<td style="">
								<div style="width:200px;height:100px;text-align:Center;margin:50 0 0 0;">
									Guru pengajar mata pelajaran<br><br><br><br><br>
									<?
										$guru = mysql_query("select * from m_gurupelajaran where pelajaran='$decode[pelajaran]' and kelas='$decode[kelas]'");
										$a_guru = mysql_fetch_array($guru);
										echo "<b>".$a_guru['nama']."</b>";
									?>
								</div>
							</td>
						</tr>
					</table>
				</body>
			</html>
		<?
	}

	$filename="Rekap_Nilai_".$decode['pelajaran']."_".$decode['kelas'].".pdf";
	
	$content = ob_get_clean();
	require_once('html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('L','A4','en', false, 'UTF-8',array(5, 5, 5, 5));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content);
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>