<?	
	session_start();
	include("../../../kernel/version.php");
	include("../../../secure/function.php");
	$uri = $_SERVER['REQUEST_URI'];
	$decode = decode($uri);
	
	if(empty($_SESSION['nama']) or $_SESSION['nama'] == "")
	{
		?>
			<script type="text/javascript">
				alert("Anda harus login dengan super user.");
				window.location = "../index.php";
			</script>
		<?
	}

	else
	{
		?>	
			<html>
				<head>
					<meta charset="utf-8">
					<link rel="shortcut icon" href="../../../images/Icon/Pad.png" type="image/png"/>
					<title>ADMINISTRATOR</title>

					<link rel="stylesheet" href="../../../css/fontFace.css">
					<link rel="stylesheet" href="../../../css/css.css">
					<link rel="stylesheet" href="../../../css/style.css">
					<script src="js/jquery.js" type="text/javascript"></script>
					<script src="js/jquery.min.js" type="text/javascript"></script>
					<script src="js/highcharts.js" type="text/javascript"></script>

					<?
						include("jsFunction.php");
					?>
				</head>

				<body style="font-family:'Ubuntu';font-size:14px;overflow-x:hidden;">
					<div style="width:102%;height:8%;border-bottom:solid 2px #ccc;margin:-10 0 0 -10;background:#efefef;">
						<div style="width:20%;height:70%;margin:8 0 0 10;float:left;font-size:20px;">
							<i>Dashboard Administrator</i>
						</div>

						<div style="width:20%;height:70%;margin:10 10 0 0;float:right;font-size:16px;">
							<?							
								echo $_SESSION['nama']."  &nbsp;|&nbsp; ";
							?>
							<a href="procContent.php?<?echo paramEncrypt('process=logout')?>" onclick="javascript:var t=confirm('Yakin ingin keluar?');if(t == true) return true; else return false">Logout</a>
						</div>
					</div>

					<?
						$cekThnAjaran = mysql_query("select * from m_param where param='thnAjaran'");
						$a_cekThnAjaran = mysql_fetch_array($cekThnAjaran);

						$cekSemester = mysql_query("select * from m_param where param='semester'");
						$a_cekSemester = mysql_fetch_array($cekSemester);
						
						if($a_cekThnAjaran['value'] == "" or $a_cekSemester['value'] == "")
						{
							?>
								<div style="width:30%;height:30%;border:solid 2px #aaa;margin:125 0 0 425;">
									<div style="height:30%;width:99%;">
										<div style="height:100%;width:20%;float:right;font-size:20px;">
											Setting<br>Akhir
										</div>
										<div style="height:100%;width:15%;float:right;">
											<img src="../../../images/Icon/Important.png" width="50px" height="50px">
										</div>
									</div>
									<div style="height:60%;width:99%;">
										<form name="finalSetting" method="post" action="<?echo $_SERVER['PHP_SELF']?>">
											<table style="margin:5 5 0 5;">
												<tr>
													<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">TAHUN AJARAN</td>
													<td style="width:250px;border-right:solid 1px #ccc;">
														<input type="text" name="thnAjaran" autocomplete="off">
													</td>
												</tr>
												<tr>
													<td style="width:100px;border-right:solid 1px #ccc;border-left:solid 1px #ccc;background:#b0e0e6;">SEMESTER</td>
													<td style="width:250px;border-right:solid 1px #ccc;">
														<select name="semesterAktif">
															<option value="">- Semester Aktif -</option>
															<option value="ganjil">Semester Ganjil</option>
															<option value="genap">Semester Genap</option>
														</select>
													</td>
												</tr>
												<tr style=border:none;>
													<td colspan="2">
														<input type="submit" name="simpanSetting" value="Finalize" style="float:right;" onclick="return finalisasi();">
													</td>
												</tr>
											</table>
									</div>
								</div>
							<?
						}

						else
						{
							?>
								<div style="width:15%;height:90%;border:solid 2px #ccc;margin:5 0 0 -10;float:left;background:#efefef;">
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

								<div style="width:100%;height:3%;font-size:10px;text-align:center;">
									All Right Reserved<br>
									Andi Ikhwannu S.M &copy; 2014
								</div>
							<?
						}
					?>
				</body>
			</html>
		<?

		if(isset($_POST['simpanSetting']))
		{
			$thnAjaran = mysql_real_escape_string($_POST['thnAjaran']);
			$semester = mysql_real_escape_string($_POST['semesterAktif']);

			$updateThnAjaran = mysql_query("update m_param set value='$thnAjaran' where param='thnAjaran'");
			if($updateThnAjaran)
			{
				$updateSemester = mysql_query("update m_param set value='$semester' where param='semester'");
				if($updateSemester)
				{
					?>
						<script type="text/javascript">
							alert("Finalisasi setting berhasil. Sistem Informasi Akademis telah diaktifkan.");
							window.location = "index.php";
						</script>
					<?
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Update tahun ajaran berhasil, update semester belum berhasil.");
							window.location = "index.php";
						</script>
					<?
				}
			}

			else
			{
				?>
					<script>
						alert("Setting tahun ajaran belum berhasil. Coba beberapa saat lagi.");
						window.location = "index.php";
					</script>
				<?
			}
		}
	}
?>

