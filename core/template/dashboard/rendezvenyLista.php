<?php 
	$vendeg = new Vendeglo($app->getDbHandler());
	
?>
<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="rendezveny"><span></span>
	<h2>Rendezvények</h2></label>
	<div class="papercut-right"></div>
</div>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Rendezvény</th>
			<th class="wideHeader">Leírás</th>
			<th>Látható</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php 
	$vendeg->drawRendezvenyList();
?>
	</tbody>
</table>
<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="assets/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false && $(this).val() != ""){
				$(this).removeClass('missing');
			} else{
				$(this).addClass('missing');
			}
			
		});
		
		$('#saveRendezveny').click(function(){
			canSubmit = true;
			data = {
				id: $('#editForm input[name="id"]').val(),
				megnevezes: $('#editForm input[name="megnevezes"]').val(),
				megjegyzes: $('#editForm textarea[name="megjegyzes"]').val()
			};

			$.each(data, function(key, val){
				attr = $('[name="'+key+'"]').attr('required');
				if (typeof attr !== typeof undefined && attr !== false 
						&& 
						$('[name="'+key+'"]').val() == ""){
					canSubmit = false;
					$('[name="'+key+'"]').addClass('missing');
				}
			});

			if (canSubmit){
				data.request = 'rendezvenyUpdate';
				$.post("requestHandler.php", data, function(resp){
					window.location.href = "dashboard";
				});
			}
		});
	});
</script>


