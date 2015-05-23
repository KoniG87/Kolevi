  <header>
        <nav class="nav-head right">
        <div class="logo left">
            <a href="dashboard"><svg class="icon icon-logo"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo"></use></svg></a>
        </div>
            <a href="?page=dashboard&sec=vendeglo&sub=dashboard" title="Vendéglő">Vendéglő</a>
            <a href="?page=dashboard&sec=kert&sub=dashboard" title="Kert">Kert</a>
            <a href="" title="Hamarosan">Delicates</a>
            <a href="?page=dashboard&sec=apartman&sub=dashboard" title="Apartman">Apartman</a>
            <a href="./vendeglo" class="right" style="margin-right:5rem;">Vissza az oldalra</a>
            <div class="lang-select">
            <?php 
            		
            ?>
					<span class="lang-active">Hu</span> / <span>En</span>
				
				</div>
        </nav>
  </header>  
   
  <div class="wrapper clearfix">

    <aside class="left">

        <ul class="dashNavigator">
            <?php
             
            	$sectionIndicator = "Vendeglo";
            	if (isset($_GET['sec'])){
            		$sectionIndicator = ucfirst($_GET['sec']);
            	}
            	
            	$dashPath = 'core/template/dash'. $sectionIndicator .'.php';
            	if (file_exists($dashPath)){
            		include($dashPath);
				}
            	
				?>
           </ul>
    </aside>

    <section class="right">
    
    <?php
    	if (!isset($_GET['sub'])){
    		$_GET['sub'] = 'dashboard';
    	}
		include('core/template/dashboard/'.$_GET['sub'].'.php');		
    ?>
    </section>
</div>
  
  
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/admin.css"/>
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/dashboard.css"/>
  
  <script type="text/javascript">
	$(document).ready(function(){
		/*$('.dashNavigator a').click(function(e){
			e.preventDefault();
			path = $(this).attr('href');
			target = $('section.right');
			$.post('core/template/dashboard/'+path+'.php', function(resp){
				target.fadeOut(250);
				setTimeout(function(){
					target.html(resp).fadeIn(250);
				}, 500);
			});
		});
		*/
		
		/*
		$('.dashNavigator a').click(function(e){
			e.preventDefault();
			path = $(this).attr('href');
			target = $('section.right');
			data = {
				'request'	=> 'napiAdmin'
			};
			$.post('core/requestHandler.php', data, function(resp){
				target.fadeOut(250);
				setTimeout(function(){
					target.html(resp).fadeIn(250);
				}, 500);
			});
		});
		*/

		$('input, select').focus(remainderCharacters);
		$('input, select').keyup(remainderCharacters);
	});


	function remainderCharacters(){
	    maxKar = $(this).attr("maxlength");
	    tooltipText = $(this).attr("title");
	    
	    if (maxKar != undefined){
	        hatraVan = maxKar - $(this).val().length;
	        tooltipText += ", max "+maxKar+" karakter (még "+hatraVan+")";
	    }
	    
	    $(this).nextAll(".tooltip:first").text(tooltipText);
	}
  </script>
  <style type="text/css">
  	.countdownRemainder{}
  </style>