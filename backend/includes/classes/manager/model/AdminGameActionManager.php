<?php


class AdminGameActionManager
{

    public static function validateAdminGameAction($adminGameAction)
    {
	$error = new Error();

	AdminGameActionLogicUtility::validateAdminGameAction($adminGameAction);

	return $error;
    }

    public static function invalidateAdminGameAction($adminGameAction)
    {
	$error = new Error();

	AdminGameActionLogicUtility::invalidateAdminGameAction($adminGameAction);

	return $error;
    }

    public static function addAdminGameAction($fkGameActionId, $fkAdminId)
    {
	$adminGameActionValidator = new BaseAdminGameActionValidator();

	$error = $adminGameActionValidator->validateAddAdminGameAction($fkGameActionId, $fkAdminId);

	if(!$error->errorExists())
	{
	    AdminGameActionLogicUtility::addAdminGameAction($fkGameActionId, $fkAdminId);
	}

	return $error;
    }

    public static function editAdminGameAction($fkGameActionId, $fkAdminId)
    {
	$adminGameActionValidator = new BaseAdminGameActionValidator();

	$error = $adminGameActionValidator->validateEditAdminGameAction($fkGameActionId, $fkAdminId);

	if(!$error->errorExists())
	{
	    AdminGameActionLogicUtility::updateAdminGameAction($fkGameActionId, $fkAdminId);
	}

	return $error;
    }

    public static function deleteAdminGameAction($fkGameActionId, $fkAdminId)
    {
	AdminGameActionLogicUtility::deleteAdminGameAction($fkGameActionId, $fkAdminId);
    }
}

?>
