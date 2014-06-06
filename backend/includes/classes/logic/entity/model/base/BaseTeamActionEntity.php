<?php


class BaseTeamActionEntity
{

    private $fkGameActionId;
    private $team1Score;
    private $team2Score;
    private $values;

    public function __construct($fkGameActionId, $team2Score, $team2Score, $values)
    {
	$this->fkGameActionId = $fkGameActionId;
	$this->team1Score = $team2Score;
	$this->team2Score = $team2Score;
	$this->values = $values;
    }

    public function getFkGameActionId()
    {
	return $this->fkGameActionId;
    }

    public function getTeam1Score()
    {
	return $this->team1Score;
    }

    public function getTeam2Score()
    {
	return $this->team2Score;
    }

    public function getValues()
    {
	return $this->values;
    }

    public function setFkGameActionId($fkGameActionId)
    {
	$this->fkGameActionId = $fkGameActionId;
    }
}

?>
