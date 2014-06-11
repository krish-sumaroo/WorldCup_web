<?php


class GameActionLogicUtility extends BaseGameActionLogicUtility
{

    public static function getNumberOfValidatedActionsBefore($actionAutomaticDate, $gameId)
    {
	$statusArray = array(AdminGameActionLogicUtility::$PROCESS_STATUS_NOT_STARTED, AdminGameActionLogicUtility::$PROCESS_STATUS_STARTED);

	$sqlConcatenator = new SqlConcatenator();
	$inPart = $sqlConcatenator->createSelectInQueryPart($statusArray, true,
		AdminGameActionLogicUtility::$PROCESS_STATUS_FIELD, AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addTable(AdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$GAME_ACTION_ID_FIELD);

	$queryBuilder->addAndConditionWithValue(GameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD, $actionAutomaticDate,
		QueryBuilder::$OPERATOR_LESS_THAN, GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(GameActionLogicUtility::$FK_GAME_ID_FIELD, $gameId,
		QueryBuilder::$OPERATOR_EQUAL, GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndQueryCondition(GameActionLogicUtility::$GAME_ACTION_ID_FIELD,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, QueryBuilder::$OPERATOR_EQUAL,
		GameActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndCondition($inPart);

	$result = $queryBuilder->executeQueryCount();

	return $result;
    }
}

?>
