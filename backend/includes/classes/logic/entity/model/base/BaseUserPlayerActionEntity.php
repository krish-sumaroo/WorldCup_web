<?php


class BaseUserPlayerActionEntity
{

    private $id;
    private $playerId;
    private $actionId;
    private $userId;
    private $timestamp;
    private $gameId;
    private $points;
    private $status;
    private $values;

    public function __construct($id, $playerId, $actionId, $userId, $timestamp, $gameId, $points, $status, $values)
    {
	$this->id = $id;
	$this->playerId = $playerId;
	$this->actionId = $actionId;
	$this->userId = $userId;
	$this->timestamp = $timestamp;
	$this->gameId = $gameId;
	$this->points = $points;
	$this->status = $status;
	$this->values = $values;
    }

    public function getId()
    {
	return $this->id;
    }

    public function getPlayerId()
    {
	return $this->playerId;
    }

    public function getActionId()
    {
	return $this->actionId;
    }

    public function getUserId()
    {
	return $this->userId;
    }

    public function getTimestamp()
    {
	return $this->timestamp;
    }

    public function getGameId()
    {
	return $this->gameId;
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

    public function setPlayerId($playerId)
    {
	$this->playerId = $playerId;
    }

    public function setActionId($actionId)
    {
	$this->actionId = $actionId;
    }

    public function setUserId($userId)
    {
	$this->userId = $userId;
    }

    public function setTimestamp($timestamp)
    {
	$this->timestamp = $timestamp;
    }

    public function setGameId($gameId)
    {
	$this->gameId = $gameId;
    }
}

?>
