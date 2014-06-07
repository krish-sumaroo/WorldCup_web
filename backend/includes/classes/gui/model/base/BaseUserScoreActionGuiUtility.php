<?php

class BaseUserScoreActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("UserScoreAction");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddUserScoreAction();\">Add UserScoreAction</a>";
        $output .= "</div>";

        $output .= "<div id='userScoreAction_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='userScoreAction_list_con'>";
        $output .= BaseUserScoreActionGuiUtility::getUserScoreActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddUserScoreAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("userScoreAction", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_gameId'>GameId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_gameId' name='txt_gameId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_team1Id'>Team1Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_team1Id' name='txt_team1Id' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_team1Score'>Team1Score *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_team1Score' name='txt_team1Score' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_team2Score'>Team2Score *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_team2Score' name='txt_team2Score' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_team2Id'>Team2Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_team2Id' name='txt_team2Id' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_userId'>UserId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_userId' name='txt_userId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_points'>Points *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_points' name='txt_points' placeholder='Points' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_status'>Status *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_status' name='txt_status' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_userScoreAction_con'></div>";

        $output .= "<div id='add_userScoreAction_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addUserScoreAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $output = "";

        $error = UserScoreActionManager::addUserScoreAction($gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>UserScoreAction has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddUserScoreAction();\">Add another >UserScoreAction</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_userScoreAction_com').hide();";
            $resultMessage .= "reloadUserScoreActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getUserScoreActionList()
    {
        $output = "";

        $userScoreActionList = BaseUserScoreActionLogicUtility::getUserScoreActionList();

        if(count($userScoreActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>GameId</th>";
            $output .= "<th>Team1Id</th>";
            $output .= "<th>Team1Score</th>";
            $output .= "<th>Team2Score</th>";
            $output .= "<th>Team2Id</th>";
            $output .= "<th>UserId</th>";
            $output .= "<th>Timestamp</th>";
            $output .= "<th>Points</th>";
            $output .= "<th>Status</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($userScoreActionList); $i++)
            {
                $id = $userScoreActionList[$i]->getId();
                $gameId = $userScoreActionList[$i]->getGameId();
                $team1Id = $userScoreActionList[$i]->getTeam1Id();
                $team1Score = $userScoreActionList[$i]->getTeam1Score();
                $team2Score = $userScoreActionList[$i]->getTeam2Score();
                $team2Id = $userScoreActionList[$i]->getTeam2Id();
                $userId = $userScoreActionList[$i]->getUserId();
                $timestamp = $userScoreActionList[$i]->getTimestamp();
                $points = $userScoreActionList[$i]->getPoints();
                $status = $userScoreActionList[$i]->getStatus();

                $userScoreActionLineContainerId = "userScoreAction_line_con_".$id;
                $userScoreActionActionLineContainerId = "userScoreAction_action_line_con_".$id;
                $userScoreActionActionContainerId = "userScoreAction_action_con_".$id;

                $gameIdContainerId = "userScoreAction_gameId_con_".$id;
                $team1IdContainerId = "userScoreAction_team1Id_con_".$id;
                $team1ScoreContainerId = "userScoreAction_team1Score_con_".$id;
                $team2ScoreContainerId = "userScoreAction_team2Score_con_".$id;
                $team2IdContainerId = "userScoreAction_team2Id_con_".$id;
                $userIdContainerId = "userScoreAction_userId_con_".$id;
                $timestampContainerId = "userScoreAction_timestamp_con_".$id;
                $pointsContainerId = "userScoreAction_points_con_".$id;
                $statusContainerId = "userScoreAction_status_con_".$id;

                $output .= "<tr id='$userScoreActionLineContainerId'>";
                $output .= "<td id='$gameIdContainerId'>$gameId</td>";
                $output .= "<td id='$team1IdContainerId'>$team1Id</td>";
                $output .= "<td id='$team1ScoreContainerId'>$team1Score</td>";
                $output .= "<td id='$team2ScoreContainerId'>$team2Score</td>";
                $output .= "<td id='$team2IdContainerId'>$team2Id</td>";
                $output .= "<td id='$userIdContainerId'>$userId</td>";
                $output .= "<td id='$timestampContainerId'>$timestamp</td>";
                $output .= "<td id='$pointsContainerId'>$points</td>";
                $output .= "<td id='$statusContainerId'>$status</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditUserScoreAction('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteUserScoreAction('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$userScoreActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='10' id='$userScoreActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for UserScoreAction</p>";
        }

        return $output;
    }

    public static function clearAddUserScoreAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_gameId').val('');";
        $output .= "$('#txt_team1Id').val('');";
        $output .= "$('#txt_team1Score').val('');";
        $output .= "$('#txt_team2Score').val('');";
        $output .= "$('#txt_team2Id').val('');";
        $output .= "$('#txt_userId').val('');";
        $output .= "$('#txt_points').val('');";
        $output .= "$('#txt_status').val('');";

        $output .= "$('#add_userScoreAction_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditUserScoreAction($id, $userId)
    {
        $output = "";

        $userScoreActionEntity = BaseUserScoreActionLogicUtility::getUserScoreActionDetails($id, $userId);

        if($userScoreActionEntity)
        {
            $userScoreActionActionLineContainerId = "userScoreAction_action_line_con_".$id;
            $userScoreActionActionContainerId = "userScoreAction_action_con_".$id;

            $editContainer = "userScoreAction_edit_con_".$id;
            $editCommandContainer = "userScoreAction_edit_com_".$id;

            $gameId = $userScoreActionEntity->getGameId();
            $team1Id = $userScoreActionEntity->getTeam1Id();
            $team1Score = $userScoreActionEntity->getTeam1Score();
            $team2Score = $userScoreActionEntity->getTeam2Score();
            $team2Id = $userScoreActionEntity->getTeam2Id();
            $userId = $userScoreActionEntity->getUserId();
            $timestamp = $userScoreActionEntity->getTimestamp();
            $points = $userScoreActionEntity->getPoints();
            $status = $userScoreActionEntity->getStatus();

            $gameIdContainer = "userScoreAction_txt_gameId_".$id;
            $team1IdContainer = "userScoreAction_txt_team1Id_".$id;
            $team1ScoreContainer = "userScoreAction_txt_team1Score_".$id;
            $team2ScoreContainer = "userScoreAction_txt_team2Score_".$id;
            $team2IdContainer = "userScoreAction_txt_team2Id_".$id;
            $userIdContainer = "userScoreAction_txt_userId_".$id;
            $timestampContainer = "userScoreAction_txt_timestamp_".$id;
            $pointsContainer = "userScoreAction_txt_points_".$id;
            $statusContainer = "userScoreAction_txt_status_".$id;

            $output .= "<h2 class='text-center'>Edit UserScoreAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$gameIdContainer'>GameId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$gameIdContainer' name='$gameIdContainer' value=\"$gameId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$team1IdContainer'>Team1Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$team1IdContainer' name='$team1IdContainer' value=\"$team1Id\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$team1ScoreContainer'>Team1Score *</label>";
            $output .= "<input class='form-control span12' type='text' id='$team1ScoreContainer' name='$team1ScoreContainer' value=\"$team1Score\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$team2ScoreContainer'>Team2Score *</label>";
            $output .= "<input class='form-control span12' type='text' id='$team2ScoreContainer' name='$team2ScoreContainer' value=\"$team2Score\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$team2IdContainer'>Team2Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$team2IdContainer' name='$team2IdContainer' value=\"$team2Id\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$userIdContainer'>UserId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$userIdContainer' name='$userIdContainer' value=\"$userId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$pointsContainer'>Points *</label>";
            $output .= "<input class='form-control span12' type='text' id='$pointsContainer' name='$pointsContainer' placeholder='Points' value=\"$points\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$statusContainer'>Status *</label>";
            $output .= "<input class='form-control span12' type='text' id='$statusContainer' name='$statusContainer' value=\"$status\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editUserScoreAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$userScoreActionActionContainerId').html('');$('#$userScoreActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editUserScoreAction($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status)
    {
        $output = "";

        $error = UserScoreActionManager::editUserScoreAction($id, $gameId, $team1Id, $team1Score, $team2Score, $team2Id, $userId, $timestamp, $points, $status);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $userScoreActionActionLineContainerId = "userScoreAction_action_line_con_".$id;
            $userScoreActionActionContainerId = "userScoreAction_action_con_".$id;

            $editCommandContainer = "userScoreAction_edit_com_".$id;

            $gameIdContainer = "userScoreAction_txt_gameId_".$id;
            $team1IdContainer = "userScoreAction_txt_team1Id_".$id;
            $team1ScoreContainer = "userScoreAction_txt_team1Score_".$id;
            $team2ScoreContainer = "userScoreAction_txt_team2Score_".$id;
            $team2IdContainer = "userScoreAction_txt_team2Id_".$id;
            $userIdContainer = "userScoreAction_txt_userId_".$id;
            $timestampContainer = "userScoreAction_txt_timestamp_".$id;
            $pointsContainer = "userScoreAction_txt_points_".$id;
            $statusContainer = "userScoreAction_txt_status_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>UserScoreAction has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$userScoreActionActionContainerId').html('');$('#$userScoreActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$gameIdContainer').html(\"gameId\");";
            $resultMessage .= "$('#$team1IdContainer').html(\"team1Id\");";
            $resultMessage .= "$('#$team1ScoreContainer').html(\"team1Score\");";
            $resultMessage .= "$('#$team2ScoreContainer').html(\"team2Score\");";
            $resultMessage .= "$('#$team2IdContainer').html(\"team2Id\");";
            $resultMessage .= "$('#$userIdContainer').html(\"userId\");";
            $resultMessage .= "$('#$timestampContainer').html(\"timestamp\");";
            $resultMessage .= "$('#$pointsContainer').html(\"points\");";
            $resultMessage .= "$('#$statusContainer').html(\"status\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteUserScoreAction($id)
    {
        $output = "";

        $userScoreActionActionLineContainerId = "userScoreAction_action_line_con_".$id;
        $userScoreActionActionContainerId = "userScoreAction_action_con_".$id;
        $userScoreActionDeleteActionContainerId = "userScoreAction_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this UserScoreAction ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$userScoreActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteUserScoreAction('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$userScoreActionActionContainerId').html('');$('#$userScoreActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteUserScoreAction($id)
    {
        $output = "";

        UserScoreActionManager::editUserScoreAction($id);

        $userScoreActionLineContainerId = "userScoreAction_line_con_".$id;
        $userScoreActionActionLineContainerId = "userScoreAction_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$userScoreActionLineContainerId').hide();";
        $output .= "$('#$userScoreActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getUserScoreActionCombo($comboId = "cbo_userScoreAction", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $userScoreActionList = BaseUserScoreActionLogicUtility::getUserScoreActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($userScoreActionList); $i++)
        {
            $id = $userScoreActionList[$i]->getId();

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
