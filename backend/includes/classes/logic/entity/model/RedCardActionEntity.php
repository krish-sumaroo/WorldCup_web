<?php


class RedCardActionEntity extends BaseRedCardActionEntity
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
	$this->playerEntity = PlayersLogicUtility::getPlayersDetails($this->getFkPlayerId());

	return $this->playerEntity;
    }

    public function getLineDisplay()
    {
	$output = "";

	$playerEntity = $this->retrievePlayerEntity();

	$output .= "Red card to ".$playerEntity->getFormattedName();

	return $output;
    }
}

?>
