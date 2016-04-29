var i = 1;
function addFriend()
{
  var html = "<div class='add_summoner' id='summoner"+ i +"'><input type='text' name='summoner["+ i +"][name]' placeholder='Name...'/><select name='summoner["+ i +"][region]'></select></div>";
	$('.container_add_summoner').append(html);
  $('#summoner'+ i +' select').load('regionList.php');
  i = i + 1;
}

$(document).ready(function()
{
	$('#add_summoner').click(function()
	{
		addFriend();
	});
});