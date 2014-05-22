<?php

class BasePlayersValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddPlayers($teamId, $name, $position, $number)
    {
        $this->validateLength($teamId, "TeamId", BasePlayersLogicUtility::$TEAMID_LIMIT);

        $this->validateLength($name, "Name", BasePlayersLogicUtility::$NAME_LIMIT);

        $this->validateLength($position, "Position", BasePlayersLogicUtility::$POSITION_LIMIT);

        $this->validateLength($number, "Number", BasePlayersLogicUtility::$NUMBER_LIMIT);


        return $this->error;
    }

    public function validateEditPlayers($teamId, $name, $position, $number)
    {
        $this->validateLength($teamId, "TeamId", BasePlayersLogicUtility::$TEAMID_LIMIT);

        $this->validateLength($name, "Name", BasePlayersLogicUtility::$NAME_LIMIT);

        $this->validateLength($position, "Position", BasePlayersLogicUtility::$POSITION_LIMIT);

        $this->validateLength($number, "Number", BasePlayersLogicUtility::$NUMBER_LIMIT);


        return $this->error;
    }
}

?>
