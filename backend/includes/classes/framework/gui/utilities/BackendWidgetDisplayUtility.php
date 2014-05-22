<?php


class BackendWidgetDisplayUtility
{

    private $width;
    private $title;
    private $content;
    private $widgetHead = "";
    private $widgetAdditionalClass = "";
    private $footer = "";
    private $addPad = true;
    private $closeable = false;

    /**
     *
     * @param type $width - width must be a number between 1 and 11 inclusive
     * @param type $title
     * @param type $content
     */
    public function __construct($width, $title, $content, $closeable = false)
    {
	$this->width = $width;
	$this->title = $title;
	$this->content = $content;
	$this->closeable = $closeable;
    }

    public function setWidgetHead($widgetHead)
    {
	$this->widgetHead = $widgetHead;
    }

    public function setWidgetAdditionalClass($class)
    {
	$this->widgetAdditionalClass = $class;
    }

    public function setFooter($footer)
    {
	$this->footer = $footer;
    }

    public function setAddPad($addPad)
    {
	$this->addPad = $addPad;
    }

    public function getDisplay()
    {
	$output = "";

	$widthClass = "col-md-".$this->width;

	$output .= "<div class='$widthClass'>";
	$output .= "<div class='widget $this->widgetAdditionalClass'>";

	$output .= "<!-- Widget head -->";
	$output .= "<div class='widget-head'>";

	if($this->widgetHead == "")
	{
	    $output .= "<div class='pull-left'>$this->title</div>";
	    $output .= "<div class='widget-icons pull-right'>";
	    $output .= "<a href='#' class='wminimize'><i class='icon-chevron-up'></i></a>";

	    if($this->closeable)
	    {
		$output .= "<a href='#' class='wclose'><i class='icon-remove'></i></a>";
	    }

	    $output .= "</div>";
	    $output .= "<div class='clearfix'></div>";
	}
	else
	{
	    $output .= $this->widgetHead;
	}

	$output .= "</div>"; //widget-head

	$output .= "<!-- Widget content -->";
	$output .= "<div class='widget-content'>";

	if($this->addPad)
	{
	    $output .= "<div class='padd'>";
	    $output .= $this->content;
	    $output .= "</div>";
	}
	else
	{
	    $output .= $this->content;
	}

	$output .= "</div>";
	$output .= "<!-- Widget ends -->";

	if($this->footer != "")
	{
	    $output .= "<div class='widget-foot'>";
	    $output .= "Problems logging in? <a href='#'> Contact us here</a>";
	    $output .= "</div>";
	}

	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }
}

?>