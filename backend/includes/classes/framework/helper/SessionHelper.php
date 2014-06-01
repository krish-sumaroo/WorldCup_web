<?php


/**
 * Description of SessionHelper
 *
 * @author suyash
 */
class SessionHelper
{

    private static $USER_SESSION_VARIABLE = "id";
    private static $USER_NAME_VARIABLE = "name";
    private static $TIME_OFFSET = "offset";
    private static $ADMIN_ROLE = "admin_role";

    public static function setUserSessionVariable($userId, $timeOffset, $adminRole)
    {
	$_SESSION[SessionHelper::$USER_SESSION_VARIABLE] = $userId;
	$_SESSION[SessionHelper::$TIME_OFFSET] = $timeOffset;
	$_SESSION[SessionHelper::$ADMIN_ROLE] = $adminRole;
    }

    public static function setUserDetails($name)
    {
	$_SESSION[SessionHelper::$USER_NAME_VARIABLE] = $name;
    }

    public static function getUserId()
    {
	if(isset($_SESSION[SessionHelper::$USER_SESSION_VARIABLE]))
	{
	    return $_SESSION[SessionHelper::$USER_SESSION_VARIABLE];
	}
	else
	{
	    return "";
	}
    }

    public static function getUserName()
    {
	if(isset($_SESSION[SessionHelper::$USER_NAME_VARIABLE]))
	{
	    return $_SESSION[SessionHelper::$USER_NAME_VARIABLE];
	}
	else
	{
	    return "";
	}
    }

    public static function isLoggedIn()
    {
	if(isset($_SESSION[SessionHelper::$USER_SESSION_VARIABLE]))
	{
	    return true;
	}
	else
	{
	    return false;
	}
    }

    public static function getTimeOffset()
    {
	return $_SESSION[SessionHelper::$TIME_OFFSET];
    }

    public static function getAdminRole()
    {
	return $_SESSION[SessionHelper::$ADMIN_ROLE];
    }

    public static function isAdminCreator()
    {
	return (SessionHelper::getAdminRole() == AdminLogicUtility::$ADMIN_ROLE_CREATOR);
    }

    public static function isAdminValidator()
    {
	return (SessionHelper::getAdminRole() == AdminLogicUtility::$ADMIN_ROLE_VALIDATOR);
    }
}

?>
