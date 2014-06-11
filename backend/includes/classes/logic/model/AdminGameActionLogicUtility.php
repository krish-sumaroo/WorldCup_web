<?php


class AdminGameActionLogicUtility extends BaseAdminGameActionLogicUtility
{

    public static $PLAYER_ID_RED_CARD_ALIAS = "player_id_red_card";
    public static $PLAYER_ID_YELLOW_CARD_ALIAS = "player_id_yellow_card";
    public static $PLAYER_ID_PLAYER_SCORE_ALIAS = "player_id_player_score";
    public static $PLAYER_ID_PLAYER_SUBSTITUTE_ALIAS = "player_id_player_substitute";

    public static function validateAdminGameAction($adminGameActionId)
    {
	AdminGameActionLogicUtility::updateActionStatus($adminGameActionId, AdminGameActionLogicUtility::$STATUS_VALIDATED);
    }

    public static function invalidateAdminGameAction($adminGameActionId)
    {
	AdminGameActionLogicUtility::updateActionStatus($adminGameActionId, AdminGameActionLogicUtility::$STATUS_NOT_VALIDATED);
    }

    private static function updateActionStatus($adminGameActionId, $actionStatus)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(AdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(AdminGameActionLogicUtility::$ACTION_STATUS_FIELD, $actionStatus);
	$queryBuilder->addAndConditionWithValue(AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $adminGameActionId,
		QueryBuilder::$OPERATOR_EQUAL, AdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->executeUpdateQuery();
    }

    public static function getGameActionList($gameId, SortQuery $sortQuery = null)
    {
	$queryBuilderAndCondition = new QueryBuilder();
	$queryBuilderAndCondition->addAndConditionWithValue(GameActionLogicUtility::$FK_GAME_ID_FIELD, $gameId,
		QueryBuilder::$OPERATOR_EQUAL, GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addFields(AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		AdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(AdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD, AdminGameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(AdminGameActionLogicUtility::$ACTION_STATUS_FIELD, AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addFields(GameActionLogicUtility::$GAME_ACTION_ID_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$FK_GAME_ID_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$ACTION_MINUTE_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$ACTION_DATE_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$ACTION_TYPE_FIELD, GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addFields(RedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, RedCardActionLogicUtility::$TABLE_NAME,
		false, "fk_game_action_id_red_card");
	$queryBuilder->addFields(RedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, RedCardActionLogicUtility::$TABLE_NAME, false,
		"fk_player_id_red_card");

	$queryBuilder->addFields(YellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		YellowCardActionLogicUtility::$TABLE_NAME, false, "fk_game_action_id_yellow_card");
	$queryBuilder->addFields(YellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD, YellowCardActionLogicUtility::$TABLE_NAME,
		false, "fk_player_id_yellow_card");

	$queryBuilder->addFields(PlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		PlayerScoreActionLogicUtility::$TABLE_NAME, false, "fk_game_action_id_player_score");
	$queryBuilder->addFields(PlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD,
		PlayerScoreActionLogicUtility::$TABLE_NAME, false, "fk_player_id_player_score");

	$queryBuilder->addFields(PlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		PlayerSubstituteActionLogicUtility::$TABLE_NAME, false, "fk_game_action_id_player_substitute");
	$queryBuilder->addFields(PlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD,
		PlayerSubstituteActionLogicUtility::$TABLE_NAME, false, "fk_player_id_player_substitute");

	$queryBuilder->addFields(PlayersLogicUtility::$NAME_FIELD, "red_card_player", false, "red_card_player_name");
	$queryBuilder->addFields(PlayersLogicUtility::$NAME_FIELD, "yellow_card_player", false, "yellow_card_player_name");
	$queryBuilder->addFields(PlayersLogicUtility::$NAME_FIELD, "player_score", false, "player_score_player_name");
	$queryBuilder->addFields(PlayersLogicUtility::$NAME_FIELD, "player_substitute", false, "player_substitute_player_name");

	$queryBuilder->addJoin(GameActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, GameActionLogicUtility::$TABLE_NAME,
		GameActionLogicUtility::$GAME_ACTION_ID_FIELD, $queryBuilderAndCondition->getAndConditionArray());
	$queryBuilder->addLeftJoin(RedCardActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, RedCardActionLogicUtility::$TABLE_NAME,
		RedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$queryBuilder->addLeftJoin(YellowCardActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, YellowCardActionLogicUtility::$TABLE_NAME,
		YellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$queryBuilder->addLeftJoin(PlayerScoreActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, PlayerScoreActionLogicUtility::$TABLE_NAME,
		PlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
	$queryBuilder->addLeftJoin(PlayerSubstituteActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, PlayerSubstituteActionLogicUtility::$TABLE_NAME,
		PlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);

	$queryBuilder->addLeftJoin(PlayersLogicUtility::$TABLE_NAME, RedCardActionLogicUtility::$TABLE_NAME,
		RedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, PlayersLogicUtility::$TABLE_NAME, PlayersLogicUtility::$ID_FIELD,
		"red_card_player");
	$queryBuilder->addLeftJoin(PlayersLogicUtility::$TABLE_NAME, YellowCardActionLogicUtility::$TABLE_NAME,
		YellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD, PlayersLogicUtility::$TABLE_NAME, PlayersLogicUtility::$ID_FIELD,
		"yellow_card_player");
	$queryBuilder->addLeftJoin(PlayersLogicUtility::$TABLE_NAME, PlayerScoreActionLogicUtility::$TABLE_NAME,
		PlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD, PlayersLogicUtility::$TABLE_NAME, PlayersLogicUtility::$ID_FIELD,
		"player_score");
	$queryBuilder->addLeftJoin(PlayersLogicUtility::$TABLE_NAME, PlayerSubstituteActionLogicUtility::$TABLE_NAME,
		PlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD, PlayersLogicUtility::$TABLE_NAME,
		PlayersLogicUtility::$ID_FIELD, "player_substitute");

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return AdminGameActionLogicUtility::convertToAdminGameActionLineEntityArray($result);
    }

    public static function getValidatedGameAction($dateBefore, $limit = "", $processStatus = "",
	    SortQuery $sortQuery = null, $actionType = "", $gameActionId = "")
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addFields(AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD,
		AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addFields(GameActionLogicUtility::$ACTION_TYPE_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$FK_GAME_ID_FIELD, GameActionLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(GameActionLogicUtility::$ACTION_DATE_FIELD, GameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addFields(RedCardActionLogicUtility::$FK_PLAYER_ID_FIELD, RedCardActionLogicUtility::$TABLE_NAME, false,
		AdminGameActionLogicUtility::$PLAYER_ID_RED_CARD_ALIAS);
	$queryBuilder->addFields(YellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD, YellowCardActionLogicUtility::$TABLE_NAME,
		false, AdminGameActionLogicUtility::$PLAYER_ID_YELLOW_CARD_ALIAS);
	$queryBuilder->addFields(PlayerScoreActionLogicUtility::$FK_PLAYER_ID_FIELD,
		PlayerScoreActionLogicUtility::$TABLE_NAME, false, AdminGameActionLogicUtility::$PLAYER_ID_PLAYER_SCORE_ALIAS);
	$queryBuilder->addFields(PlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD,
		PlayerSubstituteActionLogicUtility::$TABLE_NAME, false,
		AdminGameActionLogicUtility::$PLAYER_ID_PLAYER_SUBSTITUTE_ALIAS);

	$queryBuilder->addJoin(GameActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, GameActionLogicUtility::$TABLE_NAME,
		GameActionLogicUtility::$GAME_ACTION_ID_FIELD);

	$queryBuilder->addLeftJoin(RedCardActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, RedCardActionLogicUtility::$TABLE_NAME,
		RedCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);

	$queryBuilder->addLeftJoin(YellowCardActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, YellowCardActionLogicUtility::$TABLE_NAME,
		YellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);

	$queryBuilder->addLeftJoin(PlayerScoreActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, PlayerScoreActionLogicUtility::$TABLE_NAME,
		PlayerScoreActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);

	$queryBuilder->addLeftJoin(PlayerSubstituteActionLogicUtility::$TABLE_NAME, AdminGameActionLogicUtility::$TABLE_NAME,
		AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, PlayerSubstituteActionLogicUtility::$TABLE_NAME,
		PlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);

	$queryBuilder->addAndConditionWithValue(AdminGameActionLogicUtility::$ACTION_STATUS_FIELD,
		AdminGameActionLogicUtility::$STATUS_VALIDATED, QueryBuilder::$OPERATOR_EQUAL,
		AdminGameActionLogicUtility::$TABLE_NAME);

	$queryBuilder->addAndConditionWithValue(GameActionLogicUtility::$ACTION_DATE_FIELD, $dateBefore,
		QueryBuilder::$OPERATOR_LESS_THAN, GameActionLogicUtility::$TABLE_NAME);

	if($processStatus != "")
	{
	    $queryBuilder->addAndConditionWithValue(AdminGameActionLogicUtility::$PROCESS_STATUS_FIELD, $processStatus,
		    QueryBuilder::$OPERATOR_EQUAL, AdminGameActionLogicUtility::$TABLE_NAME);
	}

	if($limit != "")
	{
	    $queryBuilder->setLimit($limit);
	}

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	if($actionType != "")
	{
	    $queryBuilder->addAndConditionWithValue(GameActionLogicUtility::$ACTION_TYPE_FIELD, $actionType,
		    QueryBuilder::$OPERATOR_EQUAL, GameActionLogicUtility::$TABLE_NAME);
	}

	if($gameActionId != "")
	{
	    $queryBuilder->addAndConditionWithValue(AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $gameActionId,
		    QueryBuilder::$OPERATOR_EQUAL, AdminGameActionLogicUtility::$TABLE_NAME);
	}

	$result = $queryBuilder->executeQuery();

	return AdminGameActionLogicUtility::convertToObjectArray($result);
    }

    public static function updateIdArrayToStarted($idArray)
    {
	AdminGameActionLogicUtility::updateIdArrayToStatus($idArray, AdminGameActionLogicUtility::$PROCESS_STATUS_STARTED);
    }

    public static function updateIdArrayToFinished($idArray)
    {
	AdminGameActionLogicUtility::updateIdArrayToStatus($idArray, AdminGameActionLogicUtility::$PROCESS_STATUS_FINISHED);
    }

    private static function updateIdArrayToStatus($idArray, $status)
    {
	if(!ArrayUtility::isArrayEmpty($idArray))
	{
	    $sqlConcatenator = new SqlConcatenator();

	    $queryBuilder = new QueryBuilder();
	    $queryBuilder->addTable(AdminGameActionLogicUtility::$TABLE_NAME);
	    $queryBuilder->addAndCondition($sqlConcatenator->createSelectInQueryPart($idArray, false,
			    AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD));

	    $queryBuilder->addUpdateField(AdminGameActionLogicUtility::$PROCESS_STATUS_FIELD, $status);

	    $queryBuilder->executeUpdateQuery();
	}
    }

    private static function convertToAdminGameActionLineEntityArray($result)
    {
	$array = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $array[$i] = AdminGameActionLogicUtility::convertToAdminGameActionLineEntity($result[$i]);
	}

	return $array;
    }

    private static function convertToAdminGameActionLineEntity($resultDetails)
    {
	$gameActionId = $resultDetails[AdminGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD];
	$adminId = $resultDetails[AdminGameActionLogicUtility::$FK_ADMIN_ID_FIELD];
	$actionStatus = $resultDetails[AdminGameActionLogicUtility::$ACTION_STATUS_FIELD];
	$gameId = $resultDetails[GameActionLogicUtility::$GAME_ACTION_ID_FIELD];
	$actionMinute = $resultDetails[GameActionLogicUtility::$ACTION_MINUTE_FIELD];
	$actionDate = $resultDetails[GameActionLogicUtility::$ACTION_DATE_FIELD];
	$actionAutomaticDate = $resultDetails[GameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD];
	$actionType = $resultDetails[GameActionLogicUtility::$ACTION_TYPE_FIELD];
	$redCardGameActionId = $resultDetails['fk_game_action_id_red_card'];
	$redCardPlayerId = $resultDetails['fk_player_id_red_card'];
	$yellowCardGameActionId = $resultDetails['fk_game_action_id_yellow_card'];
	$yellowCardPlayerId = $resultDetails['fk_player_id_yellow_card'];
	$playerScoreGameActionId = $resultDetails['fk_game_action_id_player_score'];
	$playerScorePlayerId = $resultDetails['fk_player_id_player_score'];
	$redCardPlayerName = $resultDetails['red_card_player_name'];
	$yellowCardPlayerName = $resultDetails['yellow_card_player_name'];
	$playerScorePlayerName = $resultDetails['player_score_player_name'];
	$playerSubstitutePlayerName = $resultDetails['player_substitute_player_name'];

	return new AdminGameActionLineEntity($gameActionId, $adminId, $actionStatus, $gameId, $actionMinute, $actionDate,
		$actionAutomaticDate, $actionType, $redCardGameActionId, $redCardPlayerId, $yellowCardGameActionId,
		$yellowCardPlayerId, $playerScoreGameActionId, $playerScorePlayerId, $redCardPlayerName, $yellowCardPlayerName,
		$playerScorePlayerName, $playerSubstitutePlayerName, $resultDetails);
    }
}

?>
