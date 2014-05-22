<?php

class BaseGamesPlayersEntity
{
    private $id;
    private $gameId;
    private $playerId;
    private $teamId;
    private $values;

    public function __construct($id, $gameId, $playerId, $teamId, $values)
    {
        $this->id = $id;
        $this->gameId = $gameId;
        $this->playerId = $playerId;
        $this->teamId = $teamId;
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

    public function getPlayerId()
    {
        return $this->playerId;
    }

    public function getTeamId()
    {
        return $this->teamId;
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

    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
    }

    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }


}

?>
