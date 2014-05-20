<?php


class BaseGamesEntity
{

    private $id;
    private $stage;
    private $team1;
    private $team2;
    private $venue;
    private $t1Score;
    private $t2Score;
    private $extraScore;
    private $timeStarted;
    private $startedF;
    private $playerInfo;
    private $matchDate;
    private $matchStatus;
    private $values;

    public function __construct($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted,
	    $startedF, $playerInfo, $matchDate, $matchStatus, $values)
    {
	$this->id = $id;
	$this->stage = $stage;
	$this->team1 = $team1;
	$this->team2 = $team2;
	$this->venue = $venue;
	$this->t1Score = $t1Score;
	$this->t2Score = $t2Score;
	$this->extraScore = $extraScore;
	$this->timeStarted = $timeStarted;
	$this->startedF = $startedF;
	$this->playerInfo = $playerInfo;
	$this->matchDate = $matchDate;
	$this->matchStatus = $matchStatus;
	$this->values = $values;
    }

    public function getId()
    {
	return $this->id;
    }

    public function getStage()
    {
	return $this->stage;
    }

    public function getTeam1()
    {
	return $this->team1;
    }

    public function getTeam2()
    {
	return $this->team2;
    }

    public function getVenue()
    {
	return $this->venue;
    }

    public function getT1Score()
    {
	return $this->t1Score;
    }

    public function getT2Score()
    {
	return $this->t2Score;
    }

    public function getExtraScore()
    {
	return $this->extraScore;
    }

    public function getTimeStarted()
    {
	return $this->timeStarted;
    }

    public function getStartedF()
    {
	return $this->startedF;
    }

    public function getPlayerInfo()
    {
	return $this->playerInfo;
    }

    public function getMatchDate()
    {
	return $this->matchDate;
    }

    public function getMatchStatus()
    {
	return $this->matchStatus;
    }

    public function getValues()
    {
	return $this->values;
    }

    public function setId($id)
    {
	$this->id = $id;
    }

    public function setStage($stage)
    {
	$this->stage = $stage;
    }

    public function setTeam1($team1)
    {
	$this->team1 = $team1;
    }

    public function setTeam2($team2)
    {
	$this->team2 = $team2;
    }

    public function setVenue($venue)
    {
	$this->venue = $venue;
    }

    public function setT1Score($t1Score)
    {
	$this->t1Score = $t1Score;
    }

    public function setT2Score($t2Score)
    {
	$this->t2Score = $t2Score;
    }

    public function setExtraScore($extraScore)
    {
	$this->extraScore = $extraScore;
    }

    public function setTimeStarted($timeStarted)
    {
	$this->timeStarted = $timeStarted;
    }

    public function setStartedF($startedF)
    {
	$this->startedF = $startedF;
    }

    public function setPlayerInfo($playerInfo)
    {
	$this->playerInfo = $playerInfo;
    }

    public function setMatchDate($matchDate)
    {
	$this->matchDate = $matchDate;
    }
}

?>
