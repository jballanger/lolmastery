<?php
class Summoner
{
	protected $id,
			  $name,
			  $summonerLevel,
			  $profileIconId,
			  $revisionDate,
			  $region,
			  $platformId;

	public function __construct($sName, $region)
	{
		$this->setName($sName);
		$this->setRegion($region);
		$this->setPlatformId($region);
		$this->getSummoner($sName, $region);
	}

	public function getSummoner($sName, $region)
	{
		$infos = @file_get_contents("https://". $region .".api.pvp.net/api/lol/". $region ."/v1.4/summoner/by-name/". $sName ."?api_key=". KEY);
		if(!$this->isValid($infos))
		{
			return;
			exit();
		}
		$dataArray = json_decode($infos, true);
		$this->hydrate($dataArray[mb_strtolower(str_replace(' ', '', $sName), 'utf8')]);
	}

	public function hydrate(array $data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function isValid($data)
	{
		return !empty($data);
	}
	/**
	SET
	**/
	public function setName($name)
	{
		$this->name = $name;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setSummonerLevel($level)
	{
		$this->summonerLevel = $level;
	}

	public function setProfileIconId($iconId)
	{
		$this->profileIconId = $iconId;
	}

	public function setRevisionDate($revDate)
	{
		$this->revisionDate = $revDate;
	}

	public function setRegion($region)
	{
		$this->region = $region;
	}

	public function setPlatformId($region)
	{
		switch($region)
		{
			case 'br':
			$this->platformId = 'BR1';
			break;

			case 'eune':
			$this->platformId = 'EUN1';
			break;

			case 'euw':
			$this->platformId = 'EUW1';
			break;

			case 'jp':
			$this->platformId = 'JP1';
			break;

			case 'kr':
			$this->platformId = 'KR';
			break;

			case 'lan':
			$this->platformId = 'LA1';
			break;

			case 'las':
			$this->platformId = 'LA2';
			break;

			case 'na':
			$this->platformId = 'NA1';
			break;

			case 'oce':
			$this->platformId = 'OC1';
			break;

			case 'tr':
			$this->platformId = 'TR1';
			break;

			case 'ru':
			$this->platformId = 'RU';
			break;

			case 'pbe':
			$this->platformId = 'PBE1';
			break;
		}
	}

	/**
	GET
	**/

	public function id()
	{
		return $this->id;
	}

	public function name()
	{
		return $this->name;
	}

	public function level()
	{
		return $this->summonerLevel;
	}

	public function icon()
	{
		return $this->profileIconId;
	}

	public function revDate()
	{
		return $this->revisionDate;
	}

	public function region()
	{
		return $this->region;
	}

	public function platformId()
	{
		return $this->platformId;
	}
}
?>