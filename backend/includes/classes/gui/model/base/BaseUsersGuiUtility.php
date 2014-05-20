<?php

class BaseUsersGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Users");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddUsers();\">Add Users</a>";
        $output .= "</div>";

        $output .= "<div id='users_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='users_list_con'>";
        $output .= BaseUsersGuiUtility::getUsersList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddUsers()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("users", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_uid'>Uid</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_uid' name='txt_uid' placeholder='Uid' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_username'>Username</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_username' name='txt_username' placeholder='Username' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_nickname'>Nickname</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_nickname' name='txt_nickname' placeholder='Nickname' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_status'>Status</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_status' name='txt_status' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_teamId'>TeamId</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_teamId' name='txt_teamId' placeholder='TeamId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_country'>Country *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_country' name='txt_country' placeholder='Country' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_password'>Password</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_password' name='txt_password' placeholder='Password' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_users_con'></div>";

        $output .= "<div id='add_users_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addUsers\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addUsers($uid, $username, $nickname, $status, $teamId, $country, $password)
    {
        $output = "";

        $error = UsersManager::addUsers($uid, $username, $nickname, $status, $teamId, $country, $password);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Users has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddUsers();\">Add another >Users</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_users_com').hide();";
            $resultMessage .= "reloadUsersList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getUsersList()
    {
        $output = "";

        $usersList = BaseUsersLogicUtility::getUsersList();

        if(count($usersList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Uid</th>";
            $output .= "<th>Username</th>";
            $output .= "<th>Nickname</th>";
            $output .= "<th>Status</th>";
            $output .= "<th>TeamId</th>";
            $output .= "<th>Country</th>";
            $output .= "<th>Password</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($usersList); $i++)
            {
                $id = $usersList[$i]->getId();
                $uid = $usersList[$i]->getUid();
                $username = $usersList[$i]->getUsername();
                $nickname = $usersList[$i]->getNickname();
                $status = $usersList[$i]->getStatus();
                $teamId = $usersList[$i]->getTeamId();
                $country = $usersList[$i]->getCountry();
                $password = $usersList[$i]->getPassword();

                $usersLineContainerId = "users_line_con_".$id;
                $usersActionLineContainerId = "users_action_line_con_".$id;
                $usersActionContainerId = "users_action_con_".$id;

                $uidContainerId = "users_uid_con_".$id;
                $usernameContainerId = "users_username_con_".$id;
                $nicknameContainerId = "users_nickname_con_".$id;
                $statusContainerId = "users_status_con_".$id;
                $teamIdContainerId = "users_teamId_con_".$id;
                $countryContainerId = "users_country_con_".$id;
                $passwordContainerId = "users_password_con_".$id;

                $output .= "<tr id='$usersLineContainerId'>";
                $output .= "<td id='$uidContainerId'>$uid</td>";
                $output .= "<td id='$usernameContainerId'>$username</td>";
                $output .= "<td id='$nicknameContainerId'>$nickname</td>";
                $output .= "<td id='$statusContainerId'>$status</td>";
                $output .= "<td id='$teamIdContainerId'>$teamId</td>";
                $output .= "<td id='$countryContainerId'>$country</td>";
                $output .= "<td id='$passwordContainerId'>$password</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditUsers('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteUsers('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$usersActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='8' id='$usersActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Users</p>";
        }

        return $output;
    }

    public static function clearAddUsers()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_uid').val('');";
        $output .= "$('#txt_username').val('');";
        $output .= "$('#txt_nickname').val('');";
        $output .= "$('#txt_status').val('');";
        $output .= "$('#txt_teamId').val('');";
        $output .= "$('#txt_country').val('');";
        $output .= "$('#txt_password').val('');";

        $output .= "$('#add_users_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditUsers($id, $userId)
    {
        $output = "";

        $usersEntity = BaseUsersLogicUtility::getUsersDetails($id, $userId);

        if($usersEntity)
        {
            $usersActionLineContainerId = "users_action_line_con_".$id;
            $usersActionContainerId = "users_action_con_".$id;

            $editContainer = "users_edit_con_".$id;
            $editCommandContainer = "users_edit_com_".$id;

            $uid = $usersEntity->getUid();
            $username = $usersEntity->getUsername();
            $nickname = $usersEntity->getNickname();
            $status = $usersEntity->getStatus();
            $teamId = $usersEntity->getTeamId();
            $country = $usersEntity->getCountry();
            $password = $usersEntity->getPassword();

            $uidContainer = "users_txt_uid_".$id;
            $usernameContainer = "users_txt_username_".$id;
            $nicknameContainer = "users_txt_nickname_".$id;
            $statusContainer = "users_txt_status_".$id;
            $teamIdContainer = "users_txt_teamId_".$id;
            $countryContainer = "users_txt_country_".$id;
            $passwordContainer = "users_txt_password_".$id;

            $output .= "<h2 class='text-center'>Edit Users</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$uidContainer'>Uid</label>";
            $output .= "<input class='form-control span12' type='text' id='$uidContainer' name='$uidContainer' placeholder='Uid' value=\"$uid\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$usernameContainer'>Username</label>";
            $output .= "<input class='form-control span12' type='text' id='$usernameContainer' name='$usernameContainer' placeholder='Username' value=\"$username\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$nicknameContainer'>Nickname</label>";
            $output .= "<input class='form-control span12' type='text' id='$nicknameContainer' name='$nicknameContainer' placeholder='Nickname' value=\"$nickname\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$statusContainer'>Status</label>";
            $output .= "<input class='form-control span12' type='text' id='$statusContainer' name='$statusContainer' value=\"$status\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$teamIdContainer'>TeamId</label>";
            $output .= "<input class='form-control span12' type='text' id='$teamIdContainer' name='$teamIdContainer' placeholder='TeamId' value=\"$teamId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$countryContainer'>Country *</label>";
            $output .= "<input class='form-control span12' type='text' id='$countryContainer' name='$countryContainer' placeholder='Country' value=\"$country\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$passwordContainer'>Password</label>";
            $output .= "<input class='form-control span12' type='text' id='$passwordContainer' name='$passwordContainer' placeholder='Password' value=\"$password\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editUsers();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$usersActionContainerId').html('');$('#$usersActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editUsers($id, $uid, $username, $nickname, $status, $teamId, $country, $password)
    {
        $output = "";

        $error = UsersManager::editUsers($id, $uid, $username, $nickname, $status, $teamId, $country, $password);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $usersActionLineContainerId = "users_action_line_con_".$id;
            $usersActionContainerId = "users_action_con_".$id;

            $editCommandContainer = "users_edit_com_".$id;

            $uidContainer = "users_txt_uid_".$id;
            $usernameContainer = "users_txt_username_".$id;
            $nicknameContainer = "users_txt_nickname_".$id;
            $statusContainer = "users_txt_status_".$id;
            $teamIdContainer = "users_txt_teamId_".$id;
            $countryContainer = "users_txt_country_".$id;
            $passwordContainer = "users_txt_password_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>Users has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$usersActionContainerId').html('');$('#$usersActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$uidContainer').html(\"uid\");";
            $resultMessage .= "$('#$usernameContainer').html(\"username\");";
            $resultMessage .= "$('#$nicknameContainer').html(\"nickname\");";
            $resultMessage .= "$('#$statusContainer').html(\"status\");";
            $resultMessage .= "$('#$teamIdContainer').html(\"teamId\");";
            $resultMessage .= "$('#$countryContainer').html(\"country\");";
            $resultMessage .= "$('#$passwordContainer').html(\"password\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteUsers($id)
    {
        $output = "";

        $usersActionLineContainerId = "users_action_line_con_".$id;
        $usersActionContainerId = "users_action_con_".$id;
        $usersDeleteActionContainerId = "users_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Users ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$usersDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteUsers('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$usersActionContainerId').html('');$('#$usersActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteUsers($id)
    {
        $output = "";

        UsersManager::editUsers($id);

        $usersLineContainerId = "users_line_con_".$id;
        $usersActionLineContainerId = "users_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$usersLineContainerId').hide();";
        $output .= "$('#$usersActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getUsersCombo($comboId = "cbo_users", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $usersList = BaseUsersLogicUtility::getUsersList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($usersList); $i++)
        {
            $id = $usersList[$i]->getId();

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
