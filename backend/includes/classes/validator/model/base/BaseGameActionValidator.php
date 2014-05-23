<?php


class BaseGameActionValidator extends Validator
{

    public function __construct()
    {
	$this->error = new Error();
    }

    public function validateAddGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate,
	    $actionType)
    {
	$this->validateLength($fkGameId, "Fk Game Id", BaseGameActionLogicUtility::$FK_GAME_ID_LIMIT);

	$this->validateLength($fkUserId, "Fk User Id", BaseGameActionLogicUtility::$FK_USER_ID_LIMIT);

	$this->validateLength($actionMinute, "Action Minute", BaseGameActionLogicUtility::$ACTION_MINUTE_LIMIT);


	return $this->error;
    }

    public function validateEditGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate,
	    $actionType)
    {
	$this->validateLength($fkGameId, "Fk Game Id", BaseGameActionLogicUtility::$FK_GAME_ID_LIMIT);

	$this->validateLength($fkUserId, "Fk User Id", BaseGameActionLogicUtility::$FK_USER_ID_LIMIT);

	$this->validateLength($actionMinute, "Action Minute", BaseGameActionLogicUtility::$ACTION_MINUTE_LIMIT);


	return $this->error;
    }
}

?>
