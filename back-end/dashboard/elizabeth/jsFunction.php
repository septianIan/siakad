<?
	?>
		<script type="text/javascript">
			function finalisasi()
			{
				if(document.forms['finalSetting'].thnAjaran.value == "")
				{
					alert("Tahun ajaran tidak boleh kosong");
					document.forms['finalSetting'].thnAjaran.focus();
					return false;
				}

				if(document.forms['finalSetting'].semesterAktif.value == "")
				{
					alert("Semester tidak boleh kosong");
					document.forms['finalSetting'].semesterAktif.focus();
					return false;
				}

				else
				{
					return true;
				}
			}


			function validateTambahKelas()
			{
				if(document.forms['tambahKelas'].kelas.value == "")
				{
					alert("Kelas masih kosong.");
					document.forms['tambahKelas'].kelas.focus();
					return false
				}

				if(document.forms['tambahKelas'].ruang.value == "")
				{
					alert("Ruang masih kosong.");
					document.forms['tambahKelas'].ruang.focus();
					return false
				}

				else
				{
					return true;
				}
			}

			function validateTambahPelajaran()
			{
				if(document.forms['tambahPelajaran'].nmMapel.value == "")
				{
					alert("Nama mata pelajaran masih kosong.");
					document.forms['tambahPelajaran'].nmMapel.focus();
					return false;
				}

				else
				{
					return true;
				}
			}

			function validateEkstra()
			{
				if(document.forms['simpanEkstra'].ekstra.value == "")
				{
					alert("Nama ekstra masih kosong");
					document.forms['simpanEkstra'].ekstra.focus();
					return false;
				}

				else
				{
					return true;
				}
			}

			function validateDataSiswa()
			{
				if(document.forms['dataSiswa'].noInduk.value == "")
				{
					alert("No induk siswa kosong")
					document.forms['dataSiswa'].noInduk.focus();
					return false;
				}

				if(document.forms['dataSiswa'].nama.value == "")
				{
					alert("Nama siswa kosong")
					document.forms['dataSiswa'].nama.focus();
					return false;
				}

				if(document.forms['dataSiswa'].kelas.value == "")
				{
					alert("Kelas siswa kosong")
					document.forms['dataSiswa'].kelas.focus();
					return false;
				}

				else
				{
					return true;
				}
			}

			function triggerWaliKelas()
			{
				if(document.forms['tambahGuru'].triggerWali.value == "Yes")
				{
					document.forms['tambahGuru'].kelasNaungan.style.display = "block";
				}

				else
				{
					document.forms['tambahGuru'].kelasNaungan.style.display = "none";
				}
			}

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
		        jQuery.get('adapter/dataHit.php?nama=<?echo $_SESSION[nama]?>', null, function(tsv) {
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

		var chart2; // globally available
			$(document).ready(function() {
			chart2 = new Highcharts.Chart({
				chart: {
	            renderTo: 'container1',
	            type: 'column',
	            marginRight: 75,
				},   
				title: {
	            text: 'Data Siswa Per Kelas'
				},
				xAxis: {
	            categories: ['Kelas'],
	            tickWidth: 10,
				},
				yAxis: {
	            title: {
	               text: 'Jumlah (anak)'
					}
				},
	            legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'top',
		            x: 5,
		            y: 20,
		            floating: true,
		            borderWidth: 1,
		            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
		            shadow: true
		        },
				series:             
	            [
	            	<?php
						$sql   = mysql_query("select * from m_kelas order by kelasRuang asc");
						while($a_sql = mysql_fetch_array($sql))
						{
							$jumSiswa = mysql_query("select count(*) as jum from m_siswa where kelas='$a_sql[kelasRuang]'");
							$a_jumSiswa = mysql_fetch_array($jumSiswa);
							$jumlah = $a_jumSiswa['jum'];
							?>
								{
									name: '<?php echo $a_sql['kelasRuang'];?>',
									data: [<?php echo $jumlah;?>]
								},
			                <?
						}
					?>
	            ]
			});
		});
		</script>
	<?
?>