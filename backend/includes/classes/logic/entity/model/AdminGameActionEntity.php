<?php


class AdminGameActionEntity extends BaseAdminGameActionEntity
{

    private $gameActionEntity = "";
    private $teamActionEntity = "";

    public function getGameActionEntity()
    {
	if($this->gameActionEntity == "")
	{
	    $this->gameActionEntity = GameActionLogicUtility::convertToObject($this->getValues());
	}

	return $this->gameActionEntity;
    }

    public function getTeamActionEntity()
    {
	if($this->teamActionEntity == "")
	{
	    $this->teamActionEntity = TeamActionLogicUtility::convertToObject($this->getValues());
	}

	return $this->teamActionEntity;
    }

    public function isValidated()
    {
	return ($this->getActionStatus() == AdminGameActionLogicUtility::$STATUS_VALIDATED);
    }

    public function isNotValidated()
    {
	return ($this->getActionStatus() == AdminGameActionLogicUtility::$STATUS_NOT_VALIDATED);
    }

    public function isProcessStarted()
    {
	return ($this->getProcessStatus() == AdminGameActionLogicUtility::$PROCESS_STATUS_STARTED);
    }

    public function isProcessNotStarted()
    {
	return ($this->getProcessStatus() == AdminGameActionLogicUtility::$PROCESS_STATUS_NOT_STARTED);
    }

    public function isProcessFinished()
    {
	return ($this->getProcessStatus() == AdminGameActionLogicUtility::$PROCESS_STATUS_FINISHED);
    }

    public function isProcessError()
    {
	return ($this->getProcessStatus() == AdminGameActionLogicUtility::$PROCESS_STATUS_ERROR);
    }
}

?>
