<?php

class BasePlayerScoreActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Player Score Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddPlayerScoreAction();\">Add Player Score Action</a>";
        $output .= "</div>";

        $output .= "<div id='player_score_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='player_score_action_list_con'>";
        $output .= BasePlayerScoreActionGuiUtility::getPlayerScoreActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddPlayerScoreAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("player_score_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_player_id'>Fk Player Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_player_id' name='txt_fk_player_id' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_player_score_action_con'></div>";

        $output .= "<div id='add_player_score_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addPlayerScoreAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = PlayerScoreActionManager::addPlayerScoreAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Player Score Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddPlayerScoreAction();\">Add another >Player Score Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_player_score_action_com').hide();";
            $resultMessage .= "reloadPlayerScoreActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getPlayerScoreActionList()
    {
        $output = "";

        $playerScoreActionList = BasePlayerScoreActionLogicUtility::getPlayerScoreActionList();

        if(count($playerScoreActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk Player Id</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($playerScoreActionList); $i++)
            {
                $fkGameActionId = $playerScoreActionList[$i]->getFkGameActionId();
                $fkPlayerId = $playerScoreActionList[$i]->getFkPlayerId();

                $playerScoreActionLineContainerId = "player_score_action_line_con_".$fkGameActionId;
                $playerScoreActionActionLineContainerId = "player_score_action_action_line_con_".$fkGameActionId;
                $playerScoreActionActionContainerId = "player_score_action_action_con_".$fkGameActionId;

                $fkGameActionIdContainerId = "player_score_action_fk_game_action_id_con_".$fkGameActionId;
                $fkPlayerIdContainerId = "player_score_action_fk_player_id_con_".$fkGameActionId;

                $output .= "<tr id='$playerScoreActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkPlayerIdContainerId'>$fkPlayerId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditPlayerScoreAction('$fkGameActionId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeletePlayerScoreAction('$fkGameActionId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$playerScoreActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='2' id='$playerScoreActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Player Score Action</p>";
        }

        return $output;
    }

    public static function clearAddPlayerScoreAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_fk_player_id').val('');";

        $output .= "$('#add_player_score_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditPlayerScoreAction($fkGameActionId, $userId)
    {
        $output = "";

        $playerScoreActionEntity = BasePlayerScoreActionLogicUtility::getPlayerScoreActionDetails($fkGameActionId, $userId);

        if($playerScoreActionEntity)
        {
            $playerScoreActionActionLineContainerId = "player_score_action_action_line_con_".$fkGameActionId;
            $playerScoreActionActionContainerId = "player_score_action_action_con_".$fkGameActionId;

            $editContainer = "player_score_action_edit_con_".$fkGameActionId;
            $editCommandContainer = "player_score_action_edit_com_".$fkGameActionId;

            $fkGameActionId = $playerScoreActionEntity->getFkGameActionId();
            $fkPlayerId = $playerScoreActionEntity->getFkPlayerId();

            $fkGameActionIdContainer = "player_score_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "player_score_action_txt_fk_player_id_".$fkGameActionId;

            $output .= "<h2 class='text-center'>Edit PlayerScoreAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkPlayerIdContainer'>Fk Player Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkPlayerIdContainer' name='$fkPlayerIdContainer' value=\"$fkPlayerId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editPlayerScoreAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$playerScoreActionActionContainerId').html('');$('#$playerScoreActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editPlayerScoreAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = PlayerScoreActionManager::editPlayerScoreAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $playerScoreActionActionLineContainerId = "player_score_action_action_line_con_".$fkGameActionId;
            $playerScoreActionActionContainerId = "player_score_action_action_con_".$fkGameActionId;

            $editCommandContainer = "player_score_action_edit_com_".$fkGameActionId;

            $fkGameActionIdContainer = "player_score_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "player_score_action_txt_fk_player_id_".$fkGameActionId;

            $resultMessage = "";
            $resultMessage .= "<p>Player Score Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$playerScoreActionActionContainerId').html('');$('#$playerScoreActionActionLineContainerId').hide();\">Close</a>";
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

    public static function getDeletePlayerScoreAction($fkGameActionId)
    {
        $output = "";

        $playerScoreActionActionLineContainerId = "player_score_action_action_line_con_".$fkGameActionId;
        $playerScoreActionActionContainerId = "player_score_action_action_con_".$fkGameActionId;
        $playerScoreActionDeleteActionContainerId = "player_score_action_delete_con_".$fkGameActionId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Player Score Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$playerScoreActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deletePlayerScoreAction('$fkGameActionId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$playerScoreActionActionContainerId').html('');$('#$playerScoreActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deletePlayerScoreAction($fkGameActionId)
    {
        $output = "";

        PlayerScoreActionManager::editPlayerScoreAction($fkGameActionId);

        $playerScoreActionLineContainerId = "player_score_action_line_con_".$fkGameActionId;
        $playerScoreActionActionLineContainerId = "player_score_action_action_line_con_".$fkGameActionId;

        $output .= "<script>";
        $output .= "$('#$playerScoreActionLineContainerId').hide();";
        $output .= "$('#$playerScoreActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getPlayerScoreActionCombo($comboId = "cbo_player_score_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $playerScoreActionList = BasePlayerScoreActionLogicUtility::getPlayerScoreActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($playerScoreActionList); $i++)
        {
            $fkGameActionId = $playerScoreActionList[$i]->getFkGameActionId();

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
