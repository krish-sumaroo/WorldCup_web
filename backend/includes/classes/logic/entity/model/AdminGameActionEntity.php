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
}

?>
