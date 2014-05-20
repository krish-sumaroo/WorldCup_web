<?php

class BaseUsersValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddUsers($uid, $username, $nickname, $status, $teamId, $country, $password)
    {
        $this->checkEmptyError($uid, "Uid");
        $this->validateLength($uid, "Uid", BaseUsersLogicUtility::$UID_LIMIT);

        $this->checkEmptyError($username, "Username");
        $this->validateLength($username, "Username", BaseUsersLogicUtility::$USERNAME_LIMIT);

        $this->checkEmptyError($nickname, "Nickname");
        $this->validateLength($nickname, "Nickname", BaseUsersLogicUtility::$NICKNAME_LIMIT);

        $this->checkEmptyError($status, "Status");
        $this->validateLength($status, "Status", BaseUsersLogicUtility::$STATUS_LIMIT);

        $this->checkEmptyError($teamId, "TeamId");
        $this->validateLength($teamId, "TeamId", BaseUsersLogicUtility::$TEAMID_LIMIT);

        $this->validateLength($country, "Country", BaseUsersLogicUtility::$COUNTRY_LIMIT);

        $this->checkEmptyError($password, "Password");
        $this->validateLength($password, "Password", BaseUsersLogicUtility::$PASSWORD_LIMIT);


        return $this->error;
    }

    public function validateEditUsers($uid, $username, $nickname, $status, $teamId, $country, $password)
    {
        $this->checkEmptyError($uid, "Uid");
        $this->validateLength($uid, "Uid", BaseUsersLogicUtility::$UID_LIMIT);

        $this->checkEmptyError($username, "Username");
        $this->validateLength($username, "Username", BaseUsersLogicUtility::$USERNAME_LIMIT);

        $this->checkEmptyError($nickname, "Nickname");
        $this->validateLength($nickname, "Nickname", BaseUsersLogicUtility::$NICKNAME_LIMIT);

        $this->checkEmptyError($status, "Status");
        $this->validateLength($status, "Status", BaseUsersLogicUtility::$STATUS_LIMIT);

        $this->checkEmptyError($teamId, "TeamId");
        $this->validateLength($teamId, "TeamId", BaseUsersLogicUtility::$TEAMID_LIMIT);

        $this->validateLength($country, "Country", BaseUsersLogicUtility::$COUNTRY_LIMIT);

        $this->checkEmptyError($password, "Password");
        $this->validateLength($password, "Password", BaseUsersLogicUtility::$PASSWORD_LIMIT);


        return $this->error;
    }
}

?>
