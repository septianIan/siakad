<?
	session_start();
	include("../secure/function.php");
	include("../kernel/version.php");
	date_default_timezone_set('Asia/Jakarta');
	
	function ipClient()
	{
		$ipAdd = "";
		if(getenv('HTTP_CLIENT_IP'))
			$ipAdd = getenv('HTTP_CLIENT_IP');
		elseif(getenv('HTTP_X_FORWARDED_FOR'))
			$ipAdd = getenv('HTTP_X_FORWARDED_FOR'&quot);
		elseif(getenv('HTTP_X_FORWARDED'))
			$ipAdd = getenv('HTTP_X_FORWARDED');
		elseif(getenv('HTTP_FORWARDED_FOR'))
			$ipAdd = getenv('HTTP_FORWARDED_FOR');
		elseif(getenv('HTTP_FORWARDED'))
			$ipAdd = getenv('HTTP_FORWARDED');
		elseif(getenv('REMOTE_ADDR'))
			$ipAdd = getenv('REMOTE_ADDR');
		else
			$ipAdd = 'Unknown';
		
		return $ipAdd;
	}
	
	$uri = $_SERVER['REQUEST_URI'];
	$decode = decode($uri);

	$logIp = ipClient();
	$logTime = date("Y-m-d H:i:s");
	$logUser = $_SESSION['nama'];

	$semesterAjaran = mysql_query("select * from m_param where param='thnAjaran'");
	$a_semesterAjaran = mysql_fetch_array($semesterAjaran);

	$semester = mysql_query("select * from m_param where param='semester'");
	$a_semester = mysql_fetch_array($semester);

	if($decode['process'] == "createTbl")
	{
		$kelas = mysql_real_escape_string($_POST['kelas']);
		$pelajaran = mysql_real_escape_string($_POST['pelajaran']);
		$uri = mysql_real_escape_string($_POST['uri']);
		$mapel = str_replace(" ", "_", $pelajaran);

		$table = $mapel.$kelas;
		$db = "siakad";

		$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='$db' and table_name like '%$table%'");
		$a_cekTable = mysql_fetch_array($cekTable);

		if($a_cekTable['jumTable'] == 0)
		{
			$nilai = mysql_query("create table $table(id INT NOT NULL AUTO_INCREMENT, noInduk VARCHAR(10) NOT NULL, semester VARCHAR(10) NOT NULL, thnAjaran VARCHAR(20) NOT NULL, nama VARCHAR(200) NOT NULL, tag VARCHAR(50) NOT NULL, urutan INT(5) NOT NULL, nilai INT(5) NOT NULL, marker INT(2) NOT NULL, PRIMARY KEY (id))");
			if($nilai)
			{
				$updateGuru = mysql_query("update m_gurupelajaran set createTbl='1' where pelajaran='$pelajaran' and kelas='$kelas'");
				if($updateGuru)
				{
					$logActivity = "Create tabel nilai ".$table;
					$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
					if($insertLog)
					{
						?>
							<script type="text/javascript">
								alert("Berhasil memberikan ijin akses ke database nilai");
								window.location = "<?echo $uri?>";
							</script>
						<?
					}

					else
					{
						?>
							<script type="text/javascript">
								alert("Berhasil memberikan ijin akses ke database nilai. Log belum tercatat");
								window.location = "<?echo $uri?>";
							</script>
						<?
					}								
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Create database berhasil. Update guru pelajaran gagal.");
							window.location = "<?echo $uri?>";
						</script>
					<?
				}
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Belum berhasil create database nilai.");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Hak ijin telah diberikan");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "simpanAbsen")
	{
		$kelas = $_POST['kelas'];
		$uri = mysql_real_escape_string($_POST['uri']);

		for($r=0;$r<(count($_POST['noInduk']));$r++)
		{
			$noInduk = $_POST['noInduk'][$r];
			$nama = mysql_real_escape_string(($_POST['nama'][$r]));
			$sakit = $_POST['sakit'][$r];
			$sakit1 = $_POST['sakit1'][$r];
			$ijin = $_POST['ijin'][$r];
			$ijin1 = $_POST['ijin1'][$r];
			$alpha = $_POST['alpha'][$r];
			$alpha1 = $_POST['alpha1'][$r];

			$insert = mysql_query("insert into tbl_absen(noInduk,nama,kelas,sakit,sakit1,ijin,ijin1,alpha,alpha1) values ('$noInduk','$nama','$kelas','$sakit','$sakit1','$ijin','$ijin1','$alpha','$alpha1')");
		}

		if($insert)
		{
			$logActivity = "Entry rekap nilai kelas ".$kelas;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Rekap absen berhasil disimpan");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Rekap absen berhasil disimpan. Log belum tercatat");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}								
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil simpan rekap absen");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "updateAbsen")
	{
		$uri = mysql_real_escape_string($_POST['uri']);

		for($r=0;$r<(count($_POST['id']));$r++)
		{
			$id = $_POST['id'][$r];
			$sakit = $_POST['sakit'][$r];
			$sakit1 = $_POST['sakit1'][$r];
			$ijin = $_POST['ijin'][$r];
			$ijin1 = $_POST['ijin1'][$r];
			$alpha = $_POST['alpha'][$r];
			$alpha1 = $_POST['alpha1'][$r];

			$insert = mysql_query("update tbl_absen set sakit='$sakit',sakit1='$sakit1',ijin='$ijin',ijin1='$ijin1',alpha='$alpha',alpha1='$alpha1' where id='$id'");
		}

		if($insert)
		{
			$logActivity = "Update rekap nilai";
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Rekap absen berhasil diupdate");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Rekap absen berhasil diupdate. Log belum tercatat");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}								
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil update rekap absen");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "cariAbsen")
	{
		?>
			<script type="text/javascript">
				window.location = "index.php?<?echo paramEncrypt('doraemon=detailAbsenSiswa&kelas='.$_POST['kelas'].'&bulanAbsen='.$_POST['bulan'].'&tahunAbsen='.$_POST['tahun'])?>";
			</script>
		<?
	}
	
	elseif($decode['process'] == "inputAbsenManual")
	{
		$tgl = $_POST['tgl']." 07:00:00";
		$noInduk = $_POST['noInduk'];
		$kelas = $_POST['kelas'];
		$uri = $_POST['uri'];
		$keterangan = $_POST['status'];
		
		$sel = mysql_query("select * from m_siswa where noInduk='$noInduk'");
		$a_sel = mysql_fetch_array($sel);
		$namaSiswa = mysql_real_escape_string($a_sel['nama']);
		
		$insert = mysql_query("insert into tbl_rekapabsen(noInduk,nama,kelas,tgl,keterangan) values ('$noInduk','$namaSiswa','$a_sel[kelas]','$tgl','$keterangan')");
		if($insert)
		{
			?>
				<script type="text/javascript">
					alert("Absen berhasil disimpan.");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
		
		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil menyimpan absen.");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "editAbsenManual")
	{
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$update = mysql_query("update tbl_rekapabsen set keterangan='$status' where id='$id'");
		if($update)
		{
			?>
				<script type="text/javascript">
					alert("Absen berhasil di update.");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
		
		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil update absen.");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "simpanAkhlak")
	{
		$kelas = $_POST['kelas'];
		$uri = mysql_real_escape_string($_POST['uri']);

		for($a=0;$a<(count($_POST['noInduk']));$a++)
		{
			$noInduk = $_POST['noInduk'][$a];
			$nama = mysql_real_escape_string($_POST['nama'][$a]);
			$akhlak = $_POST['akhlak'][$a];
			$kepribadian = $_POST['kepribadian'][$a];

			$insert = mysql_query("insert into tbl_akhlak(noInduk,nama,kelas,akhlak,kepribadian) values ('$noInduk','$nama','$kelas','$akhlak','$kepribadian')");
		}

		if($insert)
		{
			$logActivity = "Simpan nilai akhlak dan kepribadian kelas ".$kelas;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Nilai akhlak kepribadian berhasil disimpan");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Nilai akhlak kepribadian berhasil disimpan. Log belum tercatat");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}								
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil simpan nilai akhlak kepribadian");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}	
	}

	elseif($decode['process'] == "updateAkhlak")
	{
		$uri = mysql_real_escape_string($_POST['uri']);

		for($a=0;$a<(count($_POST['id']));$a++)
		{
			$id = $_POST['id'][$a];
			$akhlak = $_POST['akhlak'][$a];
			$kepribadian = $_POST['kepribadian'][$a];
			
			$update = mysql_query("update tbl_akhlak set akhlak='$akhlak',kepribadian='$kepribadian' where id='$id'");
		}

		if($update)
		{
			$logActivity = "Update nilai akhlak dan kepribadian";
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Berhasil update nilai akhlak dan kepribadian");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Berhasil update nilai akhlak dan kepribadian. Log belum tercatat");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}								
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil update nilai akhlak dan kepribadian");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}	
	}

	elseif($decode['process'] == "simpanNilaiKelas9")
	{
		$jenis = mysql_real_escape_string($_POST['jenis']);
		$table = mysql_real_escape_string($_POST['table']);

		if($jenis == "TO")
			$marker = "1";
		elseif($jenis == "TP")
			$marker = "2";
		elseif($jenis == "TT")
			$marker = "3";
		elseif($jenis == "UH")
			$marker = "4";
		elseif($jenis == "UTS")
			$marker = "5";
		else
			$marker = "6";

		if($jenis == "UTS" or $jenis == "UAS")
		{
			$current = "";
		}

		else
		{
			$max = mysql_query("select max(urutan) as max from $table where tag='$jenis'");
			$a_max = mysql_fetch_array($max);
			if (empty($a_max['max'])) 
			{
				$current = "1";
			}

			else
			{
				$current = $a_max['max'] + 1;
			}
		}

		for($a=0;$a<=(count($_POST['nilai'])-1);$a++)
		{
			$noInduk = mysql_real_escape_string($_POST['noInduk'][$a]);
			$nama = mysql_real_escape_string($_POST['nama'][$a]);
			$nilai = mysql_real_escape_string($_POST['nilai'][$a]);

			if($jenis == "UH")
			{
				$insert = mysql_query("insert into $table(noInduk,semester,thnAjaran,nama,tag,urutan,nilai,marker) values ('$noInduk','$a_semester[value]','$a_semesterAjaran[value]','$nama','$jenis','$current','$nilai','$marker')");
				$insertRemidi = mysql_query("insert into $table(noInduk,semester,thnAjaran,nama,tag,urutan,nilai,marker) values ('$noInduk','$a_semester[value]','$a_semesterAjaran[value]','$nama','R','$current','','$marker')");
			}

			else
			{
				$insert = mysql_query("insert into $table(noInduk,semester,thnAjaran,nama,tag,urutan,nilai,marker) values ('$noInduk','$a_semester[value]','$a_semesterAjaran[value]','$nama','$jenis','$current','$nilai','$marker')");
			}
		}

		if($insert)
		{
			$logActivity = "Memasukkan nilai ".$jenis." ".$table;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Nilai berhasil disimpan");
						window.location = "<?echo $_POST['uri']?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Nilai berhasil disimpan. Log belum tercatat.");
						window.location = "<?echo $_POST['uri']?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil memasukkan data nilai siswa");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "updateNilai")
	{
		$tableName = mysql_real_escape_string($_POST['table']);
		$uriLocator = mysql_real_escape_string($_POST['uri']);

		$idUpdate = "";
		for($c=0;$c<=(count($_POST['id'])-1);$c++)
		{
			$nilaiUpdate = $_POST['nilai'][$c];
			$id = $_POST['id'][$c];

			$update = mysql_query("update $tableName set nilai='$nilaiUpdate' where id='$id'");
			$idUpdate = $idUpdate." ".$id;
		}

		if($update)
		{
			$logActivity = "Update nilai ".$idUpdate;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Update nilai berhasil");
						window.location = "<?echo $uriLocator?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Update nilai berhasil. Log belum tercatat.");
						window.location = "<?echo $uriLocator?>";
					</script>
				<?
			}	
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil update nilai");
					window.location = "<?echo $uriLocator?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "hapusNilai")
	{
		$pelajaran = mysql_real_escape_string($decode['pelajaran']);
		$kelas = mysql_real_escape_string($decode['kelas']);
		$table = mysql_real_escape_string($decode['table']);
		$jenis = mysql_real_escape_string($decode['jenis']);
		$urutan = mysql_real_escape_string($decode['urutan']);
		$uri = mysql_real_escape_string($decode['uri']);
		
		//echo $pelajaran." ".$kelas." ".$table." ".$jenis." ".$urutan." ".$uri;
		if($jenis == "UTS" or $jenis == "UAS")
		{
			$delete =  mysql_query("delete from $table where tag='$jenis' and urutan='$urutan'");
			if($delete)
			{
				$logActivity = "Hapus nilai ".$jenis." ".$urutan." ".$pelajaran." ".$kelas;
				$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
				if($insertLog)
				{
					?>
						<script type="text/javascript">
							alert("Nilai berhasil dihapus");
							window.location = "<?echo $uri?>";
						</script>
					<?
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Nilai berhasil dihapus. Log belum tercatat.");
							window.location = "<?echo $uri?>";
						</script>
					<?
				}
			}
			
			else
			{
				?>
					<script>
						alert("Belum berhasil hapus nilai");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}
		}

		elseif($jenis == "UH")
		{
			$delete = mysql_query("delete from $table where tag='$jenis' and urutan='$urutan' or tag='R' and urutan='$urutan'");
			if($delete)
			{
				$urutanNew = 1;
				$distinctUrutan = mysql_query("select distinct(urutan) as urutan from $table where tag='$jenis' order by urutan asc");
				while($a_distinct = mysql_fetch_array($distinctUrutan))
				{
					$update = mysql_query("update $table set urutan='$urutanNew' where tag='$jenis' and urutan='$a_distinct[urutan]' or tag='R' and urutan='$a_distinct[urutan]'");
					$urutanNew = $urutanNew + 1;
				}
				
				if($update)
				{
					$logActivity = "Hapus nilai ".$jenis." ".$urutan." ".$pelajaran." ".$kelas;
					$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
					if($insertLog)
					{
						?>
							<script type="text/javascript">
								alert("Nilai berhasil dihapus");
								window.location = "<?echo $uri?>";
							</script>
						<?
					}

					else
					{
						?>
							<script type="text/javascript">
								alert("Nilai berhasil dihapus. Log belum tercatat.");
								window.location = "<?echo $uri?>";
							</script>
						<?
					}
				}
				
				else
				{
					?>
						<script type="text/javascript">
							alert("Nilai berhasil dihapus. Update urutan gagal.");
							window.location = "<?echo $uri?>";
						</script>
					<?
				}
			}
			
			else
			{
				?>
					<script>
						alert("Belum berhasil hapus nilai");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}
		}
		
		else
		{
			$delete = mysql_query("delete from $table where tag='$jenis' and urutan='$urutan'");
			if($delete)
			{
				$urutanNew = 1;
				$distinctUrutan = mysql_query("select distinct(urutan) as urutan from $table where tag='$jenis' order by urutan asc");
				while($a_distinct = mysql_fetch_array($distinctUrutan))
				{
					$update = mysql_query("update $table set urutan='$urutanNew' where tag='$jenis' and urutan='$a_distinct[urutan]'");
					$urutanNew = $urutanNew + 1;
				}
				
				if($update)
				{
					$logActivity = "Hapus nilai ".$jenis." ".$urutan." ".$pelajaran." ".$kelas;
					$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
					if($insertLog)
					{
						?>
							<script type="text/javascript">
								alert("Nilai berhasil dihapus");
								window.location = "<?echo $uri?>";
							</script>
						<?
					}

					else
					{
						?>
							<script type="text/javascript">
								alert("Nilai berhasil dihapus. Log belum tercatat.");
								window.location = "<?echo $uri?>";
							</script>
						<?
					}
				}
				
				else
				{
					?>
						<script type="text/javascript">
							alert("Nilai berhasil dihapus. Update urutan gagal.");
							window.location = "<?echo $uri?>";
						</script>
					<?
				}
			}
			
			else
			{
				?>
					<script>
						alert("Belum berhasil hapus nilai");
						window.location = "<?echo $uri?>";
					</script>
				<?
			}
		}
	}

	elseif($decode['process'] == "setKkm")
	{
		$setKkm = mysql_real_escape_string($_POST['kkm']);
		$pelajaran = mysql_real_escape_string($_POST['pelajaran']);
		$kelas = mysql_real_escape_string($_POST['kelas']);
		$uriLocator = mysql_real_escape_string($_POST['uri']);

		$insert = mysql_query("insert into m_kkm(pelajaran,kelas,kkm) values ('$pelajaran','$kelas','$setKkm')");
		if($insert)
		{
			$logActivity = "Set KKM ".$pelajaran." ".$kelas;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("KKM berhasil diset");
						window.location = "<?echo $uriLocator?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("KKM berhasil disimpan. Log belum tercatat.");
						window.location = "<?echo $uriLocator?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil set KKM");
					window.location = "<?echo $uriLocator?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "updateKkm")
	{
		$setKkm = mysql_real_escape_string($_POST['kkm']);
		$id = mysql_real_escape_string($_POST['id']);
		$uriLocator = mysql_real_escape_string($_POST['uri']);

		$update = mysql_query("update m_kkm set kkm='$setKkm' where id='$id'");
		if($update)
		{
			$logActivity = "Update KKM id ".$id;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("KKM berhasil diupdate");
						window.location = "<?echo $uriLocator?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("KKM berhasil diupdate. Log belum tercatat.");
						window.location = "<?echo $uriLocator?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil update KKM");
					window.location = "<?echo $uriLocator?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "simpanPesertaEkstra")
	{
		$ekstra = mysql_real_escape_string($_POST['jenisEkstra']);

		for($a=0;$a<(count($_POST['noInduk']));$a++)
		{
			$noInduk = mysql_real_escape_string($_POST['noInduk'][$a]);

			$select = mysql_query("select * from m_siswa where noInduk='$noInduk'");
			$a_select = mysql_fetch_array($select);

			$nama = mysql_real_escape_string($a_select['nama']);
			$kelas = mysql_real_escape_string($a_select['kelas']);

			$insert = mysql_query("insert into tbl_pesertaekstra(noInduk,nama,kelas,ekstra) values ('$noInduk','$nama','$kelas','$ekstra')");
		}

		if($insert)
		{
			$update = mysql_query("update m_ekstra set statusPeserta='1' where ekstra='$ekstra'");
			if($update)
			{
				$logActivity = "Set peserta ekstra ".$ekstra;
				$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
				if($insertLog)
				{
					?>
						<script type="text/javascript">
							alert("Peserta ekstra berhasil disimpan");
							window.location = "<?echo $_POST['uri']?>";
						</script>
					<?
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Peserta ekstra berhasil disimpan. Log belum tercatat.");
							window.location = "<?echo $_POST['uri']?>";
						</script>
					<?
				}
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Update status peserta ekstra belum berhasil.");
						window.location = "<?echo $_POST['uri']?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil menyimpan data ekstra");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "simpanNilaiEkstra")
	{
		for($a=0;$a<(count($_POST['id']));$a++)
		{
			$id = $_POST['id'][$a];
			$uts = $_POST['nilaiUts'][$a];
			$uas = $_POST['nilaiUas'][$a];

			$update = mysql_query("update tbl_pesertaekstra set UTS='$uts',UAS='$uas' where id='$id'");
		}

		if($update)
		{
			$logActivity = "Memasukkan nilai ekstra";
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Nilai ekstra telah disimpan");
						window.location = "<?echo $_POST['uri']?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Nilai ekstra telah disimpan. Log belum tercatat.");
						window.location = "<?echo $_POST['uri']?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Nilai ekstra belum tersimpan");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "kirimSmsSingle")
	{
		$pesan = $_POST['pesan']."/n".$_POST['pengirim'];
		
		$cek = 0;
		for($r=0;$r<=(count($_POST['noTujuan'])-1);$r++)
		{
			$noTujuan = $_POST['noTujuan'][$r];
			$outbox = mysql_query("insert into outbox(DestinationNumber,TextDecoded) values ('$noTujuan','$pesan')");
			if($outbox)
				$cek = $cek + 1;
			else
				$cek = $cek;
		}
		
		if(count($_POST['noTujuan']) == $cek)
		{
			?>
				<script type="text/javascript">
					alert("Semua SMS telah terkirim ke wali murid.");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
		
		else
		{
			?>
				<script type="text/javascript">
					alert("SMS telah terkirim, tetapi ada beberapa sms yang belum terkirim");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "kirimSms")
	{
		$cekSum = 0;
		$cek = count($_POST['noHp']);
		echo $cek;
		
		$pesan = $_POST['pesan']."/n".$_POST['pengirim'];
		for($r=0;$r<=(count($_POST['noHp'])-1);$r++)
		{
			$noTujuan = $_POST['noHp'][$r];
			$outbox = mysql_query("insert into outbox(DestinationNumber,TextDecoded) values ('$noTujuan','$pesan')");
			$cekSum = $cekSum + 1;
		}
		
		if($cekSum == $cek)
		{
			?>
				<script>
					alert("SMS telah di broadcast ke orang tua / wali murid.");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
		
		else
		{
			?>
				<script>
					alert("Ada SMS yang belum terkirim. Hubungi administrator untuk lebih jelasnya.");
					window.location = "<?echo $_POST['uri']?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "logout")
	{
		session_unset();
		session_destroy();
		?>
			<script>
				window.location = "../index.php";
			</script>
		<?
	}
	
	else
	{
		?>
			<script>
				alert("Proses tidak diketehui");
				window.location = "index.php";
			</script>
		<?
	}
?>