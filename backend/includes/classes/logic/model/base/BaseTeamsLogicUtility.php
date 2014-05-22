<?php


class BaseTeamsLogicUtility
{

    //table name
    public static $TABLE_NAME = "teams";
    //fields list
    public static $ID_FIELD = "id";
    public static $NAME_FIELD = "name";
    public static $FLAG_FIELD = "flag";
    public static $GROUP_FIELD = "group";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $NAME_LIMIT = 30;
    public static $FLAG_LIMIT = 20;
    public static $GROUP_LIMIT = 2;

    public static function addTeams($name, $flag, $group)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseTeamsLogicUtility::$NAME_FIELD, $name);
	$queryBuilder->addUpdateField(BaseTeamsLogicUtility::$FLAG_FIELD, $flag);
	$queryBuilder->addUpdateField(BaseTeamsLogicUtility::$GROUP_FIELD, $group);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getTeamsDetails($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseTeamsLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseTeamsLogicUtility::$ID_FIELD, $id);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseTeamsLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateTeams($id, $name, $flag, $group)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseTeamsLogicUtility::$NAME_FIELD, $name);
	$queryBuilder->addUpdateField(BaseTeamsLogicUtility::$FLAG_FIELD, $flag);
	$queryBuilder->addUpdateField(BaseTeamsLogicUtility::$GROUP_FIELD, $group);

	$queryBuilder->addAndConditionWithValue(BaseTeamsLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getTeamsList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseTeamsLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseTeamsLogicUtility::convertToObjectArray($result);
    }

    public static function deleteTeams($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseTeamsLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseTeamsLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseTeamsLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseTeamsLogicUtility::$ID_FIELD);
    }

    public static function getName($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseTeamsLogicUtility::$NAME_FIELD);
    }

    public static function getFlag($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseTeamsLogicUtility::$FLAG_FIELD);
    }

    public static function getGroup($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseTeamsLogicUtility::$GROUP_FIELD);
    }

    protected static function updateSpecificField($id, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseTeamsLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseTeamsLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateName($id, $value)
    {
	BaseTeamsLogicUtility::updateSpecificField($id, $value, BaseTeamsLogicUtility::$NAME_FIELD, $value);
    }

    public static function updateFlag($id, $value)
    {
	BaseTeamsLogicUtility::updateSpecificField($id, $value, BaseTeamsLogicUtility::$FLAG_FIELD, $value);
    }

    public static function updateGroup($id, $value)
    {
	BaseTeamsLogicUtility::updateSpecificField($id, $value, BaseTeamsLogicUtility::$GROUP_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseTeamsLogicUtility::$ID_FIELD);
	$queryBuilder->addFields(BaseTeamsLogicUtility::$NAME_FIELD);
	$queryBuilder->addFields(BaseTeamsLogicUtility::$FLAG_FIELD);
	$queryBuilder->addFields(BaseTeamsLogicUtility::$GROUP_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseTeamsLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$id = QueryBuilder::getQueryValue($resultDetails, BaseTeamsLogicUtility::$ID_FIELD);
	$name = QueryBuilder::getQueryValue($resultDetails, BaseTeamsLogicUtility::$NAME_FIELD);
	$flag = QueryBuilder::getQueryValue($resultDetails, BaseTeamsLogicUtility::$FLAG_FIELD);
	$group = QueryBuilder::getQueryValue($resultDetails, BaseTeamsLogicUtility::$GROUP_FIELD);

	return new TeamsEntity($id, $name, $flag, $group, $resultDetails);
    }
}

?>
