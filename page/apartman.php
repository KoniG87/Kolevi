<?php 
include('page/home.php');
?>
<div class="row stickyStart">
	<div class="twelve coulumns apartman-container">

<!-- TÉRKÉP -->

<section id="terkep">
	<div class="section-label" data-labelpos="1">
		<div class="papercut-left"></div>
		<label for="terkep"><span></span>
		<h2>Térkép</h2></label>
		<div class="papercut-right" ></div>
	</div>
	<div class="terkep-container">
	    <?php 
	    include('core/template/terkep_svg.php');
	     ?>
		<!-- <img src="assets/img/aprt_terkep.png" alt="Térkép" title="térkép"> -->
		<a href="#hely">
			<div class="marker-logo">
				<h2>Kőleves Vendéglő</h2>
				<svg class="icon icon-marker-logo"><use xlink:href="#icon-marker-logo"></use></svg>
				<div class="marker-shadow"></div>
			</div>
		</a>
	</div>
	<div class="row">
		<div class="twelve columns centered">
			<h3>A mi Budapestünk</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus sit cumque quisquam ad! Obcaecati aperiam itaque porro, possimus nemo dolores, reiciendis praesentium ipsa maxime! Distinctio velit dolorum qui, repudiandae dolorem corporis magnam dignissimos sunt odio cum. Mollitia, voluptates. Esse, animi totam facilis dolore voluptatem iure perspiciatis ullam nulla voluptatibus aliquam incidunt sint dolor itaque, repellendus! Laborum incidunt ipsam sequi placeat!</p>
		</div>
	</div>
</section>

<!-- A HELY -->

<section id="hely">
	<div class="section-label" data-labelpos="2">
		<div class="papercut-left"></div>
		<label for="hely"><span></span>
		<h2>A hely</h2></label>
		<div class="papercut-right" ></div>
	</div>

	<div class="hely-container">
	     <?php 
	    include('core/template/hely_svg.php');
	     ?>

	</div>
	<div class="row">
		<div class="twelve columns centered">
			<h3>A Hely</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus sit cumque quisquam ad! Obcaecati aperiam itaque porro, possimus nemo dolores, reiciendis praesentium ipsa maxime! Distinctio velit dolorum qui, repudiandae dolorem corporis magnam dignissimos sunt odio cum. Mollitia, voluptates. Esse, animi totam facilis dolore voluptatem iure perspiciatis ullam nulla voluptatibus aliquam incidunt sint dolor itaque, repellendus! Laborum incidunt ipsam sequi placeat!</p>
		</div>
	</div>
</section>

<!-- SZOBÁK -->

<section id="szobak">
	<div class="section-label" data-labelpos="3">
		<div class="papercut-left"></div>
		<label for="szobak"><span></span>
		<h2>Szobák</h2></label>
		<div class="papercut-right" ></div>
	</div>

	<div class="row clearfix szobak-container">
		<div class="szoba clearfix">
			<div class=" seven columns">
				<div class="szoba-carousel">
					<div><img src="assets/img/gslide-1.png" alt=""></div>
					<div><img src="assets/img/gslide-2.png" alt=""></div>
					<div><img src="assets/img/gslide-3.png" alt=""></div>
					<div><img src="assets/img/gslide-4.png" alt=""></div>
					<div><img src="assets/img/gslide-1.png" alt=""></div>
					<div><img src="assets/img/gslide-2.png" alt=""></div>
					<div><img src="assets/img/gslide-3.png" alt=""></div>
					<div><img src="assets/img/gslide-4.png" alt=""></div>
				</div>
				<div class="szoba-carousel-nav">
					<div><img src="assets/img/gslide-1.png" alt=""></div>
					<div><img src="assets/img/gslide-2.png" alt=""></div>
					<div><img src="assets/img/gslide-3.png" alt=""></div>
					<div><img src="assets/img/gslide-4.png" alt=""></div>
					<div><img src="assets/img/gslide-1.png" alt=""></div>
					<div><img src="assets/img/gslide-2.png" alt=""></div>
					<div><img src="assets/img/gslide-3.png" alt=""></div>
					<div><img src="assets/img/gslide-4.png" alt=""></div>
				</div>
			</div>
			<div class="szoba-description four columns">
				<h3>Szoba 1</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo natus adipisci corporis assumenda, officiis facilis nemo sunt aliquam. Reiciendis, iure quos libero nemo eum culpa quas, vero perferendis velit ipsa minus ducimus commodi doloribus saepe beatae facilis eos modi cum molestiae omnis minima nihil. Reiciendis quos recusandae nulla earum maxime sapiente porro aliquam, dolorem velit, ratione itaque tenetur. Magnam, modi, dolor. Molestias optio maxime ratione voluptates at repellendus perferendis ipsa, obcaecati, voluptas minima reiciendis ab tenetur culpa et, quisquam sunt?</p>
			</div>

			<div class="review-container twelve columns">
				REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! REVIEWS! 
			</div>
		</div>

	</div>
</section>


<?php
	$db = $app->getDbHandler();
	
	$galeria = new Galeria($db);


	$galeria->drawGaleria();
?>

	</div>