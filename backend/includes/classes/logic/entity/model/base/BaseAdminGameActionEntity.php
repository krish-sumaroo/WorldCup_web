<?php

class BaseAdminGameActionEntity
{
    private $fkGameActionId;
    private $fkAdminId;
    private $values;

    public function __construct($fkGameActionId, $fkAdminId, $values)
    {
        $this->fkGameActionId = $fkGameActionId;
        $this->fkAdminId = $fkAdminId;
        $this->values = $values;
    }

    public function getFkGameActionId()
    {
        return $this->fkGameActionId;
    }

    public function getFkAdminId()
    {
        return $this->fkAdminId;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setFkGameActionId($fkGameActionId)
    {
        $this->fkGameActionId = $fkGameActionId;
    }

    public function setFkAdminId($fkAdminId)
    {
        $this->fkAdminId = $fkAdminId;
    }


}

?>
