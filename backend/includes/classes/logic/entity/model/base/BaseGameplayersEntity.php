<?php

class BaseGameplayersEntity
{
    private $gameId;
    private $playerId;
    private $teamId;
    private $values;

    public function __construct($gameId, $playerId, $teamId, $values)
    {
        $this->gameId = $gameId;
        $this->playerId = $playerId;
        $this->teamId = $teamId;
        $this->values = $values;
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
