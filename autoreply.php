<?
	mysql_connect('localhost','root','clusterstorm');
	mysql_select_db('siakad');
	
	$inbox = mysql_query("select * from inbox where Processed='false'");
	while($a_inbox = mysql_fetch_array($inbox))
	{
		$sms = $a_inbox['TextDecoded'];
		
		$pecah = explode(" ",$sms);
		//echo $pecah[0]." ".$pecah[1];
		
		//cek kelas
		$karakter = mysql_query("select * from m_siswa where noInduk='$pecah[1]'");
		$a_karakter = mysql_fetch_array($karakter);
		$r_karakter = mysql_num_rows($karakter);
		if($r_karakter == 0)
		{
			//sms alert no induk tidak terdaftar
			$outbox = mysql_query("insert into outbox(DestinationNumber,TextDecoded) values ('$a_inbox[SenderNumber]','Maaf nomor induk yang anda masukkan tidak terdaftar.')");
			$update = mysql_query("update inbox set Processed='true' where ID='$a_inbox[ID]'");
		}
		
		else
		{
			$kelas = $a_karakter['kelas'];
			//echo $kelas;
			
			//cek pelajaran
			if($pecah[0] == "MTK")
				$pelajaran = "matematika";
			elseif($pecah[0] == "BIND")
				$pelajaran = "bahasa_indonesia";
			elseif($pecah[0] == "FIS")
				$pelajaran = "fisika";
			elseif($pecah[0] == "BIO")
				$pelajaran = "biologi";
			elseif($pecah[0] == "IPA")
				$pelajaran = "ipa";
			elseif($pecah[0] == "PKN")
				$pelajaran = "pkn";
			elseif($pecah[0] == "KMD")
				$pelajaran = "kemuhammadiyahan";
			elseif($pecah[0] == "IPS")
				$pelajaran = "ips";
			elseif($pecah[0] == "SNBDY")
				$pelajaran = "seni_budaya";
			elseif($pecah[0] == "TIK")
				$pelajaran = "tik";
			elseif($pecah[0] == "OR")
				$pelajaran = "penjasorkes";
			elseif($pecah[0] == "PAI")
				$pelajaran = "pai";
			elseif($pecah[0] == "BING")
				$pelajaran = "bahasa_inggris";
			elseif($pecah[0] == "BTQ")
				$pelajaran = "baca_tulis_quran";
			elseif($pecah[0] == "HQR")
				$pelajaran = "hafalan_al_quran";
			elseif($pecah[0] == "BARB")
				$pelajaran = "bahasa_arab";
			elseif($pecah[0] == "BJW")
				$pelajaran = "bahasa_jawa";
			else
				$pelajaran = "";
			//echo $pelajaran;	
			
			if($pelajaran == "")
			{
				//sms keluar format pelajaran salah
				$outbox = mysql_query("insert into outbox(DestinationNumber,TextDecoded) values ('$a_inbox[SenderNumber]','Maaf kode pelajaran yang anda masukkan tidak terdaftar.')");
				$update = mysql_query("update inbox set Processed='true' where ID='$a_inbox[ID]'");
			}
			
			else
			{
				$table = $pelajaran.$kelas;
				//echo $table;
				$nilai = mysql_query("select * from $table where noInduk='$pecah[1]' order by urutan asc");
				$konten = "Nilai ".$pelajaran;
				while($a_nilai = mysql_fetch_array($nilai))
				{
					$konten = $konten.",".$a_nilai['tag'].$a_nilai['urutan']."=".$a_nilai['nilai'];
				}
				//echo $konten;
				$outbox = mysql_query("insert into outbox(DestinationNumber,TextDecoded) values ('$a_inbox[SenderNumber]','$konten')");
				$update = mysql_query("update inbox set Processed='true' where ID='$a_inbox[ID]'");
			}
		}
	}
?>