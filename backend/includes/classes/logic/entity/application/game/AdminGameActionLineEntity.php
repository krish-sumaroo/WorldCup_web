<?php


class AdminGameActionLineEntity extends AdminGameActionEntity
{

    protected $gameActionId;
    protected $adminId;
    protected $gameId;
    protected $actionMinute;
    protected $actionDate;
    protected $actionAutomaticDate;
    protected $actionType;
    protected $redCardGameActionId;
    protected $redCardPlayerId;
    protected $yellowCardGameActionId;
    protected $yellowCardPlayerId;
    protected $playerScoreGameActionId;
    protected $playerScorePlayerId;
    protected $redCardPlayerName;
    protected $yellowCardPlayerName;
    protected $playerScorePlayerName;
    protected $playerSubstitutePlayerName;
    protected $values;

    public function __construct($gameActionId, $adminId, $actionStatus, $gameId, $actionMinute, $actionDate,
	    $actionAutomaticDate, $actionType, $redCardGameActionId, $redCardPlayerId, $yellowCardGameActionId,
	    $yellowCardPlayerId, $playerScoreGameActionId, $playerScorePlayerId, $redCardPlayerName, $yellowCardPlayerName,
	    $playerScorePlayerName, $playerSubstitutePlayerName, $values)
    {
	$this->gameActionId = $gameActionId;
	$this->adminId = $adminId;
	$this->actionStatus = $actionStatus;
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
	$this->playerSubstitutePlayerName = $playerSubstitutePlayerName;
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

    public function getPlayerSubstitutePlayerName()
    {
	return utf8_encode($this->playerSubstitutePlayerName);
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

    protected function isTypePlayerSubstitute()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_PLAYER_SUBSTITUTE);
    }

    protected function isTypeTeamAction()
    {
	return ($this->getActionType() == GameActionLogicUtility::$ACTION_TYPE_TEAM_ACTION);
    }

    public function getLineDisplay()
    {
	$output = "";

	$dateUtility = DateUtilityHelper::getDateUtility();
	$offset = SessionHelper::getTimeOffset() * -60;

	$validateDisplay = $this->getValidateDisplay();

	if($this->isTypeYellowCard())
	{
	    $urlYellowCardImage = UrlConfiguration::getImageSrc("yellow_card.png", "application");

	    $output .= "<div class=''>";
	    $output .= $dateUtility->getFormattedOffsetAdjustedDate($this->getActionDate(), $offset);
	    $output .= " : ";
	    $output .= "<img class='en4' src='$urlYellowCardImage' alt='Yellow Card' title='Yellow Card' />";
	    $output .= "&nbsp;&nbsp;";
	    $output .= $this->getYellowCardPlayerName();
	    $output .= $validateDisplay;
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
	    $output .= $validateDisplay;
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
	    $output .= $validateDisplay;
	    $output .= "</div>";
	}
	elseif($this->isTypePlayerSubstitute())
	{
	    $urlPlayerSubstituteImage = UrlConfiguration::getImageSrc("substitute.png", "application");

	    $output .= "<div class=''>";
	    $output .= $dateUtility->getFormattedOffsetAdjustedDate($this->getActionDate(), $offset);
	    $output .= " : ";
	    $output .= "<img class='en4' src='$urlPlayerSubstituteImage' alt='Player is substituted' title='Player is substituted' />";
	    $output .= "&nbsp;&nbsp;";
	    $output .= $this->getPlayerSubstitutePlayerName();
	    $output .= $validateDisplay;
	    $output .= "</div>";
	}
	elseif($this->isTypeTeamAction())
	{
	    $output .= "<div class=''>";
	    $output .= $dateUtility->getFormattedOffsetAdjustedDate($this->getActionDate(), $offset);
	    $output .= " : ";
	    $output .= "Score set for match";
	    $output .= "</div>";
	}

	return $output;
    }

    protected function getValidateDisplay()
    {
	$output = "";

	$gameActionId = $this->getGameActionId();

	$validateActionContainer = "validate_act_con_".$gameActionId;

	if($this->isNotValidated())
	{
	    if(SessionHelper::isAdminValidator())
	    {
		$output .= "&nbsp;&nbsp;&nbsp;";
		$output .= "<span id='$validateActionContainer'>";
		$output .= AdminGameActionLineEntity::getValidateActionButton($gameActionId);
//		$output .= "<button class='btn btn-primary btn-xs' onclick=\"validateAdminGameAction('$gameActionId');\">Validate</button>";
		$output .= "</span>";
	    }
	}
	elseif($this->isValidated())
	{
	    if(SessionHelper::isAdminValidator())
	    {
		$output .= "&nbsp;&nbsp;&nbsp;";
		$output .= "<span id='$validateActionContainer'>";
		$output .= AdminGameActionLineEntity::getInvalidateActionButton($gameActionId);
//		$output .= "<button class='btn btn-danger btn-xs' onclick=\"invalidateAdminGameAction('$gameActionId');\">Invalidate</button>";
		$output .= "</span>";
	    }
	}

	return $output;
    }

    public static function getValidateActionButton($gameActionId)
    {
	$output = "";

	$output .= "<button class='btn btn-primary btn-xs' onclick=\"validateAdminGameAction('$gameActionId');\">Validate</button>";

	return $output;
    }

    public static function getInvalidateActionButton($gameActionId)
    {
	$output = "";

	$output .= "<button class='btn btn-danger btn-xs' onclick=\"invalidateAdminGameAction('$gameActionId');\">Invalidate</button>";

	return $output;
    }
}

