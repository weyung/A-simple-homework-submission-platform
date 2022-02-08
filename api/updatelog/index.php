<?php
    class log{
        public $title="更新日志";
        public $thead=array("时间","更新内容");
        public $tbody=array();
    }
    $updatelog=new log();
    $file=fopen("更新日志.tsv","r")or die("Unable to open the file!");
    while(!feof($file))
    {
        $log=fgets($file);
        if(strlen($log)<=1)
        {
            continue;
        }
        $pieces = explode("\t", $log);
        $row=array();
        $row['time']=$pieces[0];
        $row['content']=$pieces[1];
        array_push($updatelog->tbody,$row);
    }
    fclose($file);
    echo json_encode($updatelog);
?>