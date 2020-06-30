<?
	//MASTER REFERENSI
	if($decode['doraemon'] == "masterReferensi")
	{
		?>
			<div style="width:30%;height:100%;border-right:solid 2px #ccc;margin:0 0 0 5;float:left;">
				<div style="width:10%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Extras/Home.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					MASTER<br>RUANG KELAS
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:30%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 -1;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">TAMBAH KELAS</font>
					<div style="clear:both;"></div>

					<form name="tambahKelas" method="post" action="procContent.php?<?echo paramEncrypt('process=tambahKelas')?>">
						<table style="margin:5 5 0 5;">
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Kelas</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<select name="kelas">
										<option value=""></option>
										<?
											for($a=1;$a<=12;$a++)
											{
												?>
													<option value="<?echo $a?>"><?echo $a?></option>
												<?
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Ruang</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<select name="ruang">
										<option value=""></option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
									</select>
								</td>
							</tr>
							<tr style="border:none;">
								<td colspan="2">
									<input type="submit" name="simpanKelas" value="Simpan" style="float:right;" onclick="return validateTambahKelas();">
								</td>
							</tr>
						</table>
					</form>
				</div>

				<div style="width:98%;height:55%;border:solid 2px #aaa;margin:5 5 0 -1;background:#efefef;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">LIST KELAS</font>
					<div style="clear:both;"></div>

					<div style="width:98%;height:90%;margin:3 3 0 3;overflow:auto;background:#fefefe;">
						<table>
							<tr style="text-align:center;background:#b0e0e6;color:#000;">
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:200px;border-right:solid 1px #ccc;">KELAS</td>
								<td style="width:50px;border-right:solid 1px #ccc;">ACT</td>
							</tr>
							<?
								$no = 1;
								$daftarKelas = mysql_query("select * from m_kelas order by kelas,ruang asc");
								while($a_daftarKelas = mysql_fetch_array($daftarKelas))
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
												<td style="width:200px;border-right:solid 1px #ccc;">
													<?
														echo "Kelas ".$a_daftarKelas['kelasRuang'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;font-size:10px;text-align:Center;">
													<a href="procContent.php?<?echo paramEncrypt('process=hapusKelas&id='.$a_daftarKelas['id'].'&kelas='.$a_daftarKelas['kelasRuang'])?>" title="Hapus data kelas <?echo $a_daftarKelas['kelasRuang']?>?" onclick="javascript:var r=confirm('Yakin ingin menghapus data kelas <?echo $a_daftarKelas['kelasRuang']?>?');if(r == true) return true; else return false">
														[x]Hapus
													</a>
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
												<td style="width:200px;border-right:solid 1px #ccc;">
													<?
														echo "Kelas ".$a_daftarKelas['kelasRuang'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;font-size:10px;text-align:Center;">
													<a href="procContent.php?<?echo paramEncrypt('process=hapusKelas&id='.$a_daftarKelas['id'].'&kelas='.$a_daftarKelas['kelasRuang'])?>" title="Hapus data kelas <?echo $a_daftarKelas['kelasRuang']?>?" onclick="javascript:var r=confirm('Yakin ingin menghapus data kelas <?echo $a_daftarKelas['kelasRuang']?>?');if(r == true) return true; else return false">
														[x]Hapus
													</a>
												</td>
											</tr>
										<?
									}
									$no = $no + 1;
								}
							?>
						</table>
					</div>
				</div>
			</div>

			<div style="width:30%;height:100%;border-right:solid 2px #ccc;margin:0 0 0 5;float:left;">
				<div style="width:10%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Extras/Address_Book.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					MASTER<br>MATA PELAJARAN
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:35%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 -1;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">TAMBAH MAPEL</font>
					<div style="clear:both;"></div>

					<form name="tambahPelajaran" method="post" action="procContent.php?<?echo paramEncrypt('process=tambahPelajaran')?>">
						<table style="margin:5 5 0 5;">
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Mata Pelajaran</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<input type="text" name="nmMapel" autocomplete="off">
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Kelompok</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<select name="kelompok">
										<option value="">- Kelompok -</option>
										<option value="Kelompok A">Kelompok A</option>
										<option value="Kelompok B">Kelompok B</option>
										<option value="Mulok">Mulok Wajib</option>
										<option value="Mulok Tambahan">Mulok Tambahan</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Existing</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<input type="checkbox" name="uts" value="1">&nbsp;UTS
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="uas" value="1">&nbsp;UAS
								</td>
							</tr>
							<tr style="border:none;">
								<td colspan="2">
									<input type="submit" name="simpanPelajaran" value="Simpan" style="float:right;" onclick="return validateTambahPelajaran();">
								</td>
							</tr>
						</table>
					</form>
				</div>

				<div style="width:98%;height:50%;border:solid 2px #aaa;margin:5 5 0 -1;background:#efefef;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">LIST MAPEL</font>
					<div style="clear:both;"></div>

					<div style="width:98%;height:90%;margin:3 3 0 3;overflow:auto;background:#fefefe;">
						<table>
							<tr style="text-align:center;background:#b0e0e6;color:#000;">
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:100px;border-right:solid 1px #ccc;">MAPEL</td>
								<td style="width:100px;border-right:solid 1px #ccc;">KELOMPOK</td>
								<td style="width:50px;border-right:solid 1px #ccc;">ACT</td>
							</tr>
							<?
								$naruto = 1;
								$daftarPelajaran = mysql_query("select * from m_pelajaran order by pelajaran asc");
								while($a_daftarPelajaran = mysql_fetch_array($daftarPelajaran))
								{
									if($naruto%2 == 1)
									{
										?>
											<tr style="background:#fff;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:Center;">
													<?
														echo $naruto;
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;">
													<?
														echo $a_daftarPelajaran['pelajaran'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $a_daftarPelajaran['kelompok'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;font-size:10px;text-align:Center;">
													<a href="procContent.php?<?echo paramEncrypt('process=hapusPelajaran&id='.$a_daftarPelajaran['id'].'&pelajaran='.$a_daftarPelajaran['pelajaran'])?>" title="Hapus data pelajaran <?echo $a_daftarPelajaran['pelajaran']?>?" onclick="javascript:var r=confirm('Yakin ingin menghapus data pelajaran <?echo $a_daftarPelajaran['pelajaran']?>?');if(r == true) return true; else return false">
														[x]Hapus
													</a>
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
														echo $naruto;
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;">
													<?
														echo $a_daftarPelajaran['pelajaran'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
													<?
														echo $a_daftarPelajaran['kelompok'];
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;font-size:10px;text-align:Center;">
													<a href="procContent.php?<?echo paramEncrypt('process=hapusPelajaran&id='.$a_daftarPelajaran['id'].'&pelajaran='.$a_daftarPelajaran['pelajaran'])?>" title="Hapus data pelajaran <?echo $a_daftarPelajaran['pelajaran']?>?" onclick="javascript:var r=confirm('Yakin ingin menghapus data pelajaran <?echo $a_daftarPelajaran['pelajaran']?>?');if(r == true) return true; else return false">
														[x]Hapus
													</a>
												</td>
											</tr>
										<?
									}
									$naruto = $naruto + 1;
								}
							?>
						</table>
					</div>
				</div>
			</div>

			<div style="width:38%;height:100%;margin:0 0 0 5;float:left;">
				<div style="width:10%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Desktop/Briefcase.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					IDENTITAS SEKOLAH &<br>EXTRAKURIKULER
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:53%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 -1;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">IDENTITAS DASAR</font>
					<div style="clear:both;"></div>

					<form name="identitasSekolah" method="post" action="procContent.php?<?echo paramEncrypt('process=identitasSekolah')?>">
						<table style="margin:5 5 0 5;">
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama Sekolah</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<?
										$namaSekolah = mysql_query("select * from m_param where param='namaSekolah'");
										$a_namaSekolah = mysql_fetch_array($namaSekolah);
									?>
									<input type="text" name="nmSekolah" autocomplete="off" value="<?echo $a_namaSekolah['value']?>">
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat Sekolah</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<?
										$alamatSekolah = mysql_query("select * from m_param where param='alamatSekolah'");
										$a_alamatSekolah = mysql_fetch_array($alamatSekolah);
									?>
									<input type="text" name="alamatSekolah" autocomplete="off" value="<?echo $a_alamatSekolah['value']?>">
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">No.Telepon</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<?
										$telpSekolah = mysql_query("select * from m_param where param='telpSekolah'");
										$a_telpSekolah = mysql_fetch_array($telpSekolah);
									?>
									<input type="text" name="noTelp" autocomplete="off" value="<?echo $a_telpSekolah['value']?>">
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Website</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<?
										$webSekolah = mysql_query("select * from m_param where param='webSekolah'");
										$a_webSekolah = mysql_fetch_array($webSekolah);
									?>
									<input type="text" name="website" autocomplete="off" value="<?echo $a_webSekolah['value']?>">
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Email</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<?
										$emailSekolah = mysql_query("select * from m_param where param='emailSekolah'");
										$a_emailSekolah = mysql_fetch_array($emailSekolah);
									?>
									<input type="text" name="email" autocomplete="off" value="<?echo $a_emailSekolah['value']?>">
								</td>
							</tr>
							<tr>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Kepala Sekolah</td>
								<td style="width:300px;border-right:solid 1px #ccc;">
									<?
										$kepalaSekolah = mysql_query("select * from m_param where param='kepalaSekolah'");
										$a_kepalaSekolah = mysql_fetch_array($kepalaSekolah);
									?>
									<input type="text" name="kepalaSekolah" autocomplete="off" value="<?echo $a_kepalaSekolah['value']?>">
								</td>
							</tr>
							<tr style="border:none;">
								<td colspan="2">
									<input type="submit" name="edit" value="Simpan" style="float:right;">
								</td>
							</tr>
						</table>
					</form>
				</div>

				<div style="width:40%;height:32%;border:solid 2px #aaa;background:#efefef;margin:5 5 0 -1;float:left;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">TAMBAH EXTRA</font>
					<div style="clear:both;"></div>

					<form name="simpanEkstra" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanExtra')?>">
						<table style="margin:3 0 0 3;">
							<tr>
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Extra kurikuler</td>
								<td style="width:150px;border-right:solid 1px #ccc;">
									<input type="text" name="ekstra" autocomplete="off">
								</td>
							</tr>
							<tr style="border:none;">
								<td colspan="2">
									<input type="submit" name="simpanEkstra" value="Simpan" style="float:right;" onclick="return validateEkstra();">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div style="width:56%;height:32%;border:solid 2px #aaa;background:#efefef;margin:5 5 0 -1;float:left;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">LIST EXTRA</font>
					<div style="clear:both;"></div>

					<div style="width:95%;height:83%;border:solid 1px #ccc;margin:3 0 0 3;background:#fff;overflow-y:auto;">
						<table style="margin:3 3 0 3;">
							<tr style="background:#b0e0e6;text-align:center;">
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">EKSTRA</td>
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">ACT</td>
							</tr>
							<?
								$genta = 1;
								$selectEkstra = mysql_query("select * from m_ekstra order by ekstra asc");
								while($a_selectEkstra = mysql_fetch_array($selectEkstra))
								{
									if($genta%2 == 1)
									{
										?>
											<tr style="background:#fff;">
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
													<?
														echo $genta;
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">
													<?
														echo $a_selectEkstra['ekstra']
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;font-size:10px;">
													<a href="procContent.php?<?echo paramEncrypt('process=hapusEkstra&id='.$a_selectEkstra['id'].'&nama='.$a_selectEkstra['ekstra'])?>" title="Hapus ekstra <?echo $a_selectEkstra['ekstra']?>?" onclick="javascript:var t = confirm('Yakin ingin menghapus ekstra <?echo $a_selectEkstra['ekstra']?>?');if(t == true) return true; else return false">
														[x]Hapus
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
														echo $genta;
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">
													<?
														echo $a_selectEkstra['ekstra']
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;font-size:10px;">
													<a href="procContent.php?<?echo paramEncrypt('process=hapusEkstra&id='.$a_selectEkstra['id'].'&nama='.$a_selectEkstra['ekstra'])?>" title="Hapus ekstra <?echo $a_selectEkstra['ekstra']?>?" onclick="javascript:var t = confirm('Yakin ingin menghapus ekstra <?echo $a_selectEkstra['ekstra']?>?');if(t == true) return true; else return false">
														[x]Hapus
													</a>
												</td>
											</tr>
										<?
									}
									$genta = $genta + 1;
								}
							?>
						</table>
					</div>
				</div>
			</div>
		<?
	}

	//PRIVELLEGE MAPEL
	elseif($decode['doraemon'] == "privellegeMapel")
	{
		?>
			<div style="width:99%;height:100%;margin:0 0 0 5;float:left;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Extras/Unlock.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					PRIVELLEGE<br>MATA PELAJARAN
				</div>
				<div style="clear:both"></div>

				<div style="width:99%;height:89%;border:solid 2px #ccc;margin:0 0 0 3;background:#efefef;overflow-y:auto;">
					<table style="margin:5 5 0 5;">
						<tr style="background:#b0e0e6;text-align:Center;">
							<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
							<td style="width:300px;border-right:solid 1px #ccc;">MATA PELAJARAN</td>
							<td style="width:100px;border-right:solid 1px #ccc;">KELOMPOK</td>
							<?
								$select = mysql_query("select * from m_kelas order by kelasRuang asc");
								while($a_select = mysql_fetch_array($select))
								{
									?>
										<td style="width:100px;border-right:solid 1px #ccc;">KELAS <?echo $a_select['kelasRuang']?></td>
									<?
								}
							?>
							<td style="width:50px;border-right:solid 1px #ccc;">ACT</td>
						</tr>
						<?
							$kenji = 1;
							$mapel = mysql_query("select * from m_pelajaran order by pelajaran asc");
							while($a_mapel = mysql_fetch_array($mapel))
							{
								?>
									<form name="privellegePelajaran" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanPrivellegePelajaran&mapel='.$a_mapel['pelajaran'])?>">
										<tr style="background:#fff;">
											<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;"><?echo $kenji?></td>
											<td style="width:300px;border-right:solid 1px #ccc;"><?echo $a_mapel['pelajaran']?></td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;"><?echo $a_mapel['kelompok']?></td>
											<?
												$select = mysql_query("select * from m_kelas order by kelasRuang asc");
												while($a_select = mysql_fetch_array($select))
												{
													?>
														<td style="width:100px;border-right:solid 1px #ccc;text-align:Center;">
															<select name="<?echo $a_select['kelasRuang']?>">
																<option value="<?echo $a_mapel[$a_select[kelasRuang]]?>"><?echo $a_mapel[$a_select[kelasRuang]]?></option>
																<option value="">- Privellege -</option>
																<option value="1">1 [Ada]</option>
																<option value="0">0 [Tidak Ada]</option>
															</select>
														</td>
													<?
												}
											?>
											<td style="width:50px;border-right:solid 1px #ccc;text-align:Center;">
												<input type="hidden" name="id" value="<?echo $a_mapel['id']?>">
												<input type="submit" name="simpanPrivellege" value="Simpan">
											</td>
										</tr>
									</form>
								<?
								$kenji = $kenji+1;
							}
						?>
					</table>
				</div>
			</div>
		<?
	}
	//DATA SISWA
	elseif($decode['doraemon'] == "dataSiswa")
	{
		?>
			<div style="width:30%;height:100%;margin:0 0 0 5;float:left;border-right:solid 2px #ccc;">
				<div style="width:10%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Extras/User.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					TAMBAH<br>DATA SISWA
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:87%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 -1;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">DATA SISWA</font>
					<div style="clear:both;"></div>

					<div style="width:99%;height:95%;overflow:auto;margin:0 0 0 1;">
						<form name="dataSiswa" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanDataSiswa')?>">
							<table style="margin:5 5 0 5;">
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">No.Induk</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="noInduk" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="nama" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">NISN</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="nisn" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Tempat Lahir</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="tempatLahir" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Tgl Lahir</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="tglLahir" autocomplete="off" style="width:50%">&nbsp;<font style="font-size:10px;font-style:italic;">Format YYYY-MM-DD</font>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Agama</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<select name="agama">
											<option value="">- Agama -</option>
											<option value="Islam">Islam</option>
											<option value="Protestan">Protestan</option>
											<option value="Katolik">Katolik</option>
											<option value="Hindhu">Hindhu</option>
											<option value="Budha">Budha</option>
											<option value="Kong Hu Cu">Kong Hu Cu</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Jenis Kelamin</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<select name="jenisKelamin">
											<option value="">- Jenis Kelamin -</option>
											<option value="L">Laki-laki</option>
											<option value="P">Perempuan</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Status dlm keluarga</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="statusKeluarga" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Anak ke</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="anakKe" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<textarea name="alamat" style="height:50px;"></textarea>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">No.Telp/HP</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="telp" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Sekolah Asal</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="sekolahAsal" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Diterima di kelas</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="terimaKelas" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Diterima tgl</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="tglTerima" autocomplete="off" style="width:50%;">&nbsp;<font style="font-size:10px;font-style:italic">Format YYYY-MM-DD</font>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama Ayah</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="ayah" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama Ibu</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="ibu" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat Ortu</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<textarea name="alamatOrtu" style="height:50px;"></textarea>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">No.Telp/HP Ortu</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="telpOrtu" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Pekerjaan Ayah</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="pekerjaanAyah" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Pekerjaan Ibu</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="pekerjaanIbu" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama wali</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="wali" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat wali</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<textarea name="alamatWali" style="height:50px;"></textarea>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">No.Telp/HP Wali</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="telpWali" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Pekerjaan wali</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="pekerjaanWali" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Kelas Sekarang</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<select name="kelas">
											<option value="">- Kelas -</option>
											<?
												$kelas = mysql_query("select * from m_kelas order by kelasRuang asc");
												while($a_kelas = mysql_fetch_array($kelas))
												{
													?>
														<option value="<?echo $a_kelas['kelasRuang']?>"><?echo $a_kelas['kelasRuang']?></option>
													<?
												}
											?>
										</select>
									</td>
								</tr>
								<tr style="border:none;">
									<td colspan="2">
										<input type="submit" name="simpan" value="Simpan" style="float:right;" onclick="return validateDataSiswa();"></input>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>

			<div style="width:68%;height:50%;margin:0 0 0 5;float:left;">
				<div style="width:5%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/FileTypes/TextDocument.png" height="30" width="30">
				</div>
				<div style="width:40%;height:10%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					DAFTAR<br>DATA SISWA
				</div>
				<div style="width:40%;height:10%;margin:5 0 0 3;float:right;font-size:16px;color:dodgerblue;">
					<form name="search" method="post" action="index.php?<?echo paramEncrypt('doraemon=dataSiswa')?>">
						<table>
							<tr style="border:none;">
								<td style="width:200px;">
									<input type="text" name="cariNama" autocomplete="off" placeholder="Cari nama siswa">
								</td>
								<td style="width:50px;">
									<input type="submit" name="cari" value="Cari">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div style="clear:both"></div>

				<div style="width:99%;height:80%;margin:15 5 0 3;overflow-y:auto;border:solid 2px #ccc;">
					<table style="margin:3 3 0 3;">
						<tr style="text-align:center;background:#b0e0e6;">
							<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
							<td style="width:100px;border-right:solid 1px #ccc;">NO.INDUK</td>
							<td style="width:100px;border-right:solid 1px #ccc;">KELAS</td>
							<td style="width:325px;border-right:solid 1px #ccc;">NAMA</td>
							<td style="width:100px;border-right:solid 1px #ccc;">ACT</td>
						</tr>
						<?
							$ambrose = 1;
							if(isset($_POST['cari']))
								$siswa = mysql_query("select * from m_siswa where nama like '%$_POST[cariNama]%'order by kelas,noInduk,nama asc");
							else
								$siswa = mysql_query("select * from m_siswa order by kelas,noInduk,nama asc");

							while($a_siswa = mysql_fetch_array($siswa))
							{
								if($ambrose%2 == 1)
								{
									?>
										<tr style="background:#fff;">
											<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
												<?
													echo $ambrose;
												?>
											</td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
												<?
													echo $a_siswa['noInduk'];
												?>
											</td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
												<?
													echo $a_siswa['kelas'];
												?>
											</td>
											<td style="width:325px;border-right:solid 1px #ccc;">
												<?
													echo $a_siswa['nama'];
												?>
											</td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;font-size:10px;">
												<a href="procContent.php?<?echo paramEncrypt('process=hapusSiswa&id='.$a_siswa['id'])?>" title="Hapus <?echo $a_siswa['nama']?>" onclick="javascript:var g = confirm('Hapus <?echo $a_siswa['nama']?>?');if(g == true) return true; else return false">
													[x]Hapus
												</a>&nbsp;
												<a href="index.php?<?echo paramEncrypt('doraemon=dataSiswa&edit='.$a_siswa['id'])?>" title="Edit <?echo $a_siswa['nama']?>">
													[e]Edit
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
													echo $ambrose;
												?>
											</td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
												<?
													echo $a_siswa['noInduk'];
												?>
											</td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
												<?
													echo $a_siswa['kelas'];
												?>
											</td>
											<td style="width:300px;border-right:solid 1px #ccc;">
												<?
													echo $a_siswa['nama'];
												?>
											</td>
											<td style="width:100px;border-right:solid 1px #ccc;text-align:center;font-size:10px;">
												<a href="procContent.php?<?echo paramEncrypt('process=hapusSiswa&id='.$a_siswa['id'])?>" title="Hapus <?echo $a_siswa['nama']?>" onclick="javascript:var g = confirm('Hapus <?echo $a_siswa['nama']?>?');if(g == true) return true; else return false">
													[x]Hapus
												</a>&nbsp;
												<a href="index.php?<?echo paramEncrypt('doraemon=dataSiswa&edit='.$a_siswa['id'])?>" title="Edit <?echo $a_siswa['nama']?>">
													[e]Edit
												</a>
											</td>
										</tr>
									<?
								}
								$ambrose = $ambrose+1;
							}
						?>
					</table>
				</div>
			</div>

			<div style="width:68%;height:46%;margin:0 0 0 5;float:left;">
				<div style="width:5%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/FileTypes/Wav.png" height="25" width="25">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					EDIT SISWA
				</div>
				<div style="clear:both"></div>

				<div style="width:99%;height:90%;margin:5 5 0 3;overflow-y:auto;border:solid 2px #ccc;">
					<?
						if(isset($decode['edit']))
						{
							$detailSiswa = mysql_query("select * from m_siswa where id='$decode[edit]'");
							$a_detailSiswa = mysql_fetch_array($detailSiswa);

							?>
								<form name="editSiswa" method="post" action="procContent.php?<?echo paramEncrypt('process=editSiswa&uri='.$uri)?>">
									<div style="height:99%;width:25%;float:left;margin:3 0 0 3;">
										<table style="font-size:11px;">
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">No.Induk</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="noInduk" autocomplete="off" value="<?echo $a_detailSiswa['noInduk']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="nama" autocomplete="off" value="<?echo $a_detailSiswa['nama']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">NISN</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="nisn" autocomplete="off" value="<?echo $a_detailSiswa['nisn']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Tmpt.Lahir</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="tempatLahir" autocomplete="off" value="<?echo $a_detailSiswa['tempatLahir']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Tgl.Lahir</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="tglLahir" autocomplete="off" value="<?echo $a_detailSiswa['tglLahir']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Agama</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<select name="agama" style="height:37px;">
														<option value="<?echo $a_detailSiswa['agama']?>"><?echo $a_detailSiswa['agama']?></option>
														<option value="">- Agama -</option>
														<option value="Islam">Islam</option>
														<option value="Protestan">Protestan</option>
														<option value="Katolik">Katolik</option>
														<option value="Hindhu">Hindhu</option>
														<option value="Budha">Budha</option>
														<option value="Kong Hu Cu">Kong Hu Cu</option>
													</select>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:99%;width:25%;float:left;margin:3 0 0 0;">
										<table style="font-size:11px;">
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Jenis Kelamin</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<?
														if($a_detailSiswa['jenisKelamin'] == "L")
															$kelaminAsal = "Laki-laki";
														else
															$kelaminAsal = "Perempuan";
													?>
													<select name="jenisKelamin">
														<option value="<?echo $a_detailSiswa['jenisKelamin']?>"><?echo $kelaminAsal?></option>
														<option value="">- Jenis Kelamin -</option>
														<option value="L">Laki-laki</option>
														<option value="P">Perempuan</option>
													</select>
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Status Keluarga</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="statusKeluarga" autocomplete="off" value="<?echo $a_detailSiswa['statusKeluarga']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Anak ke</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="anakKe" autocomplete="off" value="<?echo $a_detailSiswa['anakKe']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<textarea name="alamat" style="height:35px;"><?echo $a_detailSiswa['alamat']?></textarea>
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Telp</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="telp" autocomplete="off" value="<?echo $a_detailSiswa['noTelp']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Sekolah Asal</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="sekolahAsal" autocomplete="off" value="<?echo $a_detailSiswa['sekolahAsal']?>">
												</td>
											</tr>
										</table>
									</div>
									<div style="height:99%;width:25%;float:left;margin:3 0 0 0;">
										<table style="font-size:11px;">
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Diterima di kelas</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="diterimaKelas" autocomplete="off" value="<?echo $a_detailSiswa['diterimaKelas']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Tgl Diterima</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="tglDiterima" autocomplete="off" value="<?echo $a_detailSiswa['tglTerima']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama Ayah</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="ayah" autocomplete="off" value="<?echo $a_detailSiswa['ayah']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama Ibu</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="ibu" autocomplete="off" value="<?echo $a_detailSiswa['ibu']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat Ortu</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<textarea name="alamatOrtu" style="height:35px;"><?echo $a_detailSiswa['alamatOrtu']?></textarea>
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Telp Ortu</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="telpOrtu" autocomplete="off" value="<?echo $a_detailSiswa['noTelpOrtu']?>">
												</td>
											</tr>
										</table>
									</div>
									<div style="height:99%;width:23%;float:left;margin:3 0 0 0;">
										<table style="font-size:11px;">
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Pekerjaan Ayah</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="pekerjaanAyah" autocomplete="off" value="<?echo $a_detailSiswa['pekerjaanAyah']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Pekerjaan Ibu</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="pekerjaanIbu" autocomplete="off" value="<?echo $a_detailSiswa['pekerjaanIbu']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama Wali</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="wali" autocomplete="off" value="<?echo $a_detailSiswa['namaWali']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Alamat Wali</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<textarea name="alamatWali" style="height:35px"><?echo $a_detailSiswa['alamatWali']?></textarea>
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Telp Wali</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="telpWali" autocomplete="off" value="<?echo $a_detailSiswa['noTelpWali']?>">
												</td>
											</tr>
											<tr>
												<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Pekerjaan Wali</td>
												<td style="width:150px;border-right:solid 1px #ccc;">
													<input type="text" name="pekerjaanWali" autocomplete="off" value="<?echo $a_detailSiswa['pekerjaanWali']?>">
												</td>
											</tr>
											<tr style="border:none;">
												<td colspan="2">
													<input type="hidden" name="idSiswa" value="<?echo $a_detailSiswa['id']?>">
													<input type="submit" name="editSimpan" value="Simpan" style="float:right;">
												</td>
											</tr>
										</table>
									</div>
								</form>
							<?
						}

						else
						{
							?>
								<div style="width:10%;height:35%;margin:5 0 0 310;">
									<img src="../../../images/Extras/Up.png">
								</div>
								<div style="width:99%;height:10%;margin:3 0 0 3;font-style:italic;text-align:center;">
									Pilih edit untuk merubah data siswa
								</div>
							<?
						}
					?>
				</div>
			</div>
		<?
	}

	//DATA GURU
	elseif($decode['doraemon'] == "dataGuru")
	{
		?>
			<div style="width:40%;height:100%;border-right:solid 2px #ccc;float:left;">
				<div style="width:8%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Extras/User.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					DATA<br>STAFF GURU
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:87%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">TAMBAH GURU</font>
					<div style="clear:both;"></div>

					<div style="width:98%;height:93%;border:solid 1px #ccc;margin:3 3 0 3;overflow-y:auto;background:#fff;">
						<form name="tambahGuru" method="post" action="procContent.php?<?echo paramEncrypt('process=simpanGuru')?>">
							<table style="margin:5 3 0 3;">
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Nama</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<input type="text" name="namaGuru" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Wali Kelas</td>
									<td style="width:300px;border-right:solid 1px #ccc;">
										<select name="triggerWali" style="width:30%;float:left;" onchange="triggerWaliKelas();">
											<option value="No">Tidak</option>
											<option value="Yes">Ya</option>
										</select>
										<select name="kelasNaungan" style="width:68%;display:none;float:left;margin:0 0 0 3;">
											<option value="">- Kelas -</option>
											<?
												$kelasWali = mysql_query("select * from m_kelas order by kelasRuang asc");
												while($a_kelasWali = mysql_fetch_array($kelasWali))
												{
													?>
														<option value="<?echo $a_kelasWali['kelasRuang']?>"><?echo $a_kelasWali['kelasRuang']?></option>
													<?
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">
										Mata Pelajaran
									</td>
									<td style="width:300px;border-right:solid 1px #ccc;font-size:10px;font-style:italic;font-weight:bold;">
										*[Centang pada mata pelajaran & kelas yang diampu]
									</td>
								</tr>
								<?
									$listPelajaran = mysql_query("select * from m_pelajaran order by pelajaran asc");
									while($a_listPelajaran = mysql_fetch_array($listPelajaran))
									{
										?>
											<tr>
												<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-size:10px;font-weight:bold;text-transform:uppercase;">
													<input type="checkbox" name="pelajaran[]" value="<?echo $a_listPelajaran['pelajaran']?>" style="width:5px;height:5px;"><?echo $a_listPelajaran['pelajaran']?><br>
												</td>
												<td style="width:300px;border-right:solid 1px #ccc;font-size:10px;font-weight:bold;">
													<?
														$kelasPelajaran = mysql_query("select * from m_kelas order by kelasRuang asc");
														while($a_kelasPelajaran = mysql_fetch_array($kelasPelajaran))
														{
															if($a_listPelajaran[$a_kelasPelajaran[kelasRuang]] == "1")
															{
																?>
																	<input type="checkbox" name="<?echo $a_listPelajaran['pelajaran']?>[]?>" value="<?echo $a_kelasPelajaran['kelasRuang']?>" style="width:5px;height:5px;" title="<?echo $a_listPelajaran['pelajaran']." ".$a_kelasPelajaran['kelasRuang']?>"><?echo $a_kelasPelajaran['kelasRuang']?>
																<?
															}

															else
															{
																//nothing
															}
														}
													?>
												</td>
											</tr>
										<?
									}
								?>
								<tr>
									<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">Ekstrakurikuler</td>
									<td style="width:300px;border-right:solid 1px #ccc;font-size:10px;text-transform:uppercase;font-weight:bold;">
										<?
											$selEkstra = mysql_query("select * from m_ekstra order by ekstra asc");
											while($a_selEkstra = mysql_fetch_array($selEkstra))
											{
												?>
													<input type="checkbox" name="ekstra[]" value="<?echo $a_selEkstra['ekstra']?>">&nbsp;<?echo $a_selEkstra['ekstra']?><br>
												<?
											}
										?>
									</td>
								</tr>
								<tr style="border:none;">
									<td colspan="2">
										<input type="submit" name="simpanGuru" value="Simpan" style="float:Right;">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<div style="width:59%;height:100%;float:left;">
				<div style="width:5%;height:10%;margin:5 0 0 0;float:left;">
					<img src="../../../images/FileTypes/GIF.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					DAFTAR<br>STAFF GURU
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:87%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 5;overflow-y:auto;">
					<table style="margin:5 5 0 5;">
						<tr style="text-align:Center;background:#b0e0e6;">
							<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
							<td style="width:200px;border-right:solid 1px #ccc;">NAMA GURU</td>
							<td style="width:50px;border-right:solid 1px #ccc;">WALI KELAS</td>
							<td style="width:175px;border-right:solid 1px #ccc;">MAPEL</td>
							<td style="width:125px;border-right:solid 1px #ccc;">EKSTRA</td>
						</tr>
						<?
							$no = 1;
							$selGuru = mysql_query("select * from m_guru order by nama asc");
							while($a_selGuru = mysql_fetch_array($selGuru))
							{
								?>
									<tr style="background:#fff;">
										<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;text-align:center;">
											<?
												echo $no;
											?>
										</td>
										<td style="width:200px;border-right:solid 1px #ccc;">
											<?
												echo $a_selGuru['nama'];
											?>
										</td>
										<td style="width:50px;border-right:solid 1px #ccc;text-align:center;">
											<?
												if(empty($a_selGuru['waliKelas']))
													$wali = "-";
												else
													$wali = $a_selGuru['waliKelas'];
												echo $wali;
											?>
										</td>
										<td style="width:175px;border-right:solid 1px #ccc;font-size:11px;">
											<?
												$selPel = mysql_query("select * from m_gurupelajaran where nama='$a_selGuru[nama]' order by pelajaran,kelas asc");
												while($a_selPel = mysql_fetch_array($selPel))
												{
													echo $a_selPel['pelajaran']." ".$a_selPel['kelas']."<br>";
												}
											?>
										</td>
										<td style="width:125px;border-right:solid 1px #ccc;font-size:11px;">
											<?
												$selEkstra = mysql_query("select * from m_guruekstra where nama='$a_selGuru[nama]' order by ekstra asc");
												while($a_selEkstra = mysql_fetch_array($selEkstra))
												{
													echo $a_selEkstra['ekstra']."<br>";
												}
											?>
										</td>
									</tr>
								<?
								$no = $no+1;
							}
						?>
					</table>
				</div>
			</div>
		<?
	}

	elseif($decode['doraemon'] == "userControl")
	{
		?>
			<div style="width:100%;height:100%;float:left;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../../../images/Extras/User.png" height="30" width="30">
				</div>
				<div style="width:40%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;">
					CONTROL<br>MANAJEMEN USER
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;">
					<font style="font-size:15px;float:right;margin:0 5 0 0;">User Control</font>
					<div style="clear:both;"></div>

					<div style="width:99%;height:93%;border:solid 1px #aaa;margin:3 0 0 3;overflow-y:auto;background:#fff;">
						<table style="margin:5 5 0 5;">
							<tr style="background:#b0e0e6;text-align:center;">
								<td style="width:50px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;">NO</td>
								<td style="width:250px;border-right:solid 1px #ccc;">NAMA GURU</td>
								<td style="width:75px;border-right:solid 1px #ccc;">WALI</td>
								<td style="width:175px;border-right:solid 1px #ccc;">MATA PELAJARAN</td>
								<td style="width:125px;border-right:solid 1px #ccc;">EKSTRAKURIKULER</td>
								<td style="width:150px;border-right:solid 1px #ccc;">USERNAME</td>
								<td style="width:100px;border-right:solid 1px #ccc;">AKTIFASI AKUN</td>
								<td style="width:50px;border-right:solid 1px #ccc;">ACT</td>
							</tr>
							<?
								$no = 1;
								$selGuru = mysql_query("select * from m_guru order by nama asc");
								while($a_selGuru = mysql_fetch_array($selGuru))
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
												<td style="width:250px;border-right:solid 1px #ccc;">
													<?
														echo $a_selGuru['nama'];
													?>
												</td>
												<td style="width:75px;border-right:solid 1px #ccc;text-align:center;">
													<?
														if(empty($a_selGuru['waliKelas']))
															$kelas = "-";
														else
															$kelas = $a_selGuru['waliKelas'];

														echo $kelas;
													?>
												</td>
												<td style="width:175px;border-right:solid 1px #ccc;">
													<?
														$mapel = mysql_query("select * from m_gurupelajaran where nama='$a_selGuru[nama]' order by kelas,pelajaran asc");
														while($a_mapel = mysql_fetch_array($mapel))
														{
															echo $a_mapel['pelajaran']." ".$a_mapel['kelas']."<br>";
														}
													?>
												</td>
												<td style="width:125px;border-right:solid 1px #ccc;">
													<?
														$ekstra = mysql_query("select * from m_guruekstra where nama='$a_selGuru[nama]' order by ekstra asc");
														while($a_ekstra = mysql_fetch_array($ekstra))
														{
															echo $a_ekstra['ekstra']."<br>";
														}
													?>
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_selGuru['username'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
													<?
														if($a_selGuru['aktifasi'] == '0')
															$aktif = "<font style='color:red'>Belum aktifasi</font>";
														else
															$aktif = "<font style='color:green'>Sudah aktifasi</font>";

														echo $aktif;
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:center;font-size:12px;">
													<?
														if($a_selGuru['aktif'] == "1")
														{
															?>
																<a href="procContent.php?<?echo paramEncrypt('process=deaktifasiUser&id='.$a_selGuru['id'])?>" title="Deaktifasi" onclick="javasript:var deaktifasi = confirm('Yakin ingin deaktifasi user?');if(deaktifasi == true) return true;else return false">
																	[x]Deaktifasi
																</a>
															<?
														}

														else
														{
															?>
																<a href="procContent.php?<?echo paramEncrypt('process=reaktifasiUser&id='.$a_selGuru['id'])?>" title="Reaktifasi" onclick="javasript:var reaktifasi = confirm('Yakin ingin reaktifasi user?');if(reaktifasi == true) return true;else return false">
																	[v]Reaktifasi
																</a>
															<?
														}
													?>
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
												<td style="width:250px;border-right:solid 1px #ccc;">
													<?
														echo $a_selGuru['nama'];
													?>
												</td>
												<td style="width:75px;border-right:solid 1px #ccc;text-align:center;">
													<?
														if(empty($a_selGuru['waliKelas']))
															$kelas = "-";
														else
															$kelas = $a_selGuru['waliKelas'];

														echo $kelas;
													?>
												</td>
												<td style="width:175px;border-right:solid 1px #ccc;">
													<?
														$mapel = mysql_query("select * from m_gurupelajaran where nama='$a_selGuru[nama]' order by kelas,pelajaran asc");
														while($a_mapel = mysql_fetch_array($mapel))
														{
															echo $a_mapel['pelajaran']." ".$a_mapel['kelas']."<br>";
														}
													?>
												</td>
												<td style="width:125px;border-right:solid 1px #ccc;">
													<?
														$ekstra = mysql_query("select * from m_guruekstra where nama='$a_selGuru[nama]' order by ekstra asc");
														while($a_ekstra = mysql_fetch_array($ekstra))
														{
															echo $a_ekstra['ekstra']."<br>";
														}
													?>
												</td>
												<td style="width:150px;border-right:solid 1px #ccc;text-align:center;">
													<?
														echo $a_selGuru['username'];
													?>
												</td>
												<td style="width:100px;border-right:solid 1px #ccc;text-align:center;">
													<?
														if($a_selGuru['aktifasi'] == '0')
															$aktif = "<font style='color:red'>Belum aktifasi</font>";
														else
															$aktif = "<font style='color:green'>Sudah aktifasi</font>";

														echo $aktif;
													?>
												</td>
												<td style="width:50px;border-right:solid 1px #ccc;text-align:center;font-size:12px;">
													<?
														if($a_selGuru['aktif'] == "1")
														{
															?>
																<a href="procContent.php?<?echo paramEncrypt('process=deaktifasiUser&id='.$a_selGuru['id'])?>" title="Deaktifasi" onclick="javasript:var deaktifasi = confirm('Yakin ingin deaktifasi user?');if(deaktifasi == true) return true;else return false">
																	[x]Deaktifasi
																</a>
															<?
														}

														else
														{
															?>
																<a href="procContent.php?<?echo paramEncrypt('process=reaktifasiUser&id='.$a_selGuru['id'])?>" title="Reaktifasi" onclick="javasript:var reaktifasi = confirm('Yakin ingin reaktifasi user?');if(reaktifasi == true) return true;else return false">
																	[v]Reaktifasi
																</a>
															<?
														}
													?>
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
	
	//VERIFIKASI ABSEN
	elseif($decode['doraemon'] == "verifAbsen")
	{
		?>
			<div style="width:100%;height:100%;float:left;">
				<div style="width:3%;height:8%;margin:5 0 0 0;float:left;">
					<img src="../../../images/FileTypes/TextDocument.png" height="30" width="30">
				</div>
				<div style="width:60%;height:5%;margin:5 0 0 3;float:left;font-size:16px;color:dodgerblue;line-height:90%;">
					VERIFIKASI ABSENSI<br>
					<font style="font-size:12px;color:Red;">Setelah melakukan semua verifikasi absen, dianjurkan untuk <b>CLEAR LOG</b> absen agar mesin absen tidak overload</font>
				</div>
				
				<div style="width:8%;height:5%;margin:10 0 0 3;float:right;font-size:16px;color:red;">
					<a href="procContent.php?<?echo paramEncrypt('process=hapusLogAbsen&uri='.$uri)?>" style="color:red;" title="CLEAR LOG" onclick="javascript:var t = confirm('Yakin ingin membersihkan log di mesin absen?Data yang telah dibersihkan tidak bisa dikembalikan lagi karena akan dilakukan flashing RAM.');if(t == true) return true; else return false">
						CLEAR LOG
					</a>
				</div>
				<div style="width:3%;height:8%;margin:5 0 0 0;float:right;">
					<a href="procContent.php?<?echo paramEncrypt('process=hapusLogAbsen&uri='.$uri)?>" title="CLEAR LOG" onclick="javascript:var t = confirm('Yakin ingin membersihkan log di mesin absen?Data yang telah dibersihkan tidak bisa dikembalikan lagi karena akan dilakukan flashing RAM.');if(t == true) return true; else return false">
						<img src="../../../images/Desktop/RecycleBin.png" height="30" width="30">
					</a>
				</div>
				<div style="clear:both"></div>

				<div style="width:98%;height:89%;border:solid 2px #aaa;background:#efefef;margin:0 5 0 2;overflow-y:auto;overflow-x:hidden;">
					<?
						$IP="192.168.1.201";
						$Key="0";
						
						if($IP!="")
						{
							?>
								<table style="margin:5 5 5 5;background:white;">
									<tr style="text-align:center;color:orange;background:#b0e0e6;text-transform:uppercase;font-weight:bold;">
										<td style="width:75px;border-left:solid 1px #ccc;border-right:solid 1px #ccc;">No Induk</td>
										<td style="width:600px;border-right:solid 1px #ccc;">Nama Siswa</td>
										<td style="width:50px;border-right:solid 1px #ccc;">Kelas</td>
										<td style="width:150px;border-right:solid 1px #ccc;">Waktu Absen</td>
										<td style="width:50px;border-right:solid 1px #ccc;">Verify</td>
										<td style="width:50px;border-right:solid 1px #ccc;">Status</td>
									</tr>
									<?
										$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
										if($Connect)
										{
											$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
											$newLine="\r\n";
											fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
											fputs($Connect, "Content-Type: text/xml".$newLine);
											fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
											fputs($Connect, $soap_request.$newLine);
											$buffer="";
											while($Response=fgets($Connect, 1024))
											{
												$buffer=$buffer.$Response;
											}
											
											include("socketCon/parse.php");
											$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
											$buffer=explode("\r\n",$buffer);
											for($a=1;$a<(count($buffer)-1);$a++)
											{
												$data=Parse_Data($buffer[$a],"<Row>","</Row>");
												$PIN=Parse_Data($data,"<PIN>","</PIN>");
												$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
												$Verified=Parse_Data($data,"<Verified>","</Verified>");
												$Status=Parse_Data($data,"<Status>","</Status>");
												
												if($a%2 == 0)
												{
													?>
														<tr style="background:#ddd;">
													<?
												}
												
												else
												{
													?>
														<tr>
													<?
												}
															$panjangInduk = strlen($PIN);
															if($panjangInduk == 0)
																$induk = "";
															elseif($panjangInduk == 1)
																$induk = "000".$PIN;
															elseif($panjangInduk == 2)
																$induk = "00".$PIN;
															elseif($panjangInduk == 3)
																$induk = "0".$PIN;
															else
																$induk = $PIN;
															
															$selData = mysql_query("select * from m_siswa where noInduk='$induk'");
															$a_selData = mysql_fetch_array($selData);
														?>
														<td style="border-left:solid 1px #ccc;border-right:solid 1px #ccc;text-align:Center;"><?echo $induk?></td>
														<td style="border-right:solid 1px #ccc;"><?echo $a_selData['nama']?></td>
														<td style="border-right:solid 1px #ccc;text-align:Center;"><?echo $a_selData['kelas']?></td>
														<td style="border-right:solid 1px #ccc;text-align:Center;"><?echo $DateTime?></td>
														<td style="border-right:solid 1px #ccc;text-align:Center;">
															<?
																$cek = mysql_query("select * from tbl_rekapabsen where noInduk='$induk' and kelas='$a_selData[kelas]' and tgl='$DateTime'");
																$r_cek = mysql_num_rows($cek);
																
																if($r_cek == 0)
																{
																	?>
																		<form name="verifikasiAbsen" method="POST" action="procContent.php?<?echo paramEncrypt('process=verifikasiAbsen')?>" style="margin:0 0 0 0;">
																			<input type="hidden" name="noInduk" value="<?echo $induk?>">
																			<input type="hidden" name="nama" value="<?echo $a_selData['nama']?>">
																			<input type="hidden" name="kelas" value="<?echo $a_selData['kelas']?>">
																			<input type="hidden" name="tgl" value="<?echo $DateTime?>">
																			<input type="hidden" name="uri" value="<?echo $uri?>">
																			<input type="submit" value="VERIF">
																		</form>
																	<?
																}
																
																else
																	echo "<font style='color:green;font-weight:bold;'>OK</font>";
															?>
														</td>
														<td style="border-right:solid 1px #ccc;text-align:Center;">
															<?
																if($r_cek == 0)
																	echo "<font style='color:red;font-weight:bold;'>FP</font>";
																else
																	echo "<font style='color:green;font-weight:bold;'>DB</font>";
															?>
														</td>
													</tr>
												<?
											}
										}
										
										else
											echo "Koneksi Gagal";										
									?>
							<?
						}
					?>
					</table>
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
			<div style="width:60%;height:200px;border:solid 2px #ccc;float:left;margin:5 0 0 5;padding:3 3 3 3;" id="container2">

			</div>
			<div style="width:36%;height:200px;border:solid 2px #ccc;float:left;margin:5 0 0 5;padding:3 3 3 3;" id="container1">

			</div>
		<?
	}
?>