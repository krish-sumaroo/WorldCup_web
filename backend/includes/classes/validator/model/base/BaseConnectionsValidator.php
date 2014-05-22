<?php

class BaseConnectionsValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddConnections($user1, $user2, $status)
    {
        $this->checkEmptyError($user1, "User1");
        $this->validateLength($user1, "User1", BaseConnectionsLogicUtility::$USER1_LIMIT);

        $this->checkEmptyError($user2, "User2");
        $this->validateLength($user2, "User2", BaseConnectionsLogicUtility::$USER2_LIMIT);

        $this->checkEmptyError($status, "Status");
        $this->validateLength($status, "Status", BaseConnectionsLogicUtility::$STATUS_LIMIT);


        return $this->error;
    }

    public function validateEditConnections($user1, $user2, $status)
    {
        $this->checkEmptyError($user1, "User1");
        $this->validateLength($user1, "User1", BaseConnectionsLogicUtility::$USER1_LIMIT);

        $this->checkEmptyError($user2, "User2");
        $this->validateLength($user2, "User2", BaseConnectionsLogicUtility::$USER2_LIMIT);

        $this->checkEmptyError($status, "Status");
        $this->validateLength($status, "Status", BaseConnectionsLogicUtility::$STATUS_LIMIT);


        return $this->error;
    }
}

?>
