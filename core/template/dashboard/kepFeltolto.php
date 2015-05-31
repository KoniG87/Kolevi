<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="kepfeltolto"><span></span>
	<h2>Képek feltöltése</h2></label>
	<div class="papercut-right"></div>
</div>


<div id="bootstrapped-fine-uploader"></div>

<script type="text/javascript" src="<?=$_SESSION['helper']->getPath('scripts')?>vendor/jquery.fineuploader.js"></script>	
   <script>
      function createUploader() {
        var uploader = new qq.FineUploader({
          element: document.getElementById('bootstrapped-fine-uploader'),
          request: {
            endpoint: '<?=$_SESSION['helper']->getPath('libs')?>uploader/index.php',
				paramsInBody: true
          },
			 multiple:true,

          text: {
            uploadButton: '<div><i class="icon-upload icon-white"></i> kattints vagy húzz ide fájlokat..</div>'
          },
          template: '<div class="qq-uploader span12">' +
                      '<pre class="qq-upload-drop-area span12"><span>{dragZoneText}</span></pre>' +
                      '<div class="qq-upload-button btn btn-success" style="width: auto;">{uploadButtonText}</div>' +
                      '<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
                      '<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;"></ul>' +
                    '</div>',
          classes: {
            success: 'alert alert-success',
            fail: 'alert alert-error'
          },
		  callbacks: {
			onComplete: function(id, name, response) {
				setTimeout(function(){
                    $('.alert-success').slideToggle(550, function(){ $(this).remove(); });
                }, 8500);
                setTimeout(function(){
                    $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", {request: 'handleImages'}, function(resp){});
                }, 750);
                
                
			}
		  }
        });
      }        
      window.onload = createUploader;
    </script>


<style type="text/css">
    .qq-uploader{width:70%;text-align:center;box-shadow:-2px 3px 6px #aaa;}
    /*
*  FINEUPLOADER
*/

.qq-uploader {position: relative;width: 45%;}
.qq-upload-button {display: block;width: 105px;padding: 7px 0;text-align: center;background: #000;font-variant:small-caps;border-bottom: 1px solid #DDD;color: #FFF;}
.qq-upload-button-hover {background: #A4ACBA;}
.qq-upload-button-focus {outline: 1px dotted #000000;}
.qq-upload-drop-area, .qq-upload-extra-drop-area {position: absolute;top: 0;left: 0;width: 100%;height: 100%;min-height: 30px;z-index: 2;background: #AFDBA4;text-align: center;}
.qq-upload-drop-area span {display: block;position: absolute;top: 50%;width: 100%;margin-top: -8px;font-size: 16px;}
.qq-upload-extra-drop-area {position: relative;margin-top: 50px;font-size: 16px;padding-top: 30px;height: 20px;min-height: 40px;}
.qq-upload-drop-area-active {background: #FF7171;}
.qq-upload-list {margin: 0;padding: 0;list-style: none;}
.qq-upload-list li {margin: 0;padding: 9px;line-height: 15px;font-size: 16px;background-color: #deffbd;}
.qq-upload-file, .qq-upload-spinner, .qq-upload-size, .qq-upload-cancel, .qq-upload-retry, .qq-upload-failed-text, .qq-upload-finished, .qq-upload-delete {margin-right: 12px;}
.qq-upload-file {}
.qq-upload-spinner {display: inline-block;background: url("loading.gif");width: 15px;height: 15px;vertical-align: text-bottom;}
.qq-drop-processing {display: none;}
.qq-drop-processing-spinner {display: inline-block;background: url("processing.gif");width: 24px;height: 24px;vertical-align: text-bottom;}
.qq-upload-finished {display:none;width:15px;height:15px;vertical-align:text-bottom;}
.qq-upload-retry, .qq-upload-delete {display: none;color: #000000;}
.qq-upload-cancel, .qq-upload-delete {color: #000000;}
.qq-upload-retryable .qq-upload-retry {display: inline;}
.qq-upload-size, .qq-upload-cancel, .qq-upload-retry, .qq-upload-delete {font-size: 12px;font-weight: normal;}
.qq-upload-failed-text {display: none;font-style: italic;font-weight: bold;}
.qq-upload-failed-icon {display:none;width:15px;height:15px;vertical-align:text-bottom;}
.qq-upload-fail .qq-upload-failed-text {display: inline;}
.qq-upload-retrying .qq-upload-failed-text {display: inline;color: #D60000;}
.qq-upload-list li.qq-upload-success, .qq-upload-list li.alert.alert-success {background-color: #2ecc71;color: #FFFFFF;border:2px solid #27ae60;}
.qq-upload-list li.qq-upload-fail, .qq-upload-list li.alert.alert-error {background-color: #e74c3c;color: #FFFFFF;border:2px solid #c0392b;}
.qq-progress-bar {background: -moz-linear-gradient(top,  rgba(30,87,153,1) 0%, rgba(41,137,216,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(30,87,153,1)), color-stop(50%,rgba(41,137,216,1)), color-stop(51%,rgba(32,124,202,1)), color-stop(100%,rgba(125,185,232,1))); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* IE10+ */background: linear-gradient(to bottom,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* W3C */width: 0%;height: 15px;border-radius: 6px;margin-bottom: 3px;display: none;}

</style>