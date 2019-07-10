    <link class="include" rel="stylesheet" type="text/css" href="lib/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="lib/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="lib/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="lib/syntaxhighlighter/styles/shThemejqPlot.min.css" />
    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>   

<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
		<table width="100%">
		<tr>
		<td align='left'>
      <h2><a href="?mnu=prediksi">Exponential Smoothing</a></h2>
      <h5>Penghalusan Eksponensial : Ft = Ft – 1 + α (Dt-1 – Ft-1)</h5>
	  <td align='right'>
      <h2><a href="?mnu=prediksi2">Moving Average</a></h2>
      <h5>Rata-rata Bergerak : MA = (n1 + n2 + n3 + …) / n</h5>
	  </table>
	  
    </div>
  </div>
  <!-- /. ROW  -->
  <hr />
 <?php
 //require_once"jumlah.php";
 ?>
  <!-- /. ROW  -->
 

<h1>MA = (n1 + n2 + n3 + …) / n</h1>
 <pre>
Dimana :
Ft = Peramalan untuk periode yang akan datang
n = Jumlah periode peramalan moving average
At~1 = Data aktual satu periode sebelum peramalan
At~2 = Data aktual dua periode sebelum peramalan
At~3 = Data aktual tiga periode sebelum peramalan
At~n = Data aktual satu n sebelum peramalan

Jumlah ke-n harus disesuaikan dengan persoalan yang diminta. 
Jika menggunakan moving average 3 tahunan, maka otomatis jumlah n dan data aktual akan berjumlah 3 pula.
</pre>

<?php
//https://prezi.com/cd7qrvhbdse6/metode-forecasting-exponential-smoothing/

$alpha=3;
$jumlah=10;
if(isset($_POST["Proses"])){
	$id_bahan=strip_tags($_POST["id_bahan"]);
	$alpha=strip_tags($_POST["alpha"]);
	$jumlah=strip_tags($_POST["jumlah"]);
}
?>
<form action="" method="post" enctype="multipart/form-data">
<table width="511" class="table table-striped table-bordered table-hover">


<tr>
<td width="30%"><label for="id_bahan">Pilih Bahan Baku</label>
<td valign="top">:
<td colspan="2">
  <select name="id_bahan" id="id_bahan">
    <option value="">-- Pilih --</option>
    <?php
	  $s="select * from `tb_bahan_baku`";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_bahan0=$d["id_bahan"];
				$nama_bahan=$d["nama_bahan"];
	echo"<option value='$id_bahan0' ";if($id_bahan0==$id_bahan){echo"selected";} echo">$nama_bahan  |$id_bahan0</option>";
	}
	?>

  </select></td>
</tr>

<tr>
<th width="116">Masukkan Nilai Moving Average</label>
<th width="10" valign="top">:
<th width="370" colspan="2"><input name="alpha" type="text" id="alpha" value="<?php echo $alpha;?>" size="5" /></b>
</tr>

<tr>
<td><label for="jumlah">Tulis Jumlah Bulan Prediksi</label>
<td valign="top">:
<td colspan="2"><input name="jumlah" type="text" id="jumlah" value="<?php echo $jumlah;?>" size="5" /></td>
</tr>

<tr>
<td>
<td valign="top">
<td colspan="2">
		<input name="Proses" type="submit" id="Proses" value="Proses" />
       <input name="Batal" type="reset" id="Batal" value="reset" />
</td></tr>
</table>
</form>


