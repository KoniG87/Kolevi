<h2>Képek kezelése</h2>


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
            
		
				
            $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", queryData, function(resp){
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

        $(".deleteKep").click(function(e){
			e.preventDefault();
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "kepDelete"
			};
			//containingRow.hide(250, function(){ $(this).remove(); });
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp['status']){
					containingRow.hide(250, function(){ $(this).remove(); });			
				}
			}, 'json');
			
        });
    });
</script>

<style type="text/css">
    .kepTabla img{width:7.5rem;}
    .kepTabla select{width:11.5rem!important;}
</style> 