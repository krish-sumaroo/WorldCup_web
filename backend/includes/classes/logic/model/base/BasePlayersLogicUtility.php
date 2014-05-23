<?php


class BasePlayersLogicUtility
{

    //table name
    public static $TABLE_NAME = "players";
    //fields list
    public static $ID_FIELD = "id";
    public static $TEAMID_FIELD = "teamId";
    public static $NAME_FIELD = "name";
    public static $POSITION_FIELD = "position";
    public static $NUMBER_FIELD = "number";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $TEAMID_LIMIT = 11;
    public static $NAME_LIMIT = 30;
    public static $POSITION_LIMIT = 5;
    public static $NUMBER_LIMIT = 3;

    public static function addPlayers($teamId, $name, $position, $number)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$TEAMID_FIELD, $teamId);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$NAME_FIELD, $name);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$POSITION_FIELD, $position);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$NUMBER_FIELD, $number);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getPlayersDetails($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder = BasePlayersLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BasePlayersLogicUtility::$ID_FIELD, $id);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BasePlayersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updatePlayers($id, $teamId, $name, $position, $number)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$TEAMID_FIELD, $teamId);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$NAME_FIELD, $name);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$POSITION_FIELD, $position);
	$queryBuilder->addUpdateField(BasePlayersLogicUtility::$NUMBER_FIELD, $number);

	$queryBuilder->addAndConditionWithValue(BasePlayersLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getPlayersList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder = BasePlayersLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BasePlayersLogicUtility::convertToObjectArray($result);
    }

    public static function deletePlayers($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BasePlayersLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BasePlayersLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BasePlayersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BasePlayersLogicUtility::$ID_FIELD);
    }

    public static function getTeamId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BasePlayersLogicUtility::$TEAMID_FIELD);
    }

    public static function getName($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BasePlayersLogicUtility::$NAME_FIELD);
    }

    public static function getPosition($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BasePlayersLogicUtility::$POSITION_FIELD);
    }

    public static function getNumber($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BasePlayersLogicUtility::$NUMBER_FIELD);
    }

    protected static function updateSpecificField($id, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BasePlayersLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateTeamId($id, $value)
    {
	BasePlayersLogicUtility::updateSpecificField($id, $value, BasePlayersLogicUtility::$TEAMID_FIELD, $value);
    }

    public static function updateName($id, $value)
    {
	BasePlayersLogicUtility::updateSpecificField($id, $value, BasePlayersLogicUtility::$NAME_FIELD, $value);
    }

    public static function updatePosition($id, $value)
    {
	BasePlayersLogicUtility::updateSpecificField($id, $value, BasePlayersLogicUtility::$POSITION_FIELD, $value);
    }

    public static function updateNumber($id, $value)
    {
	BasePlayersLogicUtility::updateSpecificField($id, $value, BasePlayersLogicUtility::$NUMBER_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BasePlayersLogicUtility::$ID_FIELD, BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BasePlayersLogicUtility::$TEAMID_FIELD, BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BasePlayersLogicUtility::$NAME_FIELD, BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BasePlayersLogicUtility::$POSITION_FIELD, BasePlayersLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(BasePlayersLogicUtility::$NUMBER_FIELD, BasePlayersLogicUtility::$TABLE_NAME);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BasePlayersLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$id = QueryBuilder::getQueryValue($resultDetails, BasePlayersLogicUtility::$ID_FIELD);
	$teamId = QueryBuilder::getQueryValue($resultDetails, BasePlayersLogicUtility::$TEAMID_FIELD);
	$name = QueryBuilder::getQueryValue($resultDetails, BasePlayersLogicUtility::$NAME_FIELD);
	$position = QueryBuilder::getQueryValue($resultDetails, BasePlayersLogicUtility::$POSITION_FIELD);
	$number = QueryBuilder::getQueryValue($resultDetails, BasePlayersLogicUtility::$NUMBER_FIELD);

	return new PlayersEntity($id, $teamId, $name, $position, $number, $resultDetails);
    }
}

?>
