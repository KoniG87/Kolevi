<?php 
    $user = new User($app->getDbHandler());
    $userID = isset($_POST['userID']) ? $_POST['userID'] : null;
    $userData = $user->loadUserData($userID);
    
    $userKepek = $user->loadKepek();
?>

<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="dolgozok"><span></span>
	<h2>Dolgozó rögzítése</h2></label>
	<div class="papercut-right"></div>
</div>

<button id="saveUser">Dolgozó mentése</button>

<table class="tablaGrid">
	<tbody>
		<input type="hidden" name="id" value="<?=$userData['id']?>"/>
		<tr>
			<td><label>Nicknév</label></td>
			<td><input type="text" name="username" title="Becenév" maxlength="40" required value="<?=$userData['username']?>"/>
			<span class="tooltip">Becenév, max. 40 karakter</span>
			</td>
		</tr>
        <?php
        if (!isset($_POST['userID'])){ ?>
		<tr>
			<td><label>Jelszó</label></td>
			<td><input type="password" name="pass" required value=""/>
			<span class="tooltip">Jelszó</span>
			</td>
		</tr>
		<tr>
			<td><label>Jelszó ismét</label></td>
			<td><input type="password" name="pass_re" required value=""/>
			<span class="tooltip">Jelszó ismét</span>
			</td>
		</tr>
        <?php
        }
        ?>
		<tr>
			<td><label>Teljes név</label></td>
			<td><input type="text" name="nev" maxlength="70" title="Teljes név" required value="<?=$userData['nev']?>"/>
			<span class="tooltip">Teljes név, max. 70 karakter</span>
			</td>
		</tr>
		<tr>
			<td><label>Rövid leírás</label></td>
			<td><textarea type="text" name="megjegyzes" maxlength="500" title="Rövid leírás" maxlength="500"><?=$userData['megjegyzes']?></textarea>
			<span class="tooltip">Rövid leírás, max. 500 karakter</span>
			</td>
		</tr>
        <tr>
			<td><label>Kép</label></td>
			<td>
                <select name="kep" title="Dolgozó képe">
                    <option value=""></option>
               <?php
            foreach ($userKepek AS $kepData){
                echo '<option '.($userData['kep'] == $kepData['fajlnev'] ? 'selected="selected"' : '').' value="'.$kepData['fajlnev'].'">'.basename($kepData['fajlnev']).'</option>';
            }
            ?>
                </select>
			<span class="tooltip">Dolgozó képe</span>
			</td>
		</tr>
		<tr>
			<td><label>Telszám</label></td>
			<td><input type="text" name="telefon" maxlength="20" title="Telefonszám" value="<?=$userData['telefon']?>"/>
			<span class="tooltip">Telefon szám</span>
			</td>
		</tr>
		<tr>
			<td><label>Email</label></td>
			<td><input type="text" name="email" maxlength="100" title="Email cím" required value="<?=$userData['email']?>"/>
			<span class="tooltip">Email cím</span>
			</td>
		</tr>
		<tr>
			<td><label>Facebook</label></td>
			<td><input type="text" name="facebook" maxlength="100" title="Facebook profil" value="<?=$userData['facebook']?>"/>
			<span class="tooltip">Facebook profil</span>
			</td>
		</tr>
        <?php
        if (isset($_POST['userID'])){ ?>
        <tr>
			<td><label>Jogosultság</label></td>
			<td>
                <select name="jogosultsag_id" title="Jogosultsági szint">
                    <option value=""></option>
                    <option <?=($userData['jogosultsag_id'] == 1 ? 'selected="selected"' : '')?> value="1">Csak listázáshoz</option>
                    <option <?=($userData['jogosultsag_id'] == 9? 'selected="selected"' : '')?> value="9">Adminisztrátor</option>
                </select> 
			<span class="tooltip">Jogosultsági szint</span>
			</td>
		</tr>
        <tr>
			<td><label>Aktív?</label></td>
			<td>
                <select name="allapot" title="Profil állapota">
                    <option value=""></option>
                    <option <?=(!$userData['allapot'] ? 'selected="selected"' : '')?> value="0">Nem</option>
                    <option <?=($userData['allapot'] ? 'selected="selected"' : '')?> value="1">Igen</option>
                </select> 
			<span class="tooltip">Profil állapota</span>
			</td>
		</tr>
         
        <tr>
			<td><label>Rendezvényfelelős?</label></td>
			<td>
                <select name="rendezvenyfelelos" title="Rendezvényfelelős-e?">
                    <option value=""></option>
                    <option <?=($userData['rendezvenyfelelos'] == 0 ? 'selected="selected"' : '')?> value="0">Nem</option>
                    <option <?=($userData['rendezvenyfelelos'] == 1? 'selected="selected"' : '')?> value="1">Igen</option>
                </select> 
			<span class="tooltip">Jogosultsági szint</span>
			</td>
		</tr>
        
        
        
        <?php
            }else{
            ?>
        <input type="hidden" name="allapot" value="<?=$userData['allapot']?>"/>
        <input type="hidden" name="rendezvenyfelelos" value="<?=$userData['rendezvenyfelelos']?>"/>
        <input type="hidden" name="jogosultsag_id" value="<?=$userData['jogosultsag_id']?>"/>
        <?php
            }
?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click', '#saveUser', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				email: $('input[name="email"]').val(),
				telefon: $('input[name="telefon"]').val(),
				megjegyzes: $('textarea[name="megjegyzes"]').val(),
				username: $('input[name="username"]').val(),
                kep: $('select[name="kep"]').val(),
				nev: $('input[name="nev"]').val(),
				pass: $('input[name="pass"]').val(),
				facebook: $('input[name="facebook"]').val(),
                allapot: $('[name="allapot"]').val(),
                jogosultsag_id: $('[name="jogosultsag_id"]').val(),
                rendezvenyfelelos: $('[name="rendezvenyfelelos"]').val()
			};
			

			$.each(data, function(key, val){
				attr = $('[name="'+key+'"]').attr('required');
				if (typeof attr !== typeof undefined && attr !== false 
						&& 
						$('[name="'+key+'"]').val() == ""){
					canSubmit = false;
					$('[name="'+key+'"]').addClass('missing');
				}
			});

			if ($('input[name="pass"]').val() != $('input[name="pass_re"]').val()){
				$('input[name^="pass"]').addClass('missing');
				canSubmit = false;
			}
			
			if (canSubmit){
				data.request = "dolgozoUpdate";
				$.post('requestHandler.php', data, function(resp){
					if (resp.status == "ok"){
						window.location.href="index.php?page=dashboard&sub=userLista";
						
					}
				}, 'json');
				
			}
			
		});

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false){
				if ($(this).val() != ""){
					$(this).removeClass('missing');
				}else{
					$(this).addClass('missing');
				}
			} 
			
		});

			
	});
</script>