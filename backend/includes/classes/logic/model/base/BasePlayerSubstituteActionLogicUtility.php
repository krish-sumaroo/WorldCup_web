<?php

class BasePlayerSubstituteActionLogicUtility
{
    //table name
    public static $TABLE_NAME = "player_substitute_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $FK_PLAYER_ID_FIELD = "fk_player_id";
    //fields values
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_PLAYER_ID_LIMIT = 11;

    public static function addPlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addUpdateField(BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getPlayerSubstituteActionDetails($fkGameActionId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BasePlayerSubstituteActionLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BasePlayerSubstituteActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updatePlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addUpdateField(BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

        $queryBuilder->addAndConditionWithValue(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getPlayerSubstituteActionList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BasePlayerSubstituteActionLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BasePlayerSubstituteActionLogicUtility::convertToObjectArray($result);
    }

    public static function deletePlayerSubstituteAction($fkGameActionId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BasePlayerSubstituteActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getFkGameActionId($fkGameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    public static function getFkPlayerId($fkGameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD);
    }


    protected static function updateSpecificField($fkGameActionId, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BasePlayerSubstituteActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateFkPlayerId($fkGameActionId, $value)
    {
        BasePlayerSubstituteActionLogicUtility::updateSpecificField($fkGameActionId, $value, BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
        $queryBuilder->addFields(BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BasePlayerSubstituteActionLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $fkGameActionId = QueryBuilder::getQueryValue($resultDetails, BasePlayerSubstituteActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
        $fkPlayerId = QueryBuilder::getQueryValue($resultDetails, BasePlayerSubstituteActionLogicUtility::$FK_PLAYER_ID_FIELD);

        return new PlayerSubstituteActionEntity($fkGameActionId, $fkPlayerId, $resultDetails);
    }
}

?>
