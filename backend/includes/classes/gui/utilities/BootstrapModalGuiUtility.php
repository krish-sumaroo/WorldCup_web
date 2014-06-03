<?php


class BootstrapModalGuiUtility
{

    public static function getModalContainer()
    {
	$output = "";

	$output .= "<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
	$output .= "<div class='modal-dialog'>";
	$output .= "<div class='modal-content' id='modal_content'>";

	$output .= "</div>";
	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }

    public static function getAction($actionText, $javascriptAction, $additionalClass = "", $showAsButton = true,
	    $title = "")
    {
	$output = "";

	$class = "";

	if($showAsButton)
	{
	    $class = "btn btn-default";
	}

	if($additionalClass)
	{
	    $class .= " ".$additionalClass;
	}

	$output .= "<a data-toggle='modal' data-target='#myModal' class='$class' onclick=\"$javascriptAction\" title=\"$title\">$actionText</a>";

	return $output;
    }

    public static function getModalContent($headerContent, $content, $footerContent, $addCloseButton = true,
	    $closeButtonText = "")
    {
	$output = "";

	$output .= "<div class='modal-header'>";
	$output .= "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
	$output .= "<h4 class='modal-title'>$headerContent</h4>";
	$output .= "</div>";

	$output .= "<div class='modal-body'>";
	$output .= $content;
	$output .= "</div>";

	$output .= "<div class='modal-footer'>";

	if($addCloseButton)
	{
	    if($closeButtonText == "")
	    {
		$closeButtonText = "Close";
	    }

	    $output .= "<button type='button' class='btn btn-default' data-dismiss='modal'>$closeButtonText</button>";
	}

	$output .= $footerContent;
	$output .= "</div>";

	return $output;
    }

    public static function getHideJavascriptAction()
    {
	$output = "";

	$output .= JavascriptUtility::getJavascriptAction("$('#myModal').modal('hide');");

	return $output;
    }
}

?>