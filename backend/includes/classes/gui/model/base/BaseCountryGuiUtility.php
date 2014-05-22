<?php

class BaseCountryGuiUtility
{
    public static function getDisplay()
    {
        $output = "";

        $output .= HeaderTextGuiUtility::getHeaderDisplay("Country");

        $output .= "<div>";
        $output .= "<a href='javascript:void(0);' onclick=\"getAddCountry();\">Add Country</a>";
        $output .= "</div>";

        $output .= "<div id='country_add_link' style='display: none;'>";
        $output .= "</div>";

        $output .= "<div class='' id='country_list_con'>";
        $output .= BaseCountryGuiUtility::getCountryList();
        $output .= "</div>";

        return $output;
    }

    public static function getAddCountry()
    {
        $output = "";

        $urlForm = UrlConfiguration::getUrl("country", "addProcessor");

        $output .= "<h3 style='text-align: center;'>Add Banner</h3>";

        $output .= "<div class='col-sm-12'>";
        $output .= "<form role='form' action='$urlForm' method='post'>";
        $output .= "<div class='form-group'>";
        $output .= "<label for='txt_name'>Name</label>";
        $output .= "<input class='form-control span12' type='text' id='txt_name' name='txt_name' placeholder='Name' value=\"\" />";
        $output .= "</div>";


        $output .= "<div id='add_country_con'></div>";

        $output .= "<div id='add_country_com'>";
        $output .= "<button type='button' class='btn btn-primary' onclick=\"addCountry\">Save</button>";
        $output .= "&nbsp;";
        $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
        $output .= "&nbsp;";
        $output .= "<button type='reset' class='btn'>Reset</button>";
        $output .= "</div>";
        $output .= "</form>";
        $output .= "</div>";


        return $output;
    }

