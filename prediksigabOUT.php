<script type="text/javascript"> 
function PRINTS(){ 
win=window.open('prints.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, note=0'); } 
</script>


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
      <h2><a href="?mnu=prediksi3">Exponential Smoothing OUT</a></h2>
      <h5>Penghalusan Eksponensial : Ft = Ft – 1 + α (Dt-1 – Ft-1)</h5>
      <h1>Ft+1 = αYt + (1 - α)Ft</h1>
       <pre>
Dimana :
Ft+1 = nilai peramalan untuk periode t+1
Yt = nilai sebenarnya untuk periode t+1
Ft = nilai peramalan untuk periode t
α = konstanta penghalusan (0 < α < 1)
</pre>
      <hr>
      <h2><a href="?mnu=prediksi4">Moving Average OUT</a></h2>
      <h5>Rata-rata Bergerak : MA = (n1 + n2 + n3 + …) / n</h5>
      <h1>MA = (n1 + n2 + n3 + …) / n</h1>

 <pre>
Dimana :
MA = Peramalan untuk periode yang akan datang
n = Jumlah periode peramalan moving average
At~1 = Data aktual satu periode sebelum peramalan
At~2 = Data aktual dua periode sebelum peramalan
At~3 = Data aktual tiga periode sebelum peramalan
At~n = Data aktual satu n sebelum peramalan

Jumlah ke-n harus disesuaikan dengan persoalan yang diminta. 
Jika menggunakan moving average 3 bulanan, maka otomatis jumlah n.
</pre>

      </table>
      
    </div>
  </div>
  <!-- /. ROW  -->
 
 
   <hr />
 <?php
 //require_once"jumlah.php";
 ?>

<?php
//https://prezi.com/cd7qrvhbdse6/metode-forecasting-exponential-smoothing/

$alpha=0.2;
$jumlah=10;
$moving=3;
if(isset($_POST["Proses"])){
    $id_bahan=strip_tags($_POST["id_bahan"]);
    $alpha=strip_tags($_POST["alpha"]);
    $jumlah=strip_tags($_POST["jumlah"]);
    $moving=strip_tags($_POST["moving"]);
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
<th width="116">Masukkan Nilai α</label>
<th width="10" valign="top">:
<th width="370" colspan="2"><input  name="alpha" type="text" id="alpha" value="<?php echo $alpha;?>" size="5" /></b>
</tr>

<tr>
<th width="116">Masukkan Nilai Moving Average</label>
<th width="10" valign="top">:
<th width="370" colspan="2"><input  name="moving" type="text" id="moving" value="<?php echo $moving;?>" size="5" /></b>
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
    $moving=strip_tags($_POST["moving"]);
$ket="ALpha $alpha, Jumlah Prediksi : $jumlah Bulan";
$ket2="Moving $moving, Jumlah Prediksi : $jumlah Bulan";

if(strlen($id_bahan)<3){
    echo "<script>alert('Silakan Pilih Data Latih Bahan... !');document.location.href='?mnu=prediksi';</script>";
}
elseif(strlen($alpha)<1){
    echo "<script>alert('Silakan Input Alpha... !');document.location.href='?mnu=prediksi';</script>";
}
elseif(strlen($jumlah)<1){
    echo "<script>alert('Silakan Input Jumlah Bulan YAD... !');document.location.href='?mnu=prediksi';</script>";
}
elseif(strlen($moving)<1){
    echo "<script>alert('Silakan Input Moving Average... !');document.location.href='?mnu=prediksi';</script>";
}
else{

        $jumbln=12;
        $bln_awal=6;
        $thn_awal=2018;
        $judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");

        for($i=0;$i<$jumbln;$i++){
            if($bln_awal>12){$bln_awal=$bln_awal-12;$thn_awal=$thn_awal+1;}
            if($bln_awal<10){$bln_awal="0".$bln_awal;}
            
            $ar1[$i]=$thn_awal."-".$bln_awal."-01";
            $ar2[$i]=$thn_awal."-".$bln_awal."-31";
            $arC[$i]=$judul_bln[($bln_awal+0)]." ".$thn_awal;
            //echo $arC[$i].":$ar1[$i] s/d $ar2[$i] <br>";
            $bln_awal++;
        }

        $bahan=getBahan($conn,$id_bahan);
        echo "<h2>$bahan ($id_bahan) <b>(Exponential Smoothing)<b></h2>";
        $gab="<table border='1'>";
        $gab.="<tr><td>No<td>Periode<td>Jumlah</td></tr>";
            for($i=0;$i<$jumbln;$i++){
                $no=$i+1;
                $jum=getJumlah($conn,$ar1[$i],$ar2[$i],$id_bahan);
                $arJum[$i]=$jum;
                $gab.="<tr><td>$no<td>$arC[$i]<td>$jum</td></tr>";
                
            }
        $gab.="</table>";
        echo $gab;

        $jumbln=12;
        $bln_awal=6;
        $thn_awal=$thn_awal;
        for($i=0;$i<$jumlah+$jumbln;$i++){
            if($bln_awal>12){$bln_awal=$bln_awal-12;$thn_awal=$thn_awal+1;}
            if($bln_awal<10){$bln_awal="0".$bln_awal;}
            
            $ar1[$i]=$thn_awal."-".$bln_awal."-01";
            $ar2[$i]=$thn_awal."-".$bln_awal."-31";
            $arB[$i]=$judul_bln[($bln_awal+0)]." ".$thn_awal;
            
            $F1=$arJum[$i];
            if($i>0){$F1=$arH[$i-1];}
            $jum=($alpha*$arJum[$i])+(1-$alpha)*$F1;
            $arH[$i]=round($jum,0);//PEMBULATAN 0 digit
            $arS[$i]="($alpha x $arJum[$i])+(1-$alpha) x $F1";
            //echo $arB[$i].":$ar1[$i] s/d $ar2[$i] <br>";
            $bln_awal++;
        }


        $gab= "<h2>Prediksi $jumlah Bulan $bahan ($id_bahan) <b>(Exponential Smoothing)<b></h2>";
        $gab.="<table border='1' width='80%'>";
        $hasil="";
        $gab.="<tr><th>No<th>Periode<th>Formula<th>Prediksi</th></tr>";
            for($i=0;$i<$jumlah;$i++){
                $no=$i+1;
                $jum=$arH[$i];//getJumlah($conn,$ar1[$i],$ar2[$i],$id_bahan);
                $jums=$arS[$i];
                $gab.="<tr><td>$no<td>$arB[$i]<td>$jums<td>$jum</tr>";
                $hasil.="[$no,$jum],";

                $sql="INSERT INTO `tb_prediksi_in` (`idin`, `id_bahan`, `periode`, `prediksi`, `kategori`, `keterangan`) VALUES ('', '$id_bahan', '$arB[$i]', '$jum', 'Exponential Smoothing', '$ket');";
                $up=process($conn,$sql);
            }
        $gab.="</table>";
        echo $gab;
        
        $_SESSION["cprint"]=$gab;

        $hasil1=substr($hasil,0,strlen($hasil)-1);
        ?>

| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINTS()"> |

        <h1><?php echo"Grafik  Forecasting $jumlah Bulan $bahan ($id_bahan)";?></h1>
        <div id="chart1" style="width:1200px; height:400px"></div>
<hr>

<!--------------------------------  -->
<?php

$alpha=$moving;
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
//$thn_awal=2018;
$MULAI=0;//$alpha;
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
        $n=$i-$j+$jumbln;
        $V=round($arJum[$n],0);
        $F1+=$V;
        $FS.="+$V ";
    }
    $jum=$F1/$alpha;
    $arH[$i]=round($jum,0);
    $arS[$i]="$FS / $alpha";
    $bln_awal++;
	$arJum[$i+$jumbln]=$arH[$i];
	
    
}


