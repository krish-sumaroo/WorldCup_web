<?php


class BaseGamesLogicUtility
{

    //table name
    public static $TABLE_NAME = "games";
    //fields list
    public static $ID_FIELD = "id";
    public static $STAGE_FIELD = "stage";
    public static $TEAM1_FIELD = "team1";
    public static $TEAM2_FIELD = "team2";
    public static $VENUE_FIELD = "venue";
    public static $T1SCORE_FIELD = "t1Score";
    public static $T2SCORE_FIELD = "t2Score";
    public static $EXTRASCORE_FIELD = "extraScore";
    public static $TIMESTARTED_FIELD = "timeStarted";
    public static $STARTEDF_FIELD = "startedF";
    public static $PLAYERINFO_FIELD = "playerInfo";
    public static $MATCHDATE_FIELD = "matchDate";
    public static $MATCH_STATUS_FIELD = "match_status";
    //fields values
    //match status values
    public static $NOT_STARTED_STATUS = "not_started";
    public static $STARTED_STATUS = "started";
    public static $FINISHED_STATUS = "finished";
    public static $CANCELLED_STATUS = "cancelled";
    //fields limits
    public static $ID_LIMIT = 11;
    public static $STAGE_LIMIT = 30;
    public static $TEAM1_LIMIT = 11;
    public static $TEAM2_LIMIT = 11;
    public static $VENUE_LIMIT = 11;
    public static $T1SCORE_LIMIT = 10;
    public static $T2SCORE_LIMIT = 10;
    public static $EXTRASCORE_LIMIT = 10;
    public static $STARTEDF_LIMIT = 1;
    public static $PLAYERINFO_LIMIT = 2;

    public static function addGames($stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted,
	    $startedF, $playerInfo, $matchDate)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$STAGE_FIELD, $stage);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$TEAM1_FIELD, $team1);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$TEAM2_FIELD, $team2);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$VENUE_FIELD, $venue);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$T1SCORE_FIELD, $t1Score);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$T2SCORE_FIELD, $t2Score);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$EXTRASCORE_FIELD, $extraScore);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$TIMESTARTED_FIELD, $timeStarted);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$STARTEDF_FIELD, $startedF);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$PLAYERINFO_FIELD, $playerInfo);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$MATCHDATE_FIELD, $matchDate);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getGamesDetails($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseGamesLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseGamesLogicUtility::$ID_FIELD, $id);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseGamesLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateGames($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore,
	    $timeStarted, $startedF, $playerInfo, $matchDate)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$STAGE_FIELD, $stage);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$TEAM1_FIELD, $team1);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$TEAM2_FIELD, $team2);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$VENUE_FIELD, $venue);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$T1SCORE_FIELD, $t1Score);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$T2SCORE_FIELD, $t2Score);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$EXTRASCORE_FIELD, $extraScore);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$TIMESTARTED_FIELD, $timeStarted);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$STARTEDF_FIELD, $startedF);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$PLAYERINFO_FIELD, $playerInfo);
	$queryBuilder->addUpdateField(BaseGamesLogicUtility::$MATCHDATE_FIELD, $matchDate);

	$queryBuilder->addAndConditionWithValue(BaseGamesLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getGamesList(SortQuery $sortQuery = null, $matchStatus = "")
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseGamesLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	if($matchStatus != "")
	{
	    $queryBuilder->addAndConditionWithValue(BaseGamesLogicUtility::$MATCH_STATUS_FIELD, $matchStatus);
	}

	$result = $queryBuilder->executeQuery();

	return BaseGamesLogicUtility::convertToObjectArray($result);
    }

    public static function deleteGames($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseGamesLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseGamesLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseGamesLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$ID_FIELD);
    }

    public static function getStage($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$STAGE_FIELD);
    }

    public static function getTeam1($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$TEAM1_FIELD);
    }

    public static function getTeam2($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$TEAM2_FIELD);
    }

    public static function getVenue($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$VENUE_FIELD);
    }

    public static function getT1Score($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$T1SCORE_FIELD);
    }

    public static function getT2Score($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$T2SCORE_FIELD);
    }

    public static function getExtraScore($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$EXTRASCORE_FIELD);
    }

    public static function getTimeStarted($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$TIMESTARTED_FIELD);
    }

    public static function getStartedF($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$STARTEDF_FIELD);
    }

    public static function getPlayerInfo($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$PLAYERINFO_FIELD);
    }

    public static function getMatchDate($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseGamesLogicUtility::$MATCHDATE_FIELD);
    }

    protected static function updateSpecificField($id, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseGamesLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateStage($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$STAGE_FIELD, $value);
    }

    public static function updateTeam1($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$TEAM1_FIELD, $value);
    }

    public static function updateTeam2($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$TEAM2_FIELD, $value);
    }

    public static function updateVenue($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$VENUE_FIELD, $value);
    }

    public static function updateT1Score($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$T1SCORE_FIELD, $value);
    }

    public static function updateT2Score($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$T2SCORE_FIELD, $value);
    }

    public static function updateExtraScore($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$EXTRASCORE_FIELD, $value);
    }

    public static function updateTimeStarted($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$TIMESTARTED_FIELD, $value);
    }

    public static function updateStartedF($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$STARTEDF_FIELD, $value);
    }

    public static function updatePlayerInfo($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$PLAYERINFO_FIELD, $value);
    }

    public static function updateMatchDate($id, $value)
    {
	BaseGamesLogicUtility::updateSpecificField($id, $value, BaseGamesLogicUtility::$MATCHDATE_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseGamesLogicUtility::$ID_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$STAGE_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$TEAM1_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$TEAM2_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$VENUE_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$T1SCORE_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$T2SCORE_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$EXTRASCORE_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$TIMESTARTED_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$STARTEDF_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$PLAYERINFO_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$MATCHDATE_FIELD);
	$queryBuilder->addFields(BaseGamesLogicUtility::$MATCH_STATUS_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseGamesLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$id = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$ID_FIELD);
	$stage = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$STAGE_FIELD);
	$team1 = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$TEAM1_FIELD);
	$team2 = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$TEAM2_FIELD);
	$venue = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$VENUE_FIELD);
	$t1Score = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$T1SCORE_FIELD);
	$t2Score = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$T2SCORE_FIELD);
	$extraScore = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$EXTRASCORE_FIELD);
	$timeStarted = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$TIMESTARTED_FIELD);
	$startedF = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$STARTEDF_FIELD);
	$playerInfo = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$PLAYERINFO_FIELD);
	$matchDate = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$MATCHDATE_FIELD);
	$matchStatus = QueryBuilder::getQueryValue($resultDetails, BaseGamesLogicUtility::$MATCH_STATUS_FIELD);

	return new GamesEntity($id, $stage, $team1, $team2, $venue, $t1Score, $t2Score, $extraScore, $timeStarted, $startedF,
		$playerInfo, $matchDate, $matchStatus, $resultDetails);
    }
}

?>
