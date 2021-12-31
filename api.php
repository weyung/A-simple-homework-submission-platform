<?php
    $xml=simplexml_load_file("file.xml");
    if($_GET['getnum']==1){
        echo $xml->num;
    }
?>