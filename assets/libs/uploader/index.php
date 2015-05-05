<?php
$allowedExtensions = array('jpg', 'jpeg', 'png');
$sizeLimit = 1.5 * 1024 * 1024;

require('php.php');
$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

$folder = 'uploads';
chmod($folder, 0755);
$result = $uploader->handleUpload($folder);
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
?>
