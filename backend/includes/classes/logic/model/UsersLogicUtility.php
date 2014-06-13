<?php


class UsersLogicUtility extends BaseUsersLogicUtility
{

    public static function getUserDetailsFromUsernameAndUid($username, $uid)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(UsersLogicUtility::$TABLE_NAME);
	$queryBuilder = UsersLogicUtility::addAllFields($queryBuilder);

	$queryBuilder->addAndConditionWithValue(UsersLogicUtility::$USERNAME_FIELD, $username, QueryBuilder::$OPERATOR_EQUAL,
		UsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addAndConditionWithValue(UsersLogicUtility::$UID_FIELD, $uid, QueryBuilder::$OPERATOR_EQUAL,
		UsersLogicUtility::$TABLE_NAME);

	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return UsersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function updateResetPasswordCodeByEmail($email, $verificationCode)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(UsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(UsersLogicUtility::$RESET_PASSWORD_CODE_FIELD, $verificationCode);
	$queryBuilder->addAndConditionWithValue(UsersLogicUtility::$USERNAME_FIELD, $email);

	$queryBuilder->executeUpdateQuery();
    }

    public static function getDetailsByEmailVerificationCode($email, $verificationCode)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(UsersLogicUtility::$TABLE_NAME);
	$queryBuilder = UsersLogicUtility::addAllFields($queryBuilder);
	$queryBuilder->addAndConditionWithValue(UsersLogicUtility::$USERNAME_FIELD, $email);
	$queryBuilder->addAndConditionWithValue(UsersLogicUtility::$RESET_PASSWORD_CODE_FIELD, $verificationCode);
	$result = $queryBuilder->executeQuery();

	if(count($result) > 0)
	{
	    return UsersLogicUtility::convertToObject($result[0]);
	}
	else
	{
	    return null;
	}
    }

    public static function resetPassword($email, $encryptedPassword)
    {
	$queryBuilder = new QueryBuilder();
	$queryBuilder->addTable(UsersLogicUtility::$TABLE_NAME);
	$queryBuilder->addUpdateField(UsersLogicUtility::$PASSWORD_FIELD, $encryptedPassword);
	$queryBuilder->addAndConditionWithValue(UsersLogicUtility::$USERNAME_FIELD, $email);
	$queryBuilder->executeUpdateQuery();
    }
}

?>
