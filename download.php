<?php
include("zip.php");
function get_download_link()
{
    $time=date('Y-m-d H:i:s', time());
    $hashtime=hash("sha256",$time);
    mkdir("temp/".$hashtime);
    if(zipdir(dirname(__FILE__).'/upload',"temp/".$hashtime."/".$time.".zip")){
        return "temp/".$hashtime."/".$time.".zip";
    }
    else{
        return false;
    }
}


?>