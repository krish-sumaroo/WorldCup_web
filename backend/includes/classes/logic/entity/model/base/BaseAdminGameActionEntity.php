<?php


class BaseAdminGameActionEntity
{

    protected $fkGameActionId;
    protected $fkAdminId;
    protected $actionStatus;
    protected $values;

    public function __construct($fkGameActionId, $fkAdminId, $actionStatus, $values)
    {
	$this->fkGameActionId = $fkGameActionId;
	$this->fkAdminId = $fkAdminId;
	$this->actionStatus = $actionStatus;
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

    public function getActionStatus()
    {
	return $this->actionStatus;
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
