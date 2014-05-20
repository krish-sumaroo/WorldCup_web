<?php

class BaseGamesPlayersGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("GamesPlayers");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddGamesPlayers();\">Add GamesPlayers</a>";
        $output .= "</div>";

        $output .= "<div id='gamesPlayers_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='gamesPlayers_list_con'>";
        $output .= BaseGamesPlayersGuiUtility::getGamesPlayersList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddGamesPlayers()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("gamesPlayers", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_gameId'>GameId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_gameId' name='txt_gameId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_playerId'>PlayerId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_playerId' name='txt_playerId' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_teamId'>TeamId *</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_teamId' name='txt_teamId' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_gamesPlayers_con'></div>";

        $output .= "<div id='add_gamesPlayers_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addGamesPlayers\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addGamesPlayers($gameId, $playerId, $teamId)
    {
        $output = "";

        $error = GamesPlayersManager::addGamesPlayers($gameId, $playerId, $teamId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>GamesPlayers has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddGamesPlayers();\">Add another >GamesPlayers</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_gamesPlayers_com').hide();";
            $resultMessage .= "reloadGamesPlayersList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getGamesPlayersList()
    {
        $output = "";

        $gamesPlayersList = BaseGamesPlayersLogicUtility::getGamesPlayersList();

        if(count($gamesPlayersList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>GameId</th>";
            $output .= "<th>PlayerId</th>";
            $output .= "<th>TeamId</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($gamesPlayersList); $i++)
            {
                $id = $gamesPlayersList[$i]->getId();
                $gameId = $gamesPlayersList[$i]->getGameId();
                $playerId = $gamesPlayersList[$i]->getPlayerId();
                $teamId = $gamesPlayersList[$i]->getTeamId();

                $gamesPlayersLineContainerId = "gamesPlayers_line_con_".$id;
                $gamesPlayersActionLineContainerId = "gamesPlayers_action_line_con_".$id;
                $gamesPlayersActionContainerId = "gamesPlayers_action_con_".$id;

                $gameIdContainerId = "gamesPlayers_gameId_con_".$id;
                $playerIdContainerId = "gamesPlayers_playerId_con_".$id;
                $teamIdContainerId = "gamesPlayers_teamId_con_".$id;

                $output .= "<tr id='$gamesPlayersLineContainerId'>";
                $output .= "<td id='$gameIdContainerId'>$gameId</td>";
                $output .= "<td id='$playerIdContainerId'>$playerId</td>";
                $output .= "<td id='$teamIdContainerId'>$teamId</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditGamesPlayers('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteGamesPlayers('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$gamesPlayersActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='4' id='$gamesPlayersActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for GamesPlayers</p>";
        }

        return $output;
    }

    public static function clearAddGamesPlayers()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_gameId').val('');";
        $output .= "$('#txt_playerId').val('');";
        $output .= "$('#txt_teamId').val('');";

        $output .= "$('#add_gamesPlayers_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditGamesPlayers($id, $userId)
    {
        $output = "";

        $gamesPlayersEntity = BaseGamesPlayersLogicUtility::getGamesPlayersDetails($id, $userId);

        if($gamesPlayersEntity)
        {
            $gamesPlayersActionLineContainerId = "gamesPlayers_action_line_con_".$id;
            $gamesPlayersActionContainerId = "gamesPlayers_action_con_".$id;

            $editContainer = "gamesPlayers_edit_con_".$id;
            $editCommandContainer = "gamesPlayers_edit_com_".$id;

            $gameId = $gamesPlayersEntity->getGameId();
            $playerId = $gamesPlayersEntity->getPlayerId();
            $teamId = $gamesPlayersEntity->getTeamId();

            $gameIdContainer = "gamesPlayers_txt_gameId_".$id;
            $playerIdContainer = "gamesPlayers_txt_playerId_".$id;
            $teamIdContainer = "gamesPlayers_txt_teamId_".$id;

            $output .= "<h2 class='text-center'>Edit GamesPlayers</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$gameIdContainer'>GameId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$gameIdContainer' name='$gameIdContainer' value=\"$gameId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$playerIdContainer'>PlayerId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$playerIdContainer' name='$playerIdContainer' value=\"$playerId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$teamIdContainer'>TeamId *</label>";
            $output .= "<input class='form-control span12' type='text' id='$teamIdContainer' name='$teamIdContainer' value=\"$teamId\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editGamesPlayers();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$gamesPlayersActionContainerId').html('');$('#$gamesPlayersActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editGamesPlayers($id, $gameId, $playerId, $teamId)
    {
        $output = "";

        $error = GamesPlayersManager::editGamesPlayers($id, $gameId, $playerId, $teamId);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $gamesPlayersActionLineContainerId = "gamesPlayers_action_line_con_".$id;
            $gamesPlayersActionContainerId = "gamesPlayers_action_con_".$id;

            $editCommandContainer = "gamesPlayers_edit_com_".$id;

            $gameIdContainer = "gamesPlayers_txt_gameId_".$id;
            $playerIdContainer = "gamesPlayers_txt_playerId_".$id;
            $teamIdContainer = "gamesPlayers_txt_teamId_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>GamesPlayers has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$gamesPlayersActionContainerId').html('');$('#$gamesPlayersActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$gameIdContainer').html(\"gameId\");";
            $resultMessage .= "$('#$playerIdContainer').html(\"playerId\");";
            $resultMessage .= "$('#$teamIdContainer').html(\"teamId\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteGamesPlayers($id)
    {
        $output = "";

        $gamesPlayersActionLineContainerId = "gamesPlayers_action_line_con_".$id;
        $gamesPlayersActionContainerId = "gamesPlayers_action_con_".$id;
        $gamesPlayersDeleteActionContainerId = "gamesPlayers_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this GamesPlayers ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$gamesPlayersDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteGamesPlayers('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$gamesPlayersActionContainerId').html('');$('#$gamesPlayersActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteGamesPlayers($id)
    {
        $output = "";

        GamesPlayersManager::editGamesPlayers($id);

        $gamesPlayersLineContainerId = "gamesPlayers_line_con_".$id;
        $gamesPlayersActionLineContainerId = "gamesPlayers_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$gamesPlayersLineContainerId').hide();";
        $output .= "$('#$gamesPlayersActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getGamesPlayersCombo($comboId = "cbo_gamesPlayers", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $gamesPlayersList = BaseGamesPlayersLogicUtility::getGamesPlayersList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($gamesPlayersList); $i++)
        {
            $id = $gamesPlayersList[$i]->getId();

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
