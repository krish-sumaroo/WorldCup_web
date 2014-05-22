<?php


class BackendNavigationMainEntity
{

    private $title;
    private $hasSub;
    private $leftIcon;
    private $rightIcon;
    private $itemArray;
    private $selected;
    //icon values
    //left icon values
    public static $LEFT_ICON_LIST = "icon-list-alt";
    //right icon values
    public static $RIGHT_ICON_CHEVRON_RIGHT = "icon-chevron-right";

    public function __construct($title, $hasSub = true, $leftIcon = "", $rightIcon = "")
    {
	$this->title = $title;
	$this->hasSub = $hasSub;

	if($leftIcon == "")
	{
	    $this->leftIcon = BackendNavigationMainEntity::$LEFT_ICON_LIST;
	}
	else
	{
	    $this->leftIcon = $leftIcon;
	}

	if($rightIcon == "")
	{
	    $this->rightIcon = BackendNavigationMainEntity::$RIGHT_ICON_CHEVRON_RIGHT;
	}
	else
	{
	    $this->rightIcon = $rightIcon;
	}

	$this->itemArray = array();
	$this->selected = false;
    }

    public function determineSelected($selectedIndex, $selectedReference)
    {
	if($selectedIndex == $selectedReference)
	{
	    $this->selected = true;
	}
	else
	{
	    $this->selected = false;
	}
    }

    public function addItem($url, $text)
    {
	$this->itemArray[count($this->itemArray)] = new BackendNavigationItemEntity($url, $text);
    }

    public function getDisplay()
    {
	$output = "";

	$hasSubClass = "";
	$selectedClass = "";
	$displayStyle = "";

	if($this->hasSub)
	{
	    $hasSubClass = "has_sub";
	}

	if($this->selected)
	{
	    $selectedClass = "subdrop";
	    $displayStyle = "display: block;";
	}

	$output .= "<li class='$hasSubClass'>";
	$output .= "<a href='#' class='$selectedClass'>";
	$output .= "<i class='$this->leftIcon'></i>";
	$output .= $this->title;
	$output .= "<span class='pull-right'><i class='$this->rightIcon'></i></span>";
	$output .= "</a>";

	$output .= "<ul style='$displayStyle'>";

	for($i = 0; $i < count($this->itemArray); $i++)
	{
	    $output .= $this->itemArray[$i]->getDisplay();
	}

	$output .= "</ul>";
	$output .= "</li>";

	return $output;
    }
}

?>