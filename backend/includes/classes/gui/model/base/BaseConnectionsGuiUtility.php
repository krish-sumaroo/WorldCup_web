<?php


class BaseConnectionsGuiUtility
{

    public static function getDisplay()
    {
	$output = "";

	$output .= HeaderTextGuiUtility::getHeaderDisplay("Connections");

	$output .= "<div>";
	$output .= "<a href='javascript:void(0);' onclick=\"getAddConnections();\">Add Connections</a>";
	$output .= "</div>";

	$output .= "<div id='connections_add_link' style='display: none;'>";
	$output .= "</div>";

	$output .= "<div class='' id='connections_list_con'>";
	$output .= BaseConnectionsGuiUtility::getConnectionsList();
	$output .= "</div>";

	return $output;
    }

    public static function getAddConnections()
    {
	$output = "";

	$urlForm = UrlConfiguration::getUrl("connections", "addProcessor");

	$output .= "<h3 style='text-align: center;'>Add Banner</h3>";

	$output .= "<div class='col-sm-12'>";
	$output .= "<form role='form' action='$urlForm' method='post'>";
	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_user1'>User1</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_user1' name='txt_user1' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_user2'>User2</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_user2' name='txt_user2' value=\"\" />";
	$output .= "</div>";

	$output .= "<div class='form-group'>";
	$output .= "<label for='txt_status'>Status</label>";
	$output .= "<input class='form-control span12' type='text' id='txt_status' name='txt_status' value=\"\" />";
	$output .= "</div>";


	$output .= "<div id='add_connections_con'></div>";

	$output .= "<div id='add_connections_com'>";
	$output .= "<button type='button' class='btn btn-primary' onclick=\"addConnections\">Save</button>";
	$output .= "&nbsp;";
	$output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
	$output .= "&nbsp;";
	$output .= "<button type='reset' class='btn'>Reset</button>";
	$output .= "</div>";
	$output .= "</form>";
	$output .= "</div>";


	return $output;
    }

