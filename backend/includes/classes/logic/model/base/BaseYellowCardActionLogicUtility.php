<?php

class BaseYellowCardActionLogicUtility
{
    //table name
    public static $TABLE_NAME = "yellow_card_action";
    //fields list
    public static $FK_GAME_ACTION_ID_FIELD = "fk_game_action_id";
    public static $FK_PLAYER_ID_FIELD = "fk_player_id";
    //fields values
    //fields limits
    public static $FK_GAME_ACTION_ID_LIMIT = 11;
    public static $FK_PLAYER_ID_LIMIT = 11;

    public static function addYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addUpdateField(BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getYellowCardActionDetails($fkGameActionId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseYellowCardActionLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseYellowCardActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);
        $queryBuilder->addUpdateField(BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD, $fkPlayerId);

        $queryBuilder->addAndConditionWithValue(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getYellowCardActionList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseYellowCardActionLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseYellowCardActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteYellowCardAction($fkGameActionId)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($fkGameActionId, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseYellowCardActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getFkGameActionId($fkGameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
    }

    public static function getFkPlayerId($fkGameActionId)
    {
        return BaseBannerLogicUtility::getSpecificDetails($fkGameActionId, BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD);
    }


    protected static function updateSpecificField($fkGameActionId, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseYellowCardActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD, $fkGameActionId);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateFkPlayerId($fkGameActionId, $value)
    {
        BaseYellowCardActionLogicUtility::updateSpecificField($fkGameActionId, $value, BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
        $queryBuilder->addFields(BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseYellowCardActionLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $fkGameActionId = QueryBuilder::getQueryValue($resultDetails, BaseYellowCardActionLogicUtility::$FK_GAME_ACTION_ID_FIELD);
        $fkPlayerId = QueryBuilder::getQueryValue($resultDetails, BaseYellowCardActionLogicUtility::$FK_PLAYER_ID_FIELD);

        return new YellowCardActionEntity($fkGameActionId, $fkPlayerId, $resultDetails);
    }
}

?>
