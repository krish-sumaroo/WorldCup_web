<?php

class BaseTeamActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Team Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddTeamAction();\">Add Team Action</a>";
        $output .= "</div>";

        $output .= "<div id='team_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='team_action_list_con'>";
        $output .= BaseTeamActionGuiUtility::getTeamActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddTeamAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("team_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_team_id'>Fk Team Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_team_id' name='txt_fk_team_id' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='cbo_team_action_type'>Team Action Type *</label>";
        $output .= BaseTeamActionGuiUtility::getTeamActionTypeCombo();
        $output .= "</div>";


        $output .= "<div id='add_team_action_con'></div>";

        $output .= "<div id='add_team_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addTeamAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addTeamAction($fkGameActionId, $fkTeamId, $teamActionType)
    {
        $output = "";

        $error = TeamActionManager::addTeamAction($fkGameActionId, $fkTeamId, $teamActionType);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Team Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddTeamAction();\">Add another >Team Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_team_action_com').hide();";
            $resultMessage .= "reloadTeamActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getTeamActionList()
    {
        $output = "";

        $teamActionList = BaseTeamActionLogicUtility::getTeamActionList();

        if(count($teamActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk Team Id</th>";
            $output .= "<th>Team Action Type</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($teamActionList); $i++)
            {
                $fkGameActionId = $teamActionList[$i]->getFkGameActionId();
                $fkTeamId = $teamActionList[$i]->getFkTeamId();
                $teamActionType = $teamActionList[$i]->getTeamActionType();

                $teamActionLineContainerId = "team_action_line_con_".$fkGameActionId;
                $teamActionActionLineContainerId = "team_action_action_line_con_".$fkGameActionId;
                $teamActionActionContainerId = "team_action_action_con_".$fkGameActionId;

                $fkGameActionIdContainerId = "team_action_fk_game_action_id_con_".$fkGameActionId;
                $fkTeamIdContainerId = "team_action_fk_team_id_con_".$fkGameActionId;
                $teamActionTypeContainerId = "team_action_team_action_type_con_".$fkGameActionId;

                $output .= "<tr id='$teamActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkTeamIdContainerId'>$fkTeamId</td>";
                $output .= "<td id='$teamActionTypeContainerId'>$teamActionType</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditTeamAction('$fkGameActionId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteTeamAction('$fkGameActionId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$teamActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='3' id='$teamActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Team Action</p>";
        }

        return $output;
    }

    public static function clearAddTeamAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_fk_team_id').val('');";

        $output .= "$('#add_team_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditTeamAction($fkGameActionId, $userId)
    {
        $output = "";

        $teamActionEntity = BaseTeamActionLogicUtility::getTeamActionDetails($fkGameActionId, $userId);

        if($teamActionEntity)
        {
            $teamActionActionLineContainerId = "team_action_action_line_con_".$fkGameActionId;
            $teamActionActionContainerId = "team_action_action_con_".$fkGameActionId;

            $editContainer = "team_action_edit_con_".$fkGameActionId;
            $editCommandContainer = "team_action_edit_com_".$fkGameActionId;

            $fkGameActionId = $teamActionEntity->getFkGameActionId();
            $fkTeamId = $teamActionEntity->getFkTeamId();
            $teamActionType = $teamActionEntity->getTeamActionType();

            $fkGameActionIdContainer = "team_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkTeamIdContainer = "team_action_txt_fk_team_id_".$fkGameActionId;
            $teamActionTypeContainer = "team_action_txt_team_action_type_".$fkGameActionId;

            $output .= "<h2 class='text-center'>Edit TeamAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkTeamIdContainer'>Fk Team Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkTeamIdContainer' name='$fkTeamIdContainer' value=\"$fkTeamId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$teamActionTypeContainer'>Team Action Type *</label>";
            $output .= BaseTeamActionGuiUtility::getTeamActionTypeCombo($teamActionType);
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editTeamAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$teamActionActionContainerId').html('');$('#$teamActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editTeamAction($fkGameActionId, $fkTeamId, $teamActionType)
    {
        $output = "";

        $error = TeamActionManager::editTeamAction($fkGameActionId, $fkTeamId, $teamActionType);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $teamActionActionLineContainerId = "team_action_action_line_con_".$fkGameActionId;
            $teamActionActionContainerId = "team_action_action_con_".$fkGameActionId;

            $editCommandContainer = "team_action_edit_com_".$fkGameActionId;

            $fkGameActionIdContainer = "team_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkTeamIdContainer = "team_action_txt_fk_team_id_".$fkGameActionId;
            $teamActionTypeContainer = "team_action_txt_team_action_type_".$fkGameActionId;

            $resultMessage = "";
            $resultMessage .= "<p>Team Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$teamActionActionContainerId').html('');$('#$teamActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$fkGameActionIdContainer').html(\"fkGameActionId\");";
            $resultMessage .= "$('#$fkTeamIdContainer').html(\"fkTeamId\");";
            $resultMessage .= "$('#$teamActionTypeContainer').html(\"teamActionType\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteTeamAction($fkGameActionId)
    {
        $output = "";

        $teamActionActionLineContainerId = "team_action_action_line_con_".$fkGameActionId;
        $teamActionActionContainerId = "team_action_action_con_".$fkGameActionId;
        $teamActionDeleteActionContainerId = "team_action_delete_con_".$fkGameActionId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Team Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$teamActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteTeamAction('$fkGameActionId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$teamActionActionContainerId').html('');$('#$teamActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteTeamAction($fkGameActionId)
    {
        $output = "";

        TeamActionManager::editTeamAction($fkGameActionId);

        $teamActionLineContainerId = "team_action_line_con_".$fkGameActionId;
        $teamActionActionLineContainerId = "team_action_action_line_con_".$fkGameActionId;

        $output .= "<script>";
        $output .= "$('#$teamActionLineContainerId').hide();";
        $output .= "$('#$teamActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }

    public static function getTeamActionTypeCombo($comboId = "cbo_team_action_type", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $teamActionTypeWin = BaseTeamActionLogicUtility::$TEAM_ACTION_TYPE_WIN;
        $teamActionTypeLose = BaseTeamActionLogicUtility::$TEAM_ACTION_TYPE_LOSE;
        $teamActionTypeDraw = BaseTeamActionLogicUtility::$TEAM_ACTION_TYPE_DRAW;

        $teamActionTypeWinDisplay = ucfirst($teamActionTypeWin);
        $teamActionTypeLoseDisplay = ucfirst($teamActionTypeLose);
        $teamActionTypeDrawDisplay = ucfirst($teamActionTypeDraw);

        $selectedTeamActionTypeWin = "";
        $selectedTeamActionTypeLose = "";
        $selectedTeamActionTypeDraw = "";

        if($selectedValue == $teamActionTypeWin)
        {
            $selectedTeamActionTypeWin = "selected";
        }
        elseif($selectedValue == $teamActionTypeLose)
        {
            $selectedTeamActionTypeLose = "selected";
        }
        elseif($selectedValue == $teamActionTypeDraw)
        {
            $selectedTeamActionTypeDraw = "selected";
        }

        $output .= "<select id='$comboId' name='$comboId' class='form-control span12' onchance=\"$onclickAction\">";
        $output .= "<option value = '$teamActionTypeWin' $selectedTeamActionTypeWin>$teamActionTypeWinDisplay</option>";
        $output .= "<option value = '$teamActionTypeLose' $selectedTeamActionTypeLose>$teamActionTypeLoseDisplay</option>";
        $output .= "<option value = '$teamActionTypeDraw' $selectedTeamActionTypeDraw>$teamActionTypeDrawDisplay</option>";
        $output .= "</select>";

        return $output;
    }

    public static function getTeamActionCombo($comboId = "cbo_team_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $teamActionList = BaseTeamActionLogicUtility::getTeamActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($teamActionList); $i++)
        {
            $fkGameActionId = $teamActionList[$i]->getFkGameActionId();

            $selected = "";

            if($selectedValue == $fkGameActionId)
            {
                $selected = "selected";
            }

            $output .= "<option selected='$selected' value='$fkGameActionId'>$fkGameActionId</option>";
        }

        $output .= "</select>";

        return $output;
    }
}

?>
