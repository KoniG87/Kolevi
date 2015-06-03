<?php 
include('page/home.php');
?>
<div class="row stickyStart">
	<div class="twelve coulumns delicates-container">


<!-- DELICATESRŐL -->
<section id="delicatesrol">

	<div class="section-label" data-labelpos="1">
		<div class="papercut-left"></div>
		<label for="Delicates" ><span></span>
		<h2>Delicates</h2></label>
		<div class="papercut-right"></div>
	</div>

	<div class="row">
		<div class="twelve columns centered delicates-slider">

				<div class="delicates-slide">
					<div class="delicates-slide-img">
						<img src="assets/uploads/gallery02.jpg" alt="" title="">
					</div>
					<aside>
						<h4>Házi Libazsír</h4>
						<p>Kóstold meg isteni finom hazai libánkat.</p>
						<h5>1400 Ft</h5>
					</aside>
				</div>

				<div class="delicates-slide">
					<div class="delicates-slide-img">
						<img src="assets/uploads/gallery02.jpg" alt="" title="">
					</div>
					<aside>
						<h4>Házi Libazsír, de egy másik libából.</h4>
						<p>Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.</p>
						<p>liba liba <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> liba</p>
						<h5>1400 Ft</h5>
					</aside>
				</div>

				<div class="delicates-slide">
					<div class="delicates-slide-img">
						<img src="assets/uploads/gallery02.jpg" alt="" title="">
					</div>
					<aside>
						<h4>Házi Libazsír, de egy másik libából.</h4>
						<p>Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.</p>
						<p>liba liba <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> liba</p>
						<h5>1400 Ft</h5>
					</aside>
				</div>

				<div class="delicates-slide">
					<div class="delicates-slide-img">
						<img src="assets/uploads/gallery02.jpg" alt="" title="">
					</div>
					<aside>
						<h4>Házi Libazsír, de egy másik libából.</h4>
						<p>Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.</p>
						<p>liba liba <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> liba</p>
						<h5>1400 Ft</h5>
					</aside>
				</div>

				<div class="delicates-slide">
					<div class="delicates-slide-img">
						<img src="assets/uploads/gallery02.jpg" alt="" title="">
					</div>
					<aside>
						<h4>Házi Libazsír, de egy másik libából.</h4>
						<p>Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.</p>
						<p>liba liba <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> liba</p>
						<h5>1400 Ft</h5>
					</aside>
				</div>

				<div class="delicates-slide">
					<div class="delicates-slide-img">
						<img src="assets/uploads/gallery02.jpg" alt="" title="">
					</div>
					<aside>
						<h4>Házi Libazsír, de egy másik libából.</h4>
						<p>Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.</p>
						<p>liba liba <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> liba</p>
						<h5>1400 Ft</h5>
					</aside>
				</div>
		</div>
	</div>


	<div class="row">
		<div class="twelve columns centered delicatesrol-bemutatkozas">
			<h3>Kedves vásárló</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, qui, ex? Temporibus natus at ad ducimus fuga sunt, odit quo fugiat recusandae cum cumque provident, deleniti, perspiciatis et incidunt vero placeat quia qui! Voluptatibus, nostrum nam repudiandae dicta, harum voluptatum.</p>
		</div>
	</div>
</section>


<section id="bolt">

	<div class="section-label" data-labelpos="2">
		<div class="papercut-left"></div>
		<label for="Bolt" ><span></span>
		<h2>Bolt</h2></label>
		<div class="papercut-right"></div>
	</div>

	<div class="row">
		<div class="three columns">
			<div id="eheto" class="bolt-acco-container">
				<div class="bolt-acco-illustration">
					
				</div>
				<ul class="bolt-acco">
					<div class="bolt-acco-head">
						Ehető
					</div>
					<li>Pesztó</li>
					<ul>
						<li>subkat1</li>
						<li>subkat2</li>
					</ul>
					<li>Csathni</li>
					<ul>
						<li>subkat1</li>
						<li>subkat2</li>
						<li>subkat3</li>
						<li>subkat4</li>
					</ul>
					<li>Lekvár</li>
					<ul>
						
					</ul>
					<li>Kenyér</li>
					<ul>
						
					</ul>
				</ul>			
			</div>
		</div>
		<div class="nine columns">
			
		</div>
	</div>
</section>

<?php 
	$db = $app->getDbHandler();
	$galeria = new Galeria($db);
	

	$galeria->drawGaleria();
?>

	</div>