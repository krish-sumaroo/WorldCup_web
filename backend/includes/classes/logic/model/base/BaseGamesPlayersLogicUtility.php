<?php

class BaseGamesPlayersLogicUtility
{
    //table name
    public static $TABLE_NAME = "gamesPlayers";
    //fields list
    public static $ID_FIELD = "id";
    public static $GAMEID_FIELD = "gameId";
    public static $PLAYERID_FIELD = "playerId";
    public static $TEAMID_FIELD = "teamId";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $GAMEID_LIMIT = 11;
    public static $PLAYERID_LIMIT = 11;
    public static $TEAMID_LIMIT = 11;

    public static function addGamesPlayers($gameId, $playerId, $teamId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseGamesPlayersLogicUtility::$GAMEID_FIELD, $gameId);
        $queryBuilder->addUpdateField(BaseGamesPlayersLogicUtility::$PLAYERID_FIELD, $playerId);
        $queryBuilder->addUpdateField(BaseGamesPlayersLogicUtility::$TEAMID_FIELD, $teamId);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getGamesPlayersDetails($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseGamesPlayersLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseGamesPlayersLogicUtility::$ID_FIELD, $id);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseGamesPlayersLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateGamesPlayers($id, $gameId, $playerId, $teamId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseGamesPlayersLogicUtility::$GAMEID_FIELD, $gameId);
        $queryBuilder->addUpdateField(BaseGamesPlayersLogicUtility::$PLAYERID_FIELD, $playerId);
        $queryBuilder->addUpdateField(BaseGamesPlayersLogicUtility::$TEAMID_FIELD, $teamId);

        $queryBuilder->addAndConditionWithValue(BaseGamesPlayersLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getGamesPlayersList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseGamesPlayersLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseGamesPlayersLogicUtility::convertToObjectArray($result);
    }

    public static function deleteGamesPlayers($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseGamesPlayersLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseGamesPlayersLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseGamesPlayersLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesPlayersLogicUtility::$ID_FIELD);
    }

    public static function getGameId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesPlayersLogicUtility::$GAMEID_FIELD);
    }

    public static function getPlayerId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesPlayersLogicUtility::$PLAYERID_FIELD);
    }

    public static function getTeamId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesPlayersLogicUtility::$TEAMID_FIELD);
    }


    protected static function updateSpecificField($id, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGamesPlayersLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseGamesPlayersLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateGameId($id, $value)
    {
        BaseGamesPlayersLogicUtility::updateSpecificField($id, $value, BaseGamesPlayersLogicUtility::$GAMEID_FIELD, $value);
    }

    public static function updatePlayerId($id, $value)
    {
        BaseGamesPlayersLogicUtility::updateSpecificField($id, $value, BaseGamesPlayersLogicUtility::$PLAYERID_FIELD, $value);
    }

    public static function updateTeamId($id, $value)
    {
        BaseGamesPlayersLogicUtility::updateSpecificField($id, $value, BaseGamesPlayersLogicUtility::$TEAMID_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseGamesPlayersLogicUtility::$ID_FIELD);
        $queryBuilder->addFields(BaseGamesPlayersLogicUtility::$GAMEID_FIELD);
        $queryBuilder->addFields(BaseGamesPlayersLogicUtility::$PLAYERID_FIELD);
        $queryBuilder->addFields(BaseGamesPlayersLogicUtility::$TEAMID_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseGamesPlayersLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $id = QueryBuilder::getQueryValue($resultDetails, BaseGamesPlayersLogicUtility::$ID_FIELD);
        $gameId = QueryBuilder::getQueryValue($resultDetails, BaseGamesPlayersLogicUtility::$GAMEID_FIELD);
        $playerId = QueryBuilder::getQueryValue($resultDetails, BaseGamesPlayersLogicUtility::$PLAYERID_FIELD);
        $teamId = QueryBuilder::getQueryValue($resultDetails, BaseGamesPlayersLogicUtility::$TEAMID_FIELD);

        return new GamesPlayersEntity($id, $gameId, $playerId, $teamId, $resultDetails);
    }
}

?>
