<?php 
include('page/home.php');
?>
<div class="row stickyStart">
	<div class="twelve coulumns apartman-container">


	<!-- innentől a -->
<div class="review-container ten columns centered"> <!-- Ez a container csak úgy itt van, de amúgy nem kell -->
<!-- A lényeg... -->
<div class="review-card clearfix" >
	<div class="three columns">
		<div class="review-card-img">
			<img src="assets/img/tmb-2.png" alt="">
		</div>
		<h2>Példa Pál</h2>
	</div>
	<div class="nine columns">
		<h2>"Nice try near Budapest"</h2>
		<div class="star-rating" data-rating="2"></div>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quis quod neque? Beatae mollitia commodi blanditiis, accusamus temporibus molestiae dolor totam, quibusdam corporis nobis ex, ipsum recusandae! Eum dolorem nam minus culpa veniam, in. Pariatur voluptatem, officiis harum blanditiis mollitia.</p>
	</div>
</div>
<!-- A lényeg...END! -->
</div>

<?php 
	$db = $app->getDbHandler();
	
	$apartman = new Apartman($db);
	$galeria = new Galeria($db);
	
	$apartman->drawTerkep();
	$apartman->drawHely();
	$apartman->drawSzobak();
	$galeria->drawGaleria();
?>

	</div>