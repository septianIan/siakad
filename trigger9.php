<?
	$connect = mysql_connect('localhost','root','clusterstorm');
	$db = mysql_select_db('siakad');
	
	$selPelajaran = mysql_query("select * from m_pelajaran");
	while($a_selPelajaran = mysql_fetch_array($selPelajaran))
	{
		//echo $a_selPelajaran['pelajaran']."<br>";
		$update = mysql_query("update m_pelajaran set trigger9='$a_selPelajaran[pelajaran]' where id='$a_selPelajaran[id]'");
	}
?>