<?php
class SummonerMastery
{

	protected $mastery,
			  $championLevel = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0),
			  $totalPoint = 0;

	public function __construct(Summoner $summoner)
	{
		$this->getMastery($summoner);
	}

	public function getMastery($summoner)
	{
		$infos = @file_get_contents('https://'. $summoner->region() .'.api.pvp.net/championmastery/location/'. $summoner->platformId() .'/player/'. $summoner->id() .'/champions?api_key=' . KEY);

		if(!$this->isValid($infos))
		{
			return;
			exit();
		}

		$mastery = json_decode($infos, true);
		$this->setMastery($mastery);
	}

	public function getChampionLevel(array $mastery)
	{
		foreach($mastery as $champion)
			{
				$lvl = $champion['championLevel'];
				$n = $this->championLevel[$lvl];
				$new = $n + 1;
				$this->championLevel[$lvl] = $new;
			}
	}

	public function getTotalPoint(array $mastery)
	{
		foreach($mastery as $champion)
		{
			$point = $champion['championPoints'];
			$this->totalPoint = $this->totalPoint + $point;
		}
	}

	public function isValid($data)
	{
		return !empty($data);
	}

	public function setMastery(array $mastery)
	{
		$this->mastery = $mastery;
	}

	public function mastery()
	{
		return $this->mastery;
	}

	public function championLevel()
	{
		return $this->championLevel;
	}

	public function totalPoint()
	{
		return number_format($this->totalPoint);
	}
}
?>