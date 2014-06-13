<?php


class BaseUsersLogicUtility
{

    //table name
    public static $TABLE_NAME = "users";
    //fields list
    public static $ID_FIELD = "id";
    public static $UID_FIELD = "uid";
    public static $USERNAME_FIELD = "username";
    public static $NICKNAME_FIELD = "nickname";
    public static $STATUS_FIELD = "status";
    public static $TEAMID_FIELD = "teamId";
    public static $COUNTRY_FIELD = "country";
    public static $PASSWORD_FIELD = "password";
    public static $RESET_PASSWORD_CODE_FIELD = "resetPasswordCode";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $UID_LIMIT = 100;
    public static $USERNAME_LIMIT = 50;
    public static $NICKNAME_LIMIT = 50;
    public static $STATUS_LIMIT = 1;
    public static $TEAMID_LIMIT = 30;
    public static $COUNTRY_LIMIT = 30;
    public static $PASSWORD_LIMIT = 50;

    public static function addUsers($uid, $username, $nickname, $status, $teamId, $country, $password)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$UID_FIELD, $uid);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$USERNAME_FIELD, $username);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$NICKNAME_FIELD, $nickname);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$STATUS_FIELD, $status);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$TEAMID_FIELD, $teamId);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$COUNTRY_FIELD, $country);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$PASSWORD_FIELD, $password);

	return $queryBuilder->executeInsertQuery();
    }

    public static function getUsersDetails($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseUsersLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(BaseUsersLogicUtility::$ID_FIELD, $id);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseUsersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateUsers($id, $uid, $username, $nickname, $status, $teamId, $country, $password)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$UID_FIELD, $uid);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$USERNAME_FIELD, $username);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$NICKNAME_FIELD, $nickname);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$STATUS_FIELD, $status);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$TEAMID_FIELD, $teamId);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$COUNTRY_FIELD, $country);
	$queryBuilder->addUpdateField(BaseUsersLogicUtility::$PASSWORD_FIELD, $password);

	$queryBuilder->addAndConditionWithValue(BaseUsersLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeUpdateQuery();
    }

    public static function getUsersList(SortQuery $sortQuery = null)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder = BaseUsersLogicUtility::addAllFields($queryBuilder);

	if($sortQuery)
	{
	    $queryBuilder->addSortQuery($sortQuery);
	}

	$result = $queryBuilder->executeQuery();

	return BaseUsersLogicUtility::convertToObjectArray($result);
    }

    public static function deleteUsers($id)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(BaseUsersLogicUtility::$ID_FIELD, $id);

	return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addField($field);
	$queryBuilder->addAndConditionWithValue(BaseUsersLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return BaseUsersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function getId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$ID_FIELD);
    }

    public static function getUid($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$UID_FIELD);
    }

    public static function getUsername($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$USERNAME_FIELD);
    }

    public static function getNickname($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$NICKNAME_FIELD);
    }

    public static function getStatus($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$STATUS_FIELD);
    }

    public static function getTeamId($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$TEAMID_FIELD);
    }

    public static function getCountry($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$COUNTRY_FIELD);
    }

    public static function getPassword($id)
    {
	return BaseBannerLogicUtility::getSpecificDetails($id, BaseUsersLogicUtility::$PASSWORD_FIELD);
    }

    protected static function updateSpecificField($id, $field, $value)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(BaseUsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
	$queryBuilder->addAndConditionWithValue(BaseUsersLogicUtility::$ID_FIELD, $id);

	$result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateUid($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$UID_FIELD, $value);
    }

    public static function updateUsername($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$USERNAME_FIELD, $value);
    }

    public static function updateNickname($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$NICKNAME_FIELD, $value);
    }

    public static function updateStatus($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$STATUS_FIELD, $value);
    }

    public static function updateTeamId($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$TEAMID_FIELD, $value);
    }

    public static function updateCountry($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$COUNTRY_FIELD, $value);
    }

    public static function updatePassword($id, $value)
    {
	BaseUsersLogicUtility::updateSpecificField($id, $value, BaseUsersLogicUtility::$PASSWORD_FIELD, $value);
    }

    public static function addAllFields(QueryBuilder $queryBuilder)
    {
	$queryBuilder->addFields(BaseUsersLogicUtility::$ID_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$UID_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$USERNAME_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$NICKNAME_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$STATUS_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$TEAMID_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$COUNTRY_FIELD);
	$queryBuilder->addFields(BaseUsersLogicUtility::$PASSWORD_FIELD);

	return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
	$objectArray = array();

	for($i = 0; $i < count($result); $i++)
	{
	    $objectArray[$i] = BaseUsersLogicUtility::convertToObject($result[$i]);
	}

	return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
	$id = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$ID_FIELD);
	$uid = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$UID_FIELD);
	$username = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$USERNAME_FIELD);
	$nickname = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$NICKNAME_FIELD);
	$status = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$STATUS_FIELD);
	$teamId = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$TEAMID_FIELD);
	$country = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$COUNTRY_FIELD);
	$password = QueryBuilder::getQueryValue($resultDetails, BaseUsersLogicUtility::$PASSWORD_FIELD);

	return new UsersEntity($id, $uid, $username, $nickname, $status, $teamId, $country, $password, $resultDetails);
    }
}

?>
