<?php
class Team extends Summoner
{
	protected $summonerId,
			  $numberOfTeam;

	public function __construct($summonerId)
	{
		$this->summonerId = $summonerId;
	}

	public function getTeam($summonerId, $summonerRegion)
	{
		$team = @file_get_contents("https://". $summonerRegion .".api.pvp.net/api/lol/". $summonerRegion ."/v2.4/team/by-summoner/". $summonerId ."?api_key=". KEY);

		if(!$this->isValid($team))
		{
			echo "<h2>Team not found</h2>";
			return;
			exit();
		}

		$team = json_decode($team, true);
		$this->numberOfTeam = (count($team[$summonerId]));

		$this->check($team);
		return $team;
	}

	public function showTeam(array $team)
	{
		for($i = 0; $i < $this->numberOfTeam; $i++)
		{
			echo "<a href='team.php?team=". $i ."'>". $team[$this->summonerId][$i]['name']. " - [" . $team[$this->summonerId][$i]['tag'] ."] </a>";
		}
	}

	public function check(array $team)
	{
		if($this->numberOfTeam > 1)
		{
			$this->showTeam($team);
		}
		else
		{
			Header('Location:team.php?team=0');
		}
	}
}
?>
