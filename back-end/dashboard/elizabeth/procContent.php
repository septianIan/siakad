<?
	session_start();
	include("../../../secure/function.php");
	include("../../../kernel/version.php");
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
	
	if($decode['process'] == "tambahKelas")
	{
		$kelas = mysql_real_escape_string($_POST['kelas']);
		$ruang = mysql_real_escape_string($_POST['ruang']);
		$kelasRuang = $kelas.$ruang;

		$insert = mysql_query("insert into m_kelas(kelas,ruang,kelasRuang) values ('$kelas','$ruang','$kelasRuang');");
		if($insert)
		{
			$alter = mysql_query("alter table m_pelajaran add $kelasRuang varchar(1) not null after kelompok");
			if($alter)
			{
				$logActivity = "Tambah master kelas ".$kelasRuang;
				$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
				if($insertLog)
				{
					?>
						<script type="text/javascript">
							alert("Data ruang kelas telah disimpan");
							window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
						</script>
					<?
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Data ruang kelas telah disimpan. Log belum tercatat.");
							window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
						</script>
					<?
				}
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data ruang kelas telah disimpan. Update tbl pelajaran belum berhasil.");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Data ruang kelas belum berhasil disimpan.");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "hapusKelas")
	{
		$dropName = mysql_query("select * from m_kelas where id='$decode[id]'");
		$a_dropName = mysql_fetch_array($dropName);

		$remove = mysql_query("delete from m_kelas where id='$decode[id]'");
		if($remove)
		{
			$alter = mysql_query("alter table m_pelajaran drop $a_dropName[kelasRuang]");
			if($alter)
			{
				$logActivity = "Hapus master kelas ".$decode['kelas'];
				$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
				if($insertLog)
				{
					?>
						<script type="text/javascript">
							alert("Data ruang kelas telah dihapus");
							window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
						</script>
					<?
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Data ruang kelas telah dihapus. Log belum tercatat.");
							window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
						</script>
					<?
				}	
			}
			
			else
			{
				?>
					<script type="text/javascript">
						alert("Data ruang kelas telah dihapus. Update tbl_pelajaran belum berhasil.");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Data ruang kelas belum berhasil dihapus.");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "tambahPelajaran")
	{
		$mapel = mysql_real_escape_string($_POST['nmMapel']);
		$kelompok = mysql_real_escape_string($_POST['kelompok']);

		if(isset($_POST['uts']))
			$uts = "1";
		else
			$uts = "0";

		if(isset($_POST['uas']))
			$uas = "1";
		else
			$uas = "0";

		$insert = mysql_query("insert into m_pelajaran(pelajaran,kelompok,uts,uas) values ('$mapel','$kelompok','$uts','$uas')");
		if($insert)
		{
			$logActivity = "Tambah master pelajaran ".$mapel;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Data pelajaran berhasil disimpan.");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data ruang kelas berhasil disimpan. Log belum tercatat.");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil menyimpan data pelajaran. Cek kembali apakah pelajaran sudah ada di dalam sistem.");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "hapusPelajaran")
	{
		$remove = mysql_query("delete from m_pelajaran where id='$decode[id]'");
		if($remove)
		{
			$logActivity = "Hapus master pelajaran ".$decode['pelajaran'];
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Data pelajaran telah dihapus");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data pelajaran telah dihapus. Log belum tercatat.");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Data pelajaran belum berhasil dihapus.");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "identitasSekolah")
	{
		$namaSekolah = mysql_real_escape_string($_POST['nmSekolah']);
		$alamat = mysql_real_escape_string($_POST['alamatSekolah']);
		$telp = mysql_real_escape_string($_POST['noTelp']);
		$web = mysql_real_escape_string($_POST['website']);
		$email = mysql_real_escape_string($_POST['email']);
		$kepalaSekolah = mysql_real_escape_string($_POST['kepalaSekolah']);

		$updateNama = mysql_query("update m_param set value='$namaSekolah' where param='namaSekolah'");
		$updateAlamat = mysql_query("update m_param set value='$alamat' where param='alamatSekolah'");
		$updateTelp = mysql_query("update m_param set value='$telp' where param='telpSekolah'");
		$updateWeb = mysql_query("update m_param set value='$web' where param='webSekolah'");
		$updateEmail = mysql_query("update m_param set value='$email' where param='emailSekolah'");
		$updateKepalaSekolah = mysql_query("update m_param set value='$kepalaSekolah' where param='kepalaSekolah'");

		$logActivity = "Update identitas sekolah";
		$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
		if($insertLog)
		{
			?>
				<script type="text/javascript">
					alert("Identitas berhasil diupdate");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Identitas berhasil diupdate. Log belum tercatat");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "simpanExtra")
	{
		$ekstra = mysql_real_escape_string($_POST['ekstra']);

		$insert = mysql_query("insert into m_ekstra(ekstra,statusPeserta) values ('$ekstra','0')");
		if($insert)
		{
			$logActivity = "Tambah master ekstra kurikuler ".$ekstra;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Ekstra berhasil disimpan");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Ekstra berhasil disimpan. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil menyimpan data extra");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "hapusEkstra")
	{
		$delete = mysql_query("delete from m_ekstra where id='$decode[id]'");
		if($delete)
		{
			$logActivity = "Hapus ekstra kurikuler ".$decode['nama'];
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Ekstra berhasil dihapus");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Ekstra berhasil dihapus. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil hapus data extra");
					window.location = "index.php?<?echo paramEncrypt('doraemon=masterReferensi')?>";
				</script>
			<?	
		}
	}

	elseif($decode['process'] == "simpanPrivellegePelajaran")
	{
		$kelas = mysql_query("select * from m_kelas order by kelasRuang asc");
		while($a_kelas = mysql_fetch_array($kelas))
		{
			$value = $_POST[$a_kelas[kelasRuang]];
			$kolom = $a_kelas['kelasRuang'];

			$update = mysql_query("update m_pelajaran set $kolom=$value where id='$_POST[id]'");
		}

		if($update)
		{
			$logActivity = "Atur privellege pelajaran ".$decode['mapel'];
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Privellege pelajaran berhasil diupdate");
						window.location = "index.php?<?echo paramEncrypt('doraemon=privellegeMapel')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Privellege pelajaran berhasil disimpan. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt('doraemon=privellegeMapel')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Privellege pelajaran belum berhasil disimpan");
					window.location = "index.php?<?echo paramEncrypt('doraemon=privellegeMapel')?>";
				</script>
			<?	
		}
	}

	elseif($decode['process'] == "simpanDataSiswa")
	{	
		$noInduk = mysql_real_escape_string($_POST['noInduk']);
		$nama = mysql_real_escape_string($_POST['nama']);
		$nisn = mysql_real_escape_string($_POST['nisn']);
		$tempatLahir = mysql_real_escape_string($_POST['tempatLahir']);
		$tglLahir = mysql_real_escape_string($_POST['tglLahir']);
		$agama = mysql_real_escape_string($_POST['agama']);
		$jenisKelamin = mysql_real_escape_string($_POST['jenisKelamin']);
		$statusKeluarga = mysql_real_escape_string($_POST['statusKeluarga']);
		$anakKe = mysql_real_escape_string($_POST['anakKe']);
		$alamat = mysql_real_escape_string($_POST['alamat']);
		$noTelp = mysql_real_escape_string($_POST['telp']);
		$sekolahAsal = mysql_real_escape_string($_POST['sekolahAsal']);
		$diterimaKelas = mysql_real_escape_string($_POST['terimaKelas']);
		$tglTerima = mysql_real_escape_string($_POST['tglTerima']);
		$ayah = mysql_real_escape_string($_POST['ayah']);
		$ibu = mysql_real_escape_string($_POST['ibu']);
		$alamatOrtu = mysql_real_escape_string($_POST['alamatOrtu']);
		$noTelpOrtu = mysql_real_escape_string($_POST['telpOrtu']);
		$pekerjaanAyah = mysql_real_escape_string($_POST['pekerjaanAyah']);
		$pekerjaanIbu = mysql_real_escape_string($_POST['pekerjaanIbu']);
		$namaWali = mysql_real_escape_string($_POST['wali']);
		$alamatWali = mysql_real_escape_string($_POST['alamatWali']);
		$noTelpWali = mysql_real_escape_string($_POST['telpWali']);
		$pekerjaanWali = mysql_real_escape_string($_POST['pekerjaanWali']);
		$kelas = mysql_real_escape_string($_POST['kelas']);

		/*echo $noInduk."<br>";
		echo $nama."<br>";
		echo $nisn."<br>";
		echo $tempatLahir."<br>";
		echo $tglLahir."<br>";
		echo $agama."<br>";
		echo $jenisKelamin."<br>";
		echo $statusKeluarga."<br>";
		echo $anakKe."<br>";
		echo $alamat."<br>";
		echo $noTelp."<br>";
		echo $sekolahAsal."<br>";
		echo $diterimaKelas."<br>";
		echo $tglTerima."<br>";
		echo $ayah."<br>";
		echo $ibu."<br>";
		echo $alamatOrtu."<br>";
		echo $noTelpOrtu."<br>";
		echo $pekerjaanAyah."<br>";
		echo $pekerjaanIbu."<br>";
		echo $namaWali."<br>";
		echo $alamatWali."<br>";
		echo $noTelpWali."<br>";
		echo $pekerjaanWali."<br>";
		echo $kelas."<br>";*/
		$insert = mysql_query("insert into m_siswa(noInduk,nama,nisn,tempatLahir,tglLahir,agama,jenisKelamin,statusKeluarga,anakKe,alamat,noTelp,sekolahAsal,diterimaKelas,tglTerima,ayah,ibu,alamatOrtu,noTelpOrtu,pekerjaanAyah,pekerjaanIbu,namaWali,alamatWali,noTelpWali,pekerjaanWali,kelas) values ('$noInduk','$nama','$nisn','$tempatLahir','$tglLahir','$agama','$jenisKelamin','$statusKeluarga','$anakKe','$alamat','$noTelp','$sekolahAsal','$diterimaKelas','$tglTerima','$ayah','$ibu','$alamatOrtu','$noTelpOrtu','$pekerjaanAyah','$pekerjaanIbu','$namaWali','$alamatWali','$noTelpWali','$pekerjaanWali','$kelas')");
		if($insert)
		{
			$logActivity = "Simpan data siswa ".$nama." ;no.induk ".$noInduk." ;kelas ".$kelas;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Data siswa berhasil disimpan");
						window.location = "index.php?<?echo paramEncrypt('doraemon=dataSiswa')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data siswa berhasil disimpan. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt('doraemon=dataSiswa')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil menyimpan data siswa. Cek kembali no induk siswa.");
					window.location = "index.php?<?echo paramEncrypt('doraemon=dataSiswa')?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "editSiswa")
	{
		$id = mysql_real_escape_string($_POST['idSiswa']);
		$noInduk = mysql_real_escape_string($_POST['noInduk']);
		$nama = mysql_real_escape_string($_POST['nama']);
		$nisn = mysql_real_escape_string($_POST['nisn']);
		$tempatLahir = mysql_real_escape_string($_POST['tempatLahir']);
		$tglLahir = mysql_real_escape_string($_POST['tglLahir']);
		$agama = mysql_real_escape_string($_POST['agama']);
		$jenisKelamin = mysql_real_escape_string($_POST['jenisKelamin']);
		$statusKeluarga = mysql_real_escape_string($_POST['statusKeluarga']);
		$anakKe = mysql_real_escape_string($_POST['anakKe']);
		$alamat = mysql_real_escape_string($_POST['alamat']);
		$telp = mysql_real_escape_string($_POST['telp']);
		$sekolahAsal = mysql_real_escape_string($_POST['sekolahAsal']);
		$diterimaKelas = mysql_real_escape_string($_POST['diterimaKelas']);
		$tglTerima = mysql_real_escape_string($_POST['tglDiterima']);
		$ayah = mysql_real_escape_string($_POST['ayah']);
		$ibu = mysql_real_escape_string($_POST['ibu']);
		$alamatOrtu = mysql_real_escape_string($_POST['alamatOrtu']);
		$telpOrtu = mysql_real_escape_string($_POST['telpOrtu']);
		$pekerjaanAyah = mysql_real_escape_string($_POST['pekerjaanAyah']);
		$pekerjaanIbu = mysql_real_escape_string($_POST['pekerjaanIbu']);
		$wali = mysql_real_escape_string($_POST['wali']);
		$alamatWali = mysql_real_escape_string($_POST['alamatWali']);
		$telpWali = mysql_real_escape_string($_POST['telpWali']);
		$pekerjaanWali = mysql_real_escape_string($_POST['pekerjaanWali']);

		$update = mysql_query("update m_siswa set noInduk='$noInduk',nama='$nama',nisn='$nisn',tempatLahir='$tempatLahir',tglLahir='$tglLahir',agama='$agama',jenisKelamin='$jenisKelamin',statusKeluarga='$statusKeluarga',anakKe='$anakKe',alamat='$alamat',noTelp='$telp',sekolahAsal='$sekolahAsal',diterimaKelas='$diterimaKelas',tglTerima='$tglTerima',ayah='$ayah',ibu='$ibu',alamatOrtu='$alamatOrtu',noTelpOrtu='$telpOrtu',pekerjaanAyah='$pekerjaanAyah',pekerjaanIbu='$pekerjaanIbu',namaWali='$wali',alamatWali='$alamatWali',noTelpWali='$telpWali',pekerjaanWali='$pekerjaanWali' where id='$id'");
		if($update)
		{
			$logActivity = "Edit data siswa ".$nama;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Data siswa berhasil diupdate");
						window.location = "<?echo $decode['uri']?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data siswa berhasil diupdate. Log belum tercatat");
						window.location = "<?echo $decode['uri']?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil update data siswa");
					window.location = "<?echo $decode['uri']?>";
				</script>
			<?
		}
	}
	
	elseif($decode['process'] == "hapusSiswa")
	{
		$idSiswa = $decode['id'];
		$delete = mysql_query("delete from m_siswa where id='$idSiswa'");
		if($delete)
		{
			$logActivity = "Hapuas data siswa ";
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Data siswa berhasil dihapus");
						window.location = "index.php?<?echo paramEncrypt("doraemon=dataSiswa")?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data siswa berhasil dihapus. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt("doraemon=dataSiswa")?>";
					</script>
				<?
			}
		}
		
		else
		{
			?>
				<script>
					alert("Data siswa belum berhasil dihapus");
					window.location = "index.php?<?echo paramEncrypt("doraemon=dataSiswa")?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "simpanGuru")
	{
		$nama = mysql_real_escape_string($_POST['namaGuru']);
		$triggerWali = $_POST['triggerWali'];
		if($triggerWali == "Yes")
		{
			$wali = $_POST['kelasNaungan'];
		}

		else
		{
			$wali = "";
		}

		$insertGuru = mysql_query("insert into m_guru(nama,waliKelas,aktifasi,aktif) values ('$nama','$wali','0','1')");
		if($insertGuru)
		{
			if(isset($_POST['pelajaran']))
			{
				for($a=0;$a<=(count($_POST['pelajaran'])-1);$a++)
				{
					$sub = $_POST['pelajaran'][$a];
					$replacing = str_replace(" ", "_", $sub);
					
					for($b=0;$b<=(count($_POST[$replacing])-1);$b++)
					{
						$kelasAjar = $_POST[$replacing][$b];
						$insertMapel = mysql_query("insert into m_gurupelajaran(nama,kelas,pelajaran,createTbl) values ('$nama','$kelasAjar','$sub','0')");
					}
				}
			}

			else
			{
				$insertMapel = "none";
			}

			if($insertMapel)
			{
				if(isset($_POST['ekstra']))
				{
					for($c=0;$c<=(count($_POST['ekstra'])-1);$c++)
					{
						$ekstrakurikuler = $_POST['ekstra'][$c];
						$insertEkstra = mysql_query("insert into m_guruekstra(nama,ekstra,createTbl) values ('$nama','$ekstrakurikuler','0')");
					}
				}

				else
				{
					$insertEkstra = "none";
				}

				if($insertEkstra)
				{
					$logActivity = "Simpan data guru ".$nama;
					$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
					if($insertLog)
					{
						?>
							<script type="text/javascript">
								alert("Data guru berhasil disimpan");
								window.location = "index.php?<?echo paramEncrypt('doraemon=dataGuru')?>";
							</script>
						<?
					}

					else
					{
						?>
							<script type="text/javascript">
								alert("Data guru berhasil disimpan. Log belum tercatat");
								window.location = "index.php?<?echo paramEncrypt('doraemon=dataGuru')?>";
							</script>
						<?
					}
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Data guru dan pelajaran berhasil disimpan. Update guru ekstra belum berhasil.");
							window.location = "index.php?<?echo paramEncrypt('doraemon=dataGuru')?>";
						</script>
					<?
				}
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Data guru disimpan. Update guru pelajaran belum berhasil.");
						window.location = "index.php?<?echo paramEncrypt('doraemon=dataGuru')?>";
					</script>
				<?		
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Data guru belum berhasil disimpan");
					window.location = "index.php?<?echo paramEncrypt('doraemon=dataGuru')?>";
				</script>
			<?
		}
	}

	elseif($decode['process'] == "deaktifasiUser")
	{
		$deaktifasi = mysql_query("update m_guru set aktif='0' where id='$decode[id]'");
		if($deaktifasi)
		{
			$logActivity = "Deaktifasi data guru dengan id ".$decode['id'];
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Deaktifasi berhasil");
						window.location = "index.php?<?echo paramEncrypt('doraemon=userControl')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Dekatifasi berhasil. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt('doraemon=userControl')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil deaktifasi user");
					window.location = "index.php?<?echo paramEncrypt('userControl')?>";
				</script>
			<?	
		}
	}

	elseif($decode['process'] == "reaktifasiUser")
	{
		$reaktifasi = mysql_query("update m_guru set aktif='1' where id='$decode[id]'");
		if($reaktifasi)
		{
			$logActivity = "Reaktifasi data guru dengan id ".$decode['id'];
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$logUser','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Reaktifasi berhasil");
						window.location = "index.php?<?echo paramEncrypt('doraemon=userControl')?>";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Reaktifasi berhasil. Log belum tercatat");
						window.location = "index.php?<?echo paramEncrypt('doraemon=userControl')?>";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil reaktifasi user");
					window.location = "index.php?<?echo paramEncrypt('userControl')?>";
				</script>
			<?	
		}
	}

	//VERIFIKASI ABSEN
	elseif($decode['process'] == "verifikasiAbsen")
	{
		$noInduk = $_POST['noInduk'];
		$nama = mysql_real_escape_string($_POST['nama']);
		$kelas = $_POST['kelas'];
		$tgl = $_POST['tgl'];
		$uri = $_POST['uri'];
		
		$verif = mysql_query("insert into tbl_rekapabsen(noInduk,nama,kelas,tgl,keterangan) values ('$noInduk','$nama','$kelas','$tgl','M')");
		if($verif)
		{
			?>
				<script type="text/javascript">
					alert("Verifikasi berhasil");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
		
		else
		{
			?>
				<script type="text/javascript">
					alert("Verifikasi belum berhasil");
					window.location = "<?echo $uri?>";
				</script>
			<?
		}
	}
	
	//HAPUS LOG ABSEN
	elseif($decode['process'] == "hapusLogAbsen")
	{
		$IP="192.168.1.201";
		$Key="0";
		
		if($IP!="")
		{
			$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
			if($Connect)
			{
				$soap_request="<ClearData><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg></ClearData>";
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
				$buffer=Parse_Data($buffer,"<Information>","</Information>");
				?>
					<script type="text/javascript">
						alert("<?echo "Respon dari Mesin Absen : ".$buffer?>");
						window.location = "<?echo $decode['uri']?>";
					</script>
				<?
			}
			
			else
				echo "Koneksi Gagal";
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