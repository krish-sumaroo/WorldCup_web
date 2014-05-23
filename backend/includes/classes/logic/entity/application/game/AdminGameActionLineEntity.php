<?php


class AdminGameActionLineEntity extends AdminGameActionEntity
{

    private $gameActionId;
    private $adminId;
    private $gameId;
    private $actionMinute;
    private $actionDate;
    private $actionAutomaticDate;
    private $actionType;
    private $redCardGameActionId;
    private $redCardPlayerId;
    private $yellowCardGameActionId;
    private $yellowCardPlayerId;
    private $playerScoreGameActionId;
    private $playerScorePlayerId;
    private $redCardPlayerName;
    private $yellowCardPlayerName;
    private $playerScorePlayerName;
    private $values;

    public function __construct($gameActionId, $adminId, $gameId, $actionMinute, $actionDate, $actionAutomaticDate,
	    $actionType, $redCardGameActionId, $redCardPlayerId, $yellowCardGameActionId, $yellowCardPlayerId,
	    $playerScoreGameActionId, $playerScorePlayerId, $redCardPlayerName, $yellowCardPlayerName, $playerScorePlayerName,
	    $values)
    {
	$this->gameActionId = $gameActionId;
	$this->adminId = $adminId;
	$this->gameId = $gameId;
	$this->actionMinute = $actionMinute;
	$this->actionDate = $actionDate;
	$this->actionAutomaticDate = $actionAutomaticDate;
	$this->actionType = $actionType;
	$this->redCardGameActionId = $redCardGameActionId;
	$this->redCardPlayerId = $redCardPlayerId;
	$this->yellowCardGameActionId = $yellowCardGameActionId;
	$this->yellowCardPlayerId = $yellowCardPlayerId;
	$this->playerScoreGameActionId = $playerScoreGameActionId;
	$this->playerScorePlayerId = $playerScorePlayerId;
	$this->redCardPlayerName = $redCardPlayerName;
	$this->yellowCardPlayerName = $yellowCardPlayerName;
	$this->playerScorePlayerName = $playerScorePlayerName;
	$this->values = $values;
    }

    public function getGameActionId()
    {
	return $this->gameActionId;
    }

    public function getAdminId()
    {
	return $this->adminId;
    }

    public function getGameId()
    {
	return $this->gameId;
    }

    public function getActionMinute()
    {
	return $this->actionMinute;
    }

    public function getActionDate()
    {
	return $this->actionDate;
    }

    public function getActionAutomaticDate()
    {
	return $this->actionAutomaticDate;
    }

    public function getActionType()
    {
	return $this->actionType;
    }

    public function getRedCardGameActionId()
    {
	return $this->redCardGameActionId;
    }

    public function getRedCardPlayerId()
    {
	return $this->redCardPlayerId;
    }

    public function getYellowCardGameActionId()
    {
	return $this->yellowCardGameActionId;
    }

    public function getYellowCardPlayerId()
    {
	return $this->yellowCardPlayerId;
    }

    public function getPlayerScoreGameActionId()
    {
	return $this->playerScoreGameActionId;
    }

    public function getPlayerScorePlayerId()
    {
	return $this->playerScorePlayerId;
    }

    public function getRedCardPlayerName()
    {
	return utf8_encode($this->redCardPlayerName);
    }

    public function getYellowCardPlayerName()
    {
	return utf8_encode($this->yellowCardPlayerName);
    }

    public function getPlayerScorePlayerName()
    {
	return utf8_encode($this->playerScorePlayerName);
    }

    public function getValues()
    {
	return $this->values;
    }

    protected function isTypeYellowCard()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_YELLOW_CARD);
    }

    protected function isTypeRedCard()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_RED_CARD);
    }

    protected function isTypePlayerScore()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_PLAYER_SCORE);
    }

    public function getLineDisplay()
    {
	$output = "";

	$dateUtility = DateUtilityHelper::getDateUtility();
	$offset = SessionHelper::getTimeOffset() * -60;

	if($this->isTypeYellowCard())
	{
	    $urlYellowCardImage = UrlConfiguration::getImageSrc("yellow_card.png", "application");

	    $output .= "<div class=''>";
	    $output .= $dateUtility->getFormattedOffsetAdjustedDate($this->getActionDate(), $offset);
	    $output .= " : ";
	    $output .= "<img class='en4' src='$urlYellowCardImage' alt='Yellow Card' title='Yellow Card' />";
	    $output .= "&nbsp;&nbsp;";
	    $output .= $this->getYellowCardPlayerName();
	    $output .= "</div>";
	}
	elseif($this->isTypeRedCard())
	{
	    $urlRedCardImage = UrlConfiguration::getImageSrc("red_card.png", "application");

	    $output .= "<div class=''>";
	    $output .= $dateUtility->getFormattedOffsetAdjustedDate($this->getActionDate(), $offset);
	    $output .= " : ";
	    $output .= "<img class='en4' src='$urlRedCardImage' alt='Red Card' title='Red Card' />";
	    $output .= "&nbsp;&nbsp;";
	    $output .= $this->getRedCardPlayerName();
	    $output .= "</div>";
	}
	elseif($this->isTypePlayerScore())
	{
	    $urlRedCardImage = UrlConfiguration::getImageSrc("score.png", "application");

	    $output .= "<div class=''>";
	    $output .= $dateUtility->getFormattedOffsetAdjustedDate($this->getActionDate(), $offset);
	    $output .= " : ";
	    $output .= "<img class='en4' src='$urlRedCardImage' alt='Player Scores' title='Player Scores' />";
	    $output .= "&nbsp;&nbsp;";
	    $output .= $this->getPlayerScorePlayerName();
	    $output .= "</div>";
	}

	return $output;
    }
}

