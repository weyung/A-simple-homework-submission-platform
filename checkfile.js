function checkfilesuffix()
{
    var stuname=document.getElementById('stuname').value;
    if(stuname=="")
    {
        print("姓名不能为空");
        return false;
    }
    else if(stuname.length>4)
    {
        print("你的名字有点长。。。");
        return false;
    }
    var stunum=document.getElementById('stunum').value;
    if(stunum=="")
    {
        print("学号不能为空");
        return false;
    }
    else if(stunum!=21312481&&(stunum<21312086||stunum>21312199))
    {
        print("非本班学生");
        return false;
    }
    var reg = /^\d{8}$/;
    if (!reg.test(stunum)) 
    {
        print("请输入正确学号！");
        return false;
    }
    for(var k=1;k<=2;k++)
    {
        var id="file"+k;
        var file=document.getElementById(id).value;
        //console.log(document.getElementById(id).files[0].size);
        if(file==""||file==null)
        {
            print("上传文件不能为空");
            return false;
        }
        else
        {
            var whitelist;
            if(k%2==1)
            {
                whitelist=new Array(".c",".cpp");
            }
            else if(k%2==0)
            {
                whitelist=new Array(".png",".jpg",".PNG",".JPG");
            }
            var file_suffix=file.substring(file.lastIndexOf("."));
            if(whitelist.indexOf(file_suffix) == -1)
            {
                print("请选择正确文件！");
                return false;
            }
        }
    }
    document.getElementById("submit").value="提交成功！";
}
function ptalert(txt)
{
    $("#alert").attr("class","info");
    $("#alert").text(txt);
}