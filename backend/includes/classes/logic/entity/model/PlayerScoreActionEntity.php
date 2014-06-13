<?php


class PlayerScoreActionEntity extends BasePlayerScoreActionEntity
{

    private $playerEntity = "";

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
