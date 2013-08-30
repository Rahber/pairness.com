<?php
/*********************************************

	Copyright:	Cozmuler Pakistan
	File Name:	home.php
	Package:	Pairness.com
	Author:		Rahber

*********************************************/
include('./includes/functions.php');

function listFolderFiles($dir){
    $ffs = scandir($dir);
    echo '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            echo '<li>'.$ff;
            if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
            echo '</li>';
        }
    }
    echo '</ol>';
}

listFolderFiles('./');
?>