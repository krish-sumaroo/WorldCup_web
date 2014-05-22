<?php

class BaseRedCardActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Red Card Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddRedCardAction();\">Add Red Card Action</a>";
        $output .= "</div>";

        $output .= "<div id='red_card_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='red_card_action_list_con'>";
        $output .= BaseRedCardActionGuiUtility::getRedCardActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddRedCardAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("red_card_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_fk_player_id'>Fk Player Id *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_fk_player_id' name='txt_fk_player_id' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_red_card_action_con'></div>";

        $output .= "<div id='add_red_card_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addRedCardAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addRedCardAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = RedCardActionManager::addRedCardAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Red Card Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddRedCardAction();\">Add another >Red Card Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_red_card_action_com').hide();";
            $resultMessage .= "reloadRedCardActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getRedCardActionList()
    {
        $output = "";

        $redCardActionList = BaseRedCardActionLogicUtility::getRedCardActionList();

        if(count($redCardActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk Player Id</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($redCardActionList); $i++)
            {
                $fkGameActionId = $redCardActionList[$i]->getFkGameActionId();
                $fkPlayerId = $redCardActionList[$i]->getFkPlayerId();

                $redCardActionLineContainerId = "red_card_action_line_con_".$fkGameActionId;
                $redCardActionActionLineContainerId = "red_card_action_action_line_con_".$fkGameActionId;
                $redCardActionActionContainerId = "red_card_action_action_con_".$fkGameActionId;

                $fkGameActionIdContainerId = "red_card_action_fk_game_action_id_con_".$fkGameActionId;
                $fkPlayerIdContainerId = "red_card_action_fk_player_id_con_".$fkGameActionId;

                $output .= "<tr id='$redCardActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkPlayerIdContainerId'>$fkPlayerId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditRedCardAction('$fkGameActionId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteRedCardAction('$fkGameActionId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$redCardActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='2' id='$redCardActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Red Card Action</p>";
        }

        return $output;
    }

    public static function clearAddRedCardAction()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_fk_player_id').val('');";

        $output .= "$('#add_red_card_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditRedCardAction($fkGameActionId, $userId)
    {
        $output = "";

        $redCardActionEntity = BaseRedCardActionLogicUtility::getRedCardActionDetails($fkGameActionId, $userId);

        if($redCardActionEntity)
        {
            $redCardActionActionLineContainerId = "red_card_action_action_line_con_".$fkGameActionId;
            $redCardActionActionContainerId = "red_card_action_action_con_".$fkGameActionId;

            $editContainer = "red_card_action_edit_con_".$fkGameActionId;
            $editCommandContainer = "red_card_action_edit_com_".$fkGameActionId;

            $fkGameActionId = $redCardActionEntity->getFkGameActionId();
            $fkPlayerId = $redCardActionEntity->getFkPlayerId();

            $fkGameActionIdContainer = "red_card_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "red_card_action_txt_fk_player_id_".$fkGameActionId;

            $output .= "<h2 class='text-center'>Edit RedCardAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$fkPlayerIdContainer'>Fk Player Id *</label>";
            $output .= "<input class='form-control span12' type='text' id='$fkPlayerIdContainer' name='$fkPlayerIdContainer' value=\"$fkPlayerId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editRedCardAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$redCardActionActionContainerId').html('');$('#$redCardActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editRedCardAction($fkGameActionId, $fkPlayerId)
    {
        $output = "";

        $error = RedCardActionManager::editRedCardAction($fkGameActionId, $fkPlayerId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $redCardActionActionLineContainerId = "red_card_action_action_line_con_".$fkGameActionId;
            $redCardActionActionContainerId = "red_card_action_action_con_".$fkGameActionId;

            $editCommandContainer = "red_card_action_edit_com_".$fkGameActionId;

            $fkGameActionIdContainer = "red_card_action_txt_fk_game_action_id_".$fkGameActionId;
            $fkPlayerIdContainer = "red_card_action_txt_fk_player_id_".$fkGameActionId;

            $resultMessage = "";
            $resultMessage .= "<p>Red Card Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$redCardActionActionContainerId').html('');$('#$redCardActionActionLineContainerId').hide();\">Close</a>";
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

    public static function getDeleteRedCardAction($fkGameActionId)
    {
        $output = "";

        $redCardActionActionLineContainerId = "red_card_action_action_line_con_".$fkGameActionId;
        $redCardActionActionContainerId = "red_card_action_action_con_".$fkGameActionId;
        $redCardActionDeleteActionContainerId = "red_card_action_delete_con_".$fkGameActionId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Red Card Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$redCardActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteRedCardAction('$fkGameActionId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$redCardActionActionContainerId').html('');$('#$redCardActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteRedCardAction($fkGameActionId)
    {
        $output = "";

        RedCardActionManager::editRedCardAction($fkGameActionId);

        $redCardActionLineContainerId = "red_card_action_line_con_".$fkGameActionId;
        $redCardActionActionLineContainerId = "red_card_action_action_line_con_".$fkGameActionId;

        $output .= "<script>";
        $output .= "$('#$redCardActionLineContainerId').hide();";
        $output .= "$('#$redCardActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getRedCardActionCombo($comboId = "cbo_red_card_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $redCardActionList = BaseRedCardActionLogicUtility::getRedCardActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($redCardActionList); $i++)
        {
            $fkGameActionId = $redCardActionList[$i]->getFkGameActionId();

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
