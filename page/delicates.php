<?php 
include('page/home.php');
$db = $app->getDbHandler();

$delicates = new Delicates($db);
$galeria = new Galeria($db);
?>
<!-- <div class="kosar"><svg class="icon icon-kosar"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-kosar"></use></svg><span>0</span><p>Kosár</p></div> -->


<div class="row stickyStart">
	<div class="twelve coulumns delicates-container">
<?php 
	$delicates->drawSlider();
	$delicates->drawBolt();

	
	
	$galeria->drawGaleria();
?>

	</div>
<!-- CHECKOUT VIEW OVERLAY -->
<div class="overlay-checkout">
	<svg class="icon icon-close bolt-item-close"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
	<div class="checkout-container">
		<form action="">
			<div class="row checkout-items clearfix">
			<h3>Kosár tartalma</h3>
				<div class="twelve columns centered">
					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>
					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>
					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>
					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>
					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>
					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>

					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>

					<div class="checkout-item">
						<div class="checkout-item-details">
							<h3>
								<span class="checkout-item-name">Mangós Csatni</span>\ 
								<span class="checkout-item-quantity">1</span>DB \ 
								<span class="checkout-item-cost"> 1400</span>Ft
							</h3>
						</div>
						<div class="checkout-item-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<div class="checkout-item-remove">
							<svg class="icon icon-close item-remove"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
						</div>
					</div>
				</div>
			</div>
			<div class="row checkout-closure clearfix">
				<div class="twelve columns centered">
					<div class="eight columns">
						<div class="checkout-input-svg">
							<textarea placeholder="Megjegyzés"></textarea>
						</div>
					</div>
					<div class="four columns">
						<div class="checkout-input-svg" >
							<input type="text" placeholder="Név">
						</div>
						<div class="checkout-input-svg">
							<input type="text" placeholder="Email">
						</div>
					</div>
				</div>
				<div class="twelve columns centered checkout-finish">
					<div>Összesen: <span class="sum-cost">0</span> Ft</div>
					<button type="submit">Küldés</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- ITEM VIEW OVERLAY -->
	<div class="overlay-bolt">

		<svg class="icon icon-close bolt-item-close"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg>
		
<div class="bolt-item-view-container">
	<div class="row bolt-item-view clearfix">
		<div class="five columns bolt-item-info clearfix">
			<h4>Mangós Csatni</h4>
			<p><a href="">Ehető</a><svg class="icon icon-nyil-jobbra"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-nyil-jobbra"></use></svg><a href="">Csatni</a><svg class="icon icon-nyil-jobbra"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-nyil-jobbra"></use></svg><a href="">Édes Csatnik</a></p>
			<h5>1.400 Ft</h5>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi praesentium, dolorem, eligendi cum dolor molestias eius possimus reprehenderit natus reiciendis.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi praesentium, dolorem, eligendi cum dolor molestias eius possimus reprehenderit natus reiciendis.</p>


			<form action="">
				<div class="item-q">
					<input type="text" value="1" class="no-select">
					<div class="item-q-up">
						<svg class="icon icon-nyil-jobbra"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-nyil-jobbra"></use></svg>
					</div>
					<div class="item-q-down">
						<svg class="icon icon-nyil-balra"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-nyil-balra"></use></svg>
					</div>
				</div>
				<button type="submit">Kosárba</button>
			</form>

		</div>
	
		<div class="seven columns clearfix">
			<div class="bolt-item-slider">
				<div><img src="assets/uploads/gslide-1.jpg" alt=""></div>
				<div><img src="assets/uploads/gslide-2.jpg" alt=""></div>
				<div><img src="assets/uploads/gslide-3.jpg" alt=""></div>
				<div><img src="assets/uploads/gslide-4.jpg" alt=""></div>	
			</div>
			<div class="bolt-item-slider-nav">
				<div><img src="assets/uploads/gslide-1.jpg" alt=""></div>
				<div><img src="assets/uploads/gslide-2.jpg" alt=""></div>
				<div><img src="assets/uploads/gslide-3.jpg" alt=""></div>
				<div><img src="assets/uploads/gslide-4.jpg" alt=""></div>
			</div>
		</div>
	
		<div class="twelve columns centered hasonlo-termekek">
			<h3>Hasonló termékek</h3>

		<div class="hasonlo-gird">
			<div class="hasonlo-grid-element">
				<a href="">
					<div class="hasonlo-grid-element-img">
						<img src="assets/uploads/th_gallery04.jpg" alt="">
					</div>
					<h4>Málnás Csatni</h4>
					<h5>1.400 Ft</h5>
				</a>
			</div>
			<div class="hasonlo-grid-element">
				<a href="">
					<div class="hasonlo-grid-element-img">
						<img src="assets/uploads/th_gallery04.jpg" alt="">
					</div>
					<h4>Málnás Csatni</h4>
					<h5>1.400 Ft</h5>
				</a>
			</div>
			<div class="hasonlo-grid-element">
				<a href="">
					<div class="hasonlo-grid-element-img">
						<img src="assets/uploads/th_gallery04.jpg" alt="">
					</div>
					<h4>Málnás Csatni</h4>
					<h5>1.400 Ft</h5>
				</a>
			</div>
			<div class="hasonlo-grid-element">
				<a href="">
					<div class="hasonlo-grid-element-img">
						<img src="assets/uploads/th_gallery04.jpg" alt="">
					</div>
					<h4>Málnás Csatni</h4>
					<h5>1.400 Ft</h5>
				</a>
			</div>
		</div>

		</div>
	</div>
</div>


	</div>