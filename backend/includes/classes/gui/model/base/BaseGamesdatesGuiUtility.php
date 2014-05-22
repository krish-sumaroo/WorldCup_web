<?php


class BaseGamesdatesGuiUtility
{

    public static function getDisplay()
    {
	$output = "";

	$output .= HeaderTextGuiUtility::getHeaderDisplay("Gamesdates");

	$output .= "<div>";
	$output .= "<a href='javascript:void(0);' onclick=\"getAddGamesdates();\">Add Gamesdates</a>";
	$output .= "</div>";

	$output .= "<div id='gamesdates_add_link' style='display: none;'>";
	$output .= "</div>";

	$output .= "<div class='' id='gamesdates_list_con'>";
	$output .= BaseGamesdatesGuiUtility::getGamesdatesList();
	$output .= "</div>";

	return $output;
    }

    public static function getAddGamesdates()
    {
	$output = "";

	$urlForm = UrlConfiguration::getUrl("gamesdates", "addProcessor");

	$output .= "<h3 style='text-align: center;'>Add Banner</h3>";

	$output .= "<div class='col-sm-12'>";
	$output .= "<form role='form' action='$urlForm' method='post'>";
	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_gameDate'>GameDate</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_gameDate' name='txt_gameDate' value=\"\" />";
	$output .= "</div>";


	$output .= "<div id='add_gamesdates_con'></div>";

	$output .= "<div id='add_gamesdates_com'>";
	$output .= "<button type='button' class='btn btn-primary' onclick=\"addGamesdates\">Save</button>";
	$output .= "&nbsp;";
	$output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
	$output .= "&nbsp;";
	$output .= "<button type='reset' class='btn'>Reset</button>";
	$output .= "</div>";
	$output .= "</form>";
	$output .= "</div>";


	$output .= DateGuiUtility::getJQueryDatePicker("txt_gameDate");
	return $output;
    }

