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

	$("input[type='radio']").change(function()
	{
		if($(this).val() == 'byName')
		{
			$("input[type='text']").each(function(i)
			{
				$(this).attr('name', 'summoner['+ i +'][name]');
				$(this).attr('placeholder', 'Summoner Name');
			});

			$("select").each(function(i)
			{
				$(this).attr('name', 'summoner['+ i +'][region]');
			});

			$('form').attr('action', 'mastery.php');
			$('.button_add_summoner').fadeIn('fast');
		}
		if($(this).val() == 'byTeam')
		{
			$("input[type='text']").each(function(i)
			{
				$(this).attr('name', 'team[name]');
				$(this).attr('placeholder', 'Summoner Name of a Team member');
			});

			$("select").each(function(i)
			{
				$(this).attr('name', 'team[region]');
			});

			$('form').attr('action', 'team.php');

			$('.button_add_summoner').fadeOut('fast');
			$('.add_summoner').remove();
		}
	});
});