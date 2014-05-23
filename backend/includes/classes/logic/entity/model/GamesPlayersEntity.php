<?php


class GamesPlayersEntity extends BaseGamesPlayersEntity
{

    private $playerEntity = "";

    public function getPlayerEntity()
    {
	if($this->playerEntity == "")
	{
	    $this->playerEntity = PlayersLogicUtility::convertToObject($this->getValues());
	}

	return $this->playerEntity;
    }
}

?>
