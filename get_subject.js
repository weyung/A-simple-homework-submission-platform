function get(key,value)
{
    var url="api.php?"+key+"="+value;
    $.get(url,function(data,status){
    console.log("数据: " + data + "\n状态: " + status);
    load_subject(data);
  });
}

function load_subject(num)
{
    $("#loading").remove();
    for(var k=1;k<=num;k++){
        var newp=$("<p>")
        newp.attr({class:"form",align:"center"});
        if(k%2==1){
            txt='<p class="form" align="center">第'+(k+k%2)/2+'题源文件:  <input type="file" class="filestyle" name="file[]" id="file'+k+'" /></p>';
        }
        else if(k%2==0){
            txt='<p class="form" align="center">第'+(k+k%2)/2+'题截图:  <input type="file" class="filestyle" name="file[]" id="file'+k+'" /></p>';
        }
        console.log(txt);
        $("#stunum").after(txt);
    }
}