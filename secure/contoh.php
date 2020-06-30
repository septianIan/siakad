<?
	include("function.php");
	$text = "Satu";
	$text1 = "Satu dua tiga";
	$textEncript = paramEncrypt($text);
	$textEncript1 = paramEncrypt($text1);
	
	echo $text." ".$textEncript."<br>";
	echo $text1." ".$textEncript1;
	
	echo strlen($textEncript)." ";
	echo strlen($textEncript1)."<br>";
	
	echo paramDecrypt($textEncript1);
?>