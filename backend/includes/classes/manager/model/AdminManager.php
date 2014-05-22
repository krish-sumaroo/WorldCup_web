<?php

class AdminManager
{
    public static function addAdmin($username, $password)
    {
        $adminValidator = new BaseAdminValidator();

        $error = $adminValidator->validateAddAdmin($username, $password);

        if(!$error->errorExists())
        {
            AdminLogicUtility::addAdmin($username, $password);
        }

        return $error;
    }

    public static function editAdmin($adminId, $username, $password)
    {
        $adminValidator = new BaseAdminValidator();

        $error = $adminValidator->validateEditAdmin($adminId, $username, $password);

        if(!$error->errorExists())
        {
            AdminLogicUtility::updateAdmin($adminId, $username, $password);
        }

        return $error;
    }

    public static function deleteAdmin($adminId)
    {
        AdminLogicUtility::deleteAdmin($adminId);
    }
}

?>
