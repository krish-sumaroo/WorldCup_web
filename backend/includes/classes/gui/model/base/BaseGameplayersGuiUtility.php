<?php


class BaseGameplayersGuiUtility
{

    public static function getDisplay()
    {
	$output = "";

	$output .= HeaderTextGuiUtility::getHeaderDisplay("Gameplayers");

	$output .= "<div>";
	$output .= "<a href='javascript:void(0);' onclick=\"getAddGameplayers();\">Add Gameplayers</a>";
	$output .= "</div>";

	$output .= "<div id='gameplayers_add_link' style='display: none;'>";
	$output .= "</div>";

	$output .= "<div class='' id='gameplayers_list_con'>";
	$output .= BaseGameplayersGuiUtility::getGameplayersList();
	$output .= "</div>";

	return $output;
    }

    public static function getAddGameplayers()
    {
	$output = "";

	$urlForm = UrlConfiguration::getUrl("gameplayers", "addProcessor");

	$output .= "<h3 style='text-align: center;'>Add Banner</h3>";

	$output .= "<div class='col-sm-12'>";
	$output .= "<form role='form' action='$urlForm' method='post'>";
	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_gameId'>GameId</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_gameId' name='txt_gameId' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_playerId'>PlayerId</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_playerId' name='txt_playerId' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_teamId'>TeamId</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_teamId' name='txt_teamId' value=\"\" />";
	$output .= "</div>";


	$output .= "<div id='add_gameplayers_con'></div>";

	$output .= "<div id='add_gameplayers_com'>";
	$output .= "<button type='button' class='btn btn-primary' onclick=\"addGameplayers\">Save</button>";
	$output .= "&nbsp;";
	$output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
	$output .= "&nbsp;";
	$output .= "<button type='reset' class='btn'>Reset</button>";
	$output .= "</div>";
	$output .= "</form>";
	$output .= "</div>";


	return $output;
    }

