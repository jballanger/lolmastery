<?php
require 'lib/autoload.php';
session_start();

if(isset($_POST['team']) || isset($_GET['team']))
{
	if(isset($_POST['team']))
	{
		if(!empty($_POST['team']['name']) && !empty($_POST['team']['region']))
		{
			$name = $_POST['team']['name'];
			$region = $_POST['team']['region'];

			$summoner = new Summoner($name, $region, 'byName');

			$team = new Team($summoner->id());
			$teamInfos = $team->getTeam($summoner->id(), $summoner->region());

			$_SESSION['team'] = $teamInfos;
			$_SESSION['summonerId'] = $summoner->id();
			$_SESSION['summonerRegion'] = $summoner->region();
		}
	}

	if(isset($_GET['team']))
	{
		if(isset($_SESSION['team']))
		{
			echo "<image src='assets/images/loader.gif' />";
			$team = $_SESSION['team'];
			$teamNumber = (int) $_GET['team'];
			$numberOfMember = count($team[$_SESSION['summonerId']][$teamNumber]['roster']['memberList']);

			echo "<form action='mastery.php' method='POST' name='masteryForm'>";
			for($i = 0; $i < $numberOfMember; $i++)
			{
				echo "<input type='hidden' name='summoner[". $i ."][name]' value='". $team[$_SESSION['summonerId']][$teamNumber]['roster']['memberList'][$i]['playerId']."'/>";
				echo "<input type='hidden' name='summoner[". $i ."][region]' value='". $_SESSION['summonerRegion'] ."'/>";
			}
			echo "<input type='hidden' name='isearcha' value='byId'/>
				  </form>
				  <script language='JavaScript'>
				  document.masteryForm.submit();
				  </script>
				 ";
		}
	}
}
else
{
	header('Location:index.php');
}
//56741551