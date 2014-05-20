<?php

class BaseStadiumGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Stadium");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddStadium();\">Add Stadium</a>";
        $output .= "</div>";

        $output .= "<div id='stadium_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='stadium_list_con'>";
        $output .= BaseStadiumGuiUtility::getStadiumList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddStadium()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("stadium", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_name'>Name</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_name' name='txt_name' placeholder='Name' value=\"\" />";
        $output .= "</div>";

        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_image'>Image</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_image' name='txt_image' placeholder='Image' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_stadium_con'></div>";

        $output .= "<div id='add_stadium_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addStadium\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addStadium($name, $image)
    {
        $output = "";

        $error = StadiumManager::addStadium($name, $image);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Stadium has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddStadium();\">Add another >Stadium</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_stadium_com').hide();";
            $resultMessage .= "reloadStadiumList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getStadiumList()
    {
        $output = "";

        $stadiumList = BaseStadiumLogicUtility::getStadiumList();

        if(count($stadiumList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Name</th>";
            $output .= "<th>Image</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($stadiumList); $i++)
            {
                $id = $stadiumList[$i]->getId();
                $name = $stadiumList[$i]->getName();
                $image = $stadiumList[$i]->getImage();

                $stadiumLineContainerId = "stadium_line_con_".$id;
                $stadiumActionLineContainerId = "stadium_action_line_con_".$id;
                $stadiumActionContainerId = "stadium_action_con_".$id;

                $nameContainerId = "stadium_name_con_".$id;
                $imageContainerId = "stadium_image_con_".$id;

                $output .= "<tr id='$stadiumLineContainerId'>";
                $output .= "<td id='$nameContainerId'>$name</td>";
                $output .= "<td id='$imageContainerId'>$image</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditStadium('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteStadium('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$stadiumActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='3' id='$stadiumActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Stadium</p>";
        }

        return $output;
    }

    public static function clearAddStadium()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_name').val('');";
        $output .= "$('#txt_image').val('');";

        $output .= "$('#add_stadium_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditStadium($id, $userId)
    {
        $output = "";

        $stadiumEntity = BaseStadiumLogicUtility::getStadiumDetails($id, $userId);

        if($stadiumEntity)
        {
            $stadiumActionLineContainerId = "stadium_action_line_con_".$id;
            $stadiumActionContainerId = "stadium_action_con_".$id;

            $editContainer = "stadium_edit_con_".$id;
            $editCommandContainer = "stadium_edit_com_".$id;

            $name = $stadiumEntity->getName();
            $image = $stadiumEntity->getImage();

            $nameContainer = "stadium_txt_name_".$id;
            $imageContainer = "stadium_txt_image_".$id;

            $output .= "<h2 class='text-center'>Edit Stadium</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$nameContainer'>Name</label>";
            $output .= "<input class='form-control span12' type='text' id='$nameContainer' name='$nameContainer' placeholder='Name' value=\"$name\" />";
            $output .= "</div>";

            $output .= "<div class='form-group'>";
            $output .= "<label for='$imageContainer'>Image</label>";
            $output .= "<input class='form-control span12' type='text' id='$imageContainer' name='$imageContainer' placeholder='Image' value=\"$image\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editStadium();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$stadiumActionContainerId').html('');$('#$stadiumActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editStadium($id, $name, $image)
    {
        $output = "";

        $error = StadiumManager::editStadium($id, $name, $image);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $stadiumActionLineContainerId = "stadium_action_line_con_".$id;
            $stadiumActionContainerId = "stadium_action_con_".$id;

            $editCommandContainer = "stadium_edit_com_".$id;

            $nameContainer = "stadium_txt_name_".$id;
            $imageContainer = "stadium_txt_image_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>Stadium has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$stadiumActionContainerId').html('');$('#$stadiumActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$nameContainer').html(\"name\");";
            $resultMessage .= "$('#$imageContainer').html(\"image\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteStadium($id)
    {
        $output = "";

        $stadiumActionLineContainerId = "stadium_action_line_con_".$id;
        $stadiumActionContainerId = "stadium_action_con_".$id;
        $stadiumDeleteActionContainerId = "stadium_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Stadium ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$stadiumDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteStadium('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$stadiumActionContainerId').html('');$('#$stadiumActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteStadium($id)
    {
        $output = "";

        StadiumManager::editStadium($id);

        $stadiumLineContainerId = "stadium_line_con_".$id;
        $stadiumActionLineContainerId = "stadium_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$stadiumLineContainerId').hide();";
        $output .= "$('#$stadiumActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getStadiumCombo($comboId = "cbo_stadium", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $stadiumList = BaseStadiumLogicUtility::getStadiumList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($stadiumList); $i++)
        {
            $id = $stadiumList[$i]->getId();

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
