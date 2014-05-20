<?php

class BootstrapNavigation extends Navigation
{
    public static function getDisplay($selected = "")
    {
        $output = "";

        $adminSelected = "";
        $homeSelected = "";

        if($selected == Navigation::$ADMIN_SELECTED)
        {
            $adminSelected = "active";
        }

        $homeLink = "index.php";

        $output .= "<div class='navbar navbar-fixed-top'>";
        $output .= "<div class='navbar-inner'>";
        $output .= "<div class='container'>";
        $output .= "<button type='button' class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>";
        $output .= "<span class='icon-bar'></span>";
        $output .= "<span class='icon-bar'></span>";
        $output .= "<span class='icon-bar'></span>";
        $output .= "</button>";
        $output .= "<div class='nav-collapse collapse'>";

        $output .= "<ul class='nav'>";
        $output .= "<li class='$homeSelected' id='li-contact'><a href=\"$homeLink\">Home</a></li>";

        $urlAdmin = UrlConfiguration::getUrl("admin", "adminList");

        $output .= "<li class='dropdown'>";
        $output .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Application <b class='caret'></b></a>";
        $output .= "<ul class='dropdown-menu'>";

        $output .= "<li class='$adminSelected' id='li-analyser'><a href=\"$urlAdmin\">Admin</a></li>";

        $output .= "</ul>";
        $output .= "</ul>";

        $output .= "</div><!--/.nav-collapse -->";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        return $output;
    }
}

?>
