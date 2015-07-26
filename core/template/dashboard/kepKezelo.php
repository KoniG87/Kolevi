<h2>Képek kezelése</h2>


<?php
    $imageHandler = new Image($app->getDbHandler());    
    $imageHandler->getImages();

?>

<script type="text/javascript">
    $(document).ready(function(){

    	$('.tag').click(function(){
			tagElement = $(this);
			setTimeout(function(){
				tagElement.parents('tr').find('select:first').focus().trigger('change');
			}, 550);
        });

        $('.kepTabla select').focus(function(){
             triggeredElement = $(this);
            var elozoErtek = $(this).val(); 
        }).change(function(){
            triggeredRow = $(this).parents('tr');

            queryData = {
                id: $(this).parents('tr').attr('data-id'),
                param: $(this).attr('name'),
                value: $(this).val(),
                request: 'updateImage',
                szekcio: ($('.selected', triggeredRow).length > 0 ? $('.selected', triggeredRow).map(function(){ return $(this).attr("data-szekcioid"); }).get().join(',') : ''),
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

        $(".tag").click(function(){
       	   $(this).toggleClass("selected");
       	});
    });
</script>

<style type="text/css">
    .kepTabla img{width:7.5rem;}
    .kepTabla select{width:11.5rem!important;}
    
	.tag {
	  font-size: 12px;
	  line-height: 16px;
	  background: #eee;
	  color: #444;
	  display: inline-block;
	  position: relative;
	  padding: 5px 20px 5px 10px;
	  border-top-left-radius: 4px;
	  border-bottom-left-radius: 4px;
	  margin: 0 10px 5px 0;
	  cursor:pointer;
	}
	.tag.selected{
	  background-color: rgba(80, 220, 80, 1.0);
	}
	.tag:not(.selected):hover {
	  background-color: rgba(150, 240, 150, 0.5);
	}
	.tag.selected:hover {
	  background:#4b4;  
	}
	.tag:hover:after {
	  border-color: transparent transparent transparent #739fe4;
	}
	.tag:before {
	  background: #fff;
	  width: 10px;
	  height: 10px;
	  content: "";
	  display: inline-block;
	  border-radius: 20px;
	  margin: 0 5px 0 0;
	  border:2px solid #bbb;
	}
	.tag:after, .tag:hover:after {
	  display: inline-block;
	  border: 13px solid;
	  border-color: transparent #f8f8f8 transparent transparent ;
	  height: 0;
	  width: 0;
	  position: absolute;
	  right: -0px;
	  top: 0;
	  content: "";
	  display: inline-block;
	}
    
</style> 