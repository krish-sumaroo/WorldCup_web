<?php


class AdminGameActionEntity extends BaseAdminGameActionEntity
{

    private $gameActionEntity = "";

    public function getGameActionEntity()
    {
	if($this->gameActionEntity == "")
	{
	    $this->gameActionEntity = GameActionLogicUtility::convertToObject($this->getValues());
	}

	return $this->gameActionEntity;
    }

    public function isValidated()
    {
	return ($this->getActionStatus() == AdminGameActionLogicUtility::$STATUS_VALIDATED);
    }

    public function isNotValidated()
    {
	return ($this->getActionStatus() == AdminGameActionLogicUtility::$STATUS_NOT_VALIDATED);
    }
}

?>
