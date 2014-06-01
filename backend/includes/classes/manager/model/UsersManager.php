<?php


class UsersManager
{

    public static function checkUserLoginDetails($username, $uid)
    {
	$error = new Error();

	$usersEntity = UsersLogicUtility::getUserDetailsFromUsernameAndUid($username, $uid);

	if($usersEntity)
	{
	    $error->setObject($usersEntity);
	}
	else
	{
	    $error->addError("An authentification error occurred");
	}

	return $error;
    }

    public static function addUsers($uid, $username, $nickname, $status, $teamId, $country, $password)
    {
	$usersValidator = new BaseUsersValidator();

	$error = $usersValidator->validateAddUsers($uid, $username, $nickname, $status, $teamId, $country, $password);

	if(!$error->errorExists())
	{
	    UsersLogicUtility::addUsers($uid, $username, $nickname, $status, $teamId, $country, $password);
	}

	return $error;
    }

    public static function editUsers($id, $uid, $username, $nickname, $status, $teamId, $country, $password)
    {
	$usersValidator = new BaseUsersValidator();

	$error = $usersValidator->validateEditUsers($id, $uid, $username, $nickname, $status, $teamId, $country, $password);

	if(!$error->errorExists())
	{
	    UsersLogicUtility::updateUsers($id, $uid, $username, $nickname, $status, $teamId, $country, $password);
	}

	return $error;
    }

    public static function deleteUsers($id)
    {
	UsersLogicUtility::deleteUsers($id);
    }
}

?>
