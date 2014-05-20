<?php

class TeamsManager
{
    public static function addTeams($name, $flag, $group)
    {
        $teamsValidator = new BaseTeamsValidator();

        $error = $teamsValidator->validateAddTeams($name, $flag, $group);

        if(!$error->errorExists())
        {
            TeamsLogicUtility::addTeams($name, $flag, $group);
        }

        return $error;
    }

    public static function editTeams($id, $name, $flag, $group)
    {
        $teamsValidator = new BaseTeamsValidator();

        $error = $teamsValidator->validateEditTeams($id, $name, $flag, $group);

        if(!$error->errorExists())
        {
            TeamsLogicUtility::updateTeams($id, $name, $flag, $group);
        }

        return $error;
    }

    public static function deleteTeams($id)
    {
        TeamsLogicUtility::deleteTeams($id);
    }
}

?>
