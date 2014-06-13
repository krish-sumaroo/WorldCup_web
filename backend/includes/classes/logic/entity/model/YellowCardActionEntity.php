<?php


class YellowCardActionEntity extends BaseYellowCardActionEntity
{

    private $playerEntity = "";

    public function getPlayerEntity()
    {
	if($this->playerEntity == "")
	{
	    $this->playerEntity = PlayersLogicUtility::convertToObject($this->getValues());
	}

	return $this->getPlayerEntity();
    }

    public function retrievePlayerEntity()
    {
	if($this->playerEntity == "")
	{
	    $this->playerEntity = PlayersLogicUtility::getPlayersDetails($this->getFkPlayerId());
	}

	return $this->playerEntity;
    }
}

?>
