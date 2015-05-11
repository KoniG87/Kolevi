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
			<p>lorem ipsum dolor sit amet, consectetur adipisicing elit. accusamus sit cumque quisquam ad! obcaecati aperiam itaque porro, possimus nemo dolores, reiciendis praesentium ipsa maxime! distinctio velit dolorum qui, repudiandae dolorem corporis magnam dignissimos sunt odio cum. mollitia, voluptates. esse, animi totam facilis dolore voluptatem iure perspiciatis ullam nulla voluptatibus aliquam incidunt sint dolor itaque, repellendus! laborum incidunt ipsam sequi placeat!</p>
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
			<div class="szoba-description four columns">
				<h3>Szoba 1</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto perspiciatis deserunt amet culpa commodi a praesentium fuga quod eligendi labore quidem asperiores sint accusamus aperiam similique id cupiditate dolorum omnis maiores enim quas tempora, ullam, perferendis officia accusantium. Quis, quasi.</p>
			</div>
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


			<div class="review-container ten columns centered">
				
				<div class="add-review">
					<form action="">
					<div class="three columns">
						<div class="review-img">
							<div class="gender-switch">
								<input type="radio" name="gender" id="male" checked="true">
								<label for="male">M</label>/
								<input type="radio" name="gender" id="female">
								<label style="margin-left:-8px;" for="female">F</label>
							</div>
						</div>
						<input type="text" placeholder="Név">
					</div>
					<div class="nine columns">

						<input type="text" placeholder="Cím">

						<div class="stars">
							<input type="radio" name="star" class="star-1" id="star-1" />
							<label class="star-1" for="star-1">1</label>
							<input type="radio" name="star" class="star-2" id="star-2" />
							<label class="star-2" for="star-2">2</label>
							<input type="radio" name="star" class="star-3" id="star-3" />
							<label class="star-3" for="star-3">3</label>
							<input type="radio" name="star" class="star-4" id="star-4" />
							<label class="star-4" for="star-4">4</label>
							<input type="radio" name="star" class="star-5" id="star-5" />
							<label class="star-5" for="star-5">5</label>
							<span></span>
						</div>

						<textarea placeholder="Szeretem a tollpárnákat" ></textarea>

					</div>
						<input type="submit" value="Küldés">
					</form>
				</div>
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