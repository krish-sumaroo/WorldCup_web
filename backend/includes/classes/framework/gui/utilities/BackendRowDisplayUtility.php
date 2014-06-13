<?php


//http://www.codavi.com/26
class BackendRowDisplayUtility
{

    private $widgetArray;

    public function __construct()
    {
	$this->widgetArray = array();
    }

    public function getDisplay()
    {
	$output = "";

	$output .= "<div class='row'>";

	for($i = 0; $i < count($this->widgetArray); $i++)
	{
	    $output .= $this->widgetArray[$i]->getDisplay();
	}

	$output .= "</div>";

	return $output;
    }

    /**
     * 
     * @param type $width - width must be a number between 1 and 11 inclusive
     * @param type $title
     * @param type $content
     */
    public function addWidget($width, $title, $content)
    {
	$this->widgetArray[count($this->widgetArray)] = new BackendWidgetDisplayUtility($width, $title, $content);
    }
}

?>