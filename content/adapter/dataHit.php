<?php
	$con = mysql_connect("localhost","root","clusterstorm");
	if (!$con) 
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("siakad", $con);

	$nama = mysql_real_escape_string($_GET['nama']);
	$time = mysql_query("select distinct(date(time)) as tanggal from tbl_log where user='$nama'");
	while($a_time = mysql_fetch_array($time))
	{
		$result = mysql_query("select count(*) as jumHit from tbl_log where user='$nama' and date(time)='$a_time[tanggal]'");
		while($row = mysql_fetch_array($result)) 
		{
			echo $a_time['tanggal'] . "\t" . $row['jumHit']. "\n";
		}
	}

	mysql_close($con);
?>