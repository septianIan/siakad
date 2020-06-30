<?
	include("../../kernel/version.php");
	include("../../secure/function.php");

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

	$logIp = ipClient();
	$logTime = date("Y-m-d H:i:s");
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../../images/Icon/Pad.png" type="image/png"/>
		<title>AKTIFASI AKUN</title>

		<link rel="stylesheet" href="../../css/fontFace.css">
		<link rel="stylesheet" href="../../css/css.css">
		<link rel="stylesheet" href="../../css/style.css">

		<script type="text/javascript">
			function validateAktifasi()
			{
				if(document.forms['aktifasi'].nama.value == "")
				{
					alert("Nama masih kosong");
					document.forms['aktifasi'].nama.focus();
					return false
				}

				if(document.forms['aktifasi'].username.value == "")
				{
					alert("Username masih kosong");
					document.forms['aktifasi'].username.focus();
					return false
				}

				if(document.forms['aktifasi'].password.value == "")
				{
					alert("Password masih kosong");
					document.forms['aktifasi'].password.focus();
					return false
				}

				if(document.forms['aktifasi'].rePassword.value == "")
				{
					alert("Konfirmasi password masih kosong");
					document.forms['aktifasi'].rePassword.focus();
					return false
				}

				else
				{
					if(document.forms['aktifasi'].rePassword.value != document.forms['aktifasi'].password.value)
					{
						alert("Password dan konfirmasi tidak sama");
						document.forms['aktifasi'].password.value = "";
						document.forms['aktifasi'].rePassword.value = "";
						document.forms['aktifasi'].password.focus();
						return false
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
		<div style="width:400px;height:200px;border:solid 2px #ccc;margin:150 0 0 400;">
			<div style="width:99%;height:10%;font-size:20px;text-align:right;">
				Aktifasi Akun<br>
			</div>
			<div style="width:99%;height:89%;margin:0 0 0 0;">
				<form name="aktifasi" method="post" action="<?echo $_SERVER['PHP_SELF']?>">
					<table style="margin:10 0 10 10;">
						<tr style="border:none;">
							<td style="width:400px;">
								<select name="nama">
									<option value="">- Nama Guru -</option>
									<?
										$listGuru = mysql_query("select * from m_guru where aktifasi='0'");
										while($a_listGuru = mysql_fetch_array($listGuru))
										{
											?>
												<option value="<?echo $a_listGuru['nama']?>"><?echo $a_listGuru['nama']?></option>
											<?
										}
									?>
								</select>
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
								<input type="submit" name="install" value="Aktifasi Akun" onclick="return validateAktifasi();" style="float:right;">
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
	</body>
</html>
<?
	if(isset($_POST['install']))
	{
		$nama = mysql_real_escape_string($_POST['nama']);
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$passEnkrip = md5($password);

		$update = mysql_query("update m_guru set username='$username',password='$passEnkrip',aktifasi='1' where nama='$nama'");
		if($update)
		{
			$logActivity = "Aktifasi akun user ".$nama;
			$insertLog = mysql_query("insert into tbl_log(user,activity,ip,time) values ('$nama','$logActivity','$logIp','$logTime')");
			if($insertLog)
			{
				?>
					<script type="text/javascript">
						alert("Berhasil aktifasi user");
						window.location = "../../index.php";
					</script>
				<?
			}

			else
			{
				?>
					<script type="text/javascript">
						alert("Berhasil aktifasi user. Log belum tercatat.");
						window.location = "../../index.php";
					</script>
				<?
			}
		}

		else
		{
			?>
				<script type="text/javascript">
					alert("Belum berhasil aktifasi user");
					window.location = "index.php";
				</script>
			<?
		}
	}
?>