<?php
if(isset($_POST["Proses"])){
	$id_bahan=strip_tags($_POST["id_bahan"]);
	$alpha=strip_tags($_POST["alpha"]);
	$jumlah=strip_tags($_POST["jumlah"]);

$jumbln=12;
$bln_awal=6;
$thn_awal=2018;
$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");

for($i=0;$i<$jumbln;$i++){
	if($bln_awal>12){$bln_awal=$bln_awal-12;$thn_awal=$thn_awal+1;}
	if($bln_awal<10){$bln_awal="0".$bln_awal;}
	
	$ar1[$i]=$thn_awal."-".$bln_awal."-01";
	$ar2[$i]=$thn_awal."-".$bln_awal."-31";
	$arB[$i]=$judul_bln[($bln_awal+0)]." ".$thn_awal;
	//echo $arB[$i].":$ar1[$i] s/d $ar2[$i] <br>";
	$bln_awal++;
}

$bahan=getBahan($conn,$id_bahan);
echo "<h2>$bahan ($id_bahan)</h2>";
$gab="<table border='1'>";
$gab.="<tr><td>No<td>Periode<td>Jumlah</td></tr>";
	for($i=0;$i<$jumbln;$i++){
		$no=$i+1;
		$jum=getJumlah($conn,$ar1[$i],$ar2[$i],$id_bahan);
		$arJum[$i]=$jum;
		$gab.="<tr><td>$no<td>$arB[$i]<td>$jum</td></tr>";
		
	}
$gab.="</table>";
echo $gab;

$jumbln=12;
$bln_awal=6;
$thn_awal=2018;
$MULAI=$alpha;
for($i=$MULAI;$i<$jumlah+$jumbln;$i++){
	
	if($i>$jumbln){
		$arJum[$i-1]=$jum;
	}
	
	if($bln_awal>12){$bln_awal=$bln_awal-12;$thn_awal=$thn_awal+1;}
	if($bln_awal<10){$bln_awal="0".$bln_awal;}
	
	$ar1[$i]=$thn_awal."-".$bln_awal."-01";
	$ar2[$i]=$thn_awal."-".$bln_awal."-31";
	$arB[$i]=$judul_bln[($bln_awal+0)]." ".$thn_awal;
	
	$F1=0;//$arJum[$i];
	$FS="";
	for($j=1;$j<=$alpha;$j++){
		$n=$i-$j;
		$V=round($arJum[$n],2);
		$F1+=$V;
		$FS.="+$V ";
	}
	
	$jum=$F1/$alpha;
	$arH[$i]=round($jum,2);
	$arS[$i]="$FS / $alpha";
	$bln_awal++;
	
	
}


echo "<h2>Prediksi $jumlah Bulan YAD Thd $bahan ($id_bahan)</h2>";
$gab="<table border='1'>";
$hasil="";
$gab.="<tr><td>No<td>Periode<td>Formula<td>Prediksi</td></tr>";
	for($i=0;$i<$jumlah;$i++){
		$no=$i+1;
		$jum=$arH[$i];//getJumlah($conn,$ar1[$i],$ar2[$i],$id_bahan);
		$jums=$arS[$i];
		$gab.="<tr><td>$no<td>$arB[$i]<td>$jums<td>$jum</tr>";
		$hasil.="[$no,$jum],";
	}
$gab.="</table>";
echo $gab;
$hasil=substr($hasil,0,strlen($$hasil)-1);
?>


<h1><?php echo"Grafik  Forecasting $jumlah Bulan $bahan ($id_bahan)";?></h1>
<div id="chart1" style="width:1200px; height:400px"></div>

  
  
<?php

}
?>




</div>




<?php
function getJumlah($conn,$w1,$w2,$idb){// `id_bahan`='$idb' and 
	 $sql="select sum(id_pemasukan) as `jum` from `tb_pemasukan` where tanggal between '$w1' and '$w2'";

	$d=getField($conn,$sql);
	$jum=$d["jum"];
	return $jum;
}


?>




<script class="code" type="text/javascript">
    $(document).ready(function () {
        var s1 = [<?php echo $hasil;?>];
     
        plot1 = $.jqplot("chart1", [s1, s1], {
            animate: true,
            animateReplot: true,
            cursor: {
                show: true,
                zoom: true,
                looseZoom: true,
                showTooltip: false
            },
            series:[
                {
                    pointLabels: {
                        show: true
                    },
                    renderer: $.jqplot.BarRenderer,
                    showHighlight: false,
                    yaxis: 'y2axis',
                    rendererOptions: {
                        // Speed up the animation a little bit.
                        // This is a number of milliseconds.  
                        // Default for bar series is 3000.  
                        animation: {
                            speed: 2500
                        },
                        barWidth: 15,
                        barPadding: -15,
                        barMargin: 0,
                        highlightMouseOver: false
                    }
                }, 
                {
                    rendererOptions: {
                        // speed up the animation a little bit.
                        // This is a number of milliseconds.
                        // Default for a line series is 2500.
                        animation: {
                            speed: 2000
                        }
                    }
                }
            ],
            axesDefaults: {
                pad: 0
            },
            axes: {
                // These options will set up the x axis like a category axis.
                xaxis: {
                    tickInterval: 1,
                    drawMajorGridlines: false,
                    drawMinorGridlines: true,
                    drawMajorTickMarks: false,
                    rendererOptions: {
                    tickInset: 0.5,
                    minorTicks: 1
                }
                },
                yaxis: {
                    tickOptions: {
                        formatString: "%'d"
                    },
                    rendererOptions: {
                        forceTickAt0: true
                    }
                },
                y2axis: {
                    tickOptions: {
                        formatString: "%'d"
                    },
                    rendererOptions: {
                        // align the ticks on the y2 axis with the y axis.
                        alignTicks: true,
                        forceTickAt0: true
                    }
                }
            },
            highlighter: {
                show: true, 
                showLabel: true, 
                tooltipAxes: 'y',
                sizeAdjust: 7.5 , tooltipLocation : 'ne'
            }
        });
      
    });

</script>
<!-- End example scripts -->
    <script class="include" type="text/javascript" src="lib/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="lib/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="lib/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="lib/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
  <script class="include" type="text/javascript" src="lib/plugins/jqplot.barRenderer.min.js"></script>
  <script class="include" type="text/javascript" src="lib/plugins/jqplot.highlighter.min.js"></script>
  <script class="include" type="text/javascript" src="lib/plugins/jqplot.cursor.min.js"></script> 
  <script class="include" type="text/javascript" src="lib/plugins/jqplot.pointLabels.min.js"></script>