<?php


class BaseGameplayersLogicUtility
{

    //table name
    public static $TABLE_NAME = "gameplayers";
    //fields list
    public static $GAMEID_FIELD = "gameId";
    public static $PLAYERID_FIELD = "playerId";
    public static $TEAMID_FIELD = "teamId";
    //fields values
    //fields limits
    public static $GAMEID_LIMIT = 11;
    public static $PLAYERID_LIMIT = 11;
    public static $TEAMID_LIMIT = 11;

    public static function addGameplayers($gameId, $playerId, $teamId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseGameplayersLogicUtility::$GAMEID_FIELD, $gameId);
	$queryBuilder->addUpdateField(BaseGameplayersLogicUtility::$PLAYERID_FIELD, $playerId);
	$queryBuilder->addUpdateField(BaseGameplayersLogicUtility::$TEAMID_FIELD, $teamId);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getGameplayersDetails()
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseGameplayersLogicUtility::addAllFields($queryBuilder);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseGameplayersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateGameplayers($gameId, $playerId, $teamId)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseGameplayersLogicUtility::$GAMEID_FIELD, $gameId);
	$queryBuilder->addUpdateField(BaseGameplayersLogicUtility::$PLAYERID_FIELD, $playerId);
	$queryBuilder->addUpdateField(BaseGameplayersLogicUtility::$TEAMID_FIELD, $teamId);


	return $queryBuilder->executeUpdateQuery();
    }

    public static function getGameplayersList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseGameplayersLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseGameplayersLogicUtility::convertToObjectArray($result);
    }

    public static function deleteGameplayers()
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);

	return $queryBuilder->executeDeleteQuery();
    }

//    protected static function getSpecificDetails(, $field)
//    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);
//        $queryBuilder->addField($field);
//
//        $result = $queryBuilder->executeQuery();
//
//        if(count($result) > 0)
//        {
//            return BaseGameplayersLogicUtility::convertToObject($result[0]);
//        }
//        else
//        {
//            return null;
//        }
//    }
//    public static function getGameId()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseGameplayersLogicUtility::$GAMEID_FIELD);
//    }
//
//    public static function getPlayerId()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseGameplayersLogicUtility::$PLAYERID_FIELD);
//    }
//
//    public static function getTeamId()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseGameplayersLogicUtility::$TEAMID_FIELD);
//    }
//    protected static function updateSpecificField(, $field, $value)
//    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->addTable(BaseGameplayersLogicUtility::$TABLE_NAME);
//        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
//
//        $result = $queryBuilder->executeUpdateQuery();
//    }
//
//    public static function updateGameId(, $value)
//    {
//        BaseGameplayersLogicUtility::updateSpecificField(, $value, BaseGameplayersLogicUtility::$GAMEID_FIELD, $value);
//    }
//
//    public static function updatePlayerId(, $value)
//    {
//        BaseGameplayersLogicUtility::updateSpecificField(, $value, BaseGameplayersLogicUtility::$PLAYERID_FIELD, $value);
//    }
//
//    public static function updateTeamId(, $value)
//    {
//        BaseGameplayersLogicUtility::updateSpecificField(, $value, BaseGameplayersLogicUtility::$TEAMID_FIELD, $value);
//    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseGameplayersLogicUtility::$GAMEID_FIELD);
	$queryBuilder->addFields(BaseGameplayersLogicUtility::$PLAYERID_FIELD);
	$queryBuilder->addFields(BaseGameplayersLogicUtility::$TEAMID_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseGameplayersLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$gameId = QueryBuilder::getQueryValue($resultDetails, BaseGameplayersLogicUtility::$GAMEID_FIELD);
	$playerId = QueryBuilder::getQueryValue($resultDetails, BaseGameplayersLogicUtility::$PLAYERID_FIELD);
	$teamId = QueryBuilder::getQueryValue($resultDetails, BaseGameplayersLogicUtility::$TEAMID_FIELD);

	return new GameplayersEntity($gameId, $playerId, $teamId, $resultDetails);
    }
}

?>
