<?php

class BaseUserScoreActionLogicUtility
{
    //table name
    public static $TABLE_NAME = "userScoreAction";
    //fields list
    public static $ID_FIELD = "id";
    public static $GAMEID_FIELD = "gameId";
    public static $TEAM1ID_FIELD = "team1Id";
    public static $TEAM1SCORE_FIELD = "team1Score";
    public static $TEAM2SCORE_FIELD = "team2Score";
    public static $TEAM2ID_FIELD = "team2Id";
    public static $USERID_FIELD = "userId";
    public static $TIMESTAMP_FIELD = "timestamp";
    public static $POINTS_FIELD = "points";
    public static $STATUS_FIELD = "status";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $GAMEID_LIMIT = 11;
    public static $TEAM1ID_LIMIT = 11;
    public static $TEAM1SCORE_LIMIT = 11;
    public static $TEAM2SCORE_LIMIT = 11;
    public static $TEAM2ID_LIMIT = 11;
    public static $USERID_LIMIT = 11;
    public static $POINTS_LIMIT = 20;
    public static $STATUS_LIMIT = 1;

    public static function addUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$GAMEID_FIELD, $gameId);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM1ID_FIELD, $team1Id);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM1SCORE_FIELD, $team1Score);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM2SCORE_FIELD, $team2Score);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM2ID_FIELD, $team2Id);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$USERID_FIELD, $userId);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TIMESTAMP_FIELD, $timestamp);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$POINTS_FIELD, $points);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$STATUS_FIELD, $status);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getUserScoreActionDetails($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseUserScoreActionLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseUserScoreActionLogicUtility::$ID_FIELD, $id);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseUserScoreActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateUserScoreAction($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$GAMEID_FIELD, $gameId);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM1ID_FIELD, $team1Id);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM1SCORE_FIELD, $team1Score);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM2SCORE_FIELD, $team2Score);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TEAM2ID_FIELD, $team2Id);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$USERID_FIELD, $userId);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$TIMESTAMP_FIELD, $timestamp);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$POINTS_FIELD, $points);
        $queryBuilder->addUpdateField(BaseUserScoreActionLogicUtility::$STATUS_FIELD, $status);

        $queryBuilder->addAndConditionWithValue(BaseUserScoreActionLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getUserScoreActionList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseUserScoreActionLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseUserScoreActionLogicUtility::convertToObjectArray($result);
    }

    public static function deleteUserScoreAction($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseUserScoreActionLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseUserScoreActionLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseUserScoreActionLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$ID_FIELD);
    }

    public static function getGameId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$GAMEID_FIELD);
    }

    public static function getTeam1Id($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$TEAM1ID_FIELD);
    }

    public static function getTeam1Score($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$TEAM1SCORE_FIELD);
    }

    public static function getTeam2Score($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$TEAM2SCORE_FIELD);
    }

    public static function getTeam2Id($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$TEAM2ID_FIELD);
    }

    public static function getUserId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$USERID_FIELD);
    }

    public static function getTimestamp($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$TIMESTAMP_FIELD);
    }

    public static function getPoints($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$POINTS_FIELD);
    }

    public static function getStatus($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseUserScoreActionLogicUtility::$STATUS_FIELD);
    }


    protected static function updateSpecificField($id, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseUserScoreActionLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseUserScoreActionLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateGameId($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$GAMEID_FIELD, $value);
    }

    public static function updateTeam1Id($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$TEAM1ID_FIELD, $value);
    }

    public static function updateTeam1Score($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$TEAM1SCORE_FIELD, $value);
    }

    public static function updateTeam2Score($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$TEAM2SCORE_FIELD, $value);
    }

    public static function updateTeam2Id($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$TEAM2ID_FIELD, $value);
    }

    public static function updateUserId($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$USERID_FIELD, $value);
    }

    public static function updateTimestamp($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$TIMESTAMP_FIELD, $value);
    }

    public static function updatePoints($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$POINTS_FIELD, $value);
    }

    public static function updateStatus($id, $value)
    {
        BaseUserScoreActionLogicUtility::updateSpecificField($id, $value, BaseUserScoreActionLogicUtility::$STATUS_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$ID_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$GAMEID_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$TEAM1ID_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$TEAM1SCORE_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$TEAM2SCORE_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$TEAM2ID_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$USERID_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$TIMESTAMP_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$POINTS_FIELD);
        $queryBuilder->addFields(BaseUserScoreActionLogicUtility::$STATUS_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseUserScoreActionLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $id = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$ID_FIELD);
        $gameId = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$GAMEID_FIELD);
        $team1Id = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$TEAM1ID_FIELD);
        $team1Score = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$TEAM1SCORE_FIELD);
        $team2Score = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$TEAM2SCORE_FIELD);
        $team2Id = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$TEAM2ID_FIELD);
        $userId = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$USERID_FIELD);
        $timestamp = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$TIMESTAMP_FIELD);
        $points = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$POINTS_FIELD);
        $status = QueryBuilder::getQueryValue($resultDetails, BaseUserScoreActionLogicUtility::$STATUS_FIELD);

        return new UserScoreActionEntity($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status, $resultDetails);
    }
}

?>
