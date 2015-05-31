<div class="wrapper">
	<div class="admin-login" style="text-align:center;">
		<svg class="icon icon-logo" style="width:6em;height:6em;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo"></use></svg>
		<h3>Kőleves admin</h3>
		<!-- <form action="POST"> -->
		<form method="post" action="<?=$_SESSION['helper']->getPath()?>dashboard" id="authForm">
			<input type="text" id="admin-user" placeholder="Felhasználónév"> 
			<input type="password" id="admin-pass" placeholder="Jelszó"> 
			<input type="submit" value="Belépés">
		</form>
		<!-- </form> -->
	</div>
</div>
<style>
	body{
		background: #2c3e50 ;
	}

</style>
<link rel="stylesheet" href="<?=$_SESSION['helper']->getPath('styles')?>admin.css">
<link rel="stylesheet" href="<?=$_SESSION['helper']->getPath('styles')?>login.css">
<link rel="stylesheet" href="<?=$_SESSION['helper']->getPath('styles')?>dashboard.css">

<script type="text/javascript">
	$(document).ready(function(){
		<?php
            if (isset($_SESSION['user']['id'])){ ?>
        window.location.href = "<?=$_SESSION['helper']->getPath()?>dashboard/vendeglo/dashboard";

/*         $(".nav-head>a").removeClass('subsite-active');
       $(".nav-head>a:nth-of-type(2)").addClass('subsite-active');*/
        <?php
            }
        ?>
		
		$('#authForm').submit(function(e){
			e.preventDefault();
			queryData = {
				u: $('#admin-user').val(),
				p: $('#admin-pass').val(),
				request: "authUser"
			};
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", queryData, function(resp){
				if (resp.status == "ok"){
					window.location.href = "<?=$_SESSION['helper']->getPath()?>dashboard/vendeglo/dashboard";

				}else{
					e.preventDefault();
					$('#authForm input').addClass('missing');
					setTimeout(function(){
						$('#authForm input').removeClass('missing');
					}, 500);
				}
			}, 'json').fail(function(){
                console.log('fail');
				$('#authForm input').addClass('missing');
				setTimeout(function(){
					$('#authForm input').removeClass('missing');
					
				}, 500);
			}); 
		});
		
	});
</script>