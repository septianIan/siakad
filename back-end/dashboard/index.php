<?
	include("../../kernel/version.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../../images/Icon/Pad.png" type="image/png"/>
		<title>SIAKAD SMPM 9 BJN</title>

		<link rel="stylesheet" href="../../css/fontFace.css">
		<link rel="stylesheet" href="../../css/css.css">
		<link rel="stylesheet" href="../../css/style.css">

		<script type="text/javascript">
			function validateSignIn()
			{
				if(document.forms['loginAdmin'].username.value == "")
				{
					alert("Username tidak boleh kosong.");
					document.forms['loginAdmin'].username.focus();
					return false;
				}

				if(document.forms['loginAdmin'].passcode.value == "")
				{
					alert("Password tidak boleh kosong.");
					document.forms['loginAdmin'].passcode.focus();
					return false;
				}

				else
				{
					return true;
				}
			}
		</script>
	</head>

	<body style="font-family:'Ubuntu';font-size:14px;">
		<div style="width:400px;height:200px;border:solid 2px #ccc;margin:150 0 0 400;">
			<div style="width:30%;height:99%;float:left;">
				<img src="../../images/Pic/logo.png" width="100" height="100" style="margin:40 0 0 10;">
			</div>
			<div style="width:68%;height:99%;float:left;">
				<div style="width:99%;height:30%;font-size:20px;text-align:right;">
					Administrator System<br>
					Sistem Informasi Akademis
				</div>
				<div style="width:99%;height:60%;margin:15 0 0 0;">
					<form name="loginAdmin" method="post" action="<?echo $_SERVER['PHP_SELF']?>">
						<table>
							<tr style="border:none;">
								<td style="width:300px;">
									<input type="text" name="username" autocomplete="off" placeholder="Username">
								</td>
							</tr>
							<tr style="border:none;">
								<td style="width:300px;">
									<input type="password" name="passcode" autocomplete="off" placeholder="Password">
								</td>
							</tr>
							<tr style="border:none;">
								<td style="width:300px;">
									<input type="submit" name="login" value="Sign In" onclick="return validateSignIn();" style="float:right;">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<div style="width:400px;height:30px;margin:0 0 0 400;font-size:10px;text-align:center;">
			All Right Reserved<br>
			Andi Ikhwannu S.M &copy; 2014
		</div>
	</body>
</html>
<?
	if (isset($_POST['login']))
	{
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['passcode']);
		$passEnkrip = md5($password);

		$cekUser = mysql_query("select * from m_param where param='username'");
		$a_cekUser = mysql_fetch_array($cekUser);
		if($a_cekUser['value'] == $username)
		{
			$cekPass = mysql_query("select * from m_param where param='password'");
			$a_cekPass = mysql_fetch_array($cekPass);
			if($a_cekPass['value'] == $passEnkrip)
			{
				$cekNama = mysql_query("select * from m_param where param='namaAdmin'");
				$a_cekNama = mysql_fetch_array($cekNama);

				session_start();
				$_SESSION['username'] = $a_cekUser['value'];
				$_SESSION['nama'] = $a_cekNama['value'];

				?>
					<script type="text/javascript">
						alert("Welcome, <?echo $a_cekNama['value']?>");
						window.location = "elizabeth/index.php";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Password yang anda masukkan tidak cocok.");
						window.location = "index.php";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Username yang anda masukkan salah.");
					window.location = "index.php";
				</script>
			<?
		}
	}
?>