echo "<h2>Prediksi $jumlah Bulan $bahan ($id_bahan) Moving Average </h2>";
$gab="<table border='1'>";
$hasil="";
$gab.="<tr><td>No<td>Periode<td>Formula<td>Prediksi</td></tr>";
    for($i=0;$i<$jumlah;$i++){//+$moving
        $no=$i+1;
        $jum=$arH[$i];//getJumlah($conn,$ar1[$i],$ar2[$i],$id_bahan);
        $jums=$arS[$i];
		
       // if($i<$moving){}
        //else{
                //if($i<2*$moving){$jums="";}
                $gab.="<tr><td>$no<td>$arB[$i]<td>$jums<td>$jum</tr>";
        
        //}
         $sql="INSERT INTO `tb_prediksi_in` (`idin`, `id_bahan`, `periode`, `prediksi`, `kategori`, `keterangan`) VALUES ('', '$id_bahan', '$arB[$i]', '$jum', 'Moving Average', '$ket2');";
             $up=process($conn,$sql);

        $hasil.="[$no,$jum],";
    }
$gab.="</table>";
echo $gab;
$hasil2=substr($hasil,0,strlen($$hasil)-1);
?>



<h1><?php echo"Grafik  Forecasting $jumlah Bulan $bahan ($id_bahan)";?></h1>
<div id="chart2" style="width:1200px; height:400px"></div>



          
          
        <?php
}//else
}
?>




</div>




<?php
//select sum(jumlah) as `jum` from `tb_pengeluaran` where `tanggal` between '2018-06-01' and '2018-06-30' and `id_bahan`='BHN01'
function getJumlah($conn,$w1,$w2,$idb){// `id_bahan`='$idb' and 
     $sql="select sum(jumlah) as `jum` from `tb_pengeluaran` where `tanggal` between '$w1' and '$w2' and `id_bahan`='$idb'";
    $d=getField($conn,$sql);
    $jum=$d["jum"];
    return $jum;
}
?>




<script class="code" type="text/javascript" >
    $(document).ready(function () {
        var s1 = [<?php echo $hasil1;?>];
        var s2 = [<?php echo $hasil1;?>];
           
     
        plot1 = $.jqplot("chart1", [s1, s2], {
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



<script class="code" type="text/javascript">
    $(document).ready(function () {
        var s1 = [<?php echo $hasil2;?>];
        var s2 = [<?php echo $hasil2;?>];
           
     
        plot1 = $.jqplot("chart2", [s1, s2], {
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