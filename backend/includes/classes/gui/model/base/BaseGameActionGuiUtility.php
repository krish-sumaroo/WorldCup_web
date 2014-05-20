<?php

class BaseGameActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Game Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddGameAction();\">Add Game Action</a>";
        $output .= "</div>";

        $output .= "<div id='game_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='game_action_list_con'>";
        $output .= BaseGameActionGuiUtility::getGameActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddGameAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("game_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_game_id'>Fk Game Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_game_id' name='txt_fk_game_id' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_user_id'>Fk User Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_user_id' name='txt_fk_user_id' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_action_minute'>Action Minute *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_action_minute' name='txt_action_minute' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= DateGuiUtility::getTimeChooser("action_date");
        $output .= "<input class='form-control span12' type='text' id='txt_action_date' name='txt_action_date' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= DateGuiUtility::getTimeChooser("action_automatic_date");
        $output .= "<input class='form-control span12' type='text' id='txt_action_automatic_date' name='txt_action_automatic_date' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='cbo_action_type'>Action Type *</label>";
        $output .= BaseGameActionGuiUtility::getActionTypeCombo();
        $output .= "</div>";


        $output .= "<div id='add_game_action_con'></div>";

        $output .= "<div id='add_game_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addGameAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        $output .= DateGuiUtility::getJQueryDatePicker("txt_action_date");
        $output .= DateGuiUtility::getJQueryDatePicker("txt_action_automatic_date");
        return $output;
    }

    public static function addGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType)
    {
        $output = "";

        $error = GameActionManager::addGameAction($fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Game Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddGameAction();\">Add another >Game Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_game_action_com').hide();";
            $resultMessage .= "reloadGameActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getGameActionList()
    {
        $output = "";

        $gameActionList = BaseGameActionLogicUtility::getGameActionList();

        if(count($gameActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Id</th>";
            $output .= "<th>Fk User Id</th>";
            $output .= "<th>Action Minute</th>";
            $output .= "<th>Action Date</th>";
            $output .= "<th>Action Automatic Date</th>";
            $output .= "<th>Action Type</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($gameActionList); $i++)
            {
                $gameActionId = $gameActionList[$i]->getGameActionId();
                $fkGameId = $gameActionList[$i]->getFkGameId();
                $fkUserId = $gameActionList[$i]->getFkUserId();
                $actionMinute = $gameActionList[$i]->getActionMinute();
                $actionDate = $gameActionList[$i]->getActionDate();
                $actionAutomaticDate = $gameActionList[$i]->getActionAutomaticDate();
                $actionType = $gameActionList[$i]->getActionType();

                $gameActionLineContainerId = "game_action_line_con_".$gameActionId;
                $gameActionActionLineContainerId = "game_action_action_line_con_".$gameActionId;
                $gameActionActionContainerId = "game_action_action_con_".$gameActionId;

                $fkGameIdContainerId = "game_action_fk_game_id_con_".$gameActionId;
                $fkUserIdContainerId = "game_action_fk_user_id_con_".$gameActionId;
                $actionMinuteContainerId = "game_action_action_minute_con_".$gameActionId;
                $actionDateContainerId = "game_action_action_date_con_".$gameActionId;
                $actionAutomaticDateContainerId = "game_action_action_automatic_date_con_".$gameActionId;
                $actionTypeContainerId = "game_action_action_type_con_".$gameActionId;

                $output .= "<tr id='$gameActionLineContainerId'>";
                $output .= "<td id='$fkGameIdContainerId'>$fkGameId</td>";
                $output .= "<td id='$fkUserIdContainerId'>$fkUserId</td>";
                $output .= "<td id='$actionMinuteContainerId'>$actionMinute</td>";
                $output .= "<td id='$actionDateContainerId'>$actionDate</td>";
                $output .= "<td id='$actionAutomaticDateContainerId'>$actionAutomaticDate</td>";
                $output .= "<td id='$actionTypeContainerId'>$actionType</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditGameAction('$gameActionId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteGameAction('$gameActionId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$gameActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='7' id='$gameActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Game Action</p>";
        }

        return $output;
    }

    public static function clearAddGameAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_fk_game_id').val('');";
        $output .= "$('#txt_fk_user_id').val('');";
        $output .= "$('#txt_action_minute').val('');";

        $output .= "$('#add_game_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditGameAction($gameActionId, $userId)
    {
        $output = "";

        $gameActionEntity = BaseGameActionLogicUtility::getGameActionDetails($gameActionId, $userId);

        if($gameActionEntity)
        {
            $gameActionActionLineContainerId = "game_action_action_line_con_".$gameActionId;
            $gameActionActionContainerId = "game_action_action_con_".$gameActionId;

            $editContainer = "game_action_edit_con_".$gameActionId;
            $editCommandContainer = "game_action_edit_com_".$gameActionId;

            $fkGameId = $gameActionEntity->getFkGameId();
            $fkUserId = $gameActionEntity->getFkUserId();
            $actionMinute = $gameActionEntity->getActionMinute();
            $actionDate = $gameActionEntity->getActionDate();
            $actionAutomaticDate = $gameActionEntity->getActionAutomaticDate();
            $actionType = $gameActionEntity->getActionType();

            $fkGameIdContainer = "game_action_txt_fk_game_id_".$gameActionId;
            $fkUserIdContainer = "game_action_txt_fk_user_id_".$gameActionId;
            $actionMinuteContainer = "game_action_txt_action_minute_".$gameActionId;
            $actionDateContainer = "game_action_txt_action_date_".$gameActionId;
            $actionAutomaticDateContainer = "game_action_txt_action_automatic_date_".$gameActionId;
            $actionTypeContainer = "game_action_txt_action_type_".$gameActionId;

            $output .= "<h2 class='text-center'>Edit GameAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkGameIdContainer'>Fk Game Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkGameIdContainer' name='$fkGameIdContainer' value=\"$fkGameId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkUserIdContainer'>Fk User Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkUserIdContainer' name='$fkUserIdContainer' value=\"$fkUserId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$actionMinuteContainer'>Action Minute *</label>";
            $output .= "<input class='form-control span12' type='text' id='$actionMinuteContainer' name='$actionMinuteContainer' value=\"$actionMinute\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= DateGuiUtility::getTimeChooser("action_date_".$gameActionId);
            $output .= "<input class='form-control span12' type='text' id='$actionDateContainer' name='$actionDateContainer' value=\"$actionDate\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= DateGuiUtility::getTimeChooser("action_automatic_date_".$gameActionId);
            $output .= "<input class='form-control span12' type='text' id='$actionAutomaticDateContainer' name='$actionAutomaticDateContainer' value=\"$actionAutomaticDate\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$actionTypeContainer'>Action Type *</label>";
            $output .= BaseGameActionGuiUtility::getActionTypeCombo($actionType);
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editGameAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$gameActionActionContainerId').html('');$('#$gameActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

            $output .= DateGuiUtility::getJQueryDatePicker($actionDateContainer);
            $output .= DateGuiUtility::getJQueryDatePicker($actionAutomaticDateContainer);
        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editGameAction($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType)
    {
        $output = "";

        $error = GameActionManager::editGameAction($gameActionId, $fkGameId, $fkUserId, $actionMinute, $actionDate, $actionAutomaticDate, $actionType);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $gameActionActionLineContainerId = "game_action_action_line_con_".$gameActionId;
            $gameActionActionContainerId = "game_action_action_con_".$gameActionId;

            $editCommandContainer = "game_action_edit_com_".$gameActionId;

            $fkGameIdContainer = "game_action_txt_fk_game_id_".$gameActionId;
            $fkUserIdContainer = "game_action_txt_fk_user_id_".$gameActionId;
            $actionMinuteContainer = "game_action_txt_action_minute_".$gameActionId;
            $actionDateContainer = "game_action_txt_action_date_".$gameActionId;
            $actionAutomaticDateContainer = "game_action_txt_action_automatic_date_".$gameActionId;
            $actionTypeContainer = "game_action_txt_action_type_".$gameActionId;

            $resultMessage = "";
            $resultMessage .= "<p>Game Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$gameActionActionContainerId').html('');$('#$gameActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$fkGameIdContainer').html(\"fkGameId\");";
            $resultMessage .= "$('#$fkUserIdContainer').html(\"fkUserId\");";
            $resultMessage .= "$('#$actionMinuteContainer').html(\"actionMinute\");";
            $resultMessage .= "$('#$actionDateContainer').html(\"actionDate\");";
            $resultMessage .= "$('#$actionAutomaticDateContainer').html(\"actionAutomaticDate\");";
            $resultMessage .= "$('#$actionTypeContainer').html(\"actionType\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteGameAction($gameActionId)
    {
        $output = "";

        $gameActionActionLineContainerId = "game_action_action_line_con_".$gameActionId;
        $gameActionActionContainerId = "game_action_action_con_".$gameActionId;
        $gameActionDeleteActionContainerId = "game_action_delete_con_".$gameActionId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Game Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$gameActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteGameAction('$gameActionId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$gameActionActionContainerId').html('');$('#$gameActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteGameAction($gameActionId)
    {
        $output = "";

        GameActionManager::editGameAction($gameActionId);

        $gameActionLineContainerId = "game_action_line_con_".$gameActionId;
        $gameActionActionLineContainerId = "game_action_action_line_con_".$gameActionId;

        $output .= "<script>";
        $output .= "$('#$gameActionLineContainerId').hide();";
        $output .= "$('#$gameActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }

    public static function getActionTypeCombo($comboId = "cbo_action_type", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $actionTypeRedCard = BaseGameActionLogicUtility::$ACTION_TYPE_RED_CARD;
        $actionTypeYellowCard = BaseGameActionLogicUtility::$ACTION_TYPE_YELLOW_CARD;
        $actionTypePlayerScore = BaseGameActionLogicUtility::$ACTION_TYPE_PLAYER_SCORE;
        $actionTypeTeamAction = BaseGameActionLogicUtility::$ACTION_TYPE_TEAM_ACTION;

        $actionTypeRedCardDisplay = ucfirst($actionTypeRedCard);
        $actionTypeYellowCardDisplay = ucfirst($actionTypeYellowCard);
        $actionTypePlayerScoreDisplay = ucfirst($actionTypePlayerScore);
        $actionTypeTeamActionDisplay = ucfirst($actionTypeTeamAction);

        $selectedActionTypeRedCard = "";
        $selectedActionTypeYellowCard = "";
        $selectedActionTypePlayerScore = "";
        $selectedActionTypeTeamAction = "";

        if($selectedValue == $actionTypeRedCard)
        {
            $selectedActionTypeRedCard = "selected";
        }
        elseif($selectedValue == $actionTypeYellowCard)
        {
            $selectedActionTypeYellowCard = "selected";
        }
        elseif($selectedValue == $actionTypePlayerScore)
        {
            $selectedActionTypePlayerScore = "selected";
        }
        elseif($selectedValue == $actionTypeTeamAction)
        {
            $selectedActionTypeTeamAction = "selected";
        }

        $output .= "<select id='$comboId' name='$comboId' class='form-control span12' onchance=\"$onclickAction\">";
        $output .= "<option value = '$actionTypeRedCard' $selectedActionTypeRedCard>$actionTypeRedCardDisplay</option>";
        $output .= "<option value = '$actionTypeYellowCard' $selectedActionTypeYellowCard>$actionTypeYellowCardDisplay</option>";
        $output .= "<option value = '$actionTypePlayerScore' $selectedActionTypePlayerScore>$actionTypePlayerScoreDisplay</option>";
        $output .= "<option value = '$actionTypeTeamAction' $selectedActionTypeTeamAction>$actionTypeTeamActionDisplay</option>";
        $output .= "</select>";

        return $output;
    }

    public static function getGameActionCombo($comboId = "cbo_game_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $gameActionList = BaseGameActionLogicUtility::getGameActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($gameActionList); $i++)
        {
            $gameActionId = $gameActionList[$i]->getGameActionId();

            $selected = "";

            if($selectedValue == $gameActionId)
            {
                $selected = "selected";
            }

            $output .= "<option selected='$selected' value='$gameActionId'>$gameActionId</option>";
        }

        $output .= "</select>";

        return $output;
    }
}

?>
