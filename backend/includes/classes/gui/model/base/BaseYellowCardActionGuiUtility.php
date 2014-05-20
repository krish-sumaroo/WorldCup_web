<?php

class BaseYellowCardActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Yellow Card Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddYellowCardAction();\">Add Yellow Card Action</a>";
        $output .= "</div>";

        $output .= "<div id='yellow_card_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='yellow_card_action_list_con'>";
        $output .= BaseYellowCardActionGuiUtility::getYellowCardActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddYellowCardAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("yellow_card_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_player_id'>Fk Player Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_player_id' name='txt_fk_player_id' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_yellow_card_action_con'></div>";

        $output .= "<div id='add_yellow_card_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addYellowCardAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = YellowCardActionManager::addYellowCardAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Yellow Card Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddYellowCardAction();\">Add another >Yellow Card Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_yellow_card_action_com').hide();";
            $resultMessage .= "reloadYellowCardActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getYellowCardActionList()
    {
        $output = "";

        $yellowCardActionList = BaseYellowCardActionLogicUtility::getYellowCardActionList();

        if(count($yellowCardActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk Player Id</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($yellowCardActionList); $i++)
            {
                $fkGameActionId = $yellowCardActionList[$i]->getFkGameActionId();
                $fkPlayerId = $yellowCardActionList[$i]->getFkPlayerId();

                $yellowCardActionLineContainerId = "yellow_card_action_line_con_".$fkGameActionId;
                $yellowCardActionActionLineContainerId = "yellow_card_action_action_line_con_".$fkGameActionId;
                $yellowCardActionActionContainerId = "yellow_card_action_action_con_".$fkGameActionId;

                $fkGameActionIdContainerId = "yellow_card_action_fk_game_action_id_con_".$fkGameActionId;
                $fkPlayerIdContainerId = "yellow_card_action_fk_player_id_con_".$fkGameActionId;

                $output .= "<tr id='$yellowCardActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkPlayerIdContainerId'>$fkPlayerId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditYellowCardAction('$fkGameActionId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteYellowCardAction('$fkGameActionId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$yellowCardActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='2' id='$yellowCardActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Yellow Card Action</p>";
        }

        return $output;
    }

    public static function clearAddYellowCardAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_fk_player_id').val('');";

        $output .= "$('#add_yellow_card_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditYellowCardAction($fkGameActionId, $userId)
    {
        $output = "";

        $yellowCardActionEntity = BaseYellowCardActionLogicUtility::getYellowCardActionDetails($fkGameActionId, $userId);

        if($yellowCardActionEntity)
        {
            $yellowCardActionActionLineContainerId = "yellow_card_action_action_line_con_".$fkGameActionId;
            $yellowCardActionActionContainerId = "yellow_card_action_action_con_".$fkGameActionId;

            $editContainer = "yellow_card_action_edit_con_".$fkGameActionId;
            $editCommandContainer = "yellow_card_action_edit_com_".$fkGameActionId;

            $fkGameActionId = $yellowCardActionEntity->getFkGameActionId();
            $fkPlayerId = $yellowCardActionEntity->getFkPlayerId();

            $fkGameActionIdContainer = "yellow_card_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "yellow_card_action_txt_fk_player_id_".$fkGameActionId;

            $output .= "<h2 class='text-center'>Edit YellowCardAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkPlayerIdContainer'>Fk Player Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkPlayerIdContainer' name='$fkPlayerIdContainer' value=\"$fkPlayerId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editYellowCardAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$yellowCardActionActionContainerId').html('');$('#$yellowCardActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editYellowCardAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = YellowCardActionManager::editYellowCardAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $yellowCardActionActionLineContainerId = "yellow_card_action_action_line_con_".$fkGameActionId;
            $yellowCardActionActionContainerId = "yellow_card_action_action_con_".$fkGameActionId;

            $editCommandContainer = "yellow_card_action_edit_com_".$fkGameActionId;

            $fkGameActionIdContainer = "yellow_card_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "yellow_card_action_txt_fk_player_id_".$fkGameActionId;

            $resultMessage = "";
            $resultMessage .= "<p>Yellow Card Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$yellowCardActionActionContainerId').html('');$('#$yellowCardActionActionLineContainerId').hide();\">Close</a>";
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

    public static function getDeleteYellowCardAction($fkGameActionId)
    {
        $output = "";

        $yellowCardActionActionLineContainerId = "yellow_card_action_action_line_con_".$fkGameActionId;
        $yellowCardActionActionContainerId = "yellow_card_action_action_con_".$fkGameActionId;
        $yellowCardActionDeleteActionContainerId = "yellow_card_action_delete_con_".$fkGameActionId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Yellow Card Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$yellowCardActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteYellowCardAction('$fkGameActionId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$yellowCardActionActionContainerId').html('');$('#$yellowCardActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteYellowCardAction($fkGameActionId)
    {
        $output = "";

        YellowCardActionManager::editYellowCardAction($fkGameActionId);

        $yellowCardActionLineContainerId = "yellow_card_action_line_con_".$fkGameActionId;
        $yellowCardActionActionLineContainerId = "yellow_card_action_action_line_con_".$fkGameActionId;

        $output .= "<script>";
        $output .= "$('#$yellowCardActionLineContainerId').hide();";
        $output .= "$('#$yellowCardActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getYellowCardActionCombo($comboId = "cbo_yellow_card_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $yellowCardActionList = BaseYellowCardActionLogicUtility::getYellowCardActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($yellowCardActionList); $i++)
        {
            $fkGameActionId = $yellowCardActionList[$i]->getFkGameActionId();

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
