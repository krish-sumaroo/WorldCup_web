<?php


class BackendNavigationEntity
{

    private $title;
    private $mainItemArray;

    public function __construct($title)
    {
	$this->title = $title;
	$this->mainItemArray = array();
    }

    public function addMainItem(BackendNavigationMainEntity $backendNavigationMainEntity)
    {
	$this->mainItemArray[count($this->mainItemArray)] = $backendNavigationMainEntity;
    }

    public function getDisplay()
    {
	$output = "";

	$output .= "<div class='sidebar'>";
	$output .= "<div class='sidebar-dropdown'><a href='#'>Navigation</a></div>";

	$output .= "<!--- Sidebar navigation -->";
	$output .= "<!-- If the main navigation has sub navigation, then add the class 'has_sub' to 'li' of main navigation. -->";
	$output .= "<ul id='nav'>";
	$output .= "<!-- Main menu with font awesome icon -->";

	for($i = 0; $i < count($this->mainItemArray); $i++)
	{
	    $output .= $this->mainItemArray[$i]->getDisplay();
	}

//	$output .= "<li><a href='$dashboardUrl' class='open'><i class='icon-home'></i> Dashboard</a></li>";
//	$output .= "<li class='has_sub'><a href='#'><i class='icon-list-alt'></i> Products <span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
//	$output .= "<ul>";
//	$output .= "<li><a href='$addProductUrl'>Add Product</a></li>";
//	$output .= "<li><a href='$productListUrl'>Product List</a></li>";
//	$output .= "<li><a href='$featuredProductListUrl'>Featured Product List</a></li>";
//	$output .= "<li><a href='$specialFeaturedProductListUrl'>Special Featured Product List</a></li>";
//	$output .= "</ul>";
//	$output .= "</li>";
//
//	$output .= "<li class='has_sub'><a href='#'><i class='icon-file-alt'></i> Category <span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
//	$output .= "<ul>";
//	$output .= "<li><a href='$addCategoryUrl'>Add Category</a></li>";
//	$output .= "<li><a href='$categoryListUrl'>Category List</a></li>";
//	$output .= "</ul>";
//	$output .= "</li>";
//
//	$output .= "<li class='has_sub'><a href='#'><i class='icon-file-alt'></i> Customer <span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
//	$output .= "<ul>";
//	$output .= "<li><a href='$customerListUrl'>Customer List</a></li>";
//	$output .= "</ul>";
//	$output .= "</li>";
//
//	$output .= "<li class='has_sub'><a href='#'><i class='icon-file-alt'></i> Order <span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
//	$output .= "<ul>";
//	$output .= "<li><a href='$orderRequestedListUrl'>Orders Requested</a></li>";
//	$output .= "<li><a href='$orderInProcessListUrl'>Orders In Process</a></li>";
//	$output .= "<li><a href='$orderReadyListUrl'>Orders Ready</a></li>";
//	$output .= "<li><a href='$orderDeliveredListUrl'>Orders Delivered</a></li>";
//	$output .= "<li><a href='$orderReceivedListUrl'>Orders Received</a></li>";
//	$output .= "</ul>";
//	$output .= "</li>";
//
//	$output .= "<li class='has_sub'><a href='#' class='subdrop'><i class='icon-file-alt'></i> Banners <span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
//	$output .= "<ul style='display: block;'>";
//	$output .= "<li><a href='$bannerListUrl'>Banners List</a></li>";
//	$output .= "<li><a href='$addBannerUrl'>Add Banner</a></li>";
//	$output .= "</ul>";
//	$output .= "</li>";
//
//	$output .= "<li class='has_sub'><a href='#'><i class='icon-file-alt'></i> Notifications <span class='pull-right'><i class='icon-chevron-right'></i></span></a>";
//	$output .= "<ul>";
//	$output .= "<li><a href='$clerkListUrl'>Notifier List</a></li>";
//	$output .= "</ul>";
//	$output .= "</li>";

	$output .= "</ul>";
	$output .= "</div>";

	return $output;
    }
}

