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
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
            $vendeglo->drawFoglalasLista('lezart');
        ?>
	</tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        
        
    });
</script> 