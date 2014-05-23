<?php


class GamesEntity extends BaseGamesEntity
{

    private $playersTeam1EntityList = "";
    private $playersTeam2EntityList = "";

    public function getVsDisplay()
    {
	$team1 = $this->getTeam1Entity()->getName();
	$team2 = $this->getTeam2Entity()->getName();

	return "$team1 v/s $team2";
    }

    public function getPlayersTeam1EntityList()
    {
	if($this->playersTeam1EntityList == "")
	{
	    $this->playersTeam1EntityList = GamesPlayersLogicUtility::getPlayersList($this->getId(), $this->getTeam1());
	}

	return $this->playersTeam1EntityList;
    }

    public function getPlayersTeam2EntityList()
    {
	if($this->playersTeam2EntityList == "")
	{
	    $this->playersTeam2EntityList = GamesPlayersLogicUtility::getPlayersList($this->getId(), $this->getTeam2());
	}

	return $this->playersTeam2EntityList;
    }
}

?>
