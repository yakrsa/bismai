function finish(re){
alert(111);
}

function genAuthcode(id){
alert(1);
$.ajax(
type:'POST',
url:"/index.php?g=User&m=Authcode&a=addAuth",
data:{'level':id},
success:finish(data),
dataType:json
);
}
