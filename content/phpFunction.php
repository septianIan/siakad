<?
	function namaBulan($r)
	{
		if($r == "01" or $r == "1")
			$bulan = "Januari";
		elseif($r == "02" or $r == "2")
			$bulan = "Februari";
		elseif($r == "03" or $r == "3")
			$bulan = "Maret";
		elseif($r == "04" or $r == "4")
			$bulan = "April";
		elseif($r == "05" or $r == "5")
			$bulan = "Mei";
		elseif($r == "06" or $r == "6")
			$bulan = "Juni";
		elseif($r == "07" or $r == "7")
			$bulan = "Juli";
		elseif($r == "08" or $r == "8")
			$bulan = "Agustus";
		elseif($r == "09" or $r == "9")
			$bulan = "September";
		elseif($r == "10" or $r == "10")
			$bulan = "Oktober";
		elseif($r == "11" or $r == "11")
			$bulan = "November";
		elseif($r == "12" or $r == "12")
			$bulan = "Desember";
		else
			$bulan = "Tidak Diketahui";
		
		return $bulan;
	}
	
	function ambilAbsen($noInduk,$kelas,$tglAbsensi,$blnAbsensi,$thnAbsensi)
	{
		if(strlen($tglAbsensi) == 1)
			$tglHit = "0".$tglAbsensi;
		else
			$tglHit = $tglAbsensi;
		
		if(strlen($blnAbsensi) == 1)
			$blnHit = "0".$blnAbsensi;
		else
			$blnHit = $blnAbsensi;
		
		$hit = $thnAbsensi."-".$blnHit."-".$tglHit;
		$cekAbsen = mysql_query("select * from tbl_rekapabsen where noInduk='$noInduk' and kelas='$kelas' and date(tgl)='$hit'");
		$a_cekAbsen = mysql_fetch_array($cekAbsen);
		$r_cekAbsen = mysql_num_rows($cekAbsen);
		if($r_cekAbsen != 0)
		{
			if($a_cekAbsen['keterangan'] == "M")
				$hasil = "<font style='color:blue;font-weight:bold;'>M</font>";
			elseif($a_cekAbsen['keterangan'] == "S")
				$hasil = "<font style='color:green;font-weight:bold;'>S</font>";
			elseif($a_cekAbsen['keterangan'] == "I")
				$hasil = "<font style='color:brown;font-weight:bold;'>I</font>";
			elseif($a_cekAbsen['keterangan'] == "A")
				$hasil = "<font style='color:red;font-weight:bold;'>A</font>";
			else
				$hasil = "<font style='color:black'>err</font>";
		}
		else
		{
			$hasil = "<font style='color:red;'>X</font>";
			/*$hasil = "<select name='revisiAbsen[]'>";
			$hasil = $hasil."<br><option value='M'>M</option>";
			$hasil = $hasil."<br><option value='A'>A</option>";
			$hasil = $hasil."<br><option value='I'>I</option>";
			$hasil = $hasil."<br><option value='S'>S</option>";
			$hasil = $hasil."<br></select>";
			$hasil = "<input type='text' name='revisiAbsen[]' maxlength='1' onKeyUp='cekInputAbsen('this.value')' autocomplete='off' style='text-align:center;text-transform:uppercase;'>";*/
		}
			
		return $hasil;
	}
?>