    public static function addConnections($user1, $user2, $status)
    {
	$output = "";

	$error = ConnectionsManager::addConnections($user1, $user2, $status);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
	    $resultMessage = "";
	    $resultMessage .= "<p>Connections has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddConnections();\">Add another >Connections</a> or ";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#add_connections_com').hide();";
	    $resultMessage .= "reloadConnectionsList();";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getConnectionsList()
    {
	$output = "";

	$connectionsList = BaseConnectionsLogicUtility::getConnectionsList();

	if(count($connectionsList) > 0)
	{
	    $output .= "<table class='table'>";
	    $output .= "<tr>";
	    $output .= "<th>User1</th>";
	    $output .= "<th>User2</th>";
	    $output .= "<th>Status</th>";
	    $output .= "</tr>";

	    for($i = 0; $i < count($connectionsList); $i++)
	    {
		$user1 = $connectionsList[$i]->getUser1();
		$user2 = $connectionsList[$i]->getUser2();
		$status = $connectionsList[$i]->getStatus();

//                $connectionsLineContainerId = "connections_line_con_".$;
//                $connectionsActionLineContainerId = "connections_action_line_con_".$;
//                $connectionsActionContainerId = "connections_action_con_".$;
//
//                $user1ContainerId = "connections_user1_con_".$;
//                $user2ContainerId = "connections_user2_con_".$;
//                $statusContainerId = "connections_status_con_".$;

		$output .= "<tr id='$connectionsLineContainerId'>";
		$output .= "<td id='$user1ContainerId'>$user1</td>";
		$output .= "<td id='$user2ContainerId'>$user2</td>";
		$output .= "<td id='$statusContainerId'>$status</td>";

		$output .= "<td class='list_table_data_act'>";
		$output .= "<a href='javascript:void(0);' onclick=\"getEditConnections('');\">Edit</a>";
		$output .= " | ";
		$output .= "<a href='javascript:void(0);' onclick=\"getDeleteConnections('');\">Delete</a>";
		$output .= "</td>";

		$output .= "<tr id='$connectionsActionLineContainerId' style='display: none;'>";
		$output .= "<td colspan='4' id='$connectionsActionContainerId'></td>";
		$output .= "</tr>";
	    }

	    $output .= "</table>";
	}
	else
	{
	    $output .= "<p>No records for Connections</p>";
	}

	return $output;
    }

    public static function clearAddConnections()
    {
	$output = "";

	$output .= "<script>";
	$output .= "$('#txt_user1').val('');";
	$output .= "$('#txt_user2').val('');";
	$output .= "$('#txt_status').val('');";

	$output .= "$('#add_connections_com').show();";
	$output .= "</script>";

	return $output;
    }

//    public static function getEditConnections(, $userId)
//    {
//        $output = "";
//
//        $connectionsEntity = BaseConnectionsLogicUtility::getConnectionsDetails(, $userId);
//
//        if($connectionsEntity)
//        {
//            $connectionsActionLineContainerId = "connections_action_line_con_".$;
//            $connectionsActionContainerId = "connections_action_con_".$;
//
//            $editContainer = "connections_edit_con_".$;
//            $editCommandContainer = "connections_edit_com_".$;
//
//            $user1 = $connectionsEntity->getUser1();
//            $user2 = $connectionsEntity->getUser2();
//            $status = $connectionsEntity->getStatus();
//
//            $user1Container = "connections_txt_user1_".$;
//            $user2Container = "connections_txt_user2_".$;
//            $statusContainer = "connections_txt_status_".$;
//
//            $output .= "<h2 class='text-center'>Edit Connections</h2>";
//
//            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$user1Container'>User1</label>";
//            $output .= "<input class='form-control span12' type='text' id='$user1Container' name='$user1Container' value=\"$user1\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$user2Container'>User2</label>";
//            $output .= "<input class='form-control span12' type='text' id='$user2Container' name='$user2Container' value=\"$user2\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group'>";
//            $output .= "<label for='$statusContainer'>Status</label>";
//            $output .= "<input class='form-control span12' type='text' id='$statusContainer' name='$statusContainer' value=\"$status\" />";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group' id='$editContainer'>";
//            $output .= "</div>";
//
//            $output .= "<div class='form-group' id='$editCommandContainer'>";
//            $output .= "<button class='btn btn-primary' type='button' onclick=\"editConnections();\">Save</button>";
//            $output .= "&nbsp;";
//            $output .= "<button class='btn' type='button' onclick=\"$('#$connectionsActionContainerId').html('');$('#$connectionsActionLineContainerId').hide();\">Cancel</button>";
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

    public static function editConnections($user1, $user2, $status)
    {
	$output = "";

	$error = ConnectionsManager::editConnections($user1, $user2, $status);

	if($error->errorExists())
	{
	    $output .= $error->getBoostrapError();
	}
	else
	{
//            $connectionsActionLineContainerId = "connections_action_line_con_".$;
//            $connectionsActionContainerId = "connections_action_con_".$;
//
//            $editCommandContainer = "connections_edit_com_".$;
//
//            $user1Container = "connections_txt_user1_".$;
//            $user2Container = "connections_txt_user2_".$;
//            $statusContainer = "connections_txt_status_".$;

	    $resultMessage = "";
	    $resultMessage .= "<p>Connections has been successfully saved.</p>";
	    $resultMessage .= "<p>";
	    $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$connectionsActionContainerId').html('');$('#$connectionsActionLineContainerId').hide();\">Close</a>";
	    $resultMessage .= "</p>";

	    $resultMessage .= "<script>";
	    $resultMessage .= "$('#$editCommandContainer').hide();";
	    $resultMessage .= "$('#$user1Container').html(\"user1\");";
	    $resultMessage .= "$('#$user2Container').html(\"user2\");";
	    $resultMessage .= "$('#$statusContainer').html(\"status\");";
	    $resultMessage .= "</script>";

	    $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
	}

	return $output;
    }

    public static function getDeleteConnections()
    {
	$output = "";

//        $connectionsActionLineContainerId = "connections_action_line_con_".$;
//        $connectionsActionContainerId = "connections_action_con_".$;
//        $connectionsDeleteActionContainerId = "connections_delete_con_".$;

	$output .= "<div class='well'>";

	$output .= "<table class='form_table'>";

	$output .= "<tr>";
	$output .= "<td>Do you really want to delete this Connections ?</td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td id='$connectionsDeleteActionContainerId'></td>";
	$output .= "</tr>";

	$output .= "<tr>";
	$output .= "<td>";
	$output .= "<button class='btn btn-primary' type='button' onclick=\"deleteConnections('');\">Delete</button>";
	$output .= "&nbsp;";
	$output .= "<button class='btn' type='button' onclick=\"$('#$connectionsActionContainerId').html('');$('#$connectionsActionLineContainerId').hide();\">Cancel</button>";
	$output .= "</td>";
	$output .= "</tr>";

	$output .= "</table>";

	$output .= "</div>";

	return $output;
    }

    public static function deleteConnections()
    {
	$output = "";

	ConnectionsManager::editConnections();

//        $connectionsLineContainerId = "connections_line_con_".$;
//        $connectionsActionLineContainerId = "connections_action_line_con_".$;

	$output .= "<script>";
	$output .= "$('#$connectionsLineContainerId').hide();";
	$output .= "$('#$connectionsActionLineContainerId').hide();";
	$output .= "<\script>";

	return $output;
    }

    public static function getConnectionsCombo($comboId = "cbo_connections", $selectedValue = "", $onclickAction = "")
    {
	$output = "";

	$connectionsList = BaseConnectionsLogicUtility::getConnectionsList();

	$output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

	for($i = 0; $i < count($connectionsList); $i++)
	{
//	    $ = $connectionsList[$i]->();

	    $selected = "";

//	    if($selectedValue == $)
//	    {
//		$selected = "selected";
//	    }

	    $output .= "<option selected='$selected' value='$'>$</option>";
	}

	$output .= "</select>";

	return $output;
    }
}

?>
