<?php


class FrontEndContactTemplateGuiUtility extends FrontEndTemplateGuiUtility
{

    public function __construct()
    {
	parent::__construct();
    }

    protected function getDataDisplay($data, $selectedNav = "")
    {
	$output = "";

	$dynamicBackground = DynamicTemplateGuiUtility::getContentBackgroundStyle();

	$output .= "<div class='container' style='$dynamicBackground'>";
	$output .= $data;
	$output .= "</div>";

	return $output;
    }
}

?>