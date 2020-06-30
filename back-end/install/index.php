<?
	include("../../kernel/version.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../../images/Icon/Pad.png" type="image/png"/>
		<title>INSTALL SIAKAD</title>

		<link rel="stylesheet" href="../../css/fontFace.css">
		<link rel="stylesheet" href="../../css/css.css">
		<link rel="stylesheet" href="../../css/style.css">

		<script type="text/javascript">
			function validateInstall()
			{
				if(document.forms['install'].nama.value == "")
				{
					alert("Nama administrator masih kosong.");
					document.forms['install'].nama.focus();
					return false;
				}

				if(document.forms['install'].username.value == "")
				{
					alert("Username masih kosong.");
					document.forms['install'].username.focus();
					return false;
				}

				if(document.forms['install'].password.value == "")
				{
					alert("Password masih kosong.");
					document.forms['install'].password.focus();
					return false;
				}

				if(document.forms['install'].rePassword.value == "")
				{
					alert("Konfirmasi password masih kosong.");
					document.forms['install'].rePassword.focus();
					return false;
				}

				else
				{
					if(document.forms['install'].password.value != document.forms['install'].rePassword.value)
					{
						alert("Password dan konfirmasi tidak sama.");
						document.forms['install'].password.value = "";
						document.forms['install'].rePassword.value = "";
						document.forms['install'].password.focus();
						return false;
					}

					else
					{
						return true;
					}
				}
			}
		</script>
	</head>

	<body style="font-family:'Ubuntu';font-size:14px;">
		<?
			$cek = mysql_query("select * from m_param where param='kaptenAmerika'");
			$a_cek = mysql_fetch_array($cek);
			if($a_cek['value'] == "1")
			{
				?>
					<script>
						alert("Super user telah terdaftar");
						window.location = "../dashboard/index.php";
					</script>
				<?
			}

			else
			{
				?>
					<div style="width:400px;height:200px;border:solid 2px #ccc;margin:150 0 0 400;">
						<div style="width:99%;height:10%;font-size:20px;text-align:right;">
							Install Super User System<br>
						</div>
						<div style="width:99%;height:89%;margin:0 0 0 0;">
							<form name="install" method="post" action="<?echo $_SERVER['PHP_SELF']?>">
								<table style="margin:10 0 10 10;">
									<tr style="border:none;">
										<td style="width:400px;">
											<input type="text" name="nama" autocomplete="off" placeholder="Nama Administrator">
										</td>
									</tr>
									<tr style="border:none;">
										<td style="width:400px;">
											<input type="text" name="username" autocomplete="off" placeholder="Username">
										</td>
									</tr>
									<tr style="border:none;">
										<td style="width:400px;">
											<input type="password" name="password" autocomplete="off" placeholder="Password">
										</td>
									</tr>
									<tr style="border:none;">
										<td style="width:400px;">
											<input type="password" name="rePassword" autocomplete="off" placeholder="Confirm Password">
										</td>
									</tr>
									<tr style="border:none;">
										<td style="width:400px;">
											<input type="submit" name="install" value="Create ID" onclick="return validateInstall();" style="float:right;">
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
					<div style="width:400px;height:30px;margin:0 0 0 400;font-size:10px;text-align:center;">
						All Right Reserved<br>
						Andi Ikhwannu S.M &copy; 2014
					</div>
				<?
			}
		?>
	</body>
</html>
<?
	if(isset($_POST['install']))
	{
		$nama = mysql_real_escape_string($_POST['nama']);
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$rePassword = mysql_real_escape_string($_POST['rePassword']);
		$passEnkrip = md5($password);

		$generate = mysql_query("insert into m_param(param,value) values ('namaAdmin','$nama'),('username','$username'),('password','$passEnkrip')");
		if($generate)
		{
			if($generate)
			{
				$update = mysql_query("update m_param set value='1' where param='kaptenAmerika'");
				if($update)
				{
					?>
						<script type="text/javascript">
							alert("Super user berhasil diinstall.");
							window.location = "../dashboard/index.php";
						</script>
					<?
				}

				else
				{
					?>
						<script type="text/javascript">
							alert("Generate admin, ubah kapten amerika belum berhasil.");
							window.location = "index.php";
						</script>
					<?
				}
			}
			
			else
			{
				?>
					<script type="text/javascript">
						alert("Install super user belum berhasil. Ulangi beberapa saat lagi.");
						window.location = "index.php";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Install super user belum berhasil. Ulangi beberapa saat lagi.");
					window.location = "index.php";
				</script>
			<?
		}
	}
?>