    public static function addGamesdates($gameDate)
    {
	$output = "";

	$error = GamesdatesManager::addGamesdates($gameDate);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $resultMessage = "";
	    $resultMessage .= "<p>Gamesdates has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddGamesdates();\">Add another >Gamesdates</a> or ";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#add_gamesdates_com').hide();";
	    $resultMessage .= "reloadGamesdatesList();";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getGamesdatesList()
    {
	$output = "";

	$gamesdatesList = BaseGamesdatesLogicUtility::getGamesdatesList();

	if(count($gamesdatesList) > 0)
	{
	    $output .= "<table class='table'>";
	    $output .= "<tr>";
	    $output .= "<th>GameDate</th>";
	    $output .= "</tr>";

	    for($i = 0; $i < count($gamesdatesList); $i++)
	    {
		$gameDate = $gamesdatesList[$i]->getGameDate();

//                $gamesdatesLineContainerId = "gamesdates_line_con_".$;
//                $gamesdatesActionLineContainerId = "gamesdates_action_line_con_".$;
//                $gamesdatesActionContainerId = "gamesdates_action_con_".$;
//
//                $gameDateContainerId = "gamesdates_gameDate_con_".$;

		$output .= "<tr id='$gamesdatesLineContainerId'>";
		$output .= "<td id='$gameDateContainerId'>$gameDate</td>";

		$output .= "<td class='list_table_data_act'>";
		$output .= "<a href='javascript:void(0);' onclick=\"getEditGamesdates('');\">Edit</a>";
		$output .= " | ";
		$output .= "<a href='javascript:void(0);' onclick=\"getDeleteGamesdates('');\">Delete</a>";
		$output .= "</td>";

		$output .= "<tr id='$gamesdatesActionLineContainerId' style='display: none;'>";
		$output .= "<td colspan='2' id='$gamesdatesActionContainerId'></td>";
		$output .= "</tr>";
	    }

	    $output .= "</table>";
	}
	else
	{
	    $output .= "<p>No records for Gamesdates</p>";
	}

	return $output;
    }

    public static function clearAddGamesdates()
    {
	$output = "";

	$output .= "<script>";
	$output .= "$('#txt_gameDate').val('');";

	$output .= "$('#add_gamesdates_com').show();";
	$output .= "</script>";

	return $output;
    }

//    public static function getEditGamesdates(, $userId)
//    {
//        $output = "";
//
//        $gamesdatesEntity = BaseGamesdatesLogicUtility::getGamesdatesDetails(, $userId);
//
//        if($gamesdatesEntity)
//        {
//            $gamesdatesActionLineContainerId = "gamesdates_action_line_con_".$;
//            $gamesdatesActionContainerId = "gamesdates_action_con_".$;
//
//            $editContainer = "gamesdates_edit_con_".$;
//            $editCommandContainer = "gamesdates_edit_com_".$;
//
//            $gameDate = $gamesdatesEntity->getGameDate();
//
//            $gameDateContainer = "gamesdates_txt_gameDate_".$;
//
//            $output .= "<h2 class='text-center'>Edit Gamesdates</h2>";
//
//            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$gameDateContainer'>GameDate</label>";
//            $output .= "<input class='form-control span12' type='text' id='$gameDateContainer' name='$gameDateContainer' value=\"$gameDate\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group' id='$editContainer'>";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group' id='$editCommandContainer'>";
//            $output .= "<button class='btn btn-primary' type='button' onclick=\"editGamesdates();\">Save</button>";
//            $output .= "&nbsp;";
//            $output .= "<button class='btn' type='button' onclick=\"$('#$gamesdatesActionContainerId').html('');$('#$gamesdatesActionLineContainerId').hide();\">Cancel</button>";
//            $output .= "</div>";
//
//            $output .= "</form>";
//
//            $output .= DateGuiUtility::getJQueryDatePicker($gameDateContainer);
//        }
//        else
//        {
//            $output .= "<p>An error occurred while retrieving details</p>";
//        }
//        return $output;
//    }

    public static function editGamesdates($gameDate)
    {
	$output = "";

	$error = GamesdatesManager::editGamesdates($gameDate);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
//            $gamesdatesActionLineContainerId = "gamesdates_action_line_con_".$;
//            $gamesdatesActionContainerId = "gamesdates_action_con_".$;
//
//            $editCommandContainer = "gamesdates_edit_com_".$;
//
//            $gameDateContainer = "gamesdates_txt_gameDate_".$;

	    $resultMessage = "";
	    $resultMessage .= "<p>Gamesdates has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$gamesdatesActionContainerId').html('');$('#$gamesdatesActionLineContainerId').hide();\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#$editCommandContainer').hide();";
	    $resultMessage .= "$('#$gameDateContainer').html(\"gameDate\");";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getDeleteGamesdates()
    {
	$output = "";

//        $gamesdatesActionLineContainerId = "gamesdates_action_line_con_".$;
//        $gamesdatesActionContainerId = "gamesdates_action_con_".$;
//        $gamesdatesDeleteActionContainerId = "gamesdates_delete_con_".$;

	$output .= "<div class='well'>";

	$output .= "<table class='form_table'>";

	$output .= "<tr>";
	$output .= "<td>Do you really want to delete this Gamesdates ?</td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td id='$gamesdatesDeleteActionContainerId'></td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td>";
	$output .= "<button class='btn btn-primary' type='button' onclick=\"deleteGamesdates('');\">Delete</button>";
	$output .= "&nbsp;";
	$output .= "<button class='btn' type='button' onclick=\"$('#$gamesdatesActionContainerId').html('');$('#$gamesdatesActionLineContainerId').hide();\">Cancel</button>";
	$output .= "</td>";
	$output .= "</tr>";

	$output .= "</table>";

	$output .= "</div>";

	return $output;
    }

    public static function deleteGamesdates()
    {
	$output = "";

	GamesdatesManager::editGamesdates();

//        $gamesdatesLineContainerId = "gamesdates_line_con_".$;
//        $gamesdatesActionLineContainerId = "gamesdates_action_line_con_".$;

	$output .= "<script>";
	$output .= "$('#$gamesdatesLineContainerId').hide();";
	$output .= "$('#$gamesdatesActionLineContainerId').hide();";
	$output .= "<\script>";

	return $output;
    }
//    public static function getGamesdatesCombo($comboId = "cbo_gamesdates", $selectedValue = "", $onclickAction = "")
//    {
//        $output = "";
//
//        $gamesdatesList = BaseGamesdatesLogicUtility::getGamesdatesList();
//
//        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";
//
//        for($i = 0; $i < count($gamesdatesList); $i++)
//        {
//            $ = $gamesdatesList[$i]->();
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
