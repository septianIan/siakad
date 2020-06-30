<?
	?>
		<script type="text/javascript">
			function validateSimpanNilai()
			{
				if(document.forms['tambahNilai'].jenis.value == "")
				{
					alert("Jenis nilai belum diset");
					document.forms['tambahNilai'].jenis.focus();
					return false
				}

				else
				{
					return true;
				}
			}

			function validateSetKKM()
			{
				if(document.forms['setKkm'].kkm.value == "")
				{
					alert("Nilai KKM masih kosong");
					document.forms['setKkm'].kkm.focus();
					return false
				}

				else
				{
					return true;
				}
			}

			function validateUpdateKKM()
			{
				if(document.forms['updateKkm'].kkm.value == "")
				{
					alert("Nilai KKM masih kosong");
					document.forms['updateKkm'].kkm.focus();
					return false
				}

				else
				{
					return true;
				}
			}

			function validateSimpanPengetahuan()
			{
				if(document.forms['tambahNilaiPengetahuan'].jenis.value == "")
				{
					alert("Jenis nilai masih kosong");
					document.forms['tambahNilaiPengetahuan'].jenis.focus();
					return false;
				}

				if(document.forms['tambahNilaiPengetahuan'].materi.value == "")
				{
					alert("Materi masih kosong");
					document.forms['tambahNilaiPengetahuan'].materi.focus();
					return false;
				}

				else
				{
					return true;
				}
			}

			function validateSimpanKeterampilan()
			{
				if(document.forms['tambahNilaiKeterampilan'].jenis.value == "")
				{
					alert("Jenis nilai keterampilan masih kosong");
					document.forms['tambahNilaiKeterampilan'].jenis.focus();
					return false;
				}

				if(document.forms['tambahNilaiKeterampilan'].materi.value == "")
				{
					alert("Materi keterampilan masih kosong");
					document.forms['tambahNilaiKeterampilan'].materi.focus();
					return false;
				}				

				else
				{
					return true;
				}	
			}

			function triggerSikapLainnya()
			{
				if(document.forms['tambahNilaiSikap78tambahIndikator'].sikap.value == "Lainnya")
				{
					document.forms['tambahNilaiSikap78tambahIndikator'].sikap1.style.display = "block";
				}

				else
				{
					document.forms['tambahNilaiSikap78tambahIndikator'].sikap1.style.display = "none";	
				}
			}

			function validateSimpanSikap()
			{
				if(document.forms['tambahNilaiSikap78tambahIndikator'].sikap.value == "")
				{
					alert("Sikap yang ditambahkan masih kosong");
					document.forms['tambahNilaiSikap78tambahIndikator'].sikap.focus();
					return false;
				}

				if(document.forms['tambahNilaiSikap78tambahIndikator'].indikator.value == "")
				{
					alert("Indikator masih kosong");
					document.forms['tambahNilaiSikap78tambahIndikator'].indikator.focus();
					return false;
				}

				else
				{
					if(document.forms['tambahNilaiSikap78tambahIndikator'].sikap.value == "Lainnya")
					{
						if(document.forms['tambahNilaiSikap78tambahIndikator'].sikap1.value == "")
						{
							alert("Sikap masih kosong.");
							document.forms['tambahNilaiSikap78tambahIndikator'].sikap1.focus();
							return false;			
						}

						else
						{
							return true;
						}
					}

					else
					{
						return true;
					}
				}
			}
		</script>
	<?

	function konversiHuruf($a)
	{
		if(0 <= $a and $a < 1)
			$huruf = "D-";
		elseif(1 <= $a and $a <= 1.17)
			$huruf = "D";
		elseif(1.17 < $a and $a <= 1.5)
			$huruf = "D";
		elseif(1.5 < $a and $a <= 1.83)
			$huruf = "C-";
		elseif(1.83 < $a and $a <= 2.17)
			$huruf = "C";
		elseif(2.17 < $a and $a <= 2.5)
			$huruf = "C+";
		elseif(2.5 < $a and $a <= 2.83)
			$huruf = "B-";
		elseif(2.83 < $a and $a <= 3.17)
			$huruf = "B";
		elseif(3.17 < $a and $a <= 3.5)
			$huruf = "B+";
		elseif(3.5 < $a and $a <= 3.83)
			$huruf = "A-";
		elseif(3.83 < $a and $a <= 4)
			$huruf = "A";
		else
			$huruf = "Null";

		return $huruf;
	}

	function konversiPredikat($b)
	{
		if($b == "A+")
			$predikat = "SB";
		elseif($b == "A")
			$predikat = "SB";
		elseif($b == "A-")
			$predikat = "SB";
		elseif($b == "B+")
			$predikat = "B";
		elseif($b == "B")
			$predikat = "B";
		elseif($b == "B-")
			$predikat = "B";
		elseif($b == "C+")
			$predikat = "C";
		elseif($b == "C")
			$predikat = "C";
		elseif($b == "C-")
			$predikat = "C";
		elseif($b == "D+")
			$predikat = "K";
		elseif($b == "D")
			$predikat = "K";
		elseif($b == "D-")
			$predikat = "K";
		else
			$predikat = "Null";

		return $predikat;
	}

	?>

	<script type="text/javascript">
    	var chart;
	    $(document).ready(function() {
	        var options = {
	            chart: {
	                renderTo: 'container',
	                defaultSeriesType: 'line',
	                marginRight: 100,
	                marginBottom: 25
	            },
	            title: {
	                text: 'Akses Hit Ke Server per Log Activity',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	            	type: 'date',
	            	tickInterval : 3600 * 1000 * 24,
	                tickWidth: 10,
	                labels: {
	                    align: 'center',
	                    x: 10,
	                    y: 20,
	                    formatter: function() {
	                        return Highcharts.dateFormat('%d-%m-%Y', this.value);
	                    }
	                }
	            },
	            yAxis: {
	                title: {
	                    text: 'Hit'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return Highcharts.dateFormat('%d-%m', this.x) +': <b>'+ this.y + '</b>';
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: 0,
	                y: 100,
	                borderWidth: 0
	            },
	            series: [{
	                name: 'Hit ke Server'
	            }]
	        }
	        // Load data asynchronously using jQuery. On success, add the data
	        // to the options and initiate the chart.
	        // This data is obtained by exporting a GA custom report to TSV.
	        // http://api.jquery.com/jQuery.get/
	        jQuery.get('adapter/dataHit.php?nama=<?echo $a_detailGuru[nama]?>', null, function(tsv) {
	            var lines = [];
	            traffic = [];
	            try {
	                // split the data return into lines and parse them
	                tsv = tsv.split(/\n/g);
	                jQuery.each(tsv, function(i, line) {
	                    line = line.split(/\t/);
	                    date = Date.parse(line[0]);
	                    traffic.push([
	                        date,
	                        parseInt(line[1].replace('-', ''))
	                    ]);
	                });
	            } catch (e) {  }
	            options.series[0].data = traffic;
	            chart = new Highcharts.Chart(options);
	        });
	    });

		var chart2; // globally available
		$(document).ready(function() {
		chart2 = new Highcharts.Chart({
			chart: {
            renderTo: 'container1',
            type: 'column',
            marginRight: 150,
			},   
			title: {
            text: 'Disk Space Usage'
			},
			xAxis: {
            categories: ['Pengetahuan','Keterampilan','Sikap'],
            tickWidth: 10,
            align: 'right'
			},
			yAxis: {
            title: {
               text: 'Row Record (each)'
				}
			},
            legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'top',
	            x: 5,
	            y: 100,
	            floating: true,
	            borderWidth: 1,
	            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
	            shadow: true
	        },
			series:             
            [
            	<?php
					$sql   = mysql_query("select * from m_gurupelajaran where nama='$a_detailGuru[nama]'");
					while($a_sql = mysql_fetch_array($sql))
					{
						if($a_sql['kelas'] == "9A" or $a_sql['kelas'] == "9B")
						{
							$replace = str_replace(" ", "_", $a_sql['pelajaran']);
							$table = $replace.$a_sql['kelas'];
							$cekTable = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$table'");
							$a_cekTable = mysql_fetch_array($cekTable);
							if($a_cekTable['jumTable'] != 0)
							{
								$count = mysql_query("select count(*) as jumEntry from $table");
								$a_count = mysql_fetch_array($count);
								$jumPengetahuan = $a_count['jumEntry'];
								$jumKeterampilan = 0;
								$jumSikap = 0;
							}

							else
							{
								$jumPengetahuan = 0;
								$jumKeterampilan = 0;
								$jumSikap = 0;
							}
							
						}

						else
						{
							$replace = str_replace(" ", "_", $a_sql['pelajaran']);
							$table = $replace.$a_sql['kelas'];
							$pengetahuan = $table."Pengetahuan";
							$keterampilan = $table."Keterampilan";
							$sikap = $table."Sikap";

							$cekTablePengetahuan = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$pengetahuan'");
							$a_cekTablePengetahuan = mysql_fetch_array($cekTablePengetahuan);
							if($a_cekTablePengetahuan['jumTable'] != 0)
							{
								$countPengetahuan = mysql_query("select count(*) as jumEntry from $pengetahuan");
								$a_countPengetahuan = mysql_fetch_array($countPengetahuan);
								$jumPengetahuan = $a_countPengetahuan['jumEntry'];
							}

							else
							{
								$jumPengetahuan = 0;
							}

							$cekTableKeterampilan = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$keterampilan'");
							$a_cekTableKeterampilan = mysql_fetch_array($cekTableKeterampilan);
							if($a_cekTableKeterampilan['jumTable'] != 0)
							{
								$countKeterampilan = mysql_query("select count(*) as jumEntry from $keterampilan");
								$a_countKeterampilan = mysql_fetch_array($countKeterampilan);
								$jumKeterampilan = $a_countKeterampilan['jumEntry'];
							}

							else
							{
								$jumKeterampilan = 0;
							}

							$cekTableSikap = mysql_query("select count(*) as jumTable from information_schema.tables where table_schema='siakad' and table_name='$sikap'");
							$a_cekTableSikap = mysql_fetch_array($cekTableSikap);
							if($a_cekTableSikap['jumTable'] != 0)
							{
								$countSikap = mysql_query("select count(*) as jumEntry from $sikap");
								$a_countSikap = mysql_fetch_array($countSikap);
								$jumSikap = $a_countSikap['jumEntry'];
							}

							else
							{
								$jumSikap = 0;
							}
						}

						?>
							{
								name: '<?php echo $a_sql['pelajaran'].$a_sql['kelas']; ?>',
								data: [<?php echo $jumPengetahuan.",".$jumKeterampilan.",".$jumSikap; ?>]
							},
		                <?
					}
				?>
            ]
		});
	});	
	
	var chart3; // globally available
		$(document).ready(function() {
		chart3 = new Highcharts.Chart({
			chart: {
			renderTo: 'container2',
            type: 'spline',
            animation: Highcharts.svg, // don't animate in old IE
            marginRight: 10,
            events: {
                load: function () {

                    // set up the updating of the chart each second
                    var series = this.series[0];
                    setInterval(function () {
                        var x = (new Date()).getTime(), // current time
                            y = Math.random();
                        series.addPoint([x, y], true, true);
                    }, 1000);
                }
            }
			},   
			title: {
                text: 'Server Health Traffic Monitor'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Server Traffic Load (Mbps)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series:
            [{
                name: 'Traffic Load',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: (time + i * 1000),
                            y: Math.random()
                        });
                    }
                    return data;
                }())
            }],
		});
	});
	
	function lengthSms()
	{
		var t = document.getElementById('smsIsi').value.length;
		var z = 110 - t;
		document.getElementById('smsPanjang').value = z;
	}
	</script>