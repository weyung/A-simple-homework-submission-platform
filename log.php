<?php
define("LOG_PATH","./src/log.tsv");

    function addlog($data)
    {
        $myfile = fopen(LOG_PATH, "a") or die("Unable to open file!");
        //H为24小时制
        fwrite($myfile,date('Y-m-d H:i:s', time())."\t".$_SERVER["REMOTE_ADDR"]."\t");
        fwrite($myfile,$data);
        fwrite($myfile,"\n");
        fclose($myfile);
    }
    function addrank($data){
        $myfile = fopen(RANK_PATH, "a") or die("Unable to open file!");
        //H为24小时制
        fwrite($myfile,date('Y-m-d H:i:s', time())."\t".$_SERVER["REMOTE_ADDR"]."\t");
        fwrite($myfile,$data);
        fwrite($myfile,"\n");
        fclose($myfile);
    }
    
    function showlog()
    {
        echo "<table align=\"center\" border=\"1px\" cellspacing=\"0px\" width=\"800px\">";
        echo "<tr><th>姓名</th><th>学号</th><th>提交时间</th><th>文件名</th><th>提交IP</th></tr>";
        $file=fopen(LOG_PATH,"r")or die("Unable to open the file!");
        while(!feof($file))
        {
            $log=fgets($file);
            if(strlen($log)<=1)
            {
                continue;
            }
            $pieces = explode("\t", $log);
            echo '<tr align="center">';
            $arr = array(2,3,0,4,1);
            $num = count($arr);
            for($i=0;$i<$num;++$i)
            {
                $k=$arr[$i];
                echo "<td>$pieces[$k]</td>";
            }
            echo '</tr>';
        }
        echo "</table>";
        fclose($file);
    }
    
?>