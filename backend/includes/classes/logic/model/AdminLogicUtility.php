<?php


class AdminLogicUtility extends BaseAdminLogicUtility
{

    public static function checkUserExists($username, $encryptedPassword)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(AdminLogicUtility::$TABLE_NAME);
	$queryBuilder->addFields(AdminLogicUtility::$ADMIN_ID_FIELD);
	$queryBuilder->addFields(AdminLogicUtility::$TIME_OFFSET_FIELD);
	$queryBuilder->addFields(AdminLogicUtility::$ADMIN_ROLE_FIELD);
	$queryBuilder->addAndConditionWithValue(AdminLogicUtility::$USERNAME_FIELD, $username);
	$queryBuilder->addAndConditionWithValue(AdminLogicUtility::$PASSWORD_FIELD, $encryptedPassword);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return AdminLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }
}

?>
