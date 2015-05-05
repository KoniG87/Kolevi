<?php

class Image extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Image';
        
		parent::__construct($dbHandler);
	}
    
    
    public function processImages(){
        $imagePath = 'assets/libs/uploader/uploads/';
        $destinationPath = 'assets/uploads/';
        
        $acceptedExtensions = array('jpg', 'jpeg', 'png');
        $checkFileSQL = "SELECT count(id) AS valid FROM koleves_kepek WHERE fajlnev LIKE ?;";
        $insertFileSQL = "INSERT INTO koleves_kepek (FAJLNEV) VALUES (?);";
        
        
        foreach(glob($imagePath . '*') as $dok) {
            
            $fileName = basename($dok);
            $ext = pathinfo($dok, PATHINFO_EXTENSION);
            
            if (in_array($ext, $acceptedExtensions)){
                
                $checkRES = $this->fetchItem($checkFileSQL, array("%".$fileName."%"));
                
                rename($imagePath.$fileName, $destinationPath.$fileName);
                if ($checkRES['valid'] == 0){
                    $this->insertItem($insertFileSQL, array($destinationPath.$fileName));
                }
                $this->resizeImage($destinationPath.$fileName, $destinationPath);
            }
        }
        
        
        
    }
    
    
    public function resizeImage($sourceImage, $destination, $width = 200, $height = 200){
        $fileName = basename($sourceImage);
        $fileExt = pathinfo($sourceImage, PATHINFO_EXTENSION);
        
        if ($fileExt == 'png'){
            $oldImage = imagecreatefrompng( $sourceImage);
        }else{
            $oldImage = imagecreatefromjpeg( $sourceImage );
        }
        $oldWidth = imagesx( $oldImage );
        $oldHeight = imagesy( $oldImage );
        
        //$newWidth = $width;
        //$newHeight = floor( $oldHeight * ( $width / $oldWidth ) );
        $newWidth = $width;
        $newHeight = $height;
        
        $tmpImage = imagecreatetruecolor( $width, $height );
        imagecopyresized( $tmpImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight );
        
        if ($fileExt == 'png'){
            imagepng( $tmpImage, $destination."th_".$fileName );
        }else{
            imagejpeg( $tmpImage, $destination."th_".$fileName );
        }
    }
    
    
    public function getImages(){
        $SQL = "SELECT id, fajlnev, leiras_hu, gallery_tag, szekcio FROM koleves_kepek;";
        $elements = $this->fetchItems($SQL);
        
        $this->view->getImages($elements);
    }
    
    
    
    public function updateImage(){
        $res = array();
        
        $validParameters = array(
            'gallery_tag',
            'szekcio',
            'leiras_hu'
        );
        $res['status'] = 'nope';
        
        if (in_array($_POST['param'], $validParameters)){
            $SQL = "UPDATE koleves_kepek SET ".$_POST['param']." = ? WHERE id = ?;";
            $this->updateItem($SQL, array($_POST['value'], $_POST['id']));
            $res['status'] = 'ok';
        }
        
        echo json_encode($res);
    }
	
	public function deleteImageRef(){
		$res = array();
		
		$SQL = "DELETE FROM koleves_kep_osszekotesek WHERE id = ?;";
		try{
			$this->deleteItem($SQL, array($_POST['id']));
			$res['status'] = 'ok';
			
		}catch(Exception $e){
			$res['status'] = 'nope';
			
		}
		
		echo json_encode($res);
	}
	
	
	public function insertImageRef(){
		$res = array();
		
		$SQL = "INSERT INTO koleves_kep_osszekotesek SET tipus = ?, fk_id = ?, kep_id = ?;";
		try{
			$queryParams = array(
				1,
				$_POST['rendezvenyID'],
				$_POST['kepID']
			);
			$res['inputID'] = $this->insertItem($SQL, $queryParams);
			$res['status'] = 'ok';
			
			
		}catch(Exception $e){
			$res['status'] = 'nope';
		}
		
		echo json_encode($res);
	}
}

?>