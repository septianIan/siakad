<?	
	session_start();
	include("../kernel/version.php");
	include("../secure/function.php");
	$uri = $_SERVER['REQUEST_URI'];
	$decode = decode($uri);
	
	if(empty($_SESSION['nama']) or $_SESSION['nama'] == "")
	{
		?>
			<script type="text/javascript">
				alert("Anda harus login dengan akun anda.");
				window.location = "../index.php";
			</script>
		<?
	}

	else
	{
		$detailGuru = mysql_query("select * from m_guru where id='$_SESSION[id]'");
		$a_detailGuru = mysql_fetch_array($detailGuru);
		?>	
			<html>
				<head>
					<meta charset="utf-8">
					<link rel="shortcut icon" href="../images/Icon/Pad.png" type="image/png"/>
					<title>SIAKAD SMPM9 BOJONEGORO</title>

					<link rel="stylesheet" href="../css/fontFace.css">
					<link rel="stylesheet" href="../css/css.css">
					<link rel="stylesheet" href="../css/style.css">
					<script src="js/jquery.js" type="text/javascript"></script>
					<script src="js/jquery.min.js" type="text/javascript"></script>
					<script src="js/highcharts.js" type="text/javascript"></script>

					<?
						include("jsFunction.php");
						include("phpFunction.php");
					?>
				</head>

				<body style="font-family:'Ubuntu';font-size:14px;overflow-x:hidden;">
					<?
						if($decode['doraemon'] == "detailAbsenSiswa" and $decode['act'] == "edit")
						{
							?>
								<div id="popUpTambahItem" style="position:fixed;width:400px;height:500px;border:solid 2px #9a9a9a;margin:50 0 0 400;-moz-box-shadow:inset 0px 0px 10px 0px #cdcdcd, 5px 5px 5px 1px #aaa;background:#efefef;">
							<?
						}
						
						else
						{
							?>
								<div id="popUpTambahItem" style="position:fixed;width:400px;height:500px;border:solid 2px #9a9a9a;margin:50 0 0 400;-moz-box-shadow:inset 0px 0px 10px 0px #cdcdcd, 5px 5px 5px 1px #aaa;background:#efefef;display:none;">
							<?
						}
					?>
						<div style="width:7%;height:8%;margin:5 0 0 0;float:left;">
							<img src="../images/FileTypes/TextDocument.png" height="30" width="30">
						</div>
						<div style="width:60%;height:5%;margin:3 0 0 3;float:left;font-size:16px;color:red;line-height:90%;">
							EDIT REKAP ABSEN<br>
							<?
								$dataSiswa = mysql_query("select * from m_siswa where noInduk='$decode[noInduk]' and kelas='$decode[kelas]'");
								$a_dataSiswa = mysql_fetch_array($dataSiswa);
							?>
							<font style="font-size:13px;color:dodgerblue;"><?echo $a_dataSiswa['nama']." - ".$a_dataSiswa['kelas']?></font>
						</div>
						<div style="width:100px;height:20px;float:right;margin:5 5 0 0;font-size:14px;text-align:right;">
							<?
								if(isset($decode['bulanAbsen']) and isset($decode['tahunAbsen']))
								{
									?>
										<a href="index.php?<?echo paramEncrypt('doraemon=detailAbsenSiswa&kelas='.$a_detailGuru['waliKelas'].'&tahunAbsen='.$decode['tahunAbsen'].'&bulanAbsen='.$decode['bulanAbsen'])?>" title="Tutup">
											[X] Tutup
										</a>
									<?
								}
								
								else
								{
									?>
										<a href="index.php?<?echo paramEncrypt('doraemon=detailAbsenSiswa&kelas='.$a_detailGuru['waliKelas'])?>" title="Tutup">
											[X] Tutup
										</a>
									<?
								}
							?>
						</div>
						<div style="clear:both"></div>
						
						<div style="width:98%;height:450px;border:solid 2px #aaa;margin:0 3 3 3;overflow-x:hidden;overflow-y:auto;">
							<table style="margin:5 5 5 5;background:white;">
								<?
									$jumDay = cal_days_in_month(CAL_GREGORIAN, $decode['bulanAbsen'], $decode['tahunAbsen']);
									$jumBaris = ceil($jumDay/5);
									for($r=1;$r<=$jumBaris;$r++)
									{
										?>
											<tr style="height:50px;">
												<?
													for($c=1;$c<=5;$c++)
													{
														$cur = ((($r*5)-5)+$c);
														if($cur>$jumDay)
														{
															?>
																<td style="width:75px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#aaa;">
																	
																</td>
															<?
														}
														
														else
														{
															?>
																<td style="width:75px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
																	<?
																		if(strlen($cur) == 1)
																			$tgl = "0".$cur;
																		else
																			$tgl = $cur;
																		$tglAbsen = $decode['tahunAbsen']."-".$decode['bulanAbsen']."-".$tgl;
																		
																		$cek = mysql_query("select * from tbl_rekapabsen where noInduk='$decode[noInduk]' and kelas='$decode[kelas]' and date(tgl)='$tglAbsen'");
																		$r_cek = mysql_num_rows($cek);
																		if($r_cek == 0)
																		{
																			?>
																				<font style="font-size:12px;color:red;"><?echo $tglAbsen?></font>
																				<form name="inputAbsen" method="POST" action="procContent.php?<?echo paramEncrypt('process=inputAbsenManual')?>">
																					<input type="hidden" name="tgl" value="<?echo $tglAbsen?>">
																					<input type="hidden" name="noInduk" value="<?echo $decode['noInduk']?>">
																					<input type="hidden" name="kelas" value="<?echo $decode['kelas']?>">
																					<input type="hidden" name="uri" value="<?echo $uri?>">
																					<table>
																						<tr style="border:none;">
																							<td style="width:50px;">
																								<select name="status" style="height:25px;">
																									<option value="">-</option>
																									<option value="M">Masuk</option>
																									<option value="S">Sakit</option>
																									<option value="I">Ijin</option>
																									<option value="A">Alpha</option>
																								</select>
																							</td>
																							<td style="width:25px;">
																								<input type="submit" name="simpan" value="OK" style="height:25px;color:Green;padding:0 0 0 0;">
																							</td>
																						</tr>
																					</table>
																				</form>
																			<?
																		}
																		
																		else
																		{
																			$a_cek = mysql_fetch_array($cek);
																			?>
																				<font style="font-size:12px;color:red;"><?echo $tglAbsen?></font>
																				<form name="editAbsen" method="POST" action="procContent.php?<?echo paramEncrypt('process=editAbsenManual')?>">
																					<input type="hidden" name="id" value="<?echo $a_cek['id']?>">
																					<input type="hidden" name="uri" value="<?echo $uri?>">
																					<table>
																						<tr style="border:none;">
																							<td style="width:50px;">
																								<select name="status" style="height:25px;">
																									<option value="<?echo $a_cek['keterangan']?>">
																										<?
																											if($a_cek['keterangan'] == "M")
																												echo "Masuk";
																											elseif($a_cek['keterangan'] == "S")
																												echo "Sakit";
																											elseif($a_cek['keterangan'] == "I")
																												echo "Ijin";
																											elseif($a_cek['keterangan'] == "A")
																												echo "Alpha";
																											else
																												echo "-";
																										?>
																									</option>
																									<option value="">-</option>
																									<option value="M">Masuk</option>
																									<option value="S">Sakit</option>
																									<option value="I">Ijin</option>
																									<option value="A">Alpha</option>
																								</select>
																							</td>
																							<td style="width:25px;">
																								<input type="submit" name="simpan" value="OK" style="height:25px;color:Green;padding:0 0 0 0;">
																							</td>
																						</tr>
																					</table>
																				</form>
																			<?
																		}
																	?>
																</td>
															<?
														}
													}
												?>
											</tr>
										<?
									}
								?>
							</table>
						</div>
					</div>
					
					<div style="width:102%;height:8%;border-bottom:solid 2px #ccc;margin:-10 0 0 -10;background:#efefef;">
						<div style="width:20%;height:70%;margin:8 0 0 10;float:left;font-size:20px;">
							<?
								if(empty($a_detailGuru['waliKelas']))
								{
									?>
										<i>Dashboard Guru</i>
									<?
								}

								else
								{
									?>
										<i>Dashboard Guru & Wali Kelas <?echo $a_detailGuru['waliKelas']?></i>
									<?
								}
							?>
						</div>

						<div style="width:20%;height:70%;margin:10 20 0 0;float:right;font-size:16px;text-align:right;">
							<?							
								echo $a_detailGuru['nama']."  &nbsp;|&nbsp; ";
							?>
							<a href="procContent.php?<?echo paramEncrypt('process=logout')?>" onclick="javascript:var t=confirm('Yakin ingin keluar?');if(t == true) return true; else return false">Logout</a>
						</div>
					</div>

					<div style="width:15%;height:90%;border:solid 2px #ccc;margin:5 0 0 -10;float:left;overflow-x:hidden;overflow-y:auto;background:#efefef;">
						<?
							include("menu.php");
						?>
					</div>

					<div style="width:84%;height:90%;border:solid 2px #ccc;margin:5 0 0 5;float:left;">
						<?
							include("content.php");
						?>
					</div>
					<div style="clear:both"></div>

					<div style="width:100%;height:3%;font-size:10px;text-align:center;line-height:90%;">
						All Right Reserved<br>
						Andi Ikhwannu S.M &copy; 2014
					</div>
				</body>
			</html>
		<?
	}
?>

