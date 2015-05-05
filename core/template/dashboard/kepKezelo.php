<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="kepkezelo"><span></span>
	<h2>Képek kezelése</h2></label>
	<div class="papercut-right"></div>
</div>


<?php
    $imageHandler = new Image($app->getDbHandler());    
    $imageHandler->getImages();

?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.kepTabla select').focus(function(){
             triggeredElement = $(this);
            var elozoErtek = $(this).val(); 
        }).change(function(){
            
            queryData = {
                id: $(this).parents('tr').attr('data-id'),
                param: $(this).attr('name'),
                value: $(this).val(),
                request: 'updateImage'
            };
            
		
				
            $.post('requestHandler.php', queryData, function(resp){
                if (resp.status == "ok"){
                    triggeredElement.addClass("success");
                }else{
                    triggeredElement.addClass("error")
                    triggeredElement.val(elozoErtek);
                }
                
                setTimeout(function(){
					triggeredElement.removeClass("success error");
				}, 750);
            }, 'json');
        });
    });
</script>

<style type="text/css">
    .kepTabla img{width:7.5rem;}
    .kepTabla select{width:11.5rem!important;}
</style>