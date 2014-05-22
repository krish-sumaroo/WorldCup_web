<?php


class FrontEndHomeTemplateGuiUtility extends TemplateGuiUtility
{

    private $bottomCarouselContent = "";
    private $showNewsLetter = false;

    public function __construct()
    {
	parent::__construct();

	$this->googleFont = true;
    }

    public function setBottomCarouselContent($content)
    {
	$this->bottomCarouselContent = $content;
    }

    protected function initialiseCss()
    {
	$this->defaultCssFiles = array();

	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "prettyPhoto";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "flexslider";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "font-awesome";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "style";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "application/front";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = $this->getTemplateTypeStyle();

	$this->additionalCssFiles = array();
    }

    protected function initialiseJs()
    {
	$this->defaultJsFiles = array();
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "ajax", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "jquery", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "script", "folder" => "");

	$this->additionalJsFiles = array();
	$this->externalJsFiles = array();

	$this->endJsFiles = array();
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "bootstrap", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.prettyPhoto", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "filter", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.flexslider-min", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.carouFredSel-6.1.0-packed", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "custom", "folder" => "front");
    }

    public function getDisplay($title, $content)
    {
	$output = "";

	return $output;
    }

    public function getNormalDisplay($title, $data, $selectedNav = "")
    {
	$output = "";

//	$fullTitle = $title." - ".MemberManager::getBusinessName();

	$output .= $this->openHtmlHeader($title);
	$output .= $this->loadAllJavascriptImages();
	$output .= $this->setJavascriptFolderPath(); //should always be called after other javascript files
	$output .= $this->closeHtmlHeader();

	$output .= $this->getHeader();
	$output .= $this->getHeaderSection();
	$output .= $this->getNavigationSection();
	$output .= $this->getFlexsliderSection();
	$output .= $this->getItemLineDisplay();
	$output .= $this->getDataDisplay($data);
	$output .= $this->getBottomCarouselContent();
	$output .= $this->getNewsLetterDisplay();
	$output .= $this->getFooter();

	return $output;
    }

    private function getHeaderSection()
    {
	$output = "";

	$output .= FrontEndHeaderGuiUtility::getDisplay();

	return $output;
    }

    private function getNavigationSection()
    {
	$output = "";

	$output .= "<div class='navbar bs-docs-nav' role='banner'>";
	$output .= "<div class='container'>";

	$output .= FrontEndNavigation::getDisplay();

	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }

    private function getFlexsliderSection()
    {
	$output = "";

	$output .= "<div class='container flex-main'>";
	$output .= FrontEndFlexsliderGuiUtility::getDisplay();
	$output .= "</div>";

	return $output;
    }

    private function getItemLineDisplay()
    {
	$output = "";

//	$output .= "<div class='promo'>";
//	$output .= "<div class='container'>";
	$output .= FeaturedProductGuiUtility::getDisplay();
//	$output .= "</div>";
//	$output .= "</div>";

	return $output;
    }

    protected function getDataDisplay($data, $selectedNav = "")
    {
	$output = "";

	$output .= "<div class='items'>";
	$output .= "<div class='container' style='background-color: white;border: solid thin lightgray;'>";
	$output .= $data;
	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }

    private function getBottomCarouselContent()
    {
	$output = "";

	if($this->bottomCarouselContent != "")
	{
	    $dynamicBackground = DynamicTemplateGuiUtility::getContentBackgroundStyle();

	    $output .= "<div class='recent-posts'>";
	    $output .= "<div class='container' style='$dynamicBackground'>";

	    $output .= $this->bottomCarouselContent;
	    $output .= "</div>";
	    $output .= "</div>";
	}

	return $output;
    }

    private function getNewsLetterDisplay()
    {
	$output = "";

	if($this->showNewsLetter)
	{
	    $output .= "<div class='container newsletter'>";
	    $output .= NewsletterDisplayGuiUtility::getHomeDisplay();
	    $output .= "</div>";
	}

	return $output;
    }

    protected function getFooter()
    {
	$output = "";

	$output .= "<footer>";
	$output .= "<div class='container'>";
	$output .= FrontEndFooterGuiUtility::getDisplay();
	$output .= "</div>";
	$output .= "</footer>";

	$output .= BootstrapModalGuiUtility::getModalContainer();

	$output .= parent::getFooter();

	return $output;
    }

