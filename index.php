<?php
    include ("UI.html");
    include("log.php");
    include("checkstu.php");
    $xml=simplexml_load_file("file.xml");
    header("Content-type: text/html;charset=utf-8");
    if($_GET['source']==1){
        show_source(__FILE__);
    }
    if($_GET['rank']==1){
        showrank();
    }
    if($_GET['updatelog']==1){
        showupdate();
    }
    $studir="/upload/".$_POST['stuname'].$_POST['stunum']."/";
    define("UPLOAD_PATH", dirname(__FILE__) . $studir);
    define("NUM",$xml->num);
    if(!empty($_POST['submit'])&&checkfile($xml->file_suffix,$xml->size*1000)){
        if(!is_class($_POST['stuname'],$_POST['stunum'])){
            echo $_POST['stuname'].$_POST['stunum'];
            prtfront("后端检测到姓名与学号不匹配！");
            die(123);
        }
        if (!file_exists(UPLOAD_PATH)){
            mkdir(UPLOAD_PATH, 0755);//若目录不存在则创建
            upload_file();  //开始执行
        }
    	elseif($_POST['stuname']&&$_POST['stunum']){
    		prtfront("目录已存在，请勿重复上传！(为防止文件误覆盖，本网站禁止重复上传，如需更改提交请联系课代表)");
        }
	}
	else{
	    
	}
	function prtfront($txt){
	    echo '<script>print("'.$txt.'");</script>';
	}
	function upload_file(){
	    for($k=0;$k<NUM;$k++){
            $name = basename($_FILES['file']['name'][$k]);
    	    $fnarray=explode('.', $name);
            $file_suffix = strtolower(array_pop($fnarray));
            $file_nosux="第".(($k-$k%2)/2+1)."题";
            if (move_uploaded_file($_FILES['file']['tmp_name'][$k], UPLOAD_PATH . $file_nosux.".".$file_suffix)){
    		    addlog($_POST['stuname']."\t".$_POST['stunum']."\t".$name);//记录
    		    echo '<script>success();</script>';
    			prtfront("提交成功！");
    			echo "文件大小为\t". ($_FILES["file"]["size"][$k] / 1024) . " KB<br />"; 
    			echo "类型为\t".$_FILES['file']['type'][$k]."<br />";
    			echo "<br />";
            }
            else{
                die("未知错误");
            }
        }
        addrank($_POST['stuname']."\t".$_POST['stunum']);
	}
	
    function checkfile($allow_suffix,$allow_size){
        for($k=0;$k<NUM;$k++){
            $name = basename($_FILES['file']['name'][$k]);
            $allow=explode(",",$allow_suffix);
            echo $xml->file_suffix;
            if (!$_FILES['file']['size'][$k]) {
        		$res="后端检测到第".($k+1)."个文件为空！";
        		prtfront($res);
        		return false;
        	} 
        	elseif(!get_file_suffix($name,$allow)){
                $res="后端检测到文件后缀非法！";
                prtfront($res);
                return false;
        	}
    		elseif($_FILES['file']['size'][$k]>$allow_size){
			    $res="文件过大！";
			    prtfront($res);
			    return false;
			}
            else{
                return true;
            }
        }
    }
    
    function get_file_suffix($file_name, $allow_type = array())
    {
        $fnarray=explode('.', $file_name);
        $file_suffix = strtolower(array_pop($fnarray));
        if (empty($allow_type)){
            return $file_suffix;
        }
        else{
            if (in_array($file_suffix, $allow_type)){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>