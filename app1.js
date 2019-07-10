jQuery(function()
	{
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
	});