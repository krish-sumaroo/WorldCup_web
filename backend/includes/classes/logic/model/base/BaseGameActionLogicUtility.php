<?php

class BaseGameActionLogicUtility
{
    //table name
    public static $TABLE_NAME = "game_action";
    //fields list
    public static $GAME_ACTION_ID_FIELD = "game_action_id";
    public static $FK_GAME_ID_FIELD = "fk_game_id";
    public static $FK_USER_ID_FIELD = "fk_user_id";
    public static $ACTION_MINUTE_FIELD = "action_minute";
    public static $ACTION_DATE_FIELD = "action_date";
    public static $ACTION_AUTOMATIC_DATE_FIELD = "action_automatic_date";
    public static $ACTION_TYPE_FIELD = "action_type";
    //fields values
    //fields values for action_type
    public static $ACTION_TYPE_RED_CARD = "red_card";
    public static $ACTION_TYPE_YELLOW_CARD = "yellow_card";
    public static $ACTION_TYPE_PLAYER_SCORE = "player_score";
    public static $ACTION_TYPE_TEAM_ACTION = "team_action";
    //fields limits
    public static $GAME_ACTION_ID_LIMIT = 11;
    public static $FK_GAME_ID_LIMIT = 11;
    public static $FK_USER_ID_LIMIT = 11;
    public static $ACTION_MINUTE_LIMIT = 11;

    public static function addGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$FK_GAME_ID_FIELD, $fkGameId);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_MINUTE_FIELD, $actionMinute);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_DATE_FIELD, $actionDate);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD, $actionAutomaticDate);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_TYPE_FIELD, $actionType);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getGameActionDetails($gameActionId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseGameActionLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD, $gameActionId);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseGameActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateGameAction($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$FK_GAME_ID_FIELD, $fkGameId);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_MINUTE_FIELD, $actionMinute);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_DATE_FIELD, $actionDate);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD, $actionAutomaticDate);
        $queryBuilder->addUpdateField(BaseGameActionLogicUtility::$ACTION_TYPE_FIELD, $actionType);

        $queryBuilder->addAndConditionWithValue(BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD, $gameActionId);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getGameActionList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseGameActionLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseGameActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteGameAction($gameActionId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD, $gameActionId);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($gameActionId, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD, $gameActionId);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseGameActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getGameActionId($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD);
    }

    public static function getFkGameId($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$FK_GAME_ID_FIELD);
    }

    public static function getFkUserId($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$FK_USER_ID_FIELD);
    }

    public static function getActionMinute($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$ACTION_MINUTE_FIELD);
    }

    public static function getActionDate($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$ACTION_DATE_FIELD);
    }

    public static function getActionAutomaticDate($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD);
    }

    public static function getActionType($gameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($gameActionId, BaseGameActionLogicUtility::$ACTION_TYPE_FIELD);
    }


    protected static function updateSpecificField($gameActionId, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD, $gameActionId);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateFkGameId($gameActionId, $value)
    {
        BaseGameActionLogicUtility::updateSpecificField($gameActionId, $value, BaseGameActionLogicUtility::$FK_GAME_ID_FIELD, $value);
    }

    public static function updateFkUserId($gameActionId, $value)
    {
        BaseGameActionLogicUtility::updateSpecificField($gameActionId, $value, BaseGameActionLogicUtility::$FK_USER_ID_FIELD, $value);
    }

    public static function updateActionMinute($gameActionId, $value)
    {
        BaseGameActionLogicUtility::updateSpecificField($gameActionId, $value, BaseGameActionLogicUtility::$ACTION_MINUTE_FIELD, $value);
    }

    public static function updateActionDate($gameActionId, $value)
    {
        BaseGameActionLogicUtility::updateSpecificField($gameActionId, $value, BaseGameActionLogicUtility::$ACTION_DATE_FIELD, $value);
    }

    public static function updateActionAutomaticDate($gameActionId, $value)
    {
        BaseGameActionLogicUtility::updateSpecificField($gameActionId, $value, BaseGameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD, $value);
    }

    public static function updateActionType($gameActionId, $value)
    {
        BaseGameActionLogicUtility::updateSpecificField($gameActionId, $value, BaseGameActionLogicUtility::$ACTION_TYPE_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD);
        $queryBuilder->addFields(BaseGameActionLogicUtility::$FK_GAME_ID_FIELD);
        $queryBuilder->addFields(BaseGameActionLogicUtility::$FK_USER_ID_FIELD);
        $queryBuilder->addFields(BaseGameActionLogicUtility::$ACTION_MINUTE_FIELD);
        $queryBuilder->addFields(BaseGameActionLogicUtility::$ACTION_DATE_FIELD);
        $queryBuilder->addFields(BaseGameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD);
        $queryBuilder->addFields(BaseGameActionLogicUtility::$ACTION_TYPE_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseGameActionLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $gameActionId = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$GAME_ACTION_ID_FIELD);
        $fkGameId = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$FK_GAME_ID_FIELD);
        $fkUserId = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$FK_USER_ID_FIELD);
        $actionMinute = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$ACTION_MINUTE_FIELD);
        $actionDate = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$ACTION_DATE_FIELD);
        $actionAutomaticDate = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$ACTION_AUTOMATIC_DATE_FIELD);
        $actionType = QueryBuilder::getQueryValue($resultDetails, BaseGameActionLogicUtility::$ACTION_TYPE_FIELD);

        return new GameActionEntity($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType, $resultDetails);
    }
}

?>
