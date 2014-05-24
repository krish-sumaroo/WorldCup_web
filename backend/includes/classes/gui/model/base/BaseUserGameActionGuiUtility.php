<?php

class BaseUserGameActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("User Game Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddUserGameAction();\">Add User Game Action</a>";
        $output .= "</div>";

        $output .= "<div id='user_game_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='user_game_action_list_con'>";
        $output .= BaseUserGameActionGuiUtility::getUserGameActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddUserGameAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("user_game_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";



        $output .= "<div id='add_user_game_action_con'></div>";

        $output .= "<div id='add_user_game_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addUserGameAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addUserGameAction($fkGameActionId, $fkUserId)
    {
        $output = "";

        $error = UserGameActionManager::addUserGameAction($fkGameActionId, $fkUserId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>User Game Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddUserGameAction();\">Add another >User Game Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_user_game_action_com').hide();";
            $resultMessage .= "reloadUserGameActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getUserGameActionList()
    {
        $output = "";

        $userGameActionList = BaseUserGameActionLogicUtility::getUserGameActionList();

        if(count($userGameActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk User Id</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($userGameActionList); $i++)
            {
                $fkGameActionId = $userGameActionList[$i]->getFkGameActionId();
                $fkUserId = $userGameActionList[$i]->getFkUserId();

                $userGameActionLineContainerId = "user_game_action_line_con_".$fkGameActionId."_".fkUserId;
                $userGameActionActionLineContainerId = "user_game_action_action_line_con_".$fkGameActionId."_".fkUserId;
                $userGameActionActionContainerId = "user_game_action_action_con_".$fkGameActionId."_".fkUserId;

                $fkGameActionIdContainerId = "user_game_action_fk_game_action_id_con_".$fkGameActionId."_".fkUserId;
                $fkUserIdContainerId = "user_game_action_fk_user_id_con_".$fkGameActionId."_".fkUserId;

                $output .= "<tr id='$userGameActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkUserIdContainerId'>$fkUserId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditUserGameAction('$fkGameActionId, $fkUserId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteUserGameAction('$fkGameActionId, $fkUserId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$userGameActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='1' id='$userGameActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for User Game Action</p>";
        }

        return $output;
    }

    public static function clearAddUserGameAction()
    {
        $output = "";

        $output .= "<script>";

        $output .= "$('#add_user_game_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditUserGameAction($fkGameActionId, $fkUserId, $userId)
    {
        $output = "";

        $userGameActionEntity = BaseUserGameActionLogicUtility::getUserGameActionDetails($fkGameActionId, $fkUserId, $userId);

        if($userGameActionEntity)
        {
            $userGameActionActionLineContainerId = "user_game_action_action_line_con_".$fkGameActionId."_".fkUserId;
            $userGameActionActionContainerId = "user_game_action_action_con_".$fkGameActionId."_".fkUserId;

            $editContainer = "user_game_action_edit_con_".$fkGameActionId."_".fkUserId;
            $editCommandContainer = "user_game_action_edit_com_".$fkGameActionId."_".fkUserId;

            $fkGameActionId = $userGameActionEntity->getFkGameActionId();
            $fkUserId = $userGameActionEntity->getFkUserId();

            $fkGameActionIdContainer = "user_game_action_txt_fk_game_action_id_".$fkGameActionId."_".fkUserId;
            $fkUserIdContainer = "user_game_action_txt_fk_user_id_".$fkGameActionId."_".fkUserId;

            $output .= "<h2 class='text-center'>Edit UserGameAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";


            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editUserGameAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$userGameActionActionContainerId').html('');$('#$userGameActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editUserGameAction($fkGameActionId, $fkUserId)
    {
        $output = "";

        $error = UserGameActionManager::editUserGameAction($fkGameActionId, $fkUserId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $userGameActionActionLineContainerId = "user_game_action_action_line_con_".$fkGameActionId."_".fkUserId;
            $userGameActionActionContainerId = "user_game_action_action_con_".$fkGameActionId."_".fkUserId;

            $editCommandContainer = "user_game_action_edit_com_".$fkGameActionId."_".fkUserId;

            $fkGameActionIdContainer = "user_game_action_txt_fk_game_action_id_".$fkGameActionId."_".fkUserId;
            $fkUserIdContainer = "user_game_action_txt_fk_user_id_".$fkGameActionId."_".fkUserId;

            $resultMessage = "";
            $resultMessage .= "<p>User Game Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$userGameActionActionContainerId').html('');$('#$userGameActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$fkGameActionIdContainer').html(\"fkGameActionId\");";
            $resultMessage .= "$('#$fkUserIdContainer').html(\"fkUserId\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteUserGameAction($fkGameActionId, $fkUserId)
    {
        $output = "";

        $userGameActionActionLineContainerId = "user_game_action_action_line_con_".$fkGameActionId."_".fkUserId;
        $userGameActionActionContainerId = "user_game_action_action_con_".$fkGameActionId."_".fkUserId;
        $userGameActionDeleteActionContainerId = "user_game_action_delete_con_".$fkGameActionId."_".fkUserId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this User Game Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$userGameActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteUserGameAction('$fkGameActionId, $fkUserId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$userGameActionActionContainerId').html('');$('#$userGameActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteUserGameAction($fkGameActionId, $fkUserId)
    {
        $output = "";

        UserGameActionManager::editUserGameAction($fkGameActionId, $fkUserId);

        $userGameActionLineContainerId = "user_game_action_line_con_".$fkGameActionId."_".fkUserId;
        $userGameActionActionLineContainerId = "user_game_action_action_line_con_".$fkGameActionId."_".fkUserId;

        $output .= "<script>";
        $output .= "$('#$userGameActionLineContainerId').hide();";
        $output .= "$('#$userGameActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getUserGameActionCombo($comboId = "cbo_user_game_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $userGameActionList = BaseUserGameActionLogicUtility::getUserGameActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($userGameActionList); $i++)
        {
            $fkGameActionId = $userGameActionList[$i]->getFkGameActionId();

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
