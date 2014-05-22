<?php


class BackendNavigationItemEntity
{

    private $url;
    private $text;

    public function __construct($url, $text)
    {
	$this->url = $url;
	$this->text = $text;
    }

    public function getDisplay()
    {
	$output = "";

	$output .= "<li>";
	$output .= "<a href='$this->url'>$this->text</a>";
	$output .= "</li>";

	return $output;
    }
}

?>