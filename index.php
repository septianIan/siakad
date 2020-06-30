<?
	include("kernel/version.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/Icon/Pad.png" type="image/png"/>
		<title>SIAKAD SMPM 9 BJN</title>

		
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!--<link rel="stylesheet" href="css/fontFace.css">-->
		<!--<link rel="stylesheet" href="css/css.css">-->
		<!--<link rel="stylesheet" href="css/style.css">-->
	</head>

	<body style="overflow-x:hidden;">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div class="panel panel-info" style="margin:100px 0 0 0;">
					<div class="panel-heading" style="line-height:120%;">
						<div style="float:left;margin:5 0 0 0;">
							<font style="font-size:20px;font-weight:bold;">Sistem Informasi Akademis</font><br>
							SMP Muhammadiyah 9 Bojonegoro
						</div>
						<img src="images/Pic/logo.png" width="50" height="50" style="float:Right;">
						<div style="clear:both"></div>
					</div>
					<div class="panel-body">
						<form name="login" method="post" action="#">
							<table>
								<tr style="border:none;">
									<td style="width:400px;padding:2 2;">
										<input type="text" name="username" autocomplete="off" placeholder="Username" class="form-control" autofocus>
									</td>
								</tr>
								<tr style="border:none;">
									<td style="padding:2 2;">
										<input type="password" name="passcode" autocomplete="off" placeholder="Password" class="form-control">
									</td>
								</tr>
								<tr style="border:none;">
									<td style="padding:2 2;">
										<input type="submit" name="login" value="LOGIN" style="float:right;margin:10px 0 0 0;" class="btn btn-success">
										<a href="back-end/aktifasiAkun/index.php"><font style="font-size:12px;font-weight:bold;">Aktifasi Akun</font></a>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<div class="panel-footer" style="text-align:center;font-size:10px;line-height:100%;">
						All Right Reserved<br>
						Andi Ikhwannu S.M &copy; 2014
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</body>
</html>
<?
	if(isset($_POST['login']))
	{
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['passcode']);
		$passEnkrip = md5($password);

		$selUser = mysql_query("select * from m_guru where username='$username' and password='$passEnkrip'");
		$a_selUser = mysql_fetch_array($selUser);
		$r_selUser = mysql_num_rows($selUser);

		if($r_selUser == 1)
		{
			if($a_selUser['aktif'] == "0")
			{
				?>
					<script type="text/javascript">
						alert("Status user dekatif. Hubungi administrator untuk reaktifasi");
						window.location = "index.php";
					</script>
				<?		
			}

			else
			{
				session_start();
				$_SESSION['username'] = $a_selUser['username'];
				$_SESSION['nama'] = $a_selUser['nama'];
				$_SESSION['id'] = $a_selUser['id'];

				?>
					<script type="text/javascript">
						alert("Selamat datang <?echo $a_selUser['nama']?>");
						window.location = "content/";
					</script>
				<?	
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Login belum berhasil.");
					window.location = "index.php";
				</script>
			<?
		}
	}
?>