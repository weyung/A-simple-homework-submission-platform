function success(){
    $("input").attr("disabled","disabled");
    $("#submit").remove();
}
function print(txt){
    $("#alert").attr("class","info");
    $("#alert").text(txt);
}