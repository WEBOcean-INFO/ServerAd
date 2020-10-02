$(function() {

$(".vote").click(function() 
{

var id = $(this).attr("id");
var name = $(this).attr("name");
var dataString = 'id='+ id ;
var parent = $(this);


if(name=='up')
{

$(this).fadeIn(200).html('');
$.ajax({
   type: "POST",
   url: "includes/up_vote.php",
   data: dataString,
   cache: false,

   success: function(html)
   {
    parent.html(html);
  
  }  });
  
}

  
return false;
});
});