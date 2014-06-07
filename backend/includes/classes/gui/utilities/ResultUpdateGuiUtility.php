<?php


/**
 * Description of ResultUpdateGuiUtility
 *
 * @author suyash
 */
class ResultUpdateGuiUtility
{

    public static function getResultDisplay($resultText = "", $containerId = "", $fade = true, $span = false)
    {
	$output = "";

	$output .= ResultUpdateGuiUtility::getDisplay($resultText, $containerId, $fade, "action_message", $span);

	return $output;
    }

    public static function getErrorDisplay($resultText = "", $containerId = "", $fade = true)
    {
	$output = "";

	$output .= ResultUpdateGuiUtility::getDisplay($resultText, $containerId, $fade, "error_message");

	return $output;
    }

    public static function getBootstrapErrorDisplay($error, $width = "")
    {
	$output = "";

	$style = "";

	if($width != "")
	{
	    $style = "style='width: $width;'";
	}

	$output .= "<div class='alert alert-danger alert-dismissable center-block' $style>";
	$output .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	$output .= "<strong>Warning!</strong> $error";
	$output .= "</div>";

	return $output;
    }

    public static function getBootstrapSuccessDisplay($message, $width = "")
    {
	$output = "";

	$style = "";

	if($width != "")
	{
	    $style = "style='width: $width;'";
	}

	$output .= "<div class='alert alert-success' $style>";
	$output .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
	$output .= "<strong>Success!</strong> $message";
	$output .= "</div>";

	return $output;
    }

    public static function getBootstrapInfoDisplay($text, $width = "")
    {
	$output = "";

	$style = "";

	if($width != "")
	{
	    $style = "style='width: $width;'";
	}

	$output .= "<div class='alert alert-info' $style>";
	$output .= $text;
	$output .= "</div>";

	return $output;
    }

    public static function getBootstrapAlertDisplay($text, $width = "")
    {
	$output = "";

	$style = "";

	if($width != "")
	{
	    $style = "style='width: $width;'";
	}

	$output .= "<div class='alert alert-warning' $style>";
	$output .= $text;
	$output .= "</div>";

	return $output;
    }

    private static function getDisplay($resultText = "", $containerId = "", $fade = true, $class = "action_message",
	    $span = false)
    {
	$output = "";

	if($resultText == "")
	{
	    $resultText = "Changes have been saved";
	}

	if($containerId == "")
	{
	    $containerId = "con_".time();
	}

	if($span)
	{
	    $output .= "<span id='$containerId' class='$class'>$resultText</span>";
	}
	else
	{
	    $output .= "<div id='$containerId' class='$class'>$resultText</div>";
	}

	if($fade)
	{
	    $output .= "<script>";
	    $output .= "$('#$containerId').fadeOut(3000);";
	    $output .= "</script>";
	}

	return $output;
    }
}

?>
