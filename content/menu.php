<?
	?>
		<table style="float:right;margin:5 5 5 5;font-size:14px;background:white;">
			<tr>
				<td style="width:30px;border-left:solid 1px #ccc;">
					<img src="../images/Desktop/Desktop.png" width="30" height="30" style="border:Solid 2px red;">
				</td>
				<td style="width:150px;border-right:solid 1px #ccc;">
					<a href="index.php?<?echo paramEncrypt('doraemon=dashboard')?>" title="Dashboard">Dashboard User</a>
				</td>
			</tr>
			<?
				//AKSES DATA SISWA
				if(empty($a_detailGuru['waliKelas']))
				{

				}

				else
				{
					?>
						<tr style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;color:dodgerblue;text-align:Center;background:#b0e0e6;">
							<td colspan="2">DATA SISWA</td>
						</tr>
						<tr>
							<td style="width:30px;border-left:solid 1px #ccc;">
								<img src="../images/StartMenu/Printer.png" width="30" height="30" style="border:Solid 2px dodgerblue;">
							</td>
							<td style="width:125px;border-right:solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=dataSiswa&kelas='.$a_detailGuru['waliKelas'])?>" title="Data Siswa <?echo $a_detailGuru['waliKelas']?>">Data Siswa</a>
							</td>
						</tr>
						<tr>
							<td style="width:30px;border-left:solid 1px #ccc;">
								<img src="../images/FileTypes/BMP.png" width="30" height="30" style="border:Solid 2px dodgerblue;">
							</td>
							<td style="width:125px;border-right:solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=absenSiswa&kelas='.$a_detailGuru['waliKelas'])?>" title="Rekap Absen Siswa <?echo $a_detailGuru['waliKelas']?>">Rekap Absen Siswa</a>
							</td>
						</tr>
						<tr>
							<td style="width:30px;border-left:solid 1px #ccc;">
								<img src="../images/FileTypes/TextDocument.png" width="30" height="30" style="border:Solid 2px dodgerblue;">
							</td>
							<td style="width:125px;border-right:solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=detailAbsenSiswa&kelas='.$a_detailGuru['waliKelas'])?>" title="Detail Absen Siswa <?echo $a_detailGuru['waliKelas']?>">Detail Absen Siswa</a>
							</td>
						</tr>
						<tr>
							<td style="width:30px;border-left:solid 1px #ccc;">
								<img src="../images/FileTypes/Default.png" width="30" height="30" style="border:Solid 2px dodgerblue;">
							</td>
							<td style="width:125px;border-right:solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=akhlakKepribadian&kelas='.$a_detailGuru['waliKelas'])?>" title="Aklhak & Kepribadian Siswa <?echo $a_detailGuru['waliKelas']?>">Nilai Akhlak</a>
							</td>
						</tr>
					<?
				}
				
				//INPUT NILAI MATA PELAJARAN
				$selectMapel = mysql_query("select * from m_gurupelajaran where nama='$a_detailGuru[nama]' order by pelajaran,kelas asc");
				$r_selectMapel = mysql_num_rows($selectMapel);
				if($r_selectMapel == 0)
				{

				}

				else
				{
					?>
						<tr style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;color:dodgerblue;text-align:Center;background:#b0e0e6;">
							<td colspan="2">MATA PELAJARAN</td>
						</tr>
					<?
					while($a_selectMapel = mysql_fetch_array($selectMapel))
					{
						?>
							<tr>
								<td style="width:30px;border-left:solid 1px #ccc;">
									<img src="../images/FileTypes/SystemConfiguration.png" width="30" height="30" style="border:Solid 2px orange;">
								</td>
								<td style="width:125px;border-right:solid 1px #ccc;">
									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiSiswa&pelajaran='.$a_selectMapel['pelajaran'].'&kelas='.$a_selectMapel['kelas'])?>" title="Nilai <?echo $a_selectMapel['pelajaran']." ".$a_selectMapel['kelas']?>"><?echo $a_selectMapel['pelajaran']." ".$a_selectMapel['kelas']?></a>
								</td>
							</tr>
						<?
					}
				}
				
				//NILAI EKSTRAKURIKULER
				$selectEkstra = mysql_query("select * from m_guruekstra where nama='$a_detailGuru[nama]' order by ekstra asc");
				$r_selectEkstra = mysql_num_rows($selectEkstra);
				if($r_selectEkstra == 0)
				{

				}

				else
				{
					?>
						<tr style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;color:dodgerblue;text-align:Center;background:#b0e0e6;">
							<td colspan="2">EKSTRAKURIKULER</td>
						</tr>
					<?
					while($a_selectEkstra = mysql_fetch_array($selectEkstra))
					{
						?>
							<tr>
								<td style="width:30px;border-left:solid 1px #ccc;">
									<img src="../images/FileTypes/Archive.png" width="30" height="30" style="border:Solid 2px magenta;">
								</td>
								<td style="width:125px;border-right:solid 1px #ccc;">
									<a href="index.php?<?echo paramEncrypt('doraemon=nilaiEkstra&ekstra='.$a_selectEkstra['ekstra'])?>" title="Nilai <?echo $a_selectEkstra['ekstra']?>"><?echo $a_selectEkstra['ekstra']?></a>
								</td>
							</tr>
						<?
					}	
				}
				
				//CETAK RAPORT
				if(empty($a_detailGuru['waliKelas']))
				{

				}

				else
				{
					?>
						<tr style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;color:dodgerblue;text-align:Center;background:#b0e0e6;">
							<td colspan="2">CETAK RAPORT</td>
						</tr>
						<?
							if($a_detailGuru['waliKelas'] == "7A" or $a_detailGuru['waliKelas'] == "7B")
							{
								?>
									<tr>
										<td style="width:30px;border-left:solid 1px #ccc;">
											<img src="../images/StartMenu/Printer.png" width="30" height="30" style="border:Solid 2px green;">
										</td>
										<td style="width:125px;border-right:solid 1px #ccc;">
											<a href="output/identitasSekolah.php" target="_blank" title="Cetak identitas sekolah untuk raport kelas <?echo $a_detailGuru['waliKelas']?>">Cetak ID Sekolah</a>
										</td>
									</tr>
								<?
							}
							
							else
							{
								//remove temporary
								?>
									<tr>
										<td style="width:30px;border-left:solid 1px #ccc;">
											<img src="../images/StartMenu/Printer.png" width="30" height="30" style="border:Solid 2px green;">
										</td>
										<td style="width:125px;border-right:solid 1px #ccc;">
											<a href="output/identitasSekolah.php" target="_blank" title="Cetak identitas sekolah untuk raport kelas <?echo $a_detailGuru['waliKelas']?>">Cetak ID Sekolah</a>
										</td>
									</tr>
								<?
							}
						?>
						<tr>
							<td style="width:30px;border-left:solid 1px #ccc;">
								<img src="../images/StartMenu/Printer.png" width="30" height="30" style="border:Solid 2px green;">
							</td>
							<td style="width:125px;border-right:solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=cetakRaport&kelas='.$a_detailGuru['waliKelas'])?>" title="Cetak raport kelas <?echo $a_detailGuru['waliKelas']?>">Cetak Raport</a>
							</td>
						</tr>
					<?
				}
				
				//SMS BROADCASTER
				if(empty($a_detailGuru['waliKelas']))
				{

				}

				else
				{
					?>
						<tr style="border-right:solid 1px #ccc;border-left:solid 1px #ccc;font-weight:bold;color:dodgerblue;text-align:Center;background:#b0e0e6;">
							<td colspan="2">FITUR SMS WALI MURID</td>
						</tr>
						<tr>
							<td style="width:30px;border-left:Solid 1px #ccc;">
								<img src="../images/Pic/hp.png" width="30" height="30" style="border:Solid 2px green;">
							</td>
							<td style="width:125px;border-right:Solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=smsSingle&kelas='.$a_detailGuru['waliKelas'])?>" title="SMS ke wali murid tertentu<?echo $a_detailGuru['waliKelas']?>">Single Messege</a>
							</td>
						</tr>
						<tr>
							<td style="width:30px;border-left:solid 1px #ccc;">
								<img src="../images/Pic/hp.png" width="30" height="30" style="border:Solid 2px green;">
							</td>
							<td style="width:125px;border-right:solid 1px #ccc;">
								<a href="index.php?<?echo paramEncrypt('doraemon=broadcastSms&kelas='.$a_detailGuru['waliKelas'])?>" title="Broadcast SMS ke wali murid <?echo $a_detailGuru['waliKelas']?>">Broadcast SMS</a>
							</td>
						</tr>
					<?
				}
			?>
		</table>
	<?
?>