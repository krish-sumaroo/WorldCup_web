<?php

class BaseGamesValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate)
    {
        $this->checkEmptyError($stage, "Stage");
        $this->validateLength($stage, "Stage", BaseGamesLogicUtility::$STAGE_LIMIT);

        $this->validateLength($team1, "Team1", BaseGamesLogicUtility::$TEAM1_LIMIT);

        $this->validateLength($team2, "Team2", BaseGamesLogicUtility::$TEAM2_LIMIT);

        $this->validateLength($venue, "Venue", BaseGamesLogicUtility::$VENUE_LIMIT);

        $this->validateLength($t1Score, "T1Score", BaseGamesLogicUtility::$T1SCORE_LIMIT);

        $this->validateLength($t2Score, "T2Score", BaseGamesLogicUtility::$T2SCORE_LIMIT);

        $this->validateLength($extraScore, "ExtraScore", BaseGamesLogicUtility::$EXTRASCORE_LIMIT);

        $this->validateLength($startedF, "StartedF", BaseGamesLogicUtility::$STARTEDF_LIMIT);

        $this->checkEmptyError($playerInfo, "PlayerInfo");
        $this->validateLength($playerInfo, "PlayerInfo", BaseGamesLogicUtility::$PLAYERINFO_LIMIT);

        $this->checkEmptyError($matchDate, "MatchDate");

        return $this->error;
    }

    public function validateEditGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate)
    {
        $this->checkEmptyError($stage, "Stage");
        $this->validateLength($stage, "Stage", BaseGamesLogicUtility::$STAGE_LIMIT);

        $this->validateLength($team1, "Team1", BaseGamesLogicUtility::$TEAM1_LIMIT);

        $this->validateLength($team2, "Team2", BaseGamesLogicUtility::$TEAM2_LIMIT);

        $this->validateLength($venue, "Venue", BaseGamesLogicUtility::$VENUE_LIMIT);

        $this->validateLength($t1Score, "T1Score", BaseGamesLogicUtility::$T1SCORE_LIMIT);

        $this->validateLength($t2Score, "T2Score", BaseGamesLogicUtility::$T2SCORE_LIMIT);

        $this->validateLength($extraScore, "ExtraScore", BaseGamesLogicUtility::$EXTRASCORE_LIMIT);

        $this->validateLength($startedF, "StartedF", BaseGamesLogicUtility::$STARTEDF_LIMIT);

        $this->checkEmptyError($playerInfo, "PlayerInfo");
        $this->validateLength($playerInfo, "PlayerInfo", BaseGamesLogicUtility::$PLAYERINFO_LIMIT);

        $this->checkEmptyError($matchDate, "MatchDate");

        return $this->error;
    }
}

?>
