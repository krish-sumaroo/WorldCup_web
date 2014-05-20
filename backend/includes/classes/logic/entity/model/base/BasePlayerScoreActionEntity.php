<?php

class BasePlayerScoreActionEntity
{
    private $fkGameActionId;
    private $fkPlayerId;
    private $values;

    public function __construct($fkGameActionId, $fkPlayerId, $values)
    {
        $this->fkGameActionId = $fkGameActionId;
        $this->fkPlayerId = $fkPlayerId;
        $this->values = $values;
    }

    public function getFkGameActionId()
    {
        return $this->fkGameActionId;
    }

    public function getFkPlayerId()
    {
        return $this->fkPlayerId;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setFkGameActionId($fkGameActionId)
    {
        $this->fkGameActionId = $fkGameActionId;
    }

    public function setFkPlayerId($fkPlayerId)
    {
        $this->fkPlayerId = $fkPlayerId;
    }


}

?>
