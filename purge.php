<?php

$c=0;

$files = glob('./cache/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); 
	$c++;// delete file
}

echo $c .' files purged';

?>