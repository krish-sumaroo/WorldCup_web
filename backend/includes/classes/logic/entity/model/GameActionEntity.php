<?php


class GameActionEntity extends BaseGameActionEntity
{

    private $redCardActionEntity = "";
    private $yellowCardActionEntity = "";
    private $playerScoreActionEntity = "";

    public function getRedCardActionEntity()
    {
	if($this->redCardActionEntity == "")
	{
	    $this->redCardActionEntity = RedCardActionLogicUtility::convertToObject($this->getValues());
	}

	return $this->redCardActionEntity;
    }

    public function getYellowCardActionEntity()
    {
	if($this->yellowCardActionEntity == "")
	{
	    $this->yellowCardActionEntity = YellowCardActionLogicUtility::convertToObject($this->getValues());
	}

	return $this->yellowCardActionEntity;
    }

    public function getPlayerScoreCardActionEntity()
    {
	if($this->playerScoreActionEntity == "")
	{
	    $this->playerScoreActionEntity = PlayerScoreActionLogicUtility::convertToObject($this->getValues());
	}

	return $this->playerScoreActionEntity;
    }

    public function isRedCardAction()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_RED_CARD);
    }

    public function isYellowCardAction()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_YELLOW_CARD);
    }

    public function isPlayerScoreAction()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_PLAYER_SCORE);
    }

    public function getLineDisplay()
    {
	if($this->isRedCardAction())
	{
	    $this->getRedCardActionEntity()->getLineDisplay();
	}
    }
}

?>
