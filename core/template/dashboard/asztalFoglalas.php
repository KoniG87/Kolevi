<?php
    $vendeglo = new Vendeglo($app->getDbHandler());
?>
<h2>Foglalások</h2>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Név</th>
			<th>Email</th>
			<th>Telefonszám</th>
			<th>Dátum</th>
			<th>Hány fő</th>
			<th >Megjegyzés</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
            $vendeglo->drawFoglalasLista();
        ?>
	</tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){

    	$(".approveFoglalas").click(function(){
            erintettSor = $(this).parents('tr');
            data ={ 
                id: erintettSor.attr('data-id'),
                request: 'foglalasJovahagyas'
            };
            
            $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
                if (resp.status == 'ok'){
                    $('.editFoglalas, .approveFoglalas', erintettSor).remove();
                }else{
                    alert('Sikertelen jóváhagyás!');
                }
            }, 'json');
        });


        $(".deleteFoglalas").click(function(){
            erintettSor = $(this).parents('tr');
            data ={ 
                id: erintettSor.attr('data-id'),
                request: 'foglalasDelete'
            };
            
            $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				$("td", erintettSor).fadeToggle();
                erintettSor.slideToggle(500, function(){ $(this).remove(); });
            }, 'json');
        });

        $(".editFoglalas").click(function(){
            erintettSor = $(this).parents('tr');

            inputTipusok = [
				{tipus: 'text', filter: 'string', classes: 'short-input'},
				{tipus: 'text', filter: 'email', classes: 'mid-input'},
				{tipus: 'text', filter: 'phone', classes: 'short-input'},
				{tipus: 'text', filter: 'date', classes: 'datetimepicker short-input'},
				{tipus: 'number', filter: 'positive', classes: 'xshort-input'},
				{tipus: 'textarea', filter: 'string', classes: ''}
			];

            $.each(inputTipusok, function(key, obj){
                var type = "textarea";
                var aktualisCella = $("td:nth-of-type("+ (key + 1) +")", erintettSor);
                
				if (obj.tipus == 'text' || obj.tipus == 'number'){
					type = "text";
				}

				var aktualisCellaErtek = aktualisCella.text();
				if (type == "text"){
					$element = $(" <input /> ").attr("type", obj.tipus).attr("data-orivalue", aktualisCellaErtek).addClass(obj.classes).val(aktualisCellaErtek);
					if (obj.tipus == "number" && obj.filter == "positive"){
						$element.attr("min", "1").attr("max", "10");
					}
				}else{
					$element = $(" <textarea /> ").addClass(obj.classes).attr("data-orivalue", aktualisCellaErtek).val(aktualisCellaErtek);
				}
				
            	aktualisCella.html($element);
				
            });

            $("button", erintettSor).fadeToggle();

            $('.datetimepicker').datetimepicker({
				lang: "hu",
				format: "Y-m-d H:i",
    			timepicker: true,
    			 allowTimes:[
					'08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',   
					'14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30',
					'19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30'
    			 ]
    		});
            
        });

        $(".cancelFoglalas").click(function(){
        	erintettSor = $(this).parents('tr');

        	$.each($(":input", erintettSor), function(key, obj){
            	$("td:nth-of-type("+ (key + 1) +")", erintettSor).text( $(obj).data("orivalue") );
        	});

        	$("button", erintettSor).fadeToggle();
        });



        $(".saveFoglalas").click(function(){
        	erintettSor = $(this).parents('tr');
			megjeloltIdo = $("td:nth-of-type(4) :input", erintettSor).val();
			
            data = { 
                id: erintettSor.attr('data-id'),
                request: 'asztalfoglalasUpdate',
                nev: $("td:nth-of-type(1) :input", erintettSor).val(),
                email: $("td:nth-of-type(2) :input", erintettSor).val(),
                telefonszam: $("td:nth-of-type(3) :input", erintettSor).val(),
                hanyfo: $("td:nth-of-type(5) :input", erintettSor).val(),
                megjegyzes: $("td:nth-of-type(6) :input", erintettSor).val(),
                datum: megjeloltIdo.substring(0, 10),
                ido: megjeloltIdo.substring(11, 16),
            	jovahagyas: 0      
            };
            

	        $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){

            	$.each($(":input:not(button)", erintettSor), function(key, obj){
                	$("td:nth-of-type("+ (key + 1) +")", erintettSor).text( $(obj).val() );
            	});

            	$("button", erintettSor).fadeToggle();
            }, 'json');
          
        });
        
    });
</script> 
<style type="text/css">
	.mid-input{width:14em!important;}
	.short-input{width:11em!important;}
	.xshort-input{width:8em!important;}
</style>