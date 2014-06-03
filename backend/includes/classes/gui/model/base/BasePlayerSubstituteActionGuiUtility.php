<?php

class BasePlayerSubstituteActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Player Substitute Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddPlayerSubstituteAction();\">Add Player Substitute Action</a>";
        $output .= "</div>";

        $output .= "<div id='player_substitute_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='player_substitute_action_list_con'>";
        $output .= BasePlayerSubstituteActionGuiUtility::getPlayerSubstituteActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddPlayerSubstituteAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("player_substitute_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_player_id'>Fk Player Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_player_id' name='txt_fk_player_id' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_player_substitute_action_con'></div>";

        $output .= "<div id='add_player_substitute_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addPlayerSubstituteAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addPlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = PlayerSubstituteActionManager::addPlayerSubstituteAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Player Substitute Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddPlayerSubstituteAction();\">Add another >Player Substitute Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_player_substitute_action_com').hide();";
            $resultMessage .= "reloadPlayerSubstituteActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getPlayerSubstituteActionList()
    {
        $output = "";

        $playerSubstituteActionList = BasePlayerSubstituteActionLogicUtility::getPlayerSubstituteActionList();

        if(count($playerSubstituteActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk Player Id</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($playerSubstituteActionList); $i++)
            {
                $fkGameActionId = $playerSubstituteActionList[$i]->getFkGameActionId();
                $fkPlayerId = $playerSubstituteActionList[$i]->getFkPlayerId();

                $playerSubstituteActionLineContainerId = "player_substitute_action_line_con_".$fkGameActionId;
                $playerSubstituteActionActionLineContainerId = "player_substitute_action_action_line_con_".$fkGameActionId;
                $playerSubstituteActionActionContainerId = "player_substitute_action_action_con_".$fkGameActionId;

                $fkGameActionIdContainerId = "player_substitute_action_fk_game_action_id_con_".$fkGameActionId;
                $fkPlayerIdContainerId = "player_substitute_action_fk_player_id_con_".$fkGameActionId;

                $output .= "<tr id='$playerSubstituteActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkPlayerIdContainerId'>$fkPlayerId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditPlayerSubstituteAction('$fkGameActionId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeletePlayerSubstituteAction('$fkGameActionId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$playerSubstituteActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='2' id='$playerSubstituteActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Player Substitute Action</p>";
        }

        return $output;
    }

    public static function clearAddPlayerSubstituteAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_fk_player_id').val('');";

        $output .= "$('#add_player_substitute_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditPlayerSubstituteAction($fkGameActionId, $userId)
    {
        $output = "";

        $playerSubstituteActionEntity = BasePlayerSubstituteActionLogicUtility::getPlayerSubstituteActionDetails($fkGameActionId, $userId);

        if($playerSubstituteActionEntity)
        {
            $playerSubstituteActionActionLineContainerId = "player_substitute_action_action_line_con_".$fkGameActionId;
            $playerSubstituteActionActionContainerId = "player_substitute_action_action_con_".$fkGameActionId;

            $editContainer = "player_substitute_action_edit_con_".$fkGameActionId;
            $editCommandContainer = "player_substitute_action_edit_com_".$fkGameActionId;

            $fkGameActionId = $playerSubstituteActionEntity->getFkGameActionId();
            $fkPlayerId = $playerSubstituteActionEntity->getFkPlayerId();

            $fkGameActionIdContainer = "player_substitute_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "player_substitute_action_txt_fk_player_id_".$fkGameActionId;

            $output .= "<h2 class='text-center'>Edit PlayerSubstituteAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkPlayerIdContainer'>Fk Player Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkPlayerIdContainer' name='$fkPlayerIdContainer' value=\"$fkPlayerId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editPlayerSubstituteAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$playerSubstituteActionActionContainerId').html('');$('#$playerSubstituteActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editPlayerSubstituteAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = PlayerSubstituteActionManager::editPlayerSubstituteAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $playerSubstituteActionActionLineContainerId = "player_substitute_action_action_line_con_".$fkGameActionId;
            $playerSubstituteActionActionContainerId = "player_substitute_action_action_con_".$fkGameActionId;

            $editCommandContainer = "player_substitute_action_edit_com_".$fkGameActionId;

            $fkGameActionIdContainer = "player_substitute_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "player_substitute_action_txt_fk_player_id_".$fkGameActionId;

            $resultMessage = "";
            $resultMessage .= "<p>Player Substitute Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$playerSubstituteActionActionContainerId').html('');$('#$playerSubstituteActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$fkGameActionIdContainer').html(\"fkGameActionId\");";
            $resultMessage .= "$('#$fkPlayerIdContainer').html(\"fkPlayerId\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeletePlayerSubstituteAction($fkGameActionId)
    {
        $output = "";

        $playerSubstituteActionActionLineContainerId = "player_substitute_action_action_line_con_".$fkGameActionId;
        $playerSubstituteActionActionContainerId = "player_substitute_action_action_con_".$fkGameActionId;
        $playerSubstituteActionDeleteActionContainerId = "player_substitute_action_delete_con_".$fkGameActionId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Player Substitute Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$playerSubstituteActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deletePlayerSubstituteAction('$fkGameActionId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$playerSubstituteActionActionContainerId').html('');$('#$playerSubstituteActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deletePlayerSubstituteAction($fkGameActionId)
    {
        $output = "";

        PlayerSubstituteActionManager::editPlayerSubstituteAction($fkGameActionId);

        $playerSubstituteActionLineContainerId = "player_substitute_action_line_con_".$fkGameActionId;
        $playerSubstituteActionActionLineContainerId = "player_substitute_action_action_line_con_".$fkGameActionId;

        $output .= "<script>";
        $output .= "$('#$playerSubstituteActionLineContainerId').hide();";
        $output .= "$('#$playerSubstituteActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getPlayerSubstituteActionCombo($comboId = "cbo_player_substitute_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $playerSubstituteActionList = BasePlayerSubstituteActionLogicUtility::getPlayerSubstituteActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($playerSubstituteActionList); $i++)
        {
            $fkGameActionId = $playerSubstituteActionList[$i]->getFkGameActionId();

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
