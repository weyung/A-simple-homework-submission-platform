<?php
    class rank{
        public $title="提交排行";
        public $thead=array("姓名","学号","提交时间");
        public $tbody=array();
    }
    $rank=new rank();
    define("RANK_PATH","../../src/rank.tsv");
    $file=fopen(RANK_PATH,"r")or die("Unable to open the file!");
    while(!feof($file))
    {
        $log=fgets($file);
        if(strlen($log)<=1)
        {
            continue;
        }
        $pieces = explode("\t", $log);
        $pattern="/^[\x{4e00}-\x{9fa5}]+(?=[\x{4e00}-\x{9fa5}]+$)/u";
        $starname=preg_replace($pattern,"**",$pieces[2]);
        $pattern="/^\d+(?=[\d]{2}$)/";
        $starid=preg_replace($pattern,"******",$pieces[3]);
        $row['name']=$starname;
        $row['id']=$starid;
        $row['time']=$pieces[0];
        array_push($rank->tbody,$row);
    }
    fclose($file);
    echo json_encode($rank);
    