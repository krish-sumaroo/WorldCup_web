<?php

class GamesManager
{
    public static function addGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate)
    {
        $gamesValidator = new BaseGamesValidator();

        $error = $gamesValidator->validateAddGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate);

        if(!$error->errorExists())
        {
            GamesLogicUtility::addGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate);
        }

        return $error;
    }

    public static function editGames($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate)
    {
        $gamesValidator = new BaseGamesValidator();

        $error = $gamesValidator->validateEditGames($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate);

        if(!$error->errorExists())
        {
            GamesLogicUtility::updateGames($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF, $playerInfo, $matchDate);
        }

        return $error;
    }

    public static function deleteGames($id)
    {
        GamesLogicUtility::deleteGames($id);
    }
}

?>
