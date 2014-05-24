<?php

class BaseUserGameActionLogicUtility
{
    //table name
    public static $TABLE_NAME = "user_game_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $FK_USER_ID_FIELD = "fk_user_id";
    //fields values
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_USER_ID_LIMIT = 11;

    public static function addUserGameAction($fkGameActionId, $fkUserId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addUpdateField(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getUserGameActionDetails($fkGameActionId, $fkUserId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseUserGameActionLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseUserGameActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateUserGameAction($fkGameActionId, $fkUserId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addUpdateField(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);

        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getUserGameActionList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseUserGameActionLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseUserGameActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteUserGameAction($fkGameActionId, $fkUserId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $fkUserId, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseUserGameActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getFkGameActionId($fkGameActionId, $fkUserId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, $fkUserId, BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    public static function getFkUserId($fkGameActionId, $fkUserId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, $fkUserId, BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD);
    }


    protected static function updateSpecificField($fkGameActionId, $fkUserId, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserGameActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addAndConditionWithValue(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD, $fkUserId);

        $result = $queryBuilder->executeUpdateQuery();
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
        $queryBuilder->addFields(BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseUserGameActionLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $fkGameActionId = QueryBuilder::getQueryValue($resultDetails, BaseUserGameActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
        $fkUserId = QueryBuilder::getQueryValue($resultDetails, BaseUserGameActionLogicUtility::$FK_USER_ID_FIELD);

        return new UserGameActionEntity($fkGameActionId, $fkUserId, $resultDetails);
    }
}

?>