    public static function addGameplayers($gameId, $playerId, $teamId)
    {
	$output = "";

	$error = GameplayersManager::addGameplayers($gameId, $playerId, $teamId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $resultMessage = "";
	    $resultMessage .= "<p>Gameplayers has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddGameplayers();\">Add another >Gameplayers</a> or ";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#add_gameplayers_com').hide();";
	    $resultMessage .= "reloadGameplayersList();";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getGameplayersList()
    {
	$output = "";

	$gameplayersList = BaseGameplayersLogicUtility::getGameplayersList();

	if(count($gameplayersList) > 0)
	{
	    $output .= "<table class='table'>";
	    $output .= "<tr>";
	    $output .= "<th>GameId</th>";
	    $output .= "<th>PlayerId</th>";
	    $output .= "<th>TeamId</th>";
	    $output .= "</tr>";

	    for($i = 0; $i < count($gameplayersList); $i++)
	    {
		$gameId = $gameplayersList[$i]->getGameId();
		$playerId = $gameplayersList[$i]->getPlayerId();
		$teamId = $gameplayersList[$i]->getTeamId();

//                $gameplayersLineContainerId = "gameplayers_line_con_".$;
//                $gameplayersActionLineContainerId = "gameplayers_action_line_con_".$;
//                $gameplayersActionContainerId = "gameplayers_action_con_".$;
//
//                $gameIdContainerId = "gameplayers_gameId_con_".$;
//                $playerIdContainerId = "gameplayers_playerId_con_".$;
//                $teamIdContainerId = "gameplayers_teamId_con_".$;

		$output .= "<tr id='$gameplayersLineContainerId'>";
		$output .= "<td id='$gameIdContainerId'>$gameId</td>";
		$output .= "<td id='$playerIdContainerId'>$playerId</td>";
		$output .= "<td id='$teamIdContainerId'>$teamId</td>";

		$output .= "<td class='list_table_data_act'>";
		$output .= "<a href='javascript:void(0);' onclick=\"getEditGameplayers('');\">Edit</a>";
		$output .= " | ";
		$output .= "<a href='javascript:void(0);' onclick=\"getDeleteGameplayers('');\">Delete</a>";
		$output .= "</td>";

		$output .= "<tr id='$gameplayersActionLineContainerId' style='display: none;'>";
		$output .= "<td colspan='4' id='$gameplayersActionContainerId'></td>";
		$output .= "</tr>";
	    }

	    $output .= "</table>";
	}
	else
	{
	    $output .= "<p>No records for Gameplayers</p>";
	}

	return $output;
    }

    public static function clearAddGameplayers()
    {
	$output = "";

	$output .= "<script>";
	$output .= "$('#txt_gameId').val('');";
	$output .= "$('#txt_playerId').val('');";
	$output .= "$('#txt_teamId').val('');";

	$output .= "$('#add_gameplayers_com').show();";
	$output .= "</script>";

	return $output;
    }

//    public static function getEditGameplayers(, $userId)
//    {
//        $output = "";
//
//        $gameplayersEntity = BaseGameplayersLogicUtility::getGameplayersDetails(, $userId);
//
//        if($gameplayersEntity)
//        {
//            $gameplayersActionLineContainerId = "gameplayers_action_line_con_".$;
//            $gameplayersActionContainerId = "gameplayers_action_con_".$;
//
//            $editContainer = "gameplayers_edit_con_".$;
//            $editCommandContainer = "gameplayers_edit_com_".$;
//
//            $gameId = $gameplayersEntity->getGameId();
//            $playerId = $gameplayersEntity->getPlayerId();
//            $teamId = $gameplayersEntity->getTeamId();
//
//            $gameIdContainer = "gameplayers_txt_gameId_".$;
//            $playerIdContainer = "gameplayers_txt_playerId_".$;
//            $teamIdContainer = "gameplayers_txt_teamId_".$;
//
//            $output .= "<h2 class='text-center'>Edit Gameplayers</h2>";
//
//            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$gameIdContainer'>GameId</label>";
//            $output .= "<input class='form-control span12' type='text' id='$gameIdContainer' name='$gameIdContainer' value=\"$gameId\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$playerIdContainer'>PlayerId</label>";
//            $output .= "<input class='form-control span12' type='text' id='$playerIdContainer' name='$playerIdContainer' value=\"$playerId\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$teamIdContainer'>TeamId</label>";
//            $output .= "<input class='form-control span12' type='text' id='$teamIdContainer' name='$teamIdContainer' value=\"$teamId\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group' id='$editContainer'>";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group' id='$editCommandContainer'>";
//            $output .= "<button class='btn btn-primary' type='button' onclick=\"editGameplayers();\">Save</button>";
//            $output .= "&nbsp;";
//            $output .= "<button class='btn' type='button' onclick=\"$('#$gameplayersActionContainerId').html('');$('#$gameplayersActionLineContainerId').hide();\">Cancel</button>";
//            $output .= "</div>";
//
//            $output .= "</form>";
//
//        }
//        else
//        {
//            $output .= "<p>An error occurred while retrieving details</p>";
//        }
//        return $output;
//    }

    public static function editGameplayers($gameId, $playerId, $teamId)
    {
	$output = "";

	$error = GameplayersManager::editGameplayers($gameId, $playerId, $teamId);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
//            $gameplayersActionLineContainerId = "gameplayers_action_line_con_".$;
//            $gameplayersActionContainerId = "gameplayers_action_con_".$;
//
//            $editCommandContainer = "gameplayers_edit_com_".$;
//
//            $gameIdContainer = "gameplayers_txt_gameId_".$;
//            $playerIdContainer = "gameplayers_txt_playerId_".$;
//            $teamIdContainer = "gameplayers_txt_teamId_".$;

	    $resultMessage = "";
	    $resultMessage .= "<p>Gameplayers has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$gameplayersActionContainerId').html('');$('#$gameplayersActionLineContainerId').hide();\">Close</a>";
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

    public static function getDeleteGameplayers()
    {
	$output = "";

//        $gameplayersActionLineContainerId = "gameplayers_action_line_con_".$;
//        $gameplayersActionContainerId = "gameplayers_action_con_".$;
//        $gameplayersDeleteActionContainerId = "gameplayers_delete_con_".$;

	$output .= "<div class='well'>";

	$output .= "<table class='form_table'>";

	$output .= "<tr>";
	$output .= "<td>Do you really want to delete this Gameplayers ?</td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td id='$gameplayersDeleteActionContainerId'></td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td>";
	$output .= "<button class='btn btn-primary' type='button' onclick=\"deleteGameplayers('');\">Delete</button>";
	$output .= "&nbsp;";
	$output .= "<button class='btn' type='button' onclick=\"$('#$gameplayersActionContainerId').html('');$('#$gameplayersActionLineContainerId').hide();\">Cancel</button>";
	$output .= "</td>";
	$output .= "</tr>";

	$output .= "</table>";

	$output .= "</div>";

	return $output;
    }

    public static function deleteGameplayers()
    {
	$output = "";

	GameplayersManager::editGameplayers();

//        $gameplayersLineContainerId = "gameplayers_line_con_".$;
//        $gameplayersActionLineContainerId = "gameplayers_action_line_con_".$;

	$output .= "<script>";
	$output .= "$('#$gameplayersLineContainerId').hide();";
	$output .= "$('#$gameplayersActionLineContainerId').hide();";
	$output .= "<\script>";

	return $output;
    }
//    public static function getGameplayersCombo($comboId = "cbo_gameplayers", $selectedValue = "", $onclickAction = "")
//    {
//        $output = "";
//
//        $gameplayersList = BaseGameplayersLogicUtility::getGameplayersList();
//
//        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";
//
//        for($i = 0; $i < count($gameplayersList); $i++)
//        {
//            $ = $gameplayersList[$i]->();
//
//            $selected = "";
//
//            if($selectedValue == $)
//            {
//                $selected = "selected";
//            }
//
//            $output .= "<option selected='$selected' value='$'>$</option>";
//        }
//
//        $output .= "</select>";
//
//        return $output;
//    }
}

?>
