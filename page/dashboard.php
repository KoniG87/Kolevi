<?php 
$sectionIndicator = "Vendeglo";
if (isset($_GET['sec'])){
	$sectionIndicator = ucfirst($_GET['sec']);
}
?>

<header>
        <nav class="nav-head right">
        <div class="logo left">
            <a href="dashboard"><svg class="icon icon-logo"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo"></use></svg></a>
        </div>
        <?php 
       
        $dashMenu = array(
        	'vendeglo' => array(
        		'link'	=> 	'vendeglo',
        		'szoveg' => 'Vendéglő'
        	),
        	'kert' => array(
        		'link'	=> 	'kert',
        		'szoveg' => 'Vendéglő'
        	),
        	'delicates' => array(
        		'link'	=> 	'vendeglo',
        		'szoveg' => 'Hamarosan'
        	),
        	'apartman' => array(
        		'link'	=> 	'apartman',
        		'szoveg' => 'Vendéglő'
        	)
        );
        
                
        foreach ($dashMenu AS $dashIcon => $dashData){
        	echo '<a class="'.(strtolower($sectionIndicator) == $dashIcon ? 'dashMenuActive' : '').'" href="'.$_SESSION['helper']->getPath().'dashboard/'.$dashData['link'].'/dashboard" title="'.$dashData['szoveg'].'"><svg class="icon icon-'.$dashIcon.'-2"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-'.$dashIcon.'-2"></use></svg></a>';
        }
        ?>
            
            <a href="<?=$_SESSION['helper']->getPath()?>logout.php" class="right" style="margin-right:5rem;">Kijelentkezés</a>
            <a href="<?=$_SESSION['helper']->getPath().strtolower($sectionIndicator)?>" class="right" style="margin-right:1rem;">Vissza az oldalra</a>
            <div class="lang-select">
            
				<span class="lang-active">Hu</span> / <span>En</span>
				
				</div>
        </nav>
  </header>  
   
  <div class="wrapper clearfix">

    <aside class="left">

        <ul class="dashNavigator">
            <?php
             
            	$dashPath = 'core/template/dash'. $sectionIndicator .'.php';
            	
            	if (file_exists($dashPath)){
            		include($dashPath);
				}
            	
				?>
           </ul>
    </aside>

    <section class="right">
    
    <?php
    	$subPath = 'core/template/dashboard/';
    	
    	if (!isset($_GET['sub']) || !file_exists($subPath.$_GET['sub'].'.php')){
    		$_GET['sub'] = 'dashboard';
    	}
    	$subFile = $_GET['sub'].'.php';
    	if (file_exists($subPath.strtolower($sectionIndicator).'/'.$subFile)){
    		$subPath .= strtolower($sectionIndicator).'/';
    	}
    	
    	include($subPath.$subFile);		
    ?>
    </section>
</div>
  
  
  <link rel="stylesheet" media="screen" type="text/css" href="<?=$_SESSION['helper']->getPath('styles')?>admin.css"/>
  <link rel="stylesheet" media="screen" type="text/css" href="<?=$_SESSION['helper']->getPath('styles')?>dashboard.css"/>
  <link href="<?=$_SESSION['helper']->getPath('styles')?>datepicker.css" rel="stylesheet" type="text/css"/>
	<script src="<?=$_SESSION['helper']->getPath('scripts')?>vendor/jquery-ui.min.js"></script>
  <script type="text/javascript">
	$(document).ready(function(){
		
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
  	.dashMenuActive{background:rgba(24,188,156,0.2);}
  </style>