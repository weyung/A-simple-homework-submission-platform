
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" href="https://wymcloud.cn/images/wy.png">
    <title>程序设计4班作业上传平台</title>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
    function show_link(link){
    var txt='<p align="center"><a href="'+link+'" target="_blank">下载链接</a></p>';
    $("#maindiv").append(txt);
    }  
    function update_img(){
        $("#captcha_img").attr("src",'./captcha.php');
        console.log("tet");
    }
    </script>
</head>
<body>
    <h1 align="center">程序设计4班作业上传平台（公测）</h1>
    <div id="maindiv" class="maindiv" >
        <br>
        <p align="center">作业下载</p>
        <HR style="FILTER: alpha(opacity=100,finishopacity=0,style=3)" width="80%" color=#987cb9 SIZE=3>
        <form action="" method="post" enctype="multipart/form-data"  id="fileform">
            <br/>
            <p class="form" align="center">请输入凭据：<input type="text" name="cre" value="" id="cre"/></p>
            <p class="form" align="center">验证码: 
                <input type="text" name="authcode" value="" id="captcha"/>
                <img id="captcha_img" border='1' src='./captcha.php' style="width:100px; height:30px" onclick="update_img();">
                <a onclick="update_img();">看不清，换<s>双眼睛?</s>一张?</a></p>
            <p class="form" align="center"><input class="submit" type="submit" value="确定"/></p>
        </form>
    </div>
</body>
</html>
<?php
include("rsa.php");
include("download.php");
if($_POST['cre']&&$_POST['authcode']){
    session_start();
    //HLlmWj/Z9U2z/OIHUnoyzjODciLw8EXgqQHJwXjJ2J8vxtt7BlK8CumIMYajfun5did3uXx9Fb31H8y3WRnFyWx6JagUuR50Yyke4cbdhaxm+LrCekIEKGju9Ger8BPJQ2lEMkAt/N31vUOJqEuiRnIa4TVk0RodKOXZ6l7MTmM=
    if($_POST['authcode']!=$_SESSION['authcode']){
        echo "验证码应为";
        echo $_SESSION['authcode'];
    }
    elseif(rsa_decrypt($_POST['cre'])!='admin'){
        echo "凭据无效！";
    }
    else{
        echo '<script>show_link("'.get_download_link().'")</script>';
    }
}
?>