    public static function addCountry($name)
    {
        $output = "";

        $error = CountryManager::addCountry($name);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $resultMessage = "";
            $resultMessage .= "<p>Country has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"clearAddCountry();\">Add another >Country</a> or ";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#add_notification_form_con').html('');\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#add_country_com').hide();";
            $resultMessage .= "reloadCountryList();";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getCountryList()
    {
        $output = "";

        $countryList = BaseCountryLogicUtility::getCountryList();

        if(count($countryList) > 0)
        {
            $output .= "<table class='table'>";
            $output .= "<tr>";
            $output .= "<th>Name</th>";
            $output .= "</tr>";

            for($i = 0; $i < count($countryList); $i++)
            {
                $id = $countryList[$i]->getId();
                $name = $countryList[$i]->getName();

                $countryLineContainerId = "country_line_con_".$id;
                $countryActionLineContainerId = "country_action_line_con_".$id;
                $countryActionContainerId = "country_action_con_".$id;

                $nameContainerId = "country_name_con_".$id;

                $output .= "<tr id='$countryLineContainerId'>";
                $output .= "<td id='$nameContainerId'>$name</td>";

                $output .= "<td class='list_table_data_act'>";
                $output .= "<a href='javascript:void(0);' onclick=\"getEditCountry('$id');\">Edit</a>";
                $output .= " | ";
                $output .= "<a href='javascript:void(0);' onclick=\"getDeleteCountry('$id');\">Delete</a>";
                $output .= "</td>";

                $output .= "<tr id='$countryActionLineContainerId' style='display: none;'>";
                $output .= "<td colspan='2' id='$countryActionContainerId'></td>";
                $output .= "</tr>";
            }

            $output .= "</table>";
        }
        else
        {
            $output .= "<p>No records for Country</p>";
        }

        return $output;
    }

    public static function clearAddCountry()
    {
        $output = "";

        $output .= "<script>";
        $output .= "$('#txt_name').val('');";

        $output .= "$('#add_country_com').show();";
        $output .= "</script>";

        return $output;
    }

    public static function getEditCountry($id, $userId)
    {
        $output = "";

        $countryEntity = BaseCountryLogicUtility::getCountryDetails($id, $userId);

        if($countryEntity)
        {
            $countryActionLineContainerId = "country_action_line_con_".$id;
            $countryActionContainerId = "country_action_con_".$id;

            $editContainer = "country_edit_con_".$id;
            $editCommandContainer = "country_edit_com_".$id;

            $name = $countryEntity->getName();

            $nameContainer = "country_txt_name_".$id;

            $output .= "<h2 class='text-center'>Edit Country</h2>";

            $output .= "<form class='form' role='form' action=\"\" method\"post\">";
            $output .= "<div class='form-group'>";
            $output .= "<label for='$nameContainer'>Name</label>";
            $output .= "<input class='form-control span12' type='text' id='$nameContainer' name='$nameContainer' placeholder='Name' value=\"$name\" />";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editContainer'>";
            $output .= "</div>";

            $output .= "<div class='form-group' id='$editCommandContainer'>";
            $output .= "<button class='btn btn-primary' type='button' onclick=\"editCountry();\">Save</button>";
            $output .= "&nbsp;";
            $output .= "<button class='btn' type='button' onclick=\"$('#$countryActionContainerId').html('');$('#$countryActionLineContainerId').hide();\">Cancel</button>";
            $output .= "</div>";

            $output .= "</form>";

        }
        else
        {
            $output .= "<p>An error occurred while retrieving details</p>";
        }
        return $output;
    }

    public static function editCountry($id, $name)
    {
        $output = "";

        $error = CountryManager::editCountry($id, $name);

        if($error->errorExists())
        {
            $output .= $error->getBoostrapError();
        }
        else
        {
            $countryActionLineContainerId = "country_action_line_con_".$id;
            $countryActionContainerId = "country_action_con_".$id;

            $editCommandContainer = "country_edit_com_".$id;

            $nameContainer = "country_txt_name_".$id;

            $resultMessage = "";
            $resultMessage .= "<p>Country has been successfully saved.</p>";
            $resultMessage .= "<p>";
            $resultMessage .= "<a href='javascript:void(0);' onclick=\"$('#$countryActionContainerId').html('');$('#$countryActionLineContainerId').hide();\">Close</a>";
            $resultMessage .= "</p>";

            $resultMessage .= "<script>";
            $resultMessage .= "$('#$editCommandContainer').hide();";
            $resultMessage .= "$('#$nameContainer').html(\"name\");";
            $resultMessage .= "</script>";

            $output .= ResultUpdateGuiUtility::getBootstrapSuccessDisplay($resultMessage);
        }

        return $output;
    }

    public static function getDeleteCountry($id)
    {
        $output = "";

        $countryActionLineContainerId = "country_action_line_con_".$id;
        $countryActionContainerId = "country_action_con_".$id;
        $countryDeleteActionContainerId = "country_delete_con_".$id;

        $output .= "<div class='well'>";

        $output .= "<table class='form_table'>";

        $output .= "<tr>";
        $output .= "<td>Do you really want to delete this Country ?</td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td id='$countryDeleteActionContainerId'></td>";
        $output .= "</tr>";

        $output .= "<tr>";
        $output .= "<td>";
        $output .= "<button class='btn btn-primary' type='button' onclick=\"deleteCountry('$id');\">Delete</button>";
        $output .= "&nbsp;";
        $output .= "<button class='btn' type='button' onclick=\"$('#$countryActionContainerId').html('');$('#$countryActionLineContainerId').hide();\">Cancel</button>";
        $output .= "</td>";
        $output .= "</tr>";

        $output .= "</table>";

        $output .= "</div>";

        return $output;
    }

    public static function deleteCountry($id)
    {
        $output = "";

        CountryManager::editCountry($id);

        $countryLineContainerId = "country_line_con_".$id;
        $countryActionLineContainerId = "country_action_line_con_".$id;

        $output .= "<script>";
        $output .= "$('#$countryLineContainerId').hide();";
        $output .= "$('#$countryActionLineContainerId').hide();";
        $output .= "<\script>";

        return $output;
    }


    public static function getCountryCombo($comboId = "cbo_country", $selectedValue = "", $onclickAction = "")
    {
        $output = "";

        $countryList = BaseCountryLogicUtility::getCountryList();

        $output .= "<select id='$comboId' name='$comboId' onclick=\"$onclickAction\">";

        for($i = 0; $i < count($countryList); $i++)
        {
            $id = $countryList[$i]->getId();

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
