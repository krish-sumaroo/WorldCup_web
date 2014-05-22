<?php

class BaseTeamsValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddTeams($name, $flag, $group)
    {
        $this->validateLength($name, "Name", BaseTeamsLogicUtility::$NAME_LIMIT);

        $this->validateLength($flag, "Flag", BaseTeamsLogicUtility::$FLAG_LIMIT);

        $this->validateLength($group, "Group", BaseTeamsLogicUtility::$GROUP_LIMIT);


        return $this->error;
    }

    public function validateEditTeams($name, $flag, $group)
    {
        $this->validateLength($name, "Name", BaseTeamsLogicUtility::$NAME_LIMIT);

        $this->validateLength($flag, "Flag", BaseTeamsLogicUtility::$FLAG_LIMIT);

        $this->validateLength($group, "Group", BaseTeamsLogicUtility::$GROUP_LIMIT);


        return $this->error;
    }
}

?>
