<?php


//http://www.codavi.com/25
class BackendNavigation
{

    public static $GAME_SELECTED = "game";
    public static $CATEGORY_SELECTED = "category";
    public static $CUSTOMER_SELECTED = "customer";
    public static $ORDER_SELECTED = "order";
    public static $BANNER_SELECTED = "banner";
    public static $NOTIFIER_SELECTED = "notifier";
    public static $DROPPOINT_SELECTED = "droppoint";
    public static $WEBSITE_INFORMATION_SELECTED = "website_information";

    public static function getDisplay()
    {
	$output = "";

	$output .= "<div class='navbar navbar-fixed-top bs-docs-nav' role='banner'>";
	$output .= "<div class='conjtainer'>";
	$output .= BackendNavigation::getBrandDisplay();
	$output .= BackendNavigation::getNavigationItemDisplay();
	$output .= "</div>";

	$output .= "</div>";

	return $output;
    }

    private static function getNavigationItemDisplay()
    {
	$output = "";

	$output .= "<!-- Navigation starts -->";
	$output .= "<nav class='collapse navbar-collapse bs-navbar-collapse' role='navigation'>";

//	$output .= "<ul class='nav navbar-nav'>";
//	$output .= BackendNavigation::getUploadToCloudNavigation();
//	$output .= BackendNavigation::getSyncWithServerDisplay();
//	$output .= "</ul>";
//	$output .= BackendNavigation::getSearchFormDisplay();
	$output .= BackendNavigation::getLinksDisplay();

	$output .= "</nav>";

	return $output;
    }

    private static function getLinksDisplay()
    {
	$output = "";

	$logoutUrl = UrlConfiguration::getUrl("admin", "logout");
	$settingsUrl = UrlConfiguration::getUrl("admin", "settings");

	$output .= "<!-- Links -->";
	$output .= "<ul class='nav navbar-nav pull-right'>";
	$output .= "<li class='dropdown pull-right'>";
	$output .= "<a data-toggle='dropdown' class='dropdown-toggle' href='#'>";
	$output .= "<i class='icon-user'></i> Admin <b class='caret'></b>";
	$output .= "</a>";
	$output .= "";
	$output .= "<!-- Dropdown menu -->";
	$output .= "<ul class='dropdown-menu'>";
//	$output .= "<li><a href='#'><i class='icon-user'></i> Profile</a></li>";
	$output .= "<li><a href='$settingsUrl'><i class='icon-cogs'></i> Settings</a></li>";
	$output .= "<li><a href='$logoutUrl'><i class='icon-off'></i> Logout</a></li>";
	$output .= "</ul>";
	$output .= "</li>";
	$output .= "</ul>";

	return $output;
    }

    private static function getSearchFormDisplay()
    {
	$output = "";

	$output .= "<!-- Search form -->";
	$output .= "<form class='navbar-form navbar-left' role='search'>";
	$output .= "<div class='form-group'>";
	$output .= "<input type='text' class='form-control' placeholder='Search'>";
	$output .= "</div>";
	$output .= "</form>";

	return $output;
    }

    private static function getUploadToCloudNavigation()
    {
	$output = "";

	$output .= "<!-- Upload to server link. Class 'dropdown-big' creates big dropdown -->";
	$output .= "<li class='dropdown dropdown-big'>";
	$output .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='label label-success'><i class='icon-cloud-upload'></i></span> Upload to Cloud</a>";
	$output .= "<!-- Dropdown -->";
	$output .= "<ul class='dropdown-menu'>";
	$output .= "<li>";
	$output .= "<!-- Progress bar -->";
	$output .= "<p>Photo Upload in Progress</p>";
	$output .= "<!-- Bootstrap progress bar -->";
	$output .= "<div class='progress progress-striped active'>";
	$output .= "<div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 40%'>";
	$output .= "<span class='sr-only'>40% Complete</span>";
	$output .= "</div>";
	$output .= "</div>";
	$output .= "";
	$output .= "<hr />";
	$output .= "";
	$output .= "<!-- Progress bar -->";
	$output .= "<p>Video Upload in Progress</p>";
	$output .= "<!-- Bootstrap progress bar -->";
	$output .= "<div class='progress progress-striped active'>";
	$output .= "<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 80%'>";
	$output .= "<span class='sr-only'>80% Complete</span>";
	$output .= "</div>";
	$output .= "</div>";
	$output .= "";
	$output .= "<hr />";
	$output .= "";
	$output .= "<!-- Dropdown menu footer -->";
	$output .= "<div class='drop-foot'>";
	$output .= "<a href='#'>View All</a>";
	$output .= "</div>";
	$output .= "";
	$output .= "</li>";
	$output .= "</ul>";
	$output .= "</li>";

	return $output;
    }

    private static function getSyncWithServerDisplay()
    {
	$output = "";

	$output .= "<!-- Sync to server link -->";
	$output .= "<li class='dropdown dropdown-big'>";
	$output .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='label label-danger'><i class='icon-refresh'></i></span> Sync with Server</a>";
	$output .= "<!-- Dropdown -->";
	$output .= "<ul class='dropdown-menu'>";
	$output .= "<li>";
	$output .= "<!-- Using 'icon-spin' class to rotate icon. -->";
	$output .= "<p><span class='label label-info'><i class='icon-cloud'></i></span> Syncing Members Lists to Server</p>";
	$output .= "<hr />";
	$output .= "<p><span class='label label-warning'><i class='icon-cloud'></i></span> Syncing Bookmarks Lists to Cloud</p>";
	$output .= "";
	$output .= "<hr />";
	$output .= "";
	$output .= "<!-- Dropdown menu footer -->";
	$output .= "<div class='drop-foot'>";
	$output .= "<a href='#'>View All</a>";
	$output .= "</div>";
	$output .= "</li>";
	$output .= "</ul>";
	$output .= "</li>";

	return $output;
    }

    private static function getBrandDisplay()
    {
	$output = "";

	$urlRoot = UrlConfiguration::getRootPagesUrl("index.php");

	$output .= "<!-- Menu button for smaller screens -->";
	$output .= "<div class='navbar-header'>";
	$output .= "<button class='navbar-toggle btn-navbar' type='button' data-toggle='collapse' data-target='.bs-navbar-collapse'>";
	$output .= "<span>Menu</span>";
	$output .= "</button>";
	$output .= "<!-- Site name for smallar screens -->";
	$output .= "<a href='$urlRoot' class='navbar-brand hidden-lg'>".Configuration::$APPLICATION_NAME."</a>";
	$output .= "</div>";

	return $output;
    }

    public static function getSideBarDisplay($selectedNav = "")
    {
	$output = "";

	$gameListUrl = UrlConfiguration::getUrl("games", "gameList");

	$productMainNavigationEntity = new BackendNavigationMainEntity("Games");
	$productMainNavigationEntity->determineSelected($selectedNav, BackendNavigation::$GAME_SELECTED);
	$productMainNavigationEntity->addItem($gameListUrl, "Game List");

	$backendNavigationEntity = new BackendNavigationEntity("Navigation");
	$backendNavigationEntity->addMainItem($productMainNavigationEntity);

	$output .= $backendNavigationEntity->getDisplay();

	return $output;
    }
}

?>