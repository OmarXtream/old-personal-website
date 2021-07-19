function post(){
var name = $('#name').val();
var msg = $('#msg').val();
var email =  $('#email').val();

document.getElementById("result").innerHTML = '<img src="ajax-loader.gif">';
$.post('index.php',{postname:name,postmsg:msg,postemail:email},
function(data,ts,xhr)
{

$('#result').html(data);

});
}