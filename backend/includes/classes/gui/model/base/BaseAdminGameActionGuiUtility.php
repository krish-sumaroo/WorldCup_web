<?php

class BaseAdminGameActionGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Admin Game Action");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddAdminGameAction();\">Add Admin Game Action</a>";
        $output .= "</div>";

        $output .= "<div id='admin_game_action_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='admin_game_action_list_con'>";
        $output .= BaseAdminGameActionGuiUtility::getAdminGameActionList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddAdminGameAction()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("admin_game_action", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";



        $output .= "<div id='add_admin_game_action_con'></div>";

        $output .= "<div id='add_admin_game_action_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addAdminGameAction\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addAdminGameAction($fkGameActionId, $fkAdminId)
    {
        $output = "";

        $error = AdminGameActionManager::addAdminGameAction($fkGameActionId, $fkAdminId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Admin Game Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddAdminGameAction();\">Add another >Admin Game Action</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_admin_game_action_com').hide();";
            $resultMessage .= "reloadAdminGameActionList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getAdminGameActionList()
    {
        $output = "";

        $adminGameActionList = BaseAdminGameActionLogicUtility::getAdminGameActionList();

        if(count($adminGameActionList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Fk Game Action Id</th>";
            $output .= "<th>Fk Admin Id</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($adminGameActionList); $i++)
            {
                $fkGameActionId = $adminGameActionList[$i]->getFkGameActionId();
                $fkAdminId = $adminGameActionList[$i]->getFkAdminId();

                $adminGameActionLineContainerId = "admin_game_action_line_con_".$fkGameActionId."_".fkAdminId;
                $adminGameActionActionLineContainerId = "admin_game_action_action_line_con_".$fkGameActionId."_".fkAdminId;
                $adminGameActionActionContainerId = "admin_game_action_action_con_".$fkGameActionId."_".fkAdminId;

                $fkGameActionIdContainerId = "admin_game_action_fk_game_action_id_con_".$fkGameActionId."_".fkAdminId;
                $fkAdminIdContainerId = "admin_game_action_fk_admin_id_con_".$fkGameActionId."_".fkAdminId;

                $output .= "<tr id='$adminGameActionLineContainerId'>";
                $output .= "<td id='$fkGameActionIdContainerId'>$fkGameActionId</td>";
                $output .= "<td id='$fkAdminIdContainerId'>$fkAdminId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditAdminGameAction('$fkGameActionId, $fkAdminId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteAdminGameAction('$fkGameActionId, $fkAdminId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$adminGameActionActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='1' id='$adminGameActionActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Admin Game Action</p>";
        }

        return $output;
    }

    public static function clearAddAdminGameAction()
    {
        $output = "";

        $output .= "<script>";

        $output .= "$('#add_admin_game_action_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditAdminGameAction($fkGameActionId, $fkAdminId, $userId)
    {
        $output = "";

        $adminGameActionEntity = BaseAdminGameActionLogicUtility::getAdminGameActionDetails($fkGameActionId, $fkAdminId, $userId);

        if($adminGameActionEntity)
        {
            $adminGameActionActionLineContainerId = "admin_game_action_action_line_con_".$fkGameActionId."_".fkAdminId;
            $adminGameActionActionContainerId = "admin_game_action_action_con_".$fkGameActionId."_".fkAdminId;

            $editContainer = "admin_game_action_edit_con_".$fkGameActionId."_".fkAdminId;
            $editCommandContainer = "admin_game_action_edit_com_".$fkGameActionId."_".fkAdminId;

            $fkGameActionId = $adminGameActionEntity->getFkGameActionId();
            $fkAdminId = $adminGameActionEntity->getFkAdminId();

            $fkGameActionIdContainer = "admin_game_action_txt_fk_game_action_id_".$fkGameActionId."_".fkAdminId;
            $fkAdminIdContainer = "admin_game_action_txt_fk_admin_id_".$fkGameActionId."_".fkAdminId;

            $output .= "<h2 class='text-center'>Edit AdminGameAction</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";


            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editAdminGameAction();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$adminGameActionActionContainerId').html('');$('#$adminGameActionActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editAdminGameAction($fkGameActionId, $fkAdminId)
    {
        $output = "";

        $error = AdminGameActionManager::editAdminGameAction($fkGameActionId, $fkAdminId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $adminGameActionActionLineContainerId = "admin_game_action_action_line_con_".$fkGameActionId."_".fkAdminId;
            $adminGameActionActionContainerId = "admin_game_action_action_con_".$fkGameActionId."_".fkAdminId;

            $editCommandContainer = "admin_game_action_edit_com_".$fkGameActionId."_".fkAdminId;

            $fkGameActionIdContainer = "admin_game_action_txt_fk_game_action_id_".$fkGameActionId."_".fkAdminId;
            $fkAdminIdContainer = "admin_game_action_txt_fk_admin_id_".$fkGameActionId."_".fkAdminId;

            $resultMessage = "";
            $resultMessage .= "<p>Admin Game Action has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$adminGameActionActionContainerId').html('');$('#$adminGameActionActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$fkGameActionIdContainer').html(\"fkGameActionId\");";
            $resultMessage .= "$('#$fkAdminIdContainer').html(\"fkAdminId\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteAdminGameAction($fkGameActionId, $fkAdminId)
    {
        $output = "";

        $adminGameActionActionLineContainerId = "admin_game_action_action_line_con_".$fkGameActionId."_".fkAdminId;
        $adminGameActionActionContainerId = "admin_game_action_action_con_".$fkGameActionId."_".fkAdminId;
        $adminGameActionDeleteActionContainerId = "admin_game_action_delete_con_".$fkGameActionId."_".fkAdminId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Admin Game Action ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$adminGameActionDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteAdminGameAction('$fkGameActionId, $fkAdminId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$adminGameActionActionContainerId').html('');$('#$adminGameActionActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteAdminGameAction($fkGameActionId, $fkAdminId)
    {
        $output = "";

        AdminGameActionManager::editAdminGameAction($fkGameActionId, $fkAdminId);

        $adminGameActionLineContainerId = "admin_game_action_line_con_".$fkGameActionId."_".fkAdminId;
        $adminGameActionActionLineContainerId = "admin_game_action_action_line_con_".$fkGameActionId."_".fkAdminId;

        $output .= "<script>";
        $output .= "$('#$adminGameActionLineContainerId').hide();";
        $output .= "$('#$adminGameActionActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getAdminGameActionCombo($comboId = "cbo_admin_game_action", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $adminGameActionList = BaseAdminGameActionLogicUtility::getAdminGameActionList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($adminGameActionList); $i++)
        {
            $fkGameActionId = $adminGameActionList[$i]->getFkGameActionId();

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
