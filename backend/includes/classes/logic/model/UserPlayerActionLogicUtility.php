<?php


class UserPlayerActionLogicUtility extends BaseUserPlayerActionLogicUtility
{

    public static function updateSuccess($playerId, $actionId, $dateCheck, $gameId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder = UserPlayerActionLogicUtility::prepareQueryForStatusUpdate($playerId, $actionId, $dateCheck, $gameId,
			$queryBuilder);

	$queryBuilder->addAndConditionWithValue(UserPlayerActionLogicUtility::$PLAYERID_FIELD, $playerId,
		QueryBuilder::$OPERATOR_EQUAL, UserPlayerActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addUpdateField(UserPlayerActionLogicUtility::$STATUS_FIELD,
		UserPlayerActionLogicUtility::$STATUS_SUCCESS);

	$queryBuilder->debugUpdate(); //debug

	$queryBuilder->executeUpdateQuery();
    }

    public static function updateFailure($playerId, $actionId, $dateCheck, $gameId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder = UserPlayerActionLogicUtility::prepareQueryForStatusUpdate($playerId, $actionId, $dateCheck, $gameId,
			$queryBuilder);

	$queryBuilder->addAndConditionWithValue(UserPlayerActionLogicUtility::$PLAYERID_FIELD, $playerId,
		QueryBuilder::$OPERATOR_NOT_EQUAL, UserPlayerActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addUpdateField(UserPlayerActionLogicUtility::$STATUS_FIELD, UserPlayerActionLogicUtility::$STATUS_FAILED);

	$queryBuilder->debugUpdate(); //debug

	$queryBuilder->executeUpdateQuery();
    }

    private static function prepareQueryForStatusUpdate($playerId, $actionId, $dateCheck, $gameId,
	    QueryBuilder $queryBuilder)
    {
	$queryBuilder->addTable(UserPlayerActionLogicUtility::$TABLE_NAME);


	$queryBuilder->addAndConditionWithValue(UserPlayerActionLogicUtility::$ACTIONID_FIELD, $actionId,
		QueryBuilder::$OPERATOR_EQUAL, UserPlayerActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(UserPlayerActionLogicUtility::$TIMESTAMP_FIELD, $dateCheck,
		QueryBuilder::$OPERATOR_LESS_THAN, UserPlayerActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(UserPlayerActionLogicUtility::$STATUS_FIELD,
		UserPlayerActionLogicUtility::$STATUS_INITIAL, QueryBuilder::$OPERATOR_EQUAL,
		UserPlayerActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(UserPlayerActionLogicUtility::$GAMEID_FIELD, $gameId,
		QueryBuilder::$OPERATOR_EQUAL, UserPlayerActionLogicUtility::$TABLE_NAME);

	return $queryBuilder;
    }
}

?>
