<?php
    $vendeglo = new Vendeglo($app->getDbHandler());
?>

<h2>Foglalások</h2>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Név</th>
			<th>Email</th>
			<th>Telefonszám</th>
			<th>Dátum</th>
			<th>Hány fő</th>
			<th class="wideHeader">Megjegyzés</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
            $vendeglo->drawFoglalasLista();
        ?>
	</tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        
        $(".approveFoglalas").click(function(){
            erintettSor = $(this).parents('tr');
            data ={ 
                id: erintettSor.attr('data-id'),
                request: 'foglalasJovahagyas'
            };
            
            $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
                if (resp.status == 'ok'){
                    $('.editFoglalas, .approveFoglalas', erintettSor).remove();
                }else{
                    alert('Sikertelen jóváhagyás!');
                }
            }, 'json');
        });
    });
</script>