<?php


//http://www.codavi.com/10
class TemplateGuiUtility
{

    protected $defaultCssFiles;
    protected $additionalCssFiles;
    protected $defaultJsFiles;
    protected $additionalJsFiles;
    protected $externalJsFiles;
    protected $endJsFiles; //files added at the end of the page
    protected $javascriptImages;
    protected $googleFont = false;

    public function __construct()
    {
	$this->initialiseCss();
	$this->initialiseJs();
	$this->initialiseJavascriptImages();
    }

    protected function initialiseCss()
    {
	$this->defaultCssFiles = array();

	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap/bootstrap.min";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap/united/bootstrap";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap/bootstrap-responsive.min";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "style";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "main";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "jquery.rating";

	$this->additionalCssFiles = array();
    }

    protected function initialiseJs()
    {
	$this->defaultJsFiles = array();
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "script", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "utilities", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "ajax", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "jquery.min", "folder" => "template");

	$this->additionalJsFiles = array();
	$this->externalJsFiles = array();

	$this->endJsFiles = array();
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "bootstrap.min", "folder" => "bootstrap");
    }

    protected function initialiseJavascriptImages()
    {
	$this->javascriptImages = array();
    }

    protected function openHtmlHeader($title)
    {
	$output = "";

	$output .= "<!DOCTYPE html>";
	$output .= "<html lang='en'>";

	$output .= "<head>";
	$output .= "<meta http-equiv='content-type' content='text/html; charset=UTF-8'>";
	$output .= "<meta charset='utf-8'>";
	$output .= "<title>$title</title>";
	$output .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
	$output .= "<meta name='description' content=''>";
	$output .= "<meta name='keywords' content=''>";
	$output .= "<meta name='author' content=''>";

	if($this->googleFont)
	{
	    $output .= $this->addGoogleFont();
	}

	$output .= $this->loadAllCss();
	$output .= $this->loadAllJavascript();

	$output .= "<!-- HTML5 Support for IE -->
	<!--[if lt IE 9]>";
	$output .= UrlConfiguration::loadJavascript("html4shim");
	$output .= "<![endif]-->";

	$output .= "<link rel='shortcut icon' href='img/favicon/favicon.png'>";

	return $output;
    }

    protected function closeHtmlHeader()
    {
	$output = "";

	$output .= "</head>";

	return $output;
    }

    public function getNormalDisplay($title, $data, $selectedNav = "")
    {
	$output = "";

	$output .= $this->openHtmlHeader($title);
//	$output .= $this->loadAllCss();
//	$output .= $this->loadAllJavascript();
	$output .= $this->loadAllJavascriptImages();
	$output .= $this->setJavascriptFolderPath(); //should always be called after other javascript files
	$output .= $this->closeHtmlHeader();

	$output .= $this->getHeader();
	$output .= $this->getDataDisplay($data, $selectedNav);
	$output .= $this->getFooter();

	return $output;
    }

    public function getLoggedDisplay($title, $data, $navigationItemSelected = "")
    {
	$output = "";

	$output .= $this->openHtmlHeader($title);
	$output .= $this->loadAllCss();
	$output .= $this->loadAllJavascript();
	$output .= $this->loadAllJavascriptImages();
	$output .= $this->setJavascriptFolderPath(); //should always be called after other javascript files
	$output .= $this->closeHtmlHeader();

	$output .= $this->getHeader($navigationItemSelected);
	$output .= $this->getLoggedDataDisplay($data);
	$output .= $this->getAboveFooter();
	$output .= $this->getFooter();
	$output .= $this->getNotificationDisplay();

	return $output;
    }

    protected function getDataDisplay($data, $selectedNav = "")
    {
	$output = "";

	$output .= $data;

	return $output;
    }

    protected function getFooter()
    {
	$output = "";

	$output .= $this->loadAllEndJavascript();

	$output .= "</body>";
	$output .= "</html>";

	return $output;
    }

    protected function getLoggedDataDisplay($data)
    {
	$output = "";

	$output .= "<div id='content'>";
	$output .= "<div class='container'>";
	$output .= $data;
	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }

    protected function getHeader()
    {
	$output = "";

	$output .= "<body>";

	return $output;
    }

    public function setJavascriptFolderPath()
    {
	$output = "";

	$url = Configuration::$URL;

//	$domain = $_SERVER['HTTP_HOST'];
//	$domain = $domain.Configuration::$APPLICATION_DOMAIN_ADJUSTMENT;

	$output .= "<script>";
	$output .= "var imageFolder = '".UrlConfiguration::getImageSrc("")."';";
	$output .= "var websiteUrl = '$url';";
	$output .= "</script>";

	return $output;
    }

    protected function loadAllCss()
    {
	$output = "";

	for($i = 0; $i < count($this->defaultCssFiles); $i++)
	{
	    $output .= UrlConfiguration::loadCss($this->defaultCssFiles[$i]);
	}

	for($i = 0; $i < count($this->additionalCssFiles); $i++)
	{
	    $output .= UrlConfiguration::loadCss($this->additionalCssFiles[$i]);
	}

	return $output;
    }

    protected function loadAllJavascript()
    {
	$output = "";

	for($i = 0; $i < count($this->defaultJsFiles); $i++)
	{
	    $output .= UrlConfiguration::loadJavascript($this->defaultJsFiles[$i]['file'], $this->defaultJsFiles[$i]['folder']);
	}

	for($i = 0; $i < count($this->additionalJsFiles); $i++)
	{
	    $output .= UrlConfiguration::loadJavascript($this->additionalJsFiles[$i]['file'],
			    $this->additionalJsFiles[$i]['folder']);
	}

	for($i = 0; $i < count($this->externalJsFiles); $i++)
	{
	    $output .= UrlConfiguration::loadExternalJavascript($this->externalJsFiles[$i]);
	}

	return $output;
    }

    protected function loadAllEndJavascript()
    {
	$output = "";

	for($i = 0; $i < count($this->endJsFiles); $i++)
	{
	    $output .= UrlConfiguration::loadJavascript($this->endJsFiles[$i]['file'], $this->endJsFiles[$i]['folder']);
	}

	return $output;
    }

    protected function loadAllJavascriptImages()
    {
	$output = "";

	$output .= "<script>";

	for($i = 0; $i < count($this->javascriptImages); $i++)
	{
	    $output .= "var ".$this->javascriptImages[$i]['var']." = \"".
		    UrlConfiguration::getImageSrc($this->javascriptImages[$i]['image'])."\";";
	}

	$output .= "</script>";

	return $output;
    }

    public function addCssFile($css, $folder = "")
    {
	if($folder == "")
	{
	    $this->additionalCssFiles[count($this->additionalCssFiles)] = $css;
	}
	else
	{
	    $this->additionalCssFiles[count($this->additionalCssFiles)] = $folder."/".$css;
	}
    }

    public function addJsFile($js, $folder = "")
    {
	if($folder == "")
	{
	    $this->additionalJsFiles[count($this->additionalJsFiles)] = array("file" => $js, "folder" => "");
	}
	else
	{
	    $this->additionalJsFiles[count($this->additionalJsFiles)] = array("file" => $js, "folder" => $folder);
	}
    }

    public function addEndJsFile($js, $folder = "")
    {
	if($folder == "")
	{
	    $this->endJsFiles[count($this->endJsFiles)] = array("file" => $js, "folder" => "");
	}
	else
	{
	    $this->endJsFiles[count($this->endJsFiles)] = array("file" => $js, "folder" => $folder);
	}
    }

    public function addBootstrap()
    {
	$this->addJsFile("bootstrap.min", "bootstrap");
	$this->addCssFile("bootstrap", "bootstrap/css");
    }

    public function addJQueryDatePicker()
    {
	$this->addCssFile("jquery.ui.all", "jquery-ui-1.10.2/themes/base");

	$this->addJsFile("jquery.ui.core", "jquery-ui-1.10.2/ui");
	$this->addJsFile("jquery.ui.widget", "jquery-ui-1.10.2/ui");
	$this->addJsFile("jquery.ui.datepicker", "jquery-ui-1.10.2/ui");
    }

    public function addJqueryUI()
    {
	$this->addCssFile("jquery.ui.all", "jquery-ui-1.10.2/themes/base");

	$this->addJsFile("jquery-ui", "jquery-ui-1.10.2/ui");
    }

    public function addBootstrapDatePicker()
    {
	$this->addJsFile("bootstrap-datepicker", "bootstrap");
	$this->addCssFile("datepicker", "bootstrap/css");
    }

    public function addFancyBox()
    {
	$this->addJsFile("jquery.fancybox.pack", "fancybox");
	$this->addCssFile("jquery.fancybox", "fancybox");
    }

    public function addColorBox()
    {
	$this->addJsFile("jquery.colorbox", "colorbox");
	$this->addCssFile("colorbox", "colorbox");
    }

    public function addCkEditor()
    {
	$this->addJsFile("ckeditor", "ckeditor");
	$this->addJsFile("config", "ckeditor");
	$this->addJsFile("styles", "ckeditor");

	$this->addJsFile("en", "ckeditor/lang");

	$this->addCssFile("contents", "ckeditor");

	$this->addCssFile("dialog", "ckeditor/skins/moono");
	$this->addCssFile("dialog_ie", "ckeditor/skins/moono");
	$this->addCssFile("dialog_ie7", "ckeditor/skins/moono");
	$this->addCssFile("dialog_ie8", "ckeditor/skins/moono");
	$this->addCssFile("dialog_iequirks", "ckeditor/skins/moono");
	$this->addCssFile("dialog_opera", "ckeditor/skins/moono");
	$this->addCssFile("editor", "ckeditor/skins/moono");
	$this->addCssFile("editor_gecko", "ckeditor/skins/moono");
	$this->addCssFile("editor_ie", "ckeditor/skins/moono");
	$this->addCssFile("editor_ie7", "ckeditor/skins/moono");
	$this->addCssFile("editor_ie8", "ckeditor/skins/moono");
	$this->addCssFile("editor_iequirks", "ckeditor/skins/moono");
    }

    public function addBootstrapFileUpload()
    {
	$this->addJsFile("bootstrap-fileupload.min", "bootstrap");
	$this->addCssFile("bootstrap-fileupload.min", "bootstrap/css");
    }

    public function addBootstrapModal()
    {
	$this->addJsFile("bootstrap-modal.min", "");
	$this->addCssFile("bootstrap-modal.min", "");
    }

    public function addAjaxFileUpload()
    {
	$this->addJsFile("jquery.form.min", "upload");
    }

    public function addHelpOverlayLibrary()
    {
	$this->addJsFile("chardinjs.min", "chardin");
	$this->addCssFile("chardinjs", "chardin");
    }

    public function addClEditor()
    {
	$this->addJsFile("jquery.cleditor.min", "");
	$this->addCssFile("jquery.cleditor", "");
    }

    public function addBootstroLibrary()
    {
	$this->addJsFile("bootstro.min", "bootstro");
	$this->addCssFile("bootstro.min", "bootstro");
    }

//    public function addJQuerySortableList()
//    {
//	$this->addJsFile("jquery-ui-1.10.3.list.min");
//	$this->addCssFile("jquery-ui-1.10.3.list.min");
//    }

    public function addBootstrapCarousel()
    {
	$this->addJsFile("bootstrap.min", "bootstrap/carousel/js");
    }

    public function addGoogleFont()
    {
	$output = "";

	$output .= "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>";

	return $output;
    }
}

?>
