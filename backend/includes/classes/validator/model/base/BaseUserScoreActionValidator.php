<?php

class BaseUserScoreActionValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $this->validateLength($gameId, "GameId", BaseUserScoreActionLogicUtility::$GAMEID_LIMIT);

        $this->validateLength($team1Id, "Team1Id", BaseUserScoreActionLogicUtility::$TEAM1ID_LIMIT);

        $this->validateLength($team1Score, "Team1Score", BaseUserScoreActionLogicUtility::$TEAM1SCORE_LIMIT);

        $this->validateLength($team2Score, "Team2Score", BaseUserScoreActionLogicUtility::$TEAM2SCORE_LIMIT);

        $this->validateLength($team2Id, "Team2Id", BaseUserScoreActionLogicUtility::$TEAM2ID_LIMIT);

        $this->validateLength($userId, "UserId", BaseUserScoreActionLogicUtility::$USERID_LIMIT);

        $this->checkEmptyError($timestamp, "Timestamp");
        $this->validateLength($points, "Points", BaseUserScoreActionLogicUtility::$POINTS_LIMIT);

        $this->validateLength($status, "Status", BaseUserScoreActionLogicUtility::$STATUS_LIMIT);


        return $this->error;
    }

    public function validateEditUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $this->validateLength($gameId, "GameId", BaseUserScoreActionLogicUtility::$GAMEID_LIMIT);

        $this->validateLength($team1Id, "Team1Id", BaseUserScoreActionLogicUtility::$TEAM1ID_LIMIT);

        $this->validateLength($team1Score, "Team1Score", BaseUserScoreActionLogicUtility::$TEAM1SCORE_LIMIT);

        $this->validateLength($team2Score, "Team2Score", BaseUserScoreActionLogicUtility::$TEAM2SCORE_LIMIT);

        $this->validateLength($team2Id, "Team2Id", BaseUserScoreActionLogicUtility::$TEAM2ID_LIMIT);

        $this->validateLength($userId, "UserId", BaseUserScoreActionLogicUtility::$USERID_LIMIT);

        $this->checkEmptyError($timestamp, "Timestamp");
        $this->validateLength($points, "Points", BaseUserScoreActionLogicUtility::$POINTS_LIMIT);

        $this->validateLength($status, "Status", BaseUserScoreActionLogicUtility::$STATUS_LIMIT);


        return $this->error;
    }
}

?>
