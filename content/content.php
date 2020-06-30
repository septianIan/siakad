<?
	//MASTER REFERENSI
	if($decode['doraemon'] == "dataSiswa")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/StartMenu/Printer.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					DATA SISWA KELAS <?echo $decode['kelas']?>
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
					<div style="width:99%;height:98%;border:solid 1px #aaa;margin:3 0 0 3;overflow-y:auto;background:#fff;">
						<table style="margin:5 5 0 5;">
							<tr style="background:#b0e0e6;text-align:center;">
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:75px;border-right:solid 1px #ccc;">NO.INDUK</td>
								<td style="width:250px;border-right:solid 1px #ccc;">NAMA SISWA</td>
								<td style="width:50px;border-right:solid 1px #ccc;">KELAS</td>
								<td style="width:125px;border-right:solid 1px #ccc;">JENIS KELAMIN</td>
								<td style="width:350px;border-right:solid 1px #ccc;">ALAMAT</td>
								<td style="width:50px;border-right:solid 1px #ccc;">CETAK<br>BIODATA</td>
								<?
									if($decode['kelas'] == "7A" or $decode['kelas'] == "7B")
									{
										?>
											<td style="width:50px;border-right:solid 1px #ccc;">SAMPUL<br>RAPORT</td>
										<?
									}
									
									else
									{
										//removing temporary
										?>
											<td style="width:50px;border-right:solid 1px #ccc;">SAMPUL<br>RAPORT</td>
										<?
									}
								?>
							</tr>
							<?
								$no = 1;
								$siswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
								while($a_siswa = mysql_fetch_array($siswa))
								{
									if ($no%2 == 1) 
									{
										?>
											<tr style="background:#fff;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
													<?
														echo $no;
													?>
												</td>
												<td style="width:75px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $a_siswa['noInduk'];
													?>
												</td>
												<td style="width:250px;border-right:solid 1px #ccc;">
													<?
														echo $a_siswa['nama'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_siswa['kelas'];
													?>
												</td>
												<td style="width:125px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														if($a_siswa['jenisKelamin'] == "P")
															echo "Perempuan";
														else
															echo "Laki-laki";
													?>
												</td>
												<td style="width:350px;border-right:solid 1px #ccc;">
													<?
														echo $a_siswa['alamat']
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
													<a href="output/dataSiswa.php?<?echo paramEncrypt('id='.$a_siswa['id'])?>" target="_blank" title="Cetak <?echo $a_siswa['nama']?>">
														<img src="../images/StartMenu/Printer.png" width="25" height="25">
													</a>
												</td>
												<?
													if($decode['kelas'] == "7A" or $decode['kelas'] == "7B")
													{
														?>
															<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																<a href="output/sampulRaport.php?<?echo paramEncrypt('id='.$a_siswa['id'])?>" target="_blank" title="Cetak Sampul Raport <?echo $a_siswa['nama']?>">
																	<img src="../images/StartMenu/Printer.png" width="25" height="25">
																</a>
															</td>
														<?
													}
													
													else
													{
														//removing temporary
														?>
															<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																<a href="output/sampulRaport.php?<?echo paramEncrypt('id='.$a_siswa['id'])?>" target="_blank" title="Cetak Sampul Raport <?echo $a_siswa['nama']?>">
																	<img src="../images/StartMenu/Printer.png" width="25" height="25">
																</a>
															</td>
														<?
													}
												?>
											</tr>
										<?
									}

									else
									{
										?>
											<tr style="background:#efefef;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
													<?
														echo $no;
													?>
												</td>
												<td style="width:75px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $a_siswa['noInduk'];
													?>
												</td>
												<td style="width:250px;border-right:solid 1px #ccc;">
													<?
														echo $a_siswa['nama'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_siswa['kelas'];
													?>
												</td>
												<td style="width:125px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														if($a_siswa['jenisKelamin'] == "P")
															echo "Perempuan";
														else
															echo "Laki-laki";
													?>
												</td>
												<td style="width:350px;border-right:solid 1px #ccc;">
													<?
														echo $a_siswa['alamat']
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
													<a href="output/dataSiswa.php?<?echo paramEncrypt('id='.$a_siswa['id'])?>" target="_blank" title="Cetak <?echo $a_siswa['nama']?>">
														<img src="../images/StartMenu/Printer.png" width="25" height="25">
													</a>
												</td>
												<?
													if($decode['kelas'] == "7A" or $decode['kelas'] == "7B")
													{
														?>
															<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																<a href="output/sampulRaport.php?<?echo paramEncrypt('id='.$a_siswa['id'])?>" target="_blank" title="Cetak Sampul Raport <?echo $a_siswa['nama']?>">
																	<img src="../images/StartMenu/Printer.png" width="25" height="25">
																</a>
															</td>
														<?
													}
													
													else
													{
														//removing temporary
														?>
															<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																<a href="output/sampulRaport.php?<?echo paramEncrypt('id='.$a_siswa['id'])?>" target="_blank" title="Cetak Sampul Raport <?echo $a_siswa['nama']?>">
																	<img src="../images/StartMenu/Printer.png" width="25" height="25">
																</a>
															</td>
														<?
													}
												?>
											</tr>
										<?
									}
									$no=$no+1;
								}
							?>
						</table>
					</div>
				</div>
			</div>
		<?
	}

	elseif($decode['doraemon'] == "detailAbsenSiswa")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/FileTypes/TextDocument.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					DETAIL ABSENSI SISWA KELAS <?echo $decode['kelas']?>
				</div>
				<div style="width:200px;height:30px;float:right;margin:5 10 0 0;">
					<form name="searchAbsen" method="POST" action="procContent.php?<?echo paramEncrypt('process=cariAbsen')?>">
						<table>
							<tr style="border:none;">
								<td style="width:100px;">
									<select name="bulan">
										<option value="">Bulan</option>
										<?
											for($r=1;$r<=12;$r++)
											{
												?>
													<option value="<?echo $r?>"><?echo namaBulan($r)?></option>
												<?
											}
										?>
									</select>
								</td>
								<td style="width:60px;">
									<select name="tahun">
										<option value="">Tahun</option>
										<?
											$b = date("Y");
											$a = $b - 5;
											$c = $b + 5;
											for($s=$a;$s<=$c;$s++)
											{
												?>
													<option value="<?echo $s?>"><?echo $s?></option>
												<?
											}
										?>
									</select>
								</td>
								<td style="width:40px;">
									<input type="hidden" name="kelas" value="<?echo $decode['kelas']?>">
									<input type="submit" name="cari" value="CARI">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;overflow-x:hidden;overflow-y:auto;">
					<?
						if(isset($decode['bulanAbsen']) and isset($decode['tahunAbsen']))
						{
							$blnAbsen = $decode['bulanAbsen'];
							$thnAbsen = $decode['tahunAbsen'];
						}
						
						else
						{
							$blnAbsen = date("m");
							$thnAbsen = date("Y");
						}
						
						$jumHari = cal_days_in_month(CAL_GREGORIAN, $blnAbsen, $thnAbsen);
					?>
					<table style="margin:5 5 5 5;background:white;">
						<tr style="background:#b0e0e6;text-align:center;color:green;text-align:center;height:25px;text-transform:uppercase;">
							<td style="width:75px;border-left:solid 1px #ccc;border-right:solid 1px #ccc;" rowspan="2">NO.INDUK</td>
							<td style="width:200px;border-right:solid 1px #ccc;" rowspan="2">NAMA</td>
							<td colspan="<?echo $jumHari?>" style="border-left:solid 1px #ccc;border-right:solid 1px #ccc;color:Red;"><?echo "DETAIL ABSEN SISWA BULAN ".namaBulan($blnAbsen)." TAHUN ".$thnAbsen?></td>
						</tr>
						<tr style="background:#b0e0e6;text-align:center;color:green;text-align:center;height:25px;text-transform:uppercase;">
							<?
								for($a=1;$a<=$jumHari;$a++)
								{
									?>
										<td style="border-right:solid 1px #ccc;width:30px;"><?echo $a?></td>
									<?
								}
							?>
						</tr>
						<?
							$rowNo = 1;
							$siswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk asc");
							while($a_siswa = mysql_fetch_array($siswa))
							{
								if($rowNo%2 == 0)
								{
									?>
										<tr style="background:#efefef;height:25px;">
											<td style="border-right:Solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
												<?
													echo $a_siswa['noInduk']."<br>";
												?>
												<a href="index.php?<?echo paramEncrypt('doraemon=detailAbsenSiswa&kelas='.$a_detailGuru['waliKelas'].'&act=edit&noInduk='.$a_siswa['noInduk'].'&bulanAbsen='.$blnAbsen.'&tahunAbsen='.$thnAbsen)?>" title="Edit Absen <?echo $a_siswa['nama']?>">
													<font style="font-size:10px;color:Red;">Edit Absen</font>
												</a>
											</td>
											<td style="border-right:Solid 1px #ccc;"><?echo $a_siswa['nama']?></td>
											<?
												for($a=1;$a<=$jumHari;$a++)
												{
													?>
														<td style="border-right:solid 1px #ccc;width:30px;text-align:center;">
															<?echo ambilAbsen($a_siswa['noInduk'],$a_siswa['kelas'],$a,$blnAbsen,$thnAbsen)?>
														</td>
													<?
												}
											?>
										</tr>
									<?									
								}
								
								else
								{
									?>
										<tr style="background:white;height:25px;">
											<td style="border-right:Solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
												<?
													echo $a_siswa['noInduk']."<br>";
												?>
												<a href="index.php?<?echo paramEncrypt('doraemon=detailAbsenSiswa&kelas='.$a_detailGuru['waliKelas'].'&act=edit&noInduk='.$a_siswa['noInduk'].'&bulanAbsen='.$blnAbsen.'&tahunAbsen='.$thnAbsen)?>" title="Edit Absen <?echo $a_siswa['nama']?>">
													<font style="font-size:10px;color:Red;">Edit Absen</font>
												</a>
											</td>
											<td style="border-right:Solid 1px #ccc;"><?echo $a_siswa['nama']?></td>
											<?
												for($a=1;$a<=$jumHari;$a++)
												{
													?>
														<td style="border-right:solid 1px #ccc;width:30px;text-align:center;">
															<?echo ambilAbsen($a_siswa['noInduk'],$a_siswa['kelas'],$a,$blnAbsen,$thnAbsen)?>
														</td>
													<?
												}
											?>
										</tr>
									<?
								}
								$rowNo = $rowNo + 1;
							}
						?>
					</table>
				</div>
			</div>
		<?
	}
	
	elseif($decode['doraemon'] == "absenSiswa")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/FileTypes/BMP.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					ABSENSI SISWA KELAS <?echo $decode['kelas']?>
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
					<div style="width:99%;height:98%;border:solid 1px #aaa;margin:3 0 0 3;overflow-y:auto;background:#fff;">
						<?
							$cek = mysql_query("select count(*) as hasilCek from tbl_absen where kelas='$decode[kelas]'");
							$a_cek = mysql_fetch_array($cek);

							if($a_cek['hasilCek'] != 0)
							{
								?>
									<form name="updateAbsen" method="post" action="procContent.php?<?echo paramEncrypt('process=updateAbsen')?>">
										<table style="margin:5 5 0 5;">
											<tr style="background:#b0e0e6;text-align:center;">
												<td rowspan="2" style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
												<td rowspan="2" style="width:100px;border-right:solid 1px #ccc;">NO INDUK</td>
												<td rowspan="2" style="width:500px;border-right:solid 1px #ccc;">NAMA SISWA</td>
												<td colspan="3" style="width:150px;border-right:solid 1px #ccc;">IJIN UTS</td>
												<td colspan="3" style="width:150px;border-right:solid 1px #ccc;">IJIN UAS</td>
											</tr>
											<tr style="background:#b0e0e6;text-align:center;">
												<td style="width:50px;border-right:solid 1px #ccc;">SAKIT</td>
												<td style="width:50px;border-right:solid 1px #ccc;">IJIN</td>
												<td style="width:50px;border-right:solid 1px #ccc;">ALPHA</td>
												<td style="width:50px;border-right:solid 1px #ccc;">SAKIT</td>
												<td style="width:50px;border-right:solid 1px #ccc;">IJIN</td>
												<td style="width:50px;border-right:solid 1px #ccc;">ALPHA</td>
											</tr>
											<?
												$kakashi = 1;
												$selSiswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
												while($a_selSiswa = mysql_fetch_array($selSiswa))
												{
													?>
														<tr style="background:#fff;">
															<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
																<?
																	echo $kakashi;
																?>
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
																<?
																	echo $a_selSiswa['noInduk']
																?>
															</td>
															<td style="width:300px;border-right:solid 1px #ccc;">
																<?
																	echo $a_selSiswa['nama']
																?>
															</td>
															<?
																$selData = mysql_query("select * from tbl_absen where noInduk='$a_selSiswa[noInduk]' and kelas='$decode[kelas]'");
																$a_selData = mysql_fetch_array($selData);
															?>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="sakit[]" autocomplete="off" style="text-align:Center;border:none;" value="<?echo $a_selData['sakit']?>">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="ijin[]" autocomplete="off" style="text-align:Center;border:none;" value="<?echo $a_selData['ijin']?>">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="alpha[]" autocomplete="off" style="text-align:Center;border:none;" value="<?echo $a_selData['alpha']?>">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="sakit1[]" autocomplete="off" style="text-align:Center;border:none;" value="<?echo $a_selData['sakit1']?>">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="ijin1[]" autocomplete="off" style="text-align:Center;border:none;" value="<?echo $a_selData['ijin1']?>">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="alpha1[]" autocomplete="off" style="text-align:Center;border:none;" value="<?echo $a_selData['alpha1']?>">
																<input type="hidden" name="id[]" value="<?echo $a_selData['id']?>">
															</td>
														</tr>
													<?
													$kakashi = $kakashi + 1;
												}
											?>
											<tr style="border:none;">
												<td colspan="9">
													<input type="hidden" name="uri" value="<?echo $uri?>">
													<input type="submit" name="simpan" value="Simpan" style="float:right;">
												</td>
											</tr>
										</table>
									</form>
								<?
							}

							else
							{
								?>
									<form name="simpanAbsen" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanAbsen')?>">
										<table style="margin:5 5 0 5;">
											<tr style="background:#b0e0e6;text-align:center;">
												<td rowspan="2" style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
												<td rowspan="2" style="width:100px;border-right:solid 1px #ccc;">NO INDUK</td>
												<td rowspan="2" style="width:300px;border-right:solid 1px #ccc;">NAMA SISWA</td>
												<td colspan="3" style="width:150px;border-right:solid 1px #ccc;">IJIN UTS</td>
												<td colspan="3" style="width:150px;border-right:solid 1px #ccc;">IJIN UAS</td>
											</tr>
											<tr style="background:#b0e0e6;text-align:center;">
												<td style="width:50px;border-right:solid 1px #ccc;">SAKIT</td>
												<td style="width:50px;border-right:solid 1px #ccc;">IJIN</td>
												<td style="width:50px;border-right:solid 1px #ccc;">ALPHA</td>
												<td style="width:50px;border-right:solid 1px #ccc;">SAKIT</td>
												<td style="width:50px;border-right:solid 1px #ccc;">IJIN</td>
												<td style="width:50px;border-right:solid 1px #ccc;">ALPHA</td>
											</tr>
											<?
												$kakashi = 1;
												$selSiswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
												while($a_selSiswa = mysql_fetch_array($selSiswa))
												{
													?>
														<tr style="background:#fff;">
															<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
																<?
																	echo $kakashi;
																?>
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
																<?echo $a_selSiswa['noInduk']?>
																<input type="hidden" name="noInduk[]" value="<?echo $a_selSiswa['noInduk']?>">
															</td>
															<td style="width:300px;border-right:solid 1px #ccc;">
																<?echo $a_selSiswa['nama']?>
																<input type="hidden" name="nama[]" value="<?echo $a_selSiswa['nama']?>">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="sakit[]" autocomplete="off" style="text-align:Center;">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="ijin[]" autocomplete="off" style="text-align:Center;">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="alpha[]" autocomplete="off" style="text-align:Center;">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="sakit1[]" autocomplete="off" style="text-align:Center;">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="ijin1[]" autocomplete="off" style="text-align:Center;">
															</td>
															<td style="width:50px;border-right:solid 1px #ccc;">
																<input type="text" name="alpha1[]" autocomplete="off" style="text-align:Center;">
															</td>
														</tr>
													<?
													$kakashi = $kakashi + 1;
												}
											?>
											<tr style="border:none;">
												<td colspan="9">
													<input type="hidden" name="kelas" value="<?echo $decode['kelas']?>">
													<input type="hidden" name="uri" value="<?echo $uri?>">
													<input type="submit" name="simpan" value="Simpan" style="float:right;">
												</td>
											</tr>
										</table>
									</form>
								<?
							}
						?>
					</div>
				</div>
			</div>
		<?
	}

	elseif($decode['doraemon'] == "akhlakKepribadian")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/FileTypes/Default.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					NILAI AKHLAK & KEPRIBADIAN KELAS <?echo $decode['kelas']?>
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
					<div style="width:99%;height:98%;border:solid 1px #aaa;margin:3 0 0 3;overflow-y:auto;background:#fff;">
						<?
							$cek = mysql_query("select count(*) as jumRow from tbl_akhlak where kelas='$decode[kelas]'");
							$a_cek = mysql_fetch_array($cek);

							if($a_cek['jumRow'] != 0)
							{
								?>
									<form name="updateAkhlak" method="post" action="procContent.php?<?echo paramEncrypt('process=updateAkhlak')?>">
										<table style="margin:5 5 0 5;">
											<tr style="background:#b0e0e6;text-align:center;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
												<td style="width:100px;border-right:solid 1px #ccc;">NO INDUK</td>
												<td style="width:700px;border-right:solid 1px #ccc;">NAMA SISWA</td>
												<td style="width:100px;border-right:solid 1px #ccc;">AKHLAK</td>
												<td style="width:100px;border-right:solid 1px #ccc;">KEPRIBADIAN</td>
											</tr>
											<?
												$kakashi = 1;
												$selSiswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
												while($a_selSiswa = mysql_fetch_array($selSiswa))
												{
													?>
														<tr style="background:#fff;">
															<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
																<?
																	echo $kakashi;
																?>
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
																<?echo $a_selSiswa['noInduk']?>
															</td>
															<td style="width:300px;border-right:solid 1px #ccc;">
																<?echo $a_selSiswa['nama']?>
															</td>
															<?
																$selDetail = mysql_query("select * from tbl_akhlak where noInduk='$a_selSiswa[noInduk]' and kelas='$decode[kelas]'");
																$a_selDetail = mysql_fetch_array($selDetail);
															?>
															<td style="width:100px;border-right:solid 1px #ccc;">
																<select name="akhlak[]">
																	<option value="<?echo $a_selDetail['akhlak']?>"><?echo $a_selDetail['akhlak']?></option>
																	<option value=""></option>
																	<option value="Sangat Baik">Sangat Baik</option>
																	<option value="Baik">Baik</option>
																	<option value="Cukup">Cukup</option>
																	<option value="Kurang">Kurang</option>
																</select>
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;">
																<select name="kepribadian[]">
																	<option value="<?echo $a_selDetail['kepribadian']?>"><?echo $a_selDetail['kepribadian']?></option>
																	<option value=""></option>
																	<option value="Sangat Baik">Sangat Baik</option>
																	<option value="Baik">Baik</option>
																	<option value="Cukup">Cukup</option>
																	<option value="Kurang">Kurang</option>
																</select>
																<input type="hidden" name="id[]" value="<?echo $a_selDetail['id']?>">
															</td>
														</tr>
													<?
													$kakashi = $kakashi + 1;
												}
											?>
											<tr style="border:none;">
												<td colspan="6">
													<input type="hidden" name="uri" value="<?echo $uri?>">
													<input type="submit" name="simpan" value="Simpan" style="float:right;">
												</td>
											</tr>
										</table>
									</form>
								<?
							}

							else
							{
								?>
									<form name="simpanAkhlak" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanAkhlak')?>">
										<table style="margin:5 5 0 5;">
											<tr style="background:#b0e0e6;text-align:center;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
												<td style="width:100px;border-right:solid 1px #ccc;">NO INDUK</td>
												<td style="width:300px;border-right:solid 1px #ccc;">NAMA SISWA</td>
												<td style="width:100px;border-right:solid 1px #ccc;">AKHLAK</td>
												<td style="width:100px;border-right:solid 1px #ccc;">KEPRIBADIAN</td>
											</tr>
											<?
												$kakashi = 1;
												$selSiswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
												while($a_selSiswa = mysql_fetch_array($selSiswa))
												{
													?>
														<tr style="background:#fff;">
															<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
																<?
																	echo $kakashi;
																?>
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
																<?echo $a_selSiswa['noInduk']?>
																<input type="hidden" name="noInduk[]" value="<?echo $a_selSiswa['noInduk']?>">
															</td>
															<td style="width:300px;border-right:solid 1px #ccc;">
																<?echo $a_selSiswa['nama']?>
																<input type="hidden" name="nama[]" value="<?echo $a_selSiswa['nama']?>">
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;">
																<select name="akhlak[]">
																	<option value=""></option>
																	<option value="Sangat Baik">Sangat Baik</option>
																	<option value="Baik">Baik</option>
																	<option value="Cukup">Cukup</option>
																	<option value="Kurang">Kurang</option>
																</select>
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;">
																<select name="kepribadian[]">
																	<option value=""></option>
																	<option value="Sangat Baik">Sangat Baik</option>
																	<option value="Baik">Baik</option>
																	<option value="Cukup">Cukup</option>
																	<option value="Kurang">Kurang</option>
																</select>
															</td>
														</tr>
													<?
													$kakashi = $kakashi + 1;
												}
											?>
											<tr style="border:none;">
												<td colspan="6">
													<input type="hidden" name="kelas" value="<?echo $decode['kelas']?>">
													<input type="hidden" name="uri" value="<?echo $uri?>">
													<input type="submit" name="simpan" value="Simpan" style="float:right;">
												</td>
											</tr>
										</table>
									</form>
								<?
							}
						?>		
					</div>
				</div>
			</div>
		<?
	}

	elseif($decode['doraemon'] == "nilaiSiswa")
	{
		$mapel = mysql_real_escape_string($decode['pelajaran']);
		$kelas = mysql_real_escape_string($decode['kelas']);

		$cekTable = mysql_query("select * from m_gurupelajaran where pelajaran='$mapel' and kelas='$kelas'");
		$a_cekTable = mysql_fetch_array($cekTable);
		if($a_cekTable['createTbl'] == "0")
		{
			?>
				<div style="width:300px;height:150px;border:solid 2px #aaa;box-shadow: inset 0 0px 1px rgba(0, 0, 0, 0.050), 0 0 15px rgba(0, 0, 0, 0.50);margin:150 0 0 350;">
					<div style="width:50%;height:25%;float:left;margin:5 0 0 5;">
						<div style="width:20%;height:100%;float:left;">
							<img src="../images/Icon/Important.png" width="30" heihgt="30" style="margin:5 0 0 0;">
						</div>
						<div style="width:60%;height:100%;float:left;font-style:italic;font-size:30px;color:#aaa;">
							Access
						</div>
					</div>
					<div style="clear:both"></div>

					<div style="width:95%;height:40%;margin:5 0 0 10;">
						Ijinkan pembuatan akses user ke daftar nilai <?echo $mapel?> kelas <?echo $kelas?>?
					</div>

					<div style="width:15%;height:20%;margin:5 10 0 0;float:right;">
						<form name="createTbl" method="post" action="procContent.php?<?echo paramEncrypt('process=createTbl')?>">
							<input type="hidden" name="kelas" value="<?echo $kelas?>">
							<input type="hidden" name="pelajaran" value="<?echo $mapel?>">
							<input type="hidden" name="uri" value="<?echo $uri?>">
							<input type="submit" name="buatTable" value="OK">
						</form>
					</div>
				</div>
			<?
		}

		else
		{
			$pelajaran = str_replace(" ", "_", $decode['pelajaran']);
			$table =  $pelajaran.$decode['kelas'];
			$tableNilai = $table.$decode['jenis'];
			?>
				<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
					<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
						<img src="../images/FileTypes/SystemConfiguration.png" width="30" height="30">
					</div>
					<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;text-transform:uppercase;">
						NILAI <?echo $decode['pelajaran']?> KELAS <?echo $decode['kelas']?>
					</div>
					<div style="clear:both"></div>

					<?
						if(isset($decode['act']))
						{
							?>
								<div style="width:99%;height:89%;border:solid 2px #ccc;float:left;background:#efefef;margin:0 0 0 -2;">
									<a href="output/rekapNilai.php?<?echo paramEncrypt('pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'])?>" title="Cetak Rekap Nilai" target="_blank">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;color:red;">
											Cetak Rekap Nilai
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/StartMenu/Printer.png" width="25" height="25" style="margin:2 0 0 3;">
										</div>
									</a>
									
									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=tambahNilai')?>" title="Tambah nilai">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;">
											Tambah Nilai
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/Icon/Document4.png" width="35" heihgt="35">
										</div>
									</a>

									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=editNilai')?>" title="Cek & Edit Nilai">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;">
											Cek & Edit Nilai
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/Icon/Crayons.png" width="35" heihgt="35">
										</div>
									</a>

									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=setKkm')?>" title="Set KKM">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;">
											Set KKM
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/Icon/Brush.png" width="35" heihgt="35">
										</div>
									</a>	
									<div style="clear:both"></div>

									<?
										if($decode['act'] == "tambahNilai")
										{
											?>
												<div style="width:99%;height:91%;margin:3 0 0 4;overflow-y:auto;overflow-x:auto;border:solid 2px #ccc;background:#fff;">
													<form name="tambahNilai" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanNilaiKelas9')?>">
														<table style="margin:5 5 0 5;">
															<tr style="background:#b0e0e6;text-align:Center;">
																<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
																<td style="width:150px;border-right:solid 1px #ccc;">NO.INDUK</td>
																<td style="width:650px;border-right:solid 1px #ccc;">NAMA SISWA</td>
																<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
																	<?
																		$cekUts1 = mysql_query("select * from $table where tag='UTS'");
																		$r_cekUts1 = mysql_num_rows($cekUts1);

																		$cekUas1 = mysql_query("select * from $table where tag='UAS'");
																		$r_cekUas1 = mysql_num_rows($cekUas1);

																		if($r_cekUts1 == "0" and $r_cekUas1 == "0")
																		{
																			?>
																				<select name="jenis" style="border:none;text-align:left;background:#b0e0e6;">
																					<option value="">- JENIS NILAI -</option>
																					<option value="TO">Tugas Observasi</option>
																					<option value="TP">Tugas Proyek</option>
																					<option value="TT">Tugas Terstruktur</option>
																					<option value="UH">Ulangan Harian</option>
																					<option value="UTS">UTS</option>
																					<option value="UAS">UAS</option>
																				</select>
																			<?
																		}

																		elseif($r_cekUts1 != "0" and $r_cekUas1 == "0")
																		{
																			?>
																				<select name="jenis" style="border:none;text-align:center;background:#b0e0e6;">
																					<option value="">- JENIS NILAI -</option>
																					<option value="TO">Tugas Observasi</option>
																					<option value="TP">Tugas Proyek</option>
																					<option value="TT">Tugas Terstruktur</option>
																					<option value="UH">Ulangan Harian</option>
																					<option value="UAS">UAS</option>
																				</select>
																			<?
																		}

																		elseif($r_cekUts1 == "0" and $r_cekUas1 != "0")
																		{
																			?>
																				<select name="jenis" style="border:none;text-align:center;background:#b0e0e6;">
																					<option value="">- JENIS NILAI -</option>
																					<option value="TO">Tugas Observasi</option>
																					<option value="TP">Tugas Proyek</option>
																					<option value="TT">Tugas Terstruktur</option>
																					<option value="UH">Ulangan Harian</option>
																					<option value="UTS">UTS</option>
																				</select>
																			<?
																		}

																		else
																		{
																			?>
																				<select name="jenis" style="border:none;text-align:center;background:#b0e0e6;">
																					<option value="">- JENIS NILAI -</option>
																					<option value="TO">Tugas Observasi</option>
																					<option value="TP">Tugas Proyek</option>
																					<option value="TT">Tugas Terstruktur</option>
																					<option value="UH">Ulangan Harian</option>
																				</select>
																			<?
																		}
																	?>
																</td>
															</tr>
															<?
																$no = 1;
																$murid = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
																while($a_murid = mysql_fetch_array($murid))
																{
																	if($no%2 == 1)
																	{
																		?>
																			<tr style="background:#fff;">
																				<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
																					<?echo $no?>
																				</td>
																				<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
																					<?echo $a_murid['noInduk']?>
																					<input type="hidden" name="noInduk[]" value="<?echo $a_murid['noInduk']?>" style="border:none;text-align:Center;" readonly="readonly">
																				</td>
																				<td style="width:650px;border-right:solid 1px #ccc;text-transform:uppercase;">
																					<?echo mysql_real_escape_string($a_murid['nama'])?>
																					<input type="hidden" name="nama[]" value="<?echo mysql_real_escape_string($a_murid['nama'])?>" style="border:none;text-transform:uppercase;" readonly="readonly">
																				</td>
																				<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
																					<input type="text" name="nilai[]" autocomplete="off" placeholder="Nilai" style="text-align:center;width:50%;">
																				</td>
																			</tr>
																		<?
																	}

																	else
																	{
																		?>
																			<tr style="background:#efefef;">
																				<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
																					<?echo $no?>
																				</td>
																				<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
																					<?echo $a_murid['noInduk']?>
																					<input type="hidden" name="noInduk[]" value="<?echo $a_murid['noInduk']?>" style="border:none;background:#efefef;text-align:Center;" readonly="readonly">
																				</td>
																				<td style="width:650px;border-right:solid 1px #ccc;text-transform:uppercase;">
																					<?echo mysql_real_escape_string($a_murid['nama'])?>
																					<input type="hidden" name="nama[]" value="<?echo mysql_real_escape_string($a_murid['nama'])?>" style="border:none;background:#efefef;text-transform:uppercase;" readonly="readonly">
																				</td>
																				<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
																					<input type="text" name="nilai[]" autocomplete="off" placeholder="Nilai" style="text-align:center;width:50%;">
																				</td>
																			</tr>
																		<?	
																	}
																	$no = $no + 1;
																}
															?>
															<tr style="border:none;">
																<td colspan="4">
																	<input type="hidden" name="table" value="<?echo $table?>">
																	<input type="hidden" name="uri" value="<?echo $uri?>">
																	<input type="submit" name="simpanNilai" value="Simpan" style="float:Right;" onclick="return validateSimpanNilai();">
																</td>
															</tr>
														</table>
													</form>
												</div>
											<?
										}

										elseif($decode['act'] == "editNilai")
										{
											$selKkm = mysql_query("select * from m_kkm where pelajaran='$decode[pelajaran]' and kelas='$decode[kelas]'");
											$a_selKkm = mysql_fetch_array($selKkm);
											?>
												<div style="width:99%;height:91%;margin:3 0 0 4;overflow-y:auto;overflow-x:auto;border:solid 2px #ccc;background:#fff;">
													<table style="margin:5 5 0 5;">
														<tr style="background:#b0e0e6;text-align:center;">
															<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
															<td style="width:75px;border-right:solid 1px #ccc;">NO.INDUK</td>
															<td style="width:300px;border-right:solid 1px #ccc;">NAMA SISWA</td>
															<td style="width:50px;border-right:solid 1px #ccc;">KKM</td>
															<?
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
																					<td style="width:50px;border-right:solid 1px #ccc;">
																						<?echo $a_tag['tag'].$a_urutan['urutan']?><br>
																						<a href="procContent.php?<?echo paramEncrypt('process=hapusNilai&kelas='.$decode['kelas'].'&pelajaran='.$decode['pelajaran'].'&table='.$table.'&jenis='.$a_tag['tag'].'&urutan='.$a_urutan['urutan'].'&uri='.$uri)?>">
																							<font style="font-size:10px;" title="Hapus">[x]Hapus</font>
																						</a>
																					</td>
																					<td style="width:50px;border-right:solid 1px #ccc;"><?echo "R ".$a_urutan['urutan']?></td>
																				<?
																			}

																			elseif($a_tag['tag'] == "UTS" or $a_tag['tag'] == "UAS")
																			{
																				?>
																					<td style="width:50px;border-right:solid 1px #ccc;">
																						<?echo $a_tag['tag']?><br>
																						<a href="procContent.php?<?echo paramEncrypt('process=hapusNilai&kelas='.$decode['kelas'].'&pelajaran='.$decode['pelajaran'].'&table='.$table.'&jenis='.$a_tag['tag'].'&urutan='.$a_urutan['urutan'].'&uri='.$uri)?>">
																							<font style="font-size:10px;" title="Hapus">[x]Hapus</font>
																						</a>
																					</td>
																				<?	
																			}

																			else
																			{
																				?>
																					<td style="width:50px;border-right:solid 1px #ccc;">
																						<?echo $a_tag['tag'].$a_urutan['urutan']?><br>
																						<a href="procContent.php?<?echo paramEncrypt('process=hapusNilai&kelas='.$decode['kelas'].'&pelajaran='.$decode['pelajaran'].'&table='.$table.'&jenis='.$a_tag['tag'].'&urutan='.$a_urutan['urutan'].'&uri='.$uri)?>">
																							<font style="font-size:10px;" title="Hapus">[x]Hapus</font>
																						</a>
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
															<td style="width:50px;border-right:solid 1px #ccc;">RT</td>
															<td style="width:50px;border-right:solid 1px #ccc;">RUH</td>
															<td style="width:50px;border-right:solid 1px #ccc;">NH</td>
															<td style="width:50px;border-right:solid 1px #ccc;">NA</td>
															<td style="width:75px;border-right:solid 1px #ccc;">EDIT</td>
														</tr>
														<?
															$number = 1;
															$murid = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
															while($a_murid = mysql_fetch_array($murid))
															{
																if($number%2 == 1)
																{
																	?>
																		<form name="updateNilai" method="post" action="procContent.php?<?echo paramEncrypt('process=updateNilai')?>">
																			<tr style="background:#ffffff;">
																				<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
																					<?
																						echo $number
																					?>
																				</td>
																				<td style="width:75px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						echo $a_murid['noInduk'];
																					?>
																				</td>
																				<td style="width:300px;border-right:solid 1px #ccc;">
																					<?
																						echo $a_murid['nama'];
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
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
																										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																											<?
																												if($a_nilaiTarget['nilai'] < $a_selKkm['kkm'])
																												{
																													?>
																														<input type="text" name="nilai[]" style="color:Red;border:none;text-align:center;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}

																												else
																												{
																													?>
																														<input type="text" name="nilai[]" style="border:none;text-align:center;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}
																											?>
																											<input type="hidden" name="id[]" value="<?echo $a_nilaiTarget['id']?>">
																										</td>
																									<?

																									$selectRemidi = mysql_query("select * from $table where tag='R' and urutan='$a_urutanNilai[urutan]' and noInduk='$a_murid[noInduk]'");
																									$a_selectRemidi = mysql_fetch_array($selectRemidi);
																									?>
																										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																											<input type="text" name="nilai[]" style="border:none;text-align:center;" autocomplete="off" value="<?echo $a_selectRemidi['nilai']?>">
																											<input type="hidden" name="id[]" value="<?echo $a_selectRemidi['id']?>">
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
																										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																											<?
																												if($a_nilaiTarget['nilai'] < $a_selKkm['kkm'])
																												{
																													?>
																														<input type="text" name="nilai[]" style="color:Red;border:none;text-align:center;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}

																												else
																												{
																													?>
																														<input type="text" name="nilai[]" style="border:none;text-align:center;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}
																											?>
																											<input type="hidden" name="id[]" value="<?echo $a_nilaiTarget['id']?>">
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
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//rata-rata tugas
																						$rataT = round(@($nilaiT / $jumT),2);
																						echo $rataT;
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//rata-rata ulangan harian
																						$rataUH = round(@($nilaiUH / $jumUH),2);
																						echo $rataUH;
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//NH -> Nilai Harian
																						$nilaiHarian = round(@(((3*$rataT) + $rataUH) / 4),2);
																						echo $nilaiHarian;
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//NA -> Nilai Akhir
																						$nilaiAkhir = round(@(((3*$nilaiHarian) + $nilaiUTS + (2*$nilaiUAS)) / 6),2);
																						echo $nilaiAkhir;
																					?>
																				</td>
																				<td style="width:75px;border-right:solid 1px #ccc;text-align:center;">
																					<input type="hidden" name="table" value="<?echo $table?>">
																					<input type="hidden" name="uri" value="<?echo $uri?>">
																					<input type="submit" name="simpanEdit" value="Edit">
																				</td>
																			</tr>
																		</form>
																	<?
																}

																else
																{
																	?>
																		<form name="updateNilai" method="post" action="procContent.php?<?echo paramEncrypt('process=updateNilai')?>">
																			<tr style="background:#efefef;">
																				<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
																					<?
																						echo $number
																					?>
																				</td>
																				<td style="width:75px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						echo $a_murid['noInduk'];
																					?>
																				</td>
																				<td style="width:300px;border-right:solid 1px #ccc;">
																					<?
																						echo $a_murid['nama'];
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
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
																										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																											<?
																												if($a_nilaiTarget['nilai'] < $a_selKkm['kkm'])
																												{
																													?>
																														<input type="text" name="nilai[]" style="color:Red;border:none;text-align:center;background:#efefef;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}

																												else
																												{
																													?>
																														<input type="text" name="nilai[]" style="border:none;text-align:center;background:#efefef;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}
																											?>
																											<input type="hidden" name="id[]" value="<?echo $a_nilaiTarget['id']?>">
																										</td>
																									<?

																									$selectRemidi = mysql_query("select * from $table where tag='R' and urutan='$a_urutanNilai[urutan]' and noInduk='$a_murid[noInduk]'");
																									$a_selectRemidi = mysql_fetch_array($selectRemidi);
																									?>
																										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																											<input type="text" name="nilai[]" style="border:none;text-align:center;background:#efefef;" autocomplete="off" value="<?echo $a_selectRemidi['nilai']?>">
																											<input type="hidden" name="id[]" value="<?echo $a_selectRemidi['id']?>">
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
																										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																											<?
																												if($a_nilaiTarget['nilai'] < $a_selKkm['kkm'])
																												{
																													?>
																														<input type="text" name="nilai[]" style="color:Red;border:none;text-align:center;background:#efefef;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}

																												else
																												{
																													?>
																														<input type="text" name="nilai[]" style="border:none;text-align:center;background:#efefef;" autocomplete="off" value="<?echo $a_nilaiTarget['nilai']?>">
																													<?
																												}
																											?>
																											<input type="hidden" name="id[]" value="<?echo $a_nilaiTarget['id']?>">
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
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//rata-rata tugas
																						$rataT = round(@($nilaiT / $jumT),2);
																						echo $rataT;
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//rata-rata ulangan harian
																						$rataUH = round(@($nilaiUH / $jumUH),2);
																						echo $rataUH;
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//NH -> Nilai Harian
																						$nilaiHarian = round(@(((3*$rataT) + $rataUH) / 4),2);
																						echo $nilaiHarian;
																					?>
																				</td>
																				<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
																					<?
																						//NA -> Nilai Akhir
																						$nilaiAkhir = round(@(((3*$nilaiHarian) + $nilaiUTS + (2*$nilaiUAS)) / 6),2);
																						echo $nilaiAkhir;
																					?>
																				</td>
																				<td style="width:75px;border-right:solid 1px #ccc;text-align:center;">
																					<input type="hidden" name="table" value="<?echo $table?>">
																					<input type="hidden" name="uri" value="<?echo $uri?>">
																					<input type="submit" name="simpanEdit" value="Edit">
																				</td>
																			</tr>
																		</form>
																	<?
																}
																$number = $number+1;
															}
														?>
													</table>
												</div>
											<?
										}

										else
										{
											$selKKM = mysql_query("select * from m_kkm where pelajaran='$decode[pelajaran]' and kelas='$decode[kelas]'");
											$r_selKKM = mysql_num_rows($selKKM);

											if($r_selKKM == 0)
											{
												?>
													<div style="width:99%;height:91%;margin:3 0 0 4;overflow-y:auto;overflow-x:auto;">
														<div style="width:300px;height:150px;border:solid 2px #aaa;box-shadow: inset 0 0px 1px rgba(0, 0, 0, 0.050), 0 0 15px rgba(0, 0, 0, 0.50);margin:100 0 0 350;background:#fff;">
															<div style="width:50%;height:25%;float:left;margin:5 0 0 5;">
																<div style="width:20%;height:100%;float:left;">
																	<img src="../images/Icon/Important.png" width="30" heihgt="30" style="margin:5 0 0 0;">
																</div>
																<div style="width:75%;height:100%;float:left;font-style:italic;font-size:30px;color:#aaa;">
																	Set KKM
																</div>
															</div>
															<div style="clear:both"></div>

															<form name="setKkm" method="post" action="procContent.php?<?echo paramEncrypt('process=setKkm')?>">
																<div style="width:95%;height:40%;margin:5 0 0 10;">
																	KKM untuk pelajaran <?echo $decode['pelajaran']." kelas ".$decode['kelas']?> belum diset
																	<table style="margin:5 0 0 0;">
																		<tr style="border:none;">
																			<td style="width:50px;">Nilai KKM</td>
																			<td style="width:10px;">:</td>
																			<td style="width:150px;">
																				<input type="text" name="kkm" autocomplete="off">
																				<input type="hidden" name="pelajaran" value="<?echo $decode['pelajaran']?>">
																				<input type="hidden" name="kelas" value="<?echo $decode['kelas']?>">
																				<input type="hidden" name="uri" value="<?echo $uri?>">
																			</td>
																		</tr>
																	</table>
																</div>

																<div style="width:15%;height:20%;margin:5 10 0 0;float:right;">
																	<input type="submit" name="setKkm" value="Set" onclick="return validateSetKKM();">
																</div>
															</form>
														</div>
													</div>
												<?
											}

											else
											{
												$a_selKKM = mysql_fetch_array($selKKM);
												?>
													<div style="width:99%;height:91%;margin:3 0 0 4;overflow-y:auto;overflow-x:auto;">
														<div style="width:300px;height:150px;border:solid 2px #aaa;box-shadow: inset 0 0px 1px rgba(0, 0, 0, 0.050), 0 0 15px rgba(0, 0, 0, 0.50);margin:100 0 0 350;background:#fff;">
															<div style="width:50%;height:25%;float:left;margin:5 0 0 5;">
																<div style="width:20%;height:100%;float:left;">
																	<img src="../images/Icon/Important.png" width="30" heihgt="30" style="margin:5 0 0 0;">
																</div>
																<div style="width:75%;height:100%;float:left;font-style:italic;font-size:30px;color:#aaa;">
																	KKM
																</div>
															</div>
															<div style="clear:both"></div>

															<form name="updateKkm" method="post" action="procContent.php?<?echo paramEncrypt('process=updateKkm')?>">
																<div style="width:95%;height:40%;margin:5 0 0 10;">
																	KKM untuk pelajaran <?echo $decode['pelajaran']." kelas ".$decode['kelas']?> telah diset
																	<table style="margin:5 0 0 0;">
																		<tr style="border:none;">
																			<td style="width:50px;">Nilai KKM</td>
																			<td style="width:10px;">:</td>
																			<td style="width:150px;">
																				<input type="text" name="kkm" autocomplete="off" value="<?echo $a_selKKM['kkm']?>">
																				<input type="hidden" name="id" value="<?echo $a_selKKM['id']?>">
																				<input type="hidden" name="uri" value="<?echo $uri?>">
																			</td>
																		</tr>
																	</table>
																</div>

																<div style="width:15%;height:20%;margin:5 10 0 0;float:right;">
																	<input type="submit" name="setKkm" value="Set" onclick="return validateUpdateKKM();">
																</div>
															</form>
														</div>
													</div>
												<?
											}
										}
									?>
								</div>
							<?
						}

						else
						{
							?>
								<div style="width:99%;height:89%;border:solid 2px #ccc;float:left;background:#efefef;margin:0 0 0 -2;">
									<a href="output/rekapNilai.php?<?echo paramEncrypt('pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'])?>" title="Cetak Rekap Nilai" target="_blank">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;color:red;">
											Cetak Rekap Nilai
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/StartMenu/Printer.png" width="25" height="25" style="margin:2 0 0 3;">
										</div>
									</a>
									
									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=tambahNilai')?>" title="Tambah nilai">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;">
											Tambah Nilai
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/Icon/Document4.png" width="35" heihgt="35">
										</div>
									</a>

									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=editNilai')?>" title="Cek & Edit Nilai">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;">
											Cek & Edit Nilai
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/Icon/Crayons.png" width="35" heihgt="35">
										</div>
									</a>

									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=setKkm')?>" title="Set KKM">
										<div style="height:25px;float:right;font-size:16px;margin:5 3 0 0;">
											Set KKM
										</div>
										<div style="width:30px;height:25px;float:right;margin:0 0 0 10;">
											<img src="../images/Icon/Brush.png" width="35" heihgt="35">
										</div>
									</a>
									<div style="clear:both"></div>

									<div style="width:99%;height:91%;margin:3 0 0 4;">
										<div style="width:500px;height:250px;border:solid 2px #aaa;box-shadow: inset 0 0px 1px rgba(0, 0, 0, 0.050), 0 0 15px rgba(0, 0, 0, 0.50);margin:60 0 0 250;background:#fff;">
											<div style="width:99%;height:20%;float:left;margin:5 0 0 5;">
												<div style="width:7%;height:100%;float:left;">
													<img src="../images/Icon/Important.png" width="30" heihgt="30" style="margin:5 0 0 0;">
												</div>
												<div style="width:75%;height:100%;float:left;font-style:italic;font-size:30px;color:#aaa;">
													<font style="color:red;font-weight:bold">Ada fitur baru di menu nilai!!!</font>
												</div>
											</div>
											<div style="clear:both"></div>

											<div style="width:95%;height:55%;margin:5 0 0 10;">
												Anda telah mengakses aplikasi nilai <?echo $decode['pelajaran']?> kelas <?echo $decode['kelas']?>
												<table style="margin:5 0 0 0;">
													<tr style="border:none;">
														<td style="width:25px;"><img src="../images/Icon/Brush.png" width="30" height="30"></td>
														<td style="width:200px;">Tentukan nilai KKM pelajaran</td>
													</tr>
													<tr style="border:none;">
														<td style="width:25px;"><img src="../images/Icon/Document4.png" width="30" height="30"></td>
														<td style="width:200px;">Input nilai</td>
													</tr>
													<tr style="border:none;">
														<td style="width:25px;"><img src="../images/Icon/Crayons.png" width="30" height="30"></td>
														<td style="width:450px;">Cek dan edit nilai jika perlu pembenahan</td>
													</tr>
													<tr style="border:none;">
														<td style="width:25px;"><img src="../images/StartMenu/Printer.png" width="25" height="25"></td>
														<td style="width:450px;color:Red;font-weight:bold;">Cetak rekap nilai Tugas, Ulangan harian, UTS dan UAS</td>
													</tr>
												</table>
											</div>

											<div style="width:15%;height:20%;margin:10 10 0 0;float:right;">
												<input type="button" name="setKkm" value="Lanjutkan" onclick="location.href='index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$decode['pelajaran'].'&kelas='.$decode['kelas'].'&act=setKkm')?>'">
											</div>
										</div>
									</div>
								</div>
							<?
						}
					?>
				</div>
			<?
		}
	}

	elseif($decode['doraemon'] == "cetakRaport")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/StartMenu/Printer.png" height="30" width="30">
				</div>
				<div style="width:50%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					CETAK RAPORT KELAS <?echo $decode['kelas']?>
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
					<div style="width:99%;height:98%;border:solid 1px #aaa;margin:3 0 0 3;overflow-y:auto;background:#fff;">
						<table style="margin:3 3 0 3;">
							<tr style="background:#b0e0e6;text-align:center;">
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:100px;border-right:solid 1px #ccc;">NO.INDUK</td>
								<td style="width:500px;border-right:solid 1px #ccc;">NAMA SISWA</td>
								<td style="width:100px;border-right:solid 1px #ccc;">KELAS</td>
								<td style="width:100px;border-right:solid 1px #ccc;">CETAK RAPORT UTS</td>
								<td style="width:100px;border-right:solid 1px #ccc;">CETAK RAPORT UAS</td>
							</tr>
							<?
								$no = 1;
								$selSiswa = mysql_query("select * from m_siswa where kelas='$decode[kelas]' order by noInduk,nama asc");
								while($a_selSiswa = mysql_fetch_array($selSiswa))
								{
									if($no%2 == 1)
									{
										?>
											<tr style="background:#fff;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
													<?
														echo $no;
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_selSiswa['noInduk'];
													?>
												</td>
												<td style="width:400px;border-right:solid 1px #ccc;text-transform:uppercase;">
													<?
														echo $a_selSiswa['nama'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_selSiswa['kelas'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;font-size:11px;">
													<a href="output/raportUTS9.php?<?echo paramEncrypt('id='.$a_selSiswa['id'])?>" title="Cetak raport UTS <?echo $a_selSiswa['nama']?>" target="_blank">
														<img src="../images/StartMenu/Printer.png" width="25" height="25"><br>[P]Cetak Raport
													</a>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;font-size:11px;">
													<a href="output/raportUAS9.php?<?echo paramEncrypt('id='.$a_selSiswa['id'])?>" title="Cetak raport UAS <?echo $a_selSiswa['nama']?>" target="_blank">
														<img src="../images/StartMenu/Printer.png" width="25" height="25"><br>[P]Cetak Raport
													</a>
												</td>
											</tr>
										<?
									}

									else
									{
										?>
											<tr style="background:#efefef;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
													<?
														echo $no;
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_selSiswa['noInduk'];
													?>
												</td>
												<td style="width:400px;border-right:solid 1px #ccc;text-transform:uppercase;">
													<?
														echo $a_selSiswa['nama'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_selSiswa['kelas'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;font-size:11px;">
													<a href="output/raportUTS9.php?<?echo paramEncrypt('id='.$a_selSiswa['id'])?>" title="Cetak raport UTS <?echo $a_selSiswa['nama']?>" target="_blank">
														<img src="../images/StartMenu/Printer.png" width="25" height="25"><br>[P]Cetak Raport
													</a>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;font-size:11px;">
													<a href="output/raportUAS9.php?<?echo paramEncrypt('id='.$a_selSiswa['id'])?>" title="Cetak raport UAS <?echo $a_selSiswa['nama']?>" target="_blank">
														<img src="../images/StartMenu/Printer.png" width="25" height="25"><br>[P]Cetak Raport
													</a>
												</td>
											</tr>
										<?
									}
									$no=$no+1;
								}
							?>
						</table>
					</div>
				</div>
			</div>
		<?
	}

	elseif($decode['doraemon'] == "nilaiEkstra")
	{
		$ekstraCurrent = mysql_real_escape_string($decode['ekstra']);
		$cek = mysql_query("select * from m_ekstra where ekstra='$ekstraCurrent'");
		$a_cek = mysql_fetch_array($cek);

		if($a_cek['statusPeserta'] == 0)
		{
			?>
				<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
					<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
						<img src="../images/FileTypes/Archive.png" height="30" width="30">
					</div>
					<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;text-transform:uppercase;">
						PESERTA EKSTRA <?echo $decode['ekstra']?>
					</div>
					<div style="clear:both"></div>

					<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;overflow-y:auto;">
						<form name="setEkstra" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanPesertaEkstra')?>">
							<?
								$selectKelas = mysql_query("select * from m_kelas order by kelasRuang asc");
								while($a_selectKelas = mysql_fetch_array($selectKelas))
								{
									?>
										<table style="float:left;margin:5 5 0 5;">
											<tr style="background:#b0e0e6;text-align:Center;">
												<td colspan="2" style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;width:130px;">KELAS <?echo $a_selectKelas['kelasRuang']?></td>
											</tr>
											<?
												$selectMurid = mysql_query("select * from m_siswa where kelas='$a_selectKelas[kelasRuang]' order by noInduk,nama asc");
												while($a_selectMurid = mysql_fetch_array($selectMurid))
												{
													?>
														<tr>
															<td style="width:30px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">
																<input type="checkbox" name="noInduk[]" value="<?echo $a_selectMurid['noInduk']?>" title="<?echo $a_selectMurid['nama'].' '.$a_selectKelas['kelasRuang']?>">
															</td>
															<td style="width:100px;border-right:solid 1px #ccc;text-transform:uppercase;">
																<?
																	echo $a_selectMurid['nama'];
																?>
															</td>
														</tr>
													<?
												}
											?>
										</table>
									<?
								}
							?>
							<div style="width:100px;height:50px;float:left;margin:5 0 0 5;">
								<input type="hidden" name="jenisEkstra" value="<?echo $decode['ekstra']?>">
								<input type="hidden" name="uri" value="<?echo $uri?>">
								<input type="submit" name="simpanEkstra" value="Simpan Peserta">
							</div>
						</form>
					</div>
				</div>
			<?
		}

		else
		{
			?>
				<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
					<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
						<img src="../images/FileTypes/Archive.png" height="30" width="30">
					</div>
					<div style="width:50%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;text-transform:uppercase;">
						INPUT NILAI EKSTRA <?echo $decode['ekstra']?>
					</div>
					<div style="clear:both"></div>

					<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
						<div style="width:99%;height:98%;border:solid 1px #aaa;margin:3 3 0 3;background:#fff;overflow-y:auto;">
							<form name="nilaiEkstra" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanNilaiEkstra')?>">
								<table style="margin:3 3 0 3;">
									<tr style="text-align:Center;background:#b0e0e6;">
										<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
										<td style="width:500px;border-right:solid 1px #ccc;">NAMA SISWA</td>
										<td style="width:50px;border-right:solid 1px #ccc;">KELAS</td>
										<td style="width:150px;border-right:solid 1px #ccc;">EKSTRA</td>
										<td style="width:100px;border-right:solid 1px #ccc;">NILAI UTS</td>
										<td style="width:100px;border-right:solid 1px #ccc;">NILAI UAS</td>
									</tr>
									<?
										$no = 1;
										$list = mysql_query("select * from tbl_pesertaekstra where ekstra='$ekstraCurrent' order by kelas,noInduk,nama asc");
										while($a_list = mysql_fetch_array($list))
										{
											if($no%2 == 1)
											{
												?>
													<tr style="background:#fff;">
														<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
															<?
																echo $no;
															?>
														</td>
														<td style="width:350px;border-right:solid 1px #ccc;text-transform:uppercase;">
															<?
																echo $a_list['nama'];
															?>
														</td>
														<td style="width:50px;border-right:solid 1px #ccc;text-align:Center;">
															<?
																echo $a_list['kelas'];
															?>
														</td>
														<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
															<?
																echo $a_list['ekstra'];
															?>
														</td>
														<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
															<input type="text" name="nilaiUts[]" value="<?echo $a_list['UTS']?>" autocomplete="off" placeholder="Nilai UTS" style="text-align:center;width:65;">
														</td>
														<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
															<input type="text" name="nilaiUas[]" value="<?echo $a_list['UAS']?>" autocomplete="off" placeholder="Nilai UAS" style="text-align:center;width:65;">
															<input type="hidden" name="id[]" value="<?echo $a_list['id']?>">
														</td>
													</tr>
												<?
											}

											else
											{
												?>
													<tr style="background:#efefef;">
														<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
															<?
																echo $no;
															?>
														</td>
														<td style="width:350px;border-right:solid 1px #ccc;text-transform:uppercase;">
															<?
																echo $a_list['nama'];
															?>
														</td>
														<td style="width:50px;border-right:solid 1px #ccc;text-align:Center;">
															<?
																echo $a_list['kelas'];
															?>
														</td>
														<td style="width:150px;border-right:solid 1px #ccc;text-align:Center;">
															<?
																echo $a_list['ekstra'];
															?>
														</td>
														<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
															<input type="text" name="nilaiUts[]" value="<?echo $a_list['UTS']?>" autocomplete="off" placeholder="Nilai UTS" style="text-align:center;width:65;">
														</td>
														<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
															<input type="text" name="nilaiUas[]" value="<?echo $a_list['UAS']?>" autocomplete="off" placeholder="Nilai UAS" style="text-align:center;width:65;">
															<input type="hidden" name="id[]" value="<?echo $a_list['id']?>">
														</td>
													</tr>
												<?
											}
											$no = $no+1;
										}
									?>
									<tr style="border:none;">
										<td colspan="5"> </td>
										<td style="text-align:Center;">
											<input type="hidden" name="uri" value="<?echo $uri?>">
											<input type="submit" name="simpan" value="Simpan">
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
			<?
		}
	}
	
	//SMS SINGLE
	elseif($decode['doraemon'] == "smsSingle")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/Pic/hp.png" height="40" width="40" style="margin:-5 0 0 0;">
				</div>
				<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					KIRIM SMS KE WALI MURID <?echo $decode['kelas']?>
				</div>
				<div style="clear:both"></div>
				
				<div style="width:99%;height:90%;border:solid 1px #ccc;background:#efefef;">
					<form name="kirimSms" method="POST" action="procContent.php?<?echo paramEncrypt('process=kirimSmsSingle')?>">
						<table style="background:white;margin:5 5 5 5;">
							<tr>
								<td style="width:100px;border-left:solid 1px #ccc;border-right:Solid 1px #ccc;background:#b0e0e6;">NO. TUJUAN</td>
								<td style="width:200px;border-right:Solid 1px #ccc;">
									<?
										$target = mysql_query("select * from m_siswa where kelas='$decode[kelas]' and noTelpOrtu like '08%' order by nama asc");
										while($a_target = mysql_fetch_array($target))
										{
											?>
												<input type="checkbox" name="noTujuan[]" value="<?echo $a_target['noTelpOrtu']?>">&nbsp;<?echo "<font style='color:green;'>".$a_target['nama']."</font><br>"?>
											<?
										}
									?>
								</td>
								<td style="width:100px;border-right:Solid 1px #ccc;background:#b0e0e6;">ISI SMS</td>
								<td style="width:700px;border-right:Solid 1px #ccc;">
									<textarea name="pesan" style="height:80%;" maxlength="110" id="smsIsi" onKeyUp="lengthSms()"></textarea><br>
									PANJANG KARAKTER TERSEDIA <input type="text" style="width:5%;text-align:center;color:Red;border:red;font-size:18px;font-weight:bold;background:transparent;" id="smsPanjang" value="110"></input>
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-left:solid 1px #ccc;border-right:Solid 1px #ccc;background:#b0e0e6;">PENGIRIM</td>
								<td colspan="3" style="border-right:solid 1px #ccc;">
									<?echo $a_detailGuru['nama']?>
									<input type="hidden" name="pengirim" value="<?echo $a_detailGuru['nama']?>" readonly="readonly">
									<input type="hidden" name="uri" value="<?echo $uri?>" readonly="readonly">
								</td>
							</tr>
							<tr style="border:none;">
								<td colspan="4" style="background:#efefef;">
									<input type="submit" name="kirim" value="KIRIM" style="float:right;" onclick="javascript:var e = confirm('Yakin ingin mengirim sms ke wali murid?');if(e == true) return true; else return false">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		<?
	}
	
	//SMS BROADCASTER
	elseif($decode['doraemon'] == "broadcastSms")
	{
		?>
			<div style="width:100%;height:100%;float:left;margin:0 0 0 5;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../images/Pic/hp.png" height="40" width="40" style="margin:-5 0 0 0;">
				</div>
				<div style="width:40%;height:5%;margin:10 0 0 3;float:left;font-size:16px;color:red;">
					BROADCAST SMS KE WALI MURID <?echo $decode['kelas']?>
				</div>
				<div style="clear:both"></div>
				
				<div style="width:99%;height:90%;border:solid 1px #ccc;background:#efefef;">
					<form name="kirimSms" method="POST" action="procContent.php?<?echo paramEncrypt('process=kirimSms')?>">
						<table style="background:white;margin:5 5 5 5;">
							<tr>
								<td style="width:100px;border-left:solid 1px #ccc;border-right:Solid 1px #ccc;background:#b0e0e6;">NO. TUJUAN</td>
								<td style="width:1000px;border-right:Solid 1px #ccc;">
									<?
										$target = mysql_query("select * from m_siswa where kelas='$decode[kelas]' and noTelpOrtu like '08%' order by nama asc");
										while($a_target = mysql_fetch_array($target))
										{
											?>
												<div style="height:25px;border:solid 1px green;float:left;padding:3 3 3 3;margin:2 2 2 2;border-radius:5px;background:#efefef;line-height:90%;text-align:center;">
													<?echo "<font style='color:dodgerblue;'>".$a_target['nama']."</font><br>".$a_target['noTelpOrtu']?>
												</div>
												<input type="hidden" name="noHp[]" value="<?echo $a_target['noTelpOrtu']?>">
											<?
										}
									?>
								</td>
							</tr>
							<tr style="height:200px;">
								<td style="width:100px;border-left:solid 1px #ccc;border-right:Solid 1px #ccc;background:#b0e0e6;">ISI SMS</td>
								<td style="width:1000px;border-right:Solid 1px #ccc;">
									<textarea name="pesan" style="height:80%;" maxlength="110" id="smsIsi" onKeyUp="lengthSms()"></textarea><br>
									PANJANG KARAKTER TERSEDIA <input type="text" style="width:5%;text-align:center;color:Red;border:red;font-size:18px;font-weight:bold;background:transparent;" id="smsPanjang" value="110"></input>
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-left:solid 1px #ccc;border-right:Solid 1px #ccc;background:#b0e0e6;">PENGIRIM</td>
								<td style="width:1000px;border-right:Solid 1px #ccc;">
									<?echo $a_detailGuru['nama']?>
									<input type="hidden" name="pengirim" value="<?echo $a_detailGuru['nama']?>" readonly="readonly">
									<input type="hidden" name="uri" value="<?echo $uri?>" readonly="readonly">
								</td>
							</tr>
							<tr style="border:none;">
								<td colspan="2" style="background:#efefef;">
									<input type="submit" name="kirim" value="KIRIM" style="float:right;" onclick="javascript:var e = confirm('Yakin ingin mengirim sms ke wali murid?');if(e == true) return true; else return false">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		<?
	}

	//DASHBOARD
	else
	{
		?>
			<div style="width:98%;height:300px;border:solid 2px #ccc;margin:5 0 0 5;padding:3 3 3 3;" id="container">

			</div>

			<div style="width:50%;height:200px;border:solid 2px #ccc;float:left;margin:5 0 0 5;padding:3 3 3 3;" id="container1">

			</div>
			<div style="width:30%;height:200px;border:solid 2px #ccc;float:left;margin:5 0 0 5;padding:3 3 3 3;" id="container2">

			</div>
			<div style="width:15%;height:200px;border:solid 2px #ccc;float:left;margin:5 0 0 5;padding:3 3 3 3;overflow-x:hidden;overflow-y:auto;">
				<font style="font-size:15px;float:right;">IDENTITAS USER</font>
				<div style="clear:both"></div>

				<table style="margin:5 0 0 0;font-size:14px;color:green;font-style:italic;background:#efefef;">
					<tr>
						<td style="width:300px;border-right:solid 1px #ccc;border-left:Solid 1px #ccc;" title="Nama Guru">
							<?
								echo $a_detailGuru['nama'];
							?>
						</td>
					</tr>
					<tr>
						<td style="width:300px;border-right:solid 1px #ccc;border-left:Solid 1px #ccc;" title="Wali Kelas">
							<?
								if(empty($a_detailGuru['waliKelas']))
									echo "<font style='color:red'>Wali Kelas : -</font>";
								else
									echo "<font style='color:green'>Wali Kelas : ".$a_detailGuru['waliKelas']."</font>"
							?>
						</td>
					</tr>
					<tr>
						<td style="width:300px;border-right:solid 1px #ccc;border-left:Solid 1px #ccc;" title="Pelajaran">
							<?
								$selPelajaran = mysql_query("select * from m_gurupelajaran where nama='$a_detailGuru[nama]'");
								while($a_selPelajaran = mysql_fetch_array($selPelajaran))
								{
									echo $a_selPelajaran['pelajaran']."-".$a_selPelajaran['kelas']."<br>";
								}
							?>
						</td>
					</tr>
					<tr>
						<td style="width:300px;border-right:solid 1px #ccc;border-left:Solid 1px #ccc;" title="Ekstrakurikuler">
							<?
								$selEkstra = mysql_query("select * from m_guruekstra where nama='$a_detailGuru[nama]'");
								while($a_selEkstra = mysql_fetch_array($selEkstra))
								{
									echo $a_selEkstra['ekstra']."<br>";
								}
							?>
						</td>
					</tr>
				</table>
			</div>
		<?
	}
?>