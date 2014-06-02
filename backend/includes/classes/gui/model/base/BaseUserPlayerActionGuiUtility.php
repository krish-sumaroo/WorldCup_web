<?php

class BaseUserPlayerActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("UserPlayerAction");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddUserPlayerAction();\">Add UserPlayerAction</a>";
        $output .= "</div>";

        $output .= "<div id='userPlayerAction_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='userPlayerAction_list_con'>";
        $output .= BaseUserPlayerActionGuiUtility::getUserPlayerActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddUserPlayerAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("userPlayerAction", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_playerId'>PlayerId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_playerId' name='txt_playerId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_actionId'>ActionId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_actionId' name='txt_actionId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_userId'>UserId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_userId' name='txt_userId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_gameId'>GameId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_gameId' name='txt_gameId' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_userPlayerAction_con'></div>";

        $output .= "<div id='add_userPlayerAction_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addUserPlayerAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId)
    {
        $output = "";

        $error = UserPlayerActionManager::addUserPlayerAction($playerId, $actionId, $userId, $timestamp, $gameId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>UserPlayerAction has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddUserPlayerAction();\">Add another >UserPlayerAction</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_userPlayerAction_com').hide();";
            $resultMessage .= "reloadUserPlayerActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getUserPlayerActionList()
    {
        $output = "";

        $userPlayerActionList = BaseUserPlayerActionLogicUtility::getUserPlayerActionList();

        if(count($userPlayerActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>PlayerId</th>";
            $output .= "<th>ActionId</th>";
            $output .= "<th>UserId</th>";
            $output .= "<th>Timestamp</th>";
            $output .= "<th>GameId</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($userPlayerActionList); $i++)
            {
                $id = $userPlayerActionList[$i]->getId();
                $playerId = $userPlayerActionList[$i]->getPlayerId();
                $actionId = $userPlayerActionList[$i]->getActionId();
                $userId = $userPlayerActionList[$i]->getUserId();
                $timestamp = $userPlayerActionList[$i]->getTimestamp();
                $gameId = $userPlayerActionList[$i]->getGameId();

                $userPlayerActionLineContainerId = "userPlayerAction_line_con_".$id;
                $userPlayerActionActionLineContainerId = "userPlayerAction_action_line_con_".$id;
                $userPlayerActionActionContainerId = "userPlayerAction_action_con_".$id;

                $playerIdContainerId = "userPlayerAction_playerId_con_".$id;
                $actionIdContainerId = "userPlayerAction_actionId_con_".$id;
                $userIdContainerId = "userPlayerAction_userId_con_".$id;
                $timestampContainerId = "userPlayerAction_timestamp_con_".$id;
                $gameIdContainerId = "userPlayerAction_gameId_con_".$id;

                $output .= "<tr id='$userPlayerActionLineContainerId'>";
                $output .= "<td id='$playerIdContainerId'>$playerId</td>";
                $output .= "<td id='$actionIdContainerId'>$actionId</td>";
                $output .= "<td id='$userIdContainerId'>$userId</td>";
                $output .= "<td id='$timestampContainerId'>$timestamp</td>";
                $output .= "<td id='$gameIdContainerId'>$gameId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditUserPlayerAction('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteUserPlayerAction('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$userPlayerActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='6' id='$userPlayerActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for UserPlayerAction</p>";
        }

        return $output;
    }

    public static function clearAddUserPlayerAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_playerId').val('');";
        $output .= "$('#txt_actionId').val('');";
        $output .= "$('#txt_userId').val('');";
        $output .= "$('#txt_gameId').val('');";

        $output .= "$('#add_userPlayerAction_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditUserPlayerAction($id, $userId)
    {
        $output = "";

        $userPlayerActionEntity = BaseUserPlayerActionLogicUtility::getUserPlayerActionDetails($id, $userId);

        if($userPlayerActionEntity)
        {
            $userPlayerActionActionLineContainerId = "userPlayerAction_action_line_con_".$id;
            $userPlayerActionActionContainerId = "userPlayerAction_action_con_".$id;

            $editContainer = "userPlayerAction_edit_con_".$id;
            $editCommandContainer = "userPlayerAction_edit_com_".$id;

            $playerId = $userPlayerActionEntity->getPlayerId();
            $actionId = $userPlayerActionEntity->getActionId();
            $userId = $userPlayerActionEntity->getUserId();
            $timestamp = $userPlayerActionEntity->getTimestamp();
            $gameId = $userPlayerActionEntity->getGameId();

            $playerIdContainer = "userPlayerAction_txt_playerId_".$id;
            $actionIdContainer = "userPlayerAction_txt_actionId_".$id;
            $userIdContainer = "userPlayerAction_txt_userId_".$id;
            $timestampContainer = "userPlayerAction_txt_timestamp_".$id;
            $gameIdContainer = "userPlayerAction_txt_gameId_".$id;

            $output .= "<h2 class='text-center'>Edit UserPlayerAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$playerIdContainer'>PlayerId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$playerIdContainer' name='$playerIdContainer' value=\"$playerId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$actionIdContainer'>ActionId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$actionIdContainer' name='$actionIdContainer' value=\"$actionId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$userIdContainer'>UserId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$userIdContainer' name='$userIdContainer' value=\"$userId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$gameIdContainer'>GameId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$gameIdContainer' name='$gameIdContainer' value=\"$gameId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editUserPlayerAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$userPlayerActionActionContainerId').html('');$('#$userPlayerActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editUserPlayerAction($id, $playerId, $actionId, $userId, $timestamp, $gameId)
    {
        $output = "";

        $error = UserPlayerActionManager::editUserPlayerAction($id, $playerId, $actionId, $userId, $timestamp, $gameId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $userPlayerActionActionLineContainerId = "userPlayerAction_action_line_con_".$id;
            $userPlayerActionActionContainerId = "userPlayerAction_action_con_".$id;

            $editCommandContainer = "userPlayerAction_edit_com_".$id;

            $playerIdContainer = "userPlayerAction_txt_playerId_".$id;
            $actionIdContainer = "userPlayerAction_txt_actionId_".$id;
            $userIdContainer = "userPlayerAction_txt_userId_".$id;
            $timestampContainer = "userPlayerAction_txt_timestamp_".$id;
            $gameIdContainer = "userPlayerAction_txt_gameId_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>UserPlayerAction has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$userPlayerActionActionContainerId').html('');$('#$userPlayerActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$playerIdContainer').html(\"playerId\");";
            $resultMessage .= "$('#$actionIdContainer').html(\"actionId\");";
            $resultMessage .= "$('#$userIdContainer').html(\"userId\");";
            $resultMessage .= "$('#$timestampContainer').html(\"timestamp\");";
            $resultMessage .= "$('#$gameIdContainer').html(\"gameId\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteUserPlayerAction($id)
    {
        $output = "";

        $userPlayerActionActionLineContainerId = "userPlayerAction_action_line_con_".$id;
        $userPlayerActionActionContainerId = "userPlayerAction_action_con_".$id;
        $userPlayerActionDeleteActionContainerId = "userPlayerAction_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this UserPlayerAction ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$userPlayerActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteUserPlayerAction('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$userPlayerActionActionContainerId').html('');$('#$userPlayerActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteUserPlayerAction($id)
    {
        $output = "";

        UserPlayerActionManager::editUserPlayerAction($id);

        $userPlayerActionLineContainerId = "userPlayerAction_line_con_".$id;
        $userPlayerActionActionLineContainerId = "userPlayerAction_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$userPlayerActionLineContainerId').hide();";
        $output .= "$('#$userPlayerActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getUserPlayerActionCombo($comboId = "cbo_userPlayerAction", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $userPlayerActionList = BaseUserPlayerActionLogicUtility::getUserPlayerActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($userPlayerActionList); $i++)
        {
            $id = $userPlayerActionList[$i]->getId();

            $selected = "";

            if($selectedValue == $id)
            {
                $selected = "selected";
            }

            $output .= "<option selected='$selected' value='$id'>$id</option>";
        }

        $output .= "</select>";

        return $output;
    }
}

?>
