<?php
define("CLASS_PATH","./src/class.tsv");
function showclass(){
    echo "<table align=\"center\" border=\"1px\" cellspacing=\"0px\" width=\"800px\">";
        echo "<tr><th>姓名</th><th>学号</th></tr>";
    $file=fopen(CLASS_PATH,"r")or die("Unable to open the file!");
    while(!feof($file))
        {
            $log=fgets($file);
            if(strlen($log)<=1)
            {
                continue;
            }
            $pieces = explode("\t", $log);
            echo '<tr align="center">';
            $arr = array(0,1);
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

function is_class($stuname,$stunum){
    $file=fopen(CLASS_PATH,"r")or die("Unable to open the file!");
    while(!feof($file)){
        $log=fgets($file);
        if(strlen($log)<=1)
        {
            continue;
        }
        $pieces = explode("\t", $log);
        preg_match('/(\d+)/',$pieces[1],$matches);
        if($matches[0]==$stunum&&$pieces[0]==$stuname){
            return true;
        }
    }
    fclose($file);
    return false;
}
?>