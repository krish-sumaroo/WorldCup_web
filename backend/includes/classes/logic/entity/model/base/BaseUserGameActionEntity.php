<?php

class BaseUserGameActionEntity
{
    private $fkGameActionId;
    private $fkUserId;
    private $values;

    public function __construct($fkGameActionId, $fkUserId, $values)
    {
        $this->fkGameActionId = $fkGameActionId;
        $this->fkUserId = $fkUserId;
        $this->values = $values;
    }

    public function getFkGameActionId()
    {
        return $this->fkGameActionId;
    }

    public function getFkUserId()
    {
        return $this->fkUserId;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setFkGameActionId($fkGameActionId)
    {
        $this->fkGameActionId = $fkGameActionId;
    }

    public function setFkUserId($fkUserId)
    {
        $this->fkUserId = $fkUserId;
    }


}

?>
