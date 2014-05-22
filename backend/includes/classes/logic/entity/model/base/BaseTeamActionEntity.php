<?php

class BaseTeamActionEntity
{
    private $fkGameActionId;
    private $fkTeamId;
    private $teamActionType;
    private $values;

    public function __construct($fkGameActionId, $fkTeamId, $teamActionType, $values)
    {
        $this->fkGameActionId = $fkGameActionId;
        $this->fkTeamId = $fkTeamId;
        $this->teamActionType = $teamActionType;
        $this->values = $values;
    }

    public function getFkGameActionId()
    {
        return $this->fkGameActionId;
    }

    public function getFkTeamId()
    {
        return $this->fkTeamId;
    }

    public function getTeamActionType()
    {
        return $this->teamActionType;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setFkGameActionId($fkGameActionId)
    {
        $this->fkGameActionId = $fkGameActionId;
    }

    public function setFkTeamId($fkTeamId)
    {
        $this->fkTeamId = $fkTeamId;
    }

    public function setTeamActionType($teamActionType)
    {
        $this->teamActionType = $teamActionType;
    }


}

?>
