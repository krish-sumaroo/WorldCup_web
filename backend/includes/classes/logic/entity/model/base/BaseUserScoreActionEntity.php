<?php

class BaseUserScoreActionEntity
{
    private $id;
    private $gameId;
    private $team1Id;
    private $team1Score;
    private $team2Score;
    private $team2Id;
    private $userId;
    private $timestamp;
    private $points;
    private $status;
    private $values;

    public function __construct($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status, $values)
    {
        $this->id = $id;
        $this->gameId = $gameId;
        $this->team1Id = $team1Id;
        $this->team1Score = $team1Score;
        $this->team2Score = $team2Score;
        $this->team2Id = $team2Id;
        $this->userId = $userId;
        $this->timestamp = $timestamp;
        $this->points = $points;
        $this->status = $status;
        $this->values = $values;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGameId()
    {
        return $this->gameId;
    }

    public function getTeam1Id()
    {
        return $this->team1Id;
    }

    public function getTeam1Score()
    {
        return $this->team1Score;
    }

    public function getTeam2Score()
    {
        return $this->team2Score;
    }

    public function getTeam2Id()
    {
        return $this->team2Id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setGameId($gameId)
    {
        $this->gameId = $gameId;
    }

    public function setTeam1Id($team1Id)
    {
        $this->team1Id = $team1Id;
    }

    public function setTeam1Score($team1Score)
    {
        $this->team1Score = $team1Score;
    }

    public function setTeam2Score($team2Score)
    {
        $this->team2Score = $team2Score;
    }

    public function setTeam2Id($team2Id)
    {
        $this->team2Id = $team2Id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


}

?>
