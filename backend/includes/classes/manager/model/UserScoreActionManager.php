<?php

class UserScoreActionManager
{
    public static function addUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $userScoreActionValidator = new BaseUserScoreActionValidator();

        $error = $userScoreActionValidator->validateAddUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status);

        if(!$error->errorExists())
        {
            UserScoreActionLogicUtility::addUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status);
        }

        return $error;
    }

    public static function editUserScoreAction($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $userScoreActionValidator = new BaseUserScoreActionValidator();

        $error = $userScoreActionValidator->validateEditUserScoreAction($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status);

        if(!$error->errorExists())
        {
            UserScoreActionLogicUtility::updateUserScoreAction($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status);
        }

        return $error;
    }

    public static function deleteUserScoreAction($id)
    {
        UserScoreActionLogicUtility::deleteUserScoreAction($id);
    }
}

?>
