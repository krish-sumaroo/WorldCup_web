<?php

class BaseTeamsGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Teams");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddTeams();\">Add Teams</a>";
        $output .= "</div>";

        $output .= "<div id='teams_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='teams_list_con'>";
        $output .= BaseTeamsGuiUtility::getTeamsList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddTeams()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("teams", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_name'>Name *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_name' name='txt_name' placeholder='Name' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_flag'>Flag *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_flag' name='txt_flag' placeholder='Flag' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_group'>Group *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_group' name='txt_group' placeholder='Group' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_teams_con'></div>";

        $output .= "<div id='add_teams_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addTeams\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addTeams($name, $flag, $group)
    {
        $output = "";

        $error = TeamsManager::addTeams($name, $flag, $group);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Teams has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddTeams();\">Add another >Teams</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_teams_com').hide();";
            $resultMessage .= "reloadTeamsList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getTeamsList()
    {
        $output = "";

        $teamsList = BaseTeamsLogicUtility::getTeamsList();

        if(count($teamsList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Name</th>";
            $output .= "<th>Flag</th>";
            $output .= "<th>Group</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($teamsList); $i++)
            {
                $id = $teamsList[$i]->getId();
                $name = $teamsList[$i]->getName();
                $flag = $teamsList[$i]->getFlag();
                $group = $teamsList[$i]->getGroup();

                $teamsLineContainerId = "teams_line_con_".$id;
                $teamsActionLineContainerId = "teams_action_line_con_".$id;
                $teamsActionContainerId = "teams_action_con_".$id;

                $nameContainerId = "teams_name_con_".$id;
                $flagContainerId = "teams_flag_con_".$id;
                $groupContainerId = "teams_group_con_".$id;

                $output .= "<tr id='$teamsLineContainerId'>";
                $output .= "<td id='$nameContainerId'>$name</td>";
                $output .= "<td id='$flagContainerId'>$flag</td>";
                $output .= "<td id='$groupContainerId'>$group</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditTeams('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteTeams('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$teamsActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='4' id='$teamsActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Teams</p>";
        }

        return $output;
    }

    public static function clearAddTeams()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_name').val('');";
        $output .= "$('#txt_flag').val('');";
        $output .= "$('#txt_group').val('');";

        $output .= "$('#add_teams_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditTeams($id, $userId)
    {
        $output = "";

        $teamsEntity = BaseTeamsLogicUtility::getTeamsDetails($id, $userId);

        if($teamsEntity)
        {
            $teamsActionLineContainerId = "teams_action_line_con_".$id;
            $teamsActionContainerId = "teams_action_con_".$id;

            $editContainer = "teams_edit_con_".$id;
            $editCommandContainer = "teams_edit_com_".$id;

            $name = $teamsEntity->getName();
            $flag = $teamsEntity->getFlag();
            $group = $teamsEntity->getGroup();

            $nameContainer = "teams_txt_name_".$id;
            $flagContainer = "teams_txt_flag_".$id;
            $groupContainer = "teams_txt_group_".$id;

            $output .= "<h2 class='text-center'>Edit Teams</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$nameContainer'>Name *</label>";
            $output .= "<input class='form-control span12' type='text' id='$nameContainer' name='$nameContainer' placeholder='Name' value=\"$name\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$flagContainer'>Flag *</label>";
            $output .= "<input class='form-control span12' type='text' id='$flagContainer' name='$flagContainer' placeholder='Flag' value=\"$flag\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$groupContainer'>Group *</label>";
            $output .= "<input class='form-control span12' type='text' id='$groupContainer' name='$groupContainer' placeholder='Group' value=\"$group\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editTeams();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$teamsActionContainerId').html('');$('#$teamsActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editTeams($id, $name, $flag, $group)
    {
        $output = "";

        $error = TeamsManager::editTeams($id, $name, $flag, $group);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $teamsActionLineContainerId = "teams_action_line_con_".$id;
            $teamsActionContainerId = "teams_action_con_".$id;

            $editCommandContainer = "teams_edit_com_".$id;

            $nameContainer = "teams_txt_name_".$id;
            $flagContainer = "teams_txt_flag_".$id;
            $groupContainer = "teams_txt_group_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>Teams has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$teamsActionContainerId').html('');$('#$teamsActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$nameContainer').html(\"name\");";
            $resultMessage .= "$('#$flagContainer').html(\"flag\");";
            $resultMessage .= "$('#$groupContainer').html(\"group\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteTeams($id)
    {
        $output = "";

        $teamsActionLineContainerId = "teams_action_line_con_".$id;
        $teamsActionContainerId = "teams_action_con_".$id;
        $teamsDeleteActionContainerId = "teams_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Teams ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$teamsDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteTeams('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$teamsActionContainerId').html('');$('#$teamsActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteTeams($id)
    {
        $output = "";

        TeamsManager::editTeams($id);

        $teamsLineContainerId = "teams_line_con_".$id;
        $teamsActionLineContainerId = "teams_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$teamsLineContainerId').hide();";
        $output .= "$('#$teamsActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getTeamsCombo($comboId = "cbo_teams", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $teamsList = BaseTeamsLogicUtility::getTeamsList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($teamsList); $i++)
        {
            $id = $teamsList[$i]->getId();

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
