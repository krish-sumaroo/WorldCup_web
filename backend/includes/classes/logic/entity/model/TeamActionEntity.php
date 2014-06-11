<?php


class TeamActionEntity extends BaseTeamActionEntity
{

    public function getGameActionEntity()
    {
	return GameActionLogicUtility::convertToObject($this->getValues());
    }

    public function getAdminGameActionEntity()
    {
	return AdminGameActionLogicUtility::convertToObject($this->getValues());
    }
}

?>
