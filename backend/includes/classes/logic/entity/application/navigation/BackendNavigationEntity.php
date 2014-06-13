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

	$output .= "</ul>";
	$output .= "</div>";

	return $output;
    }
}

