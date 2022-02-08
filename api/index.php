<?php
    // $xml=simplexml_load_file("file.xml");
    // if($_GET['getnum']==1){
    //     echo $xml->num;
    // }
    // $arr = array('title' => '程序设计4班作业上传平台');
    // $data= json_encode($arr);
    $data = file_get_contents("settings.json");// 从文件中读取数据到PHP变量
    if($_GET['ini']==1){
        echo $data;
    }
?>