<?php


class BaseConnectionsLogicUtility
{

    //table name
    public static $TABLE_NAME = "connections";
    //fields list
    public static $USER1_FIELD = "user1";
    public static $USER2_FIELD = "user2";
    public static $STATUS_FIELD = "status";
    //fields values
    //fields limits
    public static $USER1_LIMIT = 11;
    public static $USER2_LIMIT = 11;
    public static $STATUS_LIMIT = 2;

    public static function addConnections($user1, $user2, $status)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseConnectionsLogicUtility::$USER1_FIELD, $user1);
	$queryBuilder->addUpdateField(BaseConnectionsLogicUtility::$USER2_FIELD, $user2);
	$queryBuilder->addUpdateField(BaseConnectionsLogicUtility::$STATUS_FIELD, $status);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getConnectionsDetails()
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseConnectionsLogicUtility::addAllFields($queryBuilder);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseConnectionsLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateConnections($user1, $user2, $status)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseConnectionsLogicUtility::$USER1_FIELD, $user1);
	$queryBuilder->addUpdateField(BaseConnectionsLogicUtility::$USER2_FIELD, $user2);
	$queryBuilder->addUpdateField(BaseConnectionsLogicUtility::$STATUS_FIELD, $status);


	return $queryBuilder->executeUpdateQuery();
    }

    public static function getConnectionsList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseConnectionsLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseConnectionsLogicUtility::convertToObjectArray($result);
    }

    public static function deleteConnections()
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);

	return $queryBuilder->executeDeleteQuery();
    }

//    protected static function getSpecificDetails(, $field)
//    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);
//        $queryBuilder->addField($field);
//
//        $result = $queryBuilder->executeQuery();
//
//        if(count($result) > 0)
//        {
//            return BaseConnectionsLogicUtility::convertToObject($result[0]);
//        }
//        else
//        {
//            return null;
//        }
//    }
//    public static function getUser1()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseConnectionsLogicUtility::$USER1_FIELD);
//    }
//
//    public static function getUser2()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseConnectionsLogicUtility::$USER2_FIELD);
//    }
//
//    public static function getStatus()
//    {
//        return BaseBannerLogicUtility::getSpecificDetails(, BaseConnectionsLogicUtility::$STATUS_FIELD);
//    }
//    protected static function updateSpecificField(, $field, $value)
//    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->addTable(BaseConnectionsLogicUtility::$TABLE_NAME);
//        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
//
//        $result = $queryBuilder->executeUpdateQuery();
//    }
//
//    public static function updateUser1(, $value)
//    {
//        BaseConnectionsLogicUtility::updateSpecificField(, $value, BaseConnectionsLogicUtility::$USER1_FIELD, $value);
//    }
//
//    public static function updateUser2(, $value)
//    {
//        BaseConnectionsLogicUtility::updateSpecificField(, $value, BaseConnectionsLogicUtility::$USER2_FIELD, $value);
//    }
//
//    public static function updateStatus(, $value)
//    {
//        BaseConnectionsLogicUtility::updateSpecificField(, $value, BaseConnectionsLogicUtility::$STATUS_FIELD, $value);
//    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseConnectionsLogicUtility::$USER1_FIELD);
	$queryBuilder->addFields(BaseConnectionsLogicUtility::$USER2_FIELD);
	$queryBuilder->addFields(BaseConnectionsLogicUtility::$STATUS_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseConnectionsLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$user1 = QueryBuilder::getQueryValue($resultDetails, BaseConnectionsLogicUtility::$USER1_FIELD);
	$user2 = QueryBuilder::getQueryValue($resultDetails, BaseConnectionsLogicUtility::$USER2_FIELD);
	$status = QueryBuilder::getQueryValue($resultDetails, BaseConnectionsLogicUtility::$STATUS_FIELD);

	return new ConnectionsEntity($user1, $user2, $status, $resultDetails);
    }
}

?>