//    protected function openHtmlHeader($title)
//    {
//	$output = "";
//
//	$output .= "<!DOCTYPE html>";
//	$output .= "<html lang='en'>";
//	$output .= "<head>";
//	$output .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
//	$output .= "<meta charset='utf-8'>";
//	$output .= "<title>$title</title>";
//	$output .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
//	$output .= "<meta name='description' content=''>";
//	$output .= "<meta name='author' content=''>";
//
//	$output .= "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>";
//
//	$output .= "<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->";
//	$output .= "<!--[if lt IE 9]>";
//	$output .= "<script src='//html5shim.googlecode.com/svn/trunk/html5.js'></script>";
//	$output .= "<![endif]-->";
//	$output .= "<script src='//html5shim.googlecode.com/svn/trunk/html5.js'></script>";
//
//	return $output;
//    }
//
//    protected function closeHtmlHeader()
//    {
//	$output = "";
//
//	$output .= "</head>";
//
//	return $output;
//    }
//
//    public function getNormalDisplay($title, $data, $navigationItemSelected = "", $showSideBar = true)
//    {
//	$output = "";
//
//	$output .= $this->openHtmlHeader($title);
//	$output .= $this->loadAllCss();
//	$output .= $this->loadAllJavascript();
//	$output .= $this->loadAllJavascriptImages();
//	$output .= $this->setJavascriptFolderPath(); //should always be called after other javascript files
//	$output .= $this->closeHtmlHeader();
//
//	$output .= $this->getHeader($navigationItemSelected);
//	$output .= $this->getDataDisplay($data, $showSideBar);
//	$output .= $this->getFooter();
//
//	return $output;
//    }
//
//    public function getLoggedDisplay($title, $data, $navigationItemSelected = "")
//    {
//	$output = "";
//
//	$output .= $this->openHtmlHeader($title);
//	$output .= $this->loadAllCss();
//	$output .= $this->loadAllJavascript();
//	$output .= $this->loadAllJavascriptImages();
//	$output .= $this->setJavascriptFolderPath(); //should always be called after other javascript files
//	$output .= $this->closeHtmlHeader();
//
//	$output .= $this->getHeader($navigationItemSelected);
//	$output .= $this->getLoggedDataDisplay($data);
//	$output .= $this->getFooter();
//
//	return $output;
//    }
//
//    protected function getDataDisplay($data)
//    {
//	$output = "";
//
//	$output .= "<div class='content'>";
//	$output .= BackendNavigation::getSideBarDisplay();
//
//	$output .= "<div class='mainbar'>";
//	$output .= $this->getPageHeading($this->title);
//
//	$output .= "<div class='matter'>";
//	$output .= "<div class='container'>";
//	$output .= $data;
//	$output .= "</div>";
//	$output .= "</div>";
//
//	$output .= "</div>";
//
//	$output .= "</div>";
//
//	return $output;
//    }
//
//    protected function getFooter()
//    {
//	$output = "";
//
//	$output .= $this->loadAllEndJavascript();
//
//	$output .= "</body>";
//	$output .= "</html>";
//
//	return $output;
//    }
//
//    protected function getHeader()
//    {
//	$output = "";
//
//	$output .= "<body>";
//	$output .= "<div class='head'>";
//
//	$output .= BackendNavigation::getDisplay();
//	$output .= BackendHeaderGuiUtility::getDisplay();
//
//	$output .= "</div>";
//
//	return $output;
//    }
//
//    protected function getPageHeading($title)
//    {
//	$output = "";
//
//	$output .= "<div class='page-head'>";
//	$output .= "<h2 class='pull-left'><i class='icon-home'></i> $title</h2>";
//
//	$output .= "<div class='clearfix'></div>";
//
//	$output .= "</div>";
//
//	return $output;
//    }

    private function getTemplateTypeStyle()
    {
	$styleFile = "";

	if(MemberManager::getTemplateType() == MemberLogicUtility::$BLUE_TEMPLATE)
	{
	    $styleFile = "blue";
	}
	elseif(MemberManager::getTemplateType() == MemberLogicUtility::$BROWN_TEMPLATE)
	{
	    $styleFile = "brown";
	}
	elseif(MemberManager::getTemplateType() == MemberLogicUtility::$GREEN_TEMPLATE)
	{
	    $styleFile = "green";
	}
	elseif(MemberManager::getTemplateType() == MemberLogicUtility::$RED_TEMPLATE)
	{
	    $styleFile = "red";
	}
	elseif(MemberManager::getTemplateType() == MemberLogicUtility::$ORANGE_TEMPLATE)
	{
	    $styleFile = "orange";
	}
	elseif(MemberManager::getTemplateType() == MemberLogicUtility::$YELLOW_TEMPLATE)
	{
	    $styleFile = "yellow";
	}

	return $styleFile;
    }
}

?>