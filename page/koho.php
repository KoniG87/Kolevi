<div class="wrapper">
	<div class="admin-login" style="text-align:center;">
		<svg class="icon icon-logo" style="width:6em;height:6em;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo"></use></svg>
		<h3>Kőleves admin</h3>
		<!-- <form action="POST"> -->
		<form method="post" action="./dashboard" id="authForm">
			<input type="text" id="admin-user"> 
			<input type="password" id="admin-pass"> 
			<input type="submit" value="Belépés">
		</form>
		<!-- </form> -->
	</div>
</div>

<link rel="stylesheet" href="assets/css/admin.css">
<link rel="stylesheet" href="assets/css/login.css">
<link rel="stylesheet" href="assets/css/dashboard.css">
<script type="text/javascript">
	$(document).ready(function(){
		<?php
            if (isset($_SESSION['user']['id'])){ ?>
        window.location.href = "index.php?page=dashboard&sec=vendeglo&sub=dashboard";
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
			$.post("requestHandler.php", queryData, function(resp){
				if (resp.status == "ok"){
					window.location.href = "index.php?page=dashboard&sec=vendeglo&sub=dashboard";
	
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