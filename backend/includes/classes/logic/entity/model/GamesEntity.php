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

    public function getScoreDisplay()
    {
	if(($this->getT1Score() != "") && ($this->getT2Score() != ""))
	{
	    $team1Score = $this->getT1Score();
	    $team2Score = $this->getT2Score();

	    return "($team1Score - $team2Score)";
	}
	else
	{
	    return "";
	}
    }

    public function getPlayersTeam1EntityList()
    {
	if($this->playersTeam1EntityList == "")
	{
//	    $this->playersTeam1EntityList = GamesPlayersLogicUtility::getPlayersList($this->getId(), $this->getTeam1());
	    $this->playersTeam1EntityList = PlayersLogicUtility::getPlayersListByTeamId($this->getTeam1());
	}

	return $this->playersTeam1EntityList;
    }

    public function getPlayersTeam2EntityList()
    {
	if($this->playersTeam2EntityList == "")
	{
	    $this->playersTeam2EntityList = PlayersLogicUtility::getPlayersListByTeamId($this->getTeam2());
//	    $this->playersTeam2EntityList = GamesPlayersLogicUtility::getPlayersList($this->getId(), $this->getTeam2());
	}

	return $this->playersTeam2EntityList;
    }
}

?>
