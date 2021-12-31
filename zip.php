<?php

/*
    e.g.
    zipdir(dirname(__FILE__).'/upload',"test.zip");
*/
function zipdir($aimdir,$aimname)
{
    $dirarray=explode('/', $aimdir);
    $last_dir = strtolower(array_pop($dirarray));
    //父目录
    $parent_dir=str_replace($last_dir,"",$aimdir);
    //新建文件
    $myfile = fopen($parent_dir.$aimname, "w");
    fclose($myfile);
    
    $zip=new ZipArchive();
    if($zip->open($parent_dir.$aimname, ZipArchive::OVERWRITE)=== TRUE){
        addFileToZip($aimdir, $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
        $zip->close(); //关闭处理的zip文件
        return true;
    }
    else{
        return false;
    }
}

function pt($text)
{
    echo $text."<br/>";
}

function addFileToZip($path,$zip){
    $handler=opendir($path); //打开当前文件夹由$path指定。
    while(($filename=readdir($handler))!==false){
        if($filename != "." && $filename != ".."){
            //文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if(is_dir($path."/".$filename)){
                // 如果读取的某个对象是文件夹，则递归
                addFileToZip($path."/".$filename, $zip);
            }else{ 
                //将文件加入zip对象
                $res=str_replace("/www/wwwroot/hw.atpyyds.xyz/","",$path);
                $zip->addFile($path."/".$filename,$res."/".$filename);
            }
        }
    }
    @closedir($path);
}
?>