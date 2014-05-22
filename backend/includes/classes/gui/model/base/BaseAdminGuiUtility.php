<?php

class BaseAdminGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Admin");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddAdmin();\">Add Admin</a>";
        $output .= "</div>";

        $output .= "<div id='admin_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='admin_list_con'>";
        $output .= BaseAdminGuiUtility::getAdminList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddAdmin()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("admin", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_username'>Username *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_username' name='txt_username' placeholder='Username' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_password'>Password *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_password' name='txt_password' placeholder='Password' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_admin_con'></div>";

        $output .= "<div id='add_admin_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addAdmin\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addAdmin($username, $password)
    {
        $output = "";

        $error = AdminManager::addAdmin($username, $password);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Admin has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddAdmin();\">Add another >Admin</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_admin_com').hide();";
            $resultMessage .= "reloadAdminList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getAdminList()
    {
        $output = "";

        $adminList = BaseAdminLogicUtility::getAdminList();

        if(count($adminList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Username</th>";
            $output .= "<th>Password</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($adminList); $i++)
            {
                $adminId = $adminList[$i]->getAdminId();
                $username = $adminList[$i]->getUsername();
                $password = $adminList[$i]->getPassword();

                $adminLineContainerId = "admin_line_con_".$adminId;
                $adminActionLineContainerId = "admin_action_line_con_".$adminId;
                $adminActionContainerId = "admin_action_con_".$adminId;

                $usernameContainerId = "admin_username_con_".$adminId;
                $passwordContainerId = "admin_password_con_".$adminId;

                $output .= "<tr id='$adminLineContainerId'>";
                $output .= "<td id='$usernameContainerId'>$username</td>";
                $output .= "<td id='$passwordContainerId'>$password</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditAdmin('$adminId');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteAdmin('$adminId');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$adminActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='3' id='$adminActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Admin</p>";
        }

        return $output;
    }

    public static function clearAddAdmin()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_username').val('');";
        $output .= "$('#txt_password').val('');";

        $output .= "$('#add_admin_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditAdmin($adminId, $userId)
    {
        $output = "";

        $adminEntity = BaseAdminLogicUtility::getAdminDetails($adminId, $userId);

        if($adminEntity)
        {
            $adminActionLineContainerId = "admin_action_line_con_".$adminId;
            $adminActionContainerId = "admin_action_con_".$adminId;

            $editContainer = "admin_edit_con_".$adminId;
            $editCommandContainer = "admin_edit_com_".$adminId;

            $username = $adminEntity->getUsername();
            $password = $adminEntity->getPassword();

            $usernameContainer = "admin_txt_username_".$adminId;
            $passwordContainer = "admin_txt_password_".$adminId;

            $output .= "<h2 class='text-center'>Edit Admin</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$usernameContainer'>Username *</label>";
            $output .= "<input class='form-control span12' type='text' id='$usernameContainer' name='$usernameContainer' placeholder='Username' value=\"$username\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$passwordContainer'>Password *</label>";
            $output .= "<input class='form-control span12' type='text' id='$passwordContainer' name='$passwordContainer' placeholder='Password' value=\"$password\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editAdmin();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$adminActionContainerId').html('');$('#$adminActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editAdmin($adminId, $username, $password)
    {
        $output = "";

        $error = AdminManager::editAdmin($adminId, $username, $password);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $adminActionLineContainerId = "admin_action_line_con_".$adminId;
            $adminActionContainerId = "admin_action_con_".$adminId;

            $editCommandContainer = "admin_edit_com_".$adminId;

            $usernameContainer = "admin_txt_username_".$adminId;
            $passwordContainer = "admin_txt_password_".$adminId;

            $resultMessage = "";
            $resultMessage .= "<p>Admin has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$adminActionContainerId').html('');$('#$adminActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$usernameContainer').html(\"username\");";
            $resultMessage .= "$('#$passwordContainer').html(\"password\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteAdmin($adminId)
    {
        $output = "";

        $adminActionLineContainerId = "admin_action_line_con_".$adminId;
        $adminActionContainerId = "admin_action_con_".$adminId;
        $adminDeleteActionContainerId = "admin_delete_con_".$adminId;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Admin ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$adminDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteAdmin('$adminId');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$adminActionContainerId').html('');$('#$adminActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteAdmin($adminId)
    {
        $output = "";

        AdminManager::editAdmin($adminId);

        $adminLineContainerId = "admin_line_con_".$adminId;
        $adminActionLineContainerId = "admin_action_line_con_".$adminId;

        $output .= "<script>";
        $output .= "$('#$adminLineContainerId').hide();";
        $output .= "$('#$adminActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getAdminCombo($comboId = "cbo_admin", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $adminList = BaseAdminLogicUtility::getAdminList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($adminList); $i++)
        {
            $adminId = $adminList[$i]->getAdminId();

            $selected = "";

            if($selectedValue == $adminId)
            {
                $selected = "selected";
            }

            $output .= "<option selected='$selected' value='$adminId'>$adminId</option>";
        }

        $output .= "</select>";

        return $output;
    }
}

?>
