<?php
require_once"../konmysqli.php";
session_start();

	$group1 = $_POST['data1'];
	$sql = mysqli_query($conn, "select * from tb_prediksi_in where periode='$group1' And kategori='Exponential Smoothing' group by id_bahan");
?>

<script type="text/javascript">
	function getAll(){
		let id_bhn = $('#id_bahan').val();
		$.ajax({
			url: 'pemasukan/search.php',
			type: 'POST',
			data: {data1: id_bhn},
			cache: false,
			success: function(response){
				$('.idbhn').html(response);
			}
		});
		}
	
	getAll();
	
		$(".cbb").change(function(){
			let id_bahan = $('#id_bahan').val();
			
			$.ajax({
				url: 'pemasukan/search.php',
				type: 'POST',
				data: {data1: id_bahan},
				success: function(response){
					$('.idbhn').html(response);
				}
			});
		});
		
	function getAll1(){
		let id_bhn = $('#id_bahan').val();
		$.ajax({
			url: 'pemasukan/search2.php',
			type: 'POST',
			data: {data1: id_bhn},
			cache: false,
			success: function(response){
				$('.jmlah').html(response);
			}
		});
		}
	
	getAll1();
	
		$(".cbb").change(function(){
			let id_bahan = $('#id_bahan').val();
			
			$.ajax({
				url: 'pemasukan/search2.php',
				type: 'POST',
				data: {data1: id_bahan},
				success: function(response){
					$('.jmlah').html(response);
				}
			});
		});

	function getAll2(){
		let id_bhn = $('#id_bahan').val();
		$.ajax({
			url: 'pemasukan/search3.php',
			type: 'POST',
			data: {data1: id_bhn},
			cache: false,
			success: function(response){
				$('.jmlah2').html(response);
			}
		});
		}
	
	getAll2();
	
		$(".cbb").change(function(){
			let id_bahan = $('#id_bahan').val();
			
			$.ajax({
				url: 'pemasukan/search3.php',
				type: 'POST',
				data: {data1: id_bahan},
				success: function(response){
					$('.jmlah2').html(response);
				}
			});
		});	
</script>

<select name="id_bahan" id="id_bahan" class="cbb">
    <option value="show-all" selected="selected">-- Pilih --</option>
    <?php
		while($pel1=mysqli_fetch_array($sql)){
				$pel2=$pel1['id_bahan'];
	?>
	<option value='<?php echo "$pel2";?>'><?php echo "$pel2";?></option>
	<?php
		}
	?>
</select>