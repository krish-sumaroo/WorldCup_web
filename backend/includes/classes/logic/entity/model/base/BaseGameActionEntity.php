<?php

class BaseGameActionEntity
{
    private $gameActionId;
    private $fkGameId;
    private $fkUserId;
    private $actionMinute;
    private $actionDate;
    private $actionAutomaticDate;
    private $actionType;
    private $values;

    public function __construct($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType, $values)
    {
        $this->gameActionId = $gameActionId;
        $this->fkGameId = $fkGameId;
        $this->fkUserId = $fkUserId;
        $this->actionMinute = $actionMinute;
        $this->actionDate = $actionDate;
        $this->actionAutomaticDate = $actionAutomaticDate;
        $this->actionType = $actionType;
        $this->values = $values;
    }

    public function getGameActionId()
    {
        return $this->gameActionId;
    }

    public function getFkGameId()
    {
        return $this->fkGameId;
    }

    public function getFkUserId()
    {
        return $this->fkUserId;
    }

    public function getActionMinute()
    {
        return $this->actionMinute;
    }

    public function getActionDate()
    {
        return $this->actionDate;
    }

    public function getActionAutomaticDate()
    {
        return $this->actionAutomaticDate;
    }

    public function getActionType()
    {
        return $this->actionType;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setGameActionId($gameActionId)
    {
        $this->gameActionId = $gameActionId;
    }

    public function setFkGameId($fkGameId)
    {
        $this->fkGameId = $fkGameId;
    }

    public function setFkUserId($fkUserId)
    {
        $this->fkUserId = $fkUserId;
    }

    public function setActionMinute($actionMinute)
    {
        $this->actionMinute = $actionMinute;
    }

    public function setActionDate($actionDate)
    {
        $this->actionDate = $actionDate;
    }

    public function setActionAutomaticDate($actionAutomaticDate)
    {
        $this->actionAutomaticDate = $actionAutomaticDate;
    }

    public function setActionType($actionType)
    {
        $this->actionType = $actionType;
    }


}

?>
