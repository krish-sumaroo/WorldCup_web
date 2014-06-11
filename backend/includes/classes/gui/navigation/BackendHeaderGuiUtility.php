<?php


class BackendHeaderGuiUtility
{

    public static function getDisplay()
    {
	$output = "";

	$output .= "<header>";
	$output .= "<div class='container'>";
	$output .= "<div class='row'>";

	$output .= BackendHeaderGuiUtility::getLogoDisplay();
	$output .= BackendHeaderGuiUtility::getButtonDisplay();

	$output .= "</div>";
	$output .= "</div>";
	$output .= "</header>";

	return $output;
    }

    private static function getButtonDisplay()
    {
	$output = "";

	$output .= "<!-- Button section -->";
	$output .= "<div class='col-md-4'>";

	$output .= "<!-- Buttons -->";
	$output .= "<ul class='nav nav-pills'>";

//	$output .= BackendHeaderGuiUtility::getSimpleLineDisplay();
//	$output .= BackendHeaderGuiUtility::getExtendedLineDisplay();
//	$output .= BackendHeaderGuiUtility::getSecondSimpleLineDisplay();

	$output .= "</ul>";
	$output .= "</div>";

	$output .= BackendHeaderGuiUtility::getDataSectionDisplay();

	return $output;
    }

    private static function getDataSectionDisplay()
    {
	$output = "";

	$output .= "<div class='col-md-4'>";
	$output .= "<div class='header-data'>";

//	$output .= BackendHeaderGuiUtility::getTrafficDisplay();
//	$output .= BackendHeaderGuiUtility::getMemberData();
//	$output .= BackendHeaderGuiUtility::getRevenueData();

	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }

    private static function getTrafficDisplay()
    {
	$output = "";

	$output .= "<div class='hdata'>";
	$output .= "<div class='mcol-left'>";
	$output .= "<i class='icon-signal bred'></i>";
	$output .= "</div>";
	$output .= "<div class='mcol-right'>";
	$output .= "<p><a href='#'>7000</a> <em>visits</em></p>";
	$output .= "</div>";
	$output .= "<div class='clearfix'></div>";
	$output .= "</div>";

	return $output;
    }

    private static function getMemberData()
    {
	$output = "";

	$output .= "<div class='hdata'>";
	$output .= "<div class='mcol-left'>";
	$output .= "<i class='icon-user bblue'></i>";
	$output .= "</div>";
	$output .= "<div class='mcol-right'>";
	$output .= "<p><a href='#'>test</a> <em>users</em></p>";
	$output .= "</div>";
	$output .= "<div class='clearfix'></div>";
	$output .= "</div>";

	return $output;
    }

    private static function getRevenueData()
    {
	$output = "";

	$output .= "<div class='hdata'>";
	$output .= "<div class='mcol-left'>";
	$output .= "<i class='icon-money bgreen'></i>";
	$output .= "</div>";
	$output .= "<div class='mcol-right'>";
	$output .= "<p><a href='#'>test</a><em>orders</em></p>";
	$output .= "</div>";
	$output .= "<div class='clearfix'></div>";
	$output .= "</div>";

	return $output;
    }

    private static function getSecondSimpleLineDisplay()
    {
	$output = "";

	$output .= "<!-- Members button with number of latest members count -->";
	$output .= "<li class='dropdown dropdown-big'>";
	$output .= "<a class='dropdown-toggle' href='#' data-toggle='dropdown'>";
	$output .= "<i class='icon-user'></i> Users <span class='label label-success'>6</span>";
	$output .= "</a>";
	$output .= "";
	$output .= "<ul class='dropdown-menu'>";
	$output .= "<li>";
	$output .= "<!-- Heading - h5 -->";
	$output .= "<h5><i class='icon-user'></i> Users</h5>";
	$output .= "<!-- Use hr tag to add border -->";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<!-- List item heading h6-->";
	$output .= "<h6><a href='#'>Ravi Kumar</a> <span class='label label-warning pull-right'>Free</span></h6>";
	$output .= "<div class='clearfix'></div>";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<h6><a href='#'>Balaji</a> <span class='label label-important pull-right'>Premium</span></h6>";
	$output .= "<div class='clearfix'></div>";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<h6><a href='#'>Kumarasamy</a> <span class='label label-warning pull-right'>Free</span></h6>";
	$output .= "<div class='clearfix'></div>";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<div class='drop-foot'>";
	$output .= "<a href='#'>View All</a>";
	$output .= "</div>";
	$output .= "</li>";
	$output .= "</ul>";
	$output .= "</li>";

	return $output;
    }

    private static function getExtendedLineDisplay()
    {
	$output = "";

	$output .= "<!-- Message button with number of latest messages count-->";
	$output .= "<li class='dropdown dropdown-big'>";
	$output .= "<a class='dropdown-toggle' href='#' data-toggle='dropdown'>";
	$output .= "<i class='icon-envelope-alt'></i> Inbox <span class='label label-primary'>6</span>";
	$output .= "</a>";
	$output .= "";
	$output .= "<ul class='dropdown-menu'>";
	$output .= "<li>";
	$output .= "<!-- Heading - h5 -->";
	$output .= "<h5><i class='icon-envelope-alt'></i> Messages</h5>";
	$output .= "<!-- Use hr tag to add border -->";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<!-- List item heading h6 -->";
	$output .= "<h6><a href='#'>Hello how are you?</a></h6>";
	$output .= "<!-- List item para -->";
	$output .= "<p>Quisque eu consectetur erat eget semper...</p>";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<h6><a href='#'>Today is wonderful?</a></h6>";
	$output .= "<p>Quisque eu consectetur erat eget semper...</p>";
	$output .= "<hr />";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<div class='drop-foot'>";
	$output .= "<a href='#'>View All</a>";
	$output .= "</div>";
	$output .= "</li>";
	$output .= "</ul>";
	$output .= "</li>";

	return $output;
    }

    private static function getSimpleLineDisplay()
    {
	$output = "";

	$output .= "<li class='dropdown dropdown-big'>";
	$output .= "<a class='dropdown-toggle' href='#' data-toggle='dropdown'>";
	$output .= "<i class='icon-comments'></i> Pending Orders <span class='label label-info'>2</span>";
	$output .= "</a>";

	$output .= "<ul class='dropdown-menu'>";
	$output .= "<li>";
	$output .= "<h5><i class='icon-comments'></i> Orders</h5>";
	$output .= "<hr />";
	$output .= "</li>";

	$output .= "<li>";
	$output .= "<h6>";
	$output .= "<a href='#'>test</a>";
	$output .= "<span class='label label-warning pull-right'>3</span>";
	$output .= "</h6>";
	$output .= "<div class='clearfix'></div>";
	$output .= "<hr />";
	$output .= "</li>";

	$output .= "</ul>";
	$output .= "</li>";

	return $output;
    }

    private static function getLogoDisplay()
    {
	$output = "";

	$urlBackend = UrlConfiguration::getRootPagesUrl("index.php");
	$businessName = Configuration::$APPLICATION_NAME;

	$output .= "<!-- Logo section -->";
	$output .= "<div class='col-md-4'>";
	$output .= "<!-- Logo. -->";
	$output .= "<div class='logo'>";
	$output .= "<h1><a href='$urlBackend'>$businessName</a></h1>";
	$output .= "<p class='meta'>Your admin panel</p>";
	$output .= "</div>";
	$output .= "<!-- Logo ends -->";
	$output .= "</div>";

	return $output;
    }
}

?>