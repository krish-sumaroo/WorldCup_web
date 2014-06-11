<?php


class UserScoreActionLogicUtility extends BaseUserScoreActionLogicUtility
{

    public static function updateSuccess($dateCheck, $gameId, $scoreTeam1, $scoreTeam2)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder = UserScoreActionLogicUtility::prepareQueryForStatusUpdate($dateCheck, $gameId, $scoreTeam1, $scoreTeam2,
			$queryBuilder);

	$queryBuilder->addUpdateField(UserScoreActionLogicUtility::$STATUS_FIELD, UserScoreActionLogicUtility::$STATUS_SUCCESS);

	$queryBuilder->executeUpdateQuery();
    }

    public static function updateFailure($dateCheck, $gameId, $scoreTeam1, $scoreTeam2)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder = UserScoreActionLogicUtility::prepareQueryForStatusUpdate($dateCheck, $gameId, $scoreTeam1, $scoreTeam2,
			$queryBuilder);

	$queryBuilder->addUpdateField(UserScoreActionLogicUtility::$STATUS_FIELD, UserScoreActionLogicUtility::$STATUS_FAILED);

	$queryBuilder->executeUpdateQuery();
    }

    private static function prepareQueryForStatusUpdate($dateCheck, $gameId, $scoreTeam1, $scoreTeam2,
	    QueryBuilder $queryBuilder)
    {
	$queryBuilder->addTable(UserScoreActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(UserScoreActionLogicUtility::$TIMESTAMP_FIELD, $dateCheck,
		QueryBuilder::$OPERATOR_LESS_THAN, UserScoreActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(UserScoreActionLogicUtility::$STATUS_FIELD,
		UserScoreActionLogicUtility::$STATUS_INITIAL, QueryBuilder::$OPERATOR_EQUAL, UserScoreActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(UserScoreActionLogicUtility::$GAMEID_FIELD, $gameId,
		QueryBuilder::$OPERATOR_EQUAL, UserScoreActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(UserScoreActionLogicUtility::$TEAM1SCORE_FIELD, $scoreTeam1,
		QueryBuilder::$OPERATOR_EQUAL, UserScoreActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(UserScoreActionLogicUtility::$TEAM2SCORE_FIELD, $scoreTeam2,
		QueryBuilder::$OPERATOR_EQUAL, UserScoreActionLogicUtility::$TABLE_NAME);

	return $queryBuilder;
    }
}

?>
