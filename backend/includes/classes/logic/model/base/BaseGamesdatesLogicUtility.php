<?php


class BaseGamesdatesLogicUtility
{

    //table name
    public static $TABLE_NAME = "gamesdates";
    //fields list
    public static $GAMEDATE_FIELD = "gameDate";

    //fields values
    //fields limits

    public static function addGamesdates($gameDate)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseGamesdatesLogicUtility::$GAMEDATE_FIELD, $gameDate);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getGamesdatesDetails()
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseGamesdatesLogicUtility::addAllFields($queryBuilder);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseGamesdatesLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateGamesdates($gameDate)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseGamesdatesLogicUtility::$GAMEDATE_FIELD, $gameDate);


	return $queryBuilder->executeUpdateQuery();
    }

    public static function getGamesdatesList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseGamesdatesLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseGamesdatesLogicUtility::convertToObjectArray($result);
    }

    public static function deleteGamesdates()
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);

	return $queryBuilder->executeDeleteQuery();
    }

//    protected static function getSpecificDetails(, $field)
//    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);
//        $queryBuilder->addField($field);
//
//        $result = $queryBuilder->executeQuery();
//
//        if(count($result) > 0)
//        {
//            return BaseGamesdatesLogicUtility::convertToObject($result[0]);
//        }
//        else
//        {
//            return null;
//        }
//    }
//
//    public static function getGameDate()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseGamesdatesLogicUtility::$GAMEDATE_FIELD);
//    }
//
//
//    protected static function updateSpecificField(, $field, $value)
//    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->addTable(BaseGamesdatesLogicUtility::$TABLE_NAME);
//        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
//
//        $result = $queryBuilder->executeUpdateQuery();
//    }
//
//    public static function updateGameDate(, $value)
//    {
//        BaseGamesdatesLogicUtility::updateSpecificField(, $value, BaseGamesdatesLogicUtility::$GAMEDATE_FIELD, $value);
//    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseGamesdatesLogicUtility::$GAMEDATE_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseGamesdatesLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$gameDate = QueryBuilder::getQueryValue($resultDetails, BaseGamesdatesLogicUtility::$GAMEDATE_FIELD);

	return new GamesdatesEntity($gameDate, $resultDetails);
    }
}

?>
