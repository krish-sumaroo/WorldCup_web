<?php

class BasePlayersGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Players");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddPlayers();\">Add Players</a>";
        $output .= "</div>";

        $output .= "<div id='players_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='players_list_con'>";
        $output .= BasePlayersGuiUtility::getPlayersList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddPlayers()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("players", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_teamId'>TeamId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_teamId' name='txt_teamId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_name'>Name *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_name' name='txt_name' placeholder='Name' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_position'>Position *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_position' name='txt_position' placeholder='Position' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_number'>Number *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_number' name='txt_number' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_players_con'></div>";

        $output .= "<div id='add_players_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addPlayers\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addPlayers($teamId, $name, $position, $number)
    {
        $output = "";

        $error = PlayersManager::addPlayers($teamId, $name, $position, $number);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Players has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddPlayers();\">Add another >Players</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_players_com').hide();";
            $resultMessage .= "reloadPlayersList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getPlayersList()
    {
        $output = "";

        $playersList = BasePlayersLogicUtility::getPlayersList();

        if(count($playersList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>TeamId</th>";
            $output .= "<th>Name</th>";
            $output .= "<th>Position</th>";
            $output .= "<th>Number</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($playersList); $i++)
            {
                $id = $playersList[$i]->getId();
                $teamId = $playersList[$i]->getTeamId();
                $name = $playersList[$i]->getName();
                $position = $playersList[$i]->getPosition();
                $number = $playersList[$i]->getNumber();

                $playersLineContainerId = "players_line_con_".$id;
                $playersActionLineContainerId = "players_action_line_con_".$id;
                $playersActionContainerId = "players_action_con_".$id;

                $teamIdContainerId = "players_teamId_con_".$id;
                $nameContainerId = "players_name_con_".$id;
                $positionContainerId = "players_position_con_".$id;
                $numberContainerId = "players_number_con_".$id;

                $output .= "<tr id='$playersLineContainerId'>";
                $output .= "<td id='$teamIdContainerId'>$teamId</td>";
                $output .= "<td id='$nameContainerId'>$name</td>";
                $output .= "<td id='$positionContainerId'>$position</td>";
                $output .= "<td id='$numberContainerId'>$number</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditPlayers('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeletePlayers('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$playersActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='5' id='$playersActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Players</p>";
        }

        return $output;
    }

    public static function clearAddPlayers()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_teamId').val('');";
        $output .= "$('#txt_name').val('');";
        $output .= "$('#txt_position').val('');";
        $output .= "$('#txt_number').val('');";

        $output .= "$('#add_players_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditPlayers($id, $userId)
    {
        $output = "";

        $playersEntity = BasePlayersLogicUtility::getPlayersDetails($id, $userId);

        if($playersEntity)
        {
            $playersActionLineContainerId = "players_action_line_con_".$id;
            $playersActionContainerId = "players_action_con_".$id;

            $editContainer = "players_edit_con_".$id;
            $editCommandContainer = "players_edit_com_".$id;

            $teamId = $playersEntity->getTeamId();
            $name = $playersEntity->getName();
            $position = $playersEntity->getPosition();
            $number = $playersEntity->getNumber();

            $teamIdContainer = "players_txt_teamId_".$id;
            $nameContainer = "players_txt_name_".$id;
            $positionContainer = "players_txt_position_".$id;
            $numberContainer = "players_txt_number_".$id;

            $output .= "<h2 class='text-center'>Edit Players</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$teamIdContainer'>TeamId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$teamIdContainer' name='$teamIdContainer' value=\"$teamId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$nameContainer'>Name *</label>";
            $output .= "<input class='form-control span12' type='text' id='$nameContainer' name='$nameContainer' placeholder='Name' value=\"$name\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$positionContainer'>Position *</label>";
            $output .= "<input class='form-control span12' type='text' id='$positionContainer' name='$positionContainer' placeholder='Position' value=\"$position\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$numberContainer'>Number *</label>";
            $output .= "<input class='form-control span12' type='text' id='$numberContainer' name='$numberContainer' value=\"$number\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editPlayers();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$playersActionContainerId').html('');$('#$playersActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editPlayers($id, $teamId, $name, $position, $number)
    {
        $output = "";

        $error = PlayersManager::editPlayers($id, $teamId, $name, $position, $number);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $playersActionLineContainerId = "players_action_line_con_".$id;
            $playersActionContainerId = "players_action_con_".$id;

            $editCommandContainer = "players_edit_com_".$id;

            $teamIdContainer = "players_txt_teamId_".$id;
            $nameContainer = "players_txt_name_".$id;
            $positionContainer = "players_txt_position_".$id;
            $numberContainer = "players_txt_number_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>Players has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$playersActionContainerId').html('');$('#$playersActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$teamIdContainer').html(\"teamId\");";
            $resultMessage .= "$('#$nameContainer').html(\"name\");";
            $resultMessage .= "$('#$positionContainer').html(\"position\");";
            $resultMessage .= "$('#$numberContainer').html(\"number\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeletePlayers($id)
    {
        $output = "";

        $playersActionLineContainerId = "players_action_line_con_".$id;
        $playersActionContainerId = "players_action_con_".$id;
        $playersDeleteActionContainerId = "players_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Players ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$playersDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deletePlayers('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$playersActionContainerId').html('');$('#$playersActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deletePlayers($id)
    {
        $output = "";

        PlayersManager::editPlayers($id);

        $playersLineContainerId = "players_line_con_".$id;
        $playersActionLineContainerId = "players_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$playersLineContainerId').hide();";
        $output .= "$('#$playersActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getPlayersCombo($comboId = "cbo_players", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $playersList = BasePlayersLogicUtility::getPlayersList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($playersList); $i++)
        {
            $id = $playersList[$i]->getId();

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
