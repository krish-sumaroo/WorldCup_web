<?php

class ConnectionsManager
{
    public static function addConnections($user1, $user2, $status)
    {
        $connectionsValidator = new BaseConnectionsValidator();

        $error = $connectionsValidator->validateAddConnections($user1, $user2, $status);

        if(!$error->errorExists())
        {
            ConnectionsLogicUtility::addConnections($user1, $user2, $status);
        }

        return $error;
    }

    public static function editConnections($user1, $user2, $status)
    {
        $connectionsValidator = new BaseConnectionsValidator();

        $error = $connectionsValidator->validateEditConnections($user1, $user2, $status);

        if(!$error->errorExists())
        {
            ConnectionsLogicUtility::updateConnections($user1, $user2, $status);
        }

        return $error;
    }

    public static function deleteConnections()
    {
        ConnectionsLogicUtility::deleteConnections();
    }
}

?>
