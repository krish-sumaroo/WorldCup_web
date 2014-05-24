<?php


/**
 * Description of TemplateGuiUtility
 *
 * @author suyash
 */
class BackendTemplateGuiUtility extends TemplateGuiUtility
{

    private $title;
    private $titleLink;
    private $titleLinkText;

    public function __construct($title, $titleLink = "", $titleLinkText = "")
    {
	parent::__construct();

	$this->title = $title;
	$this->titleLink = $titleLink;
	$this->titleLinkText = $titleLinkText;
    }

    public function setTitle($title)
    {
	$this->title = $title;
    }

    protected function initialiseCss()
    {
	$this->defaultCssFiles = array();

	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "font-awesome";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "jquery-ui-1.9.2.custom.min";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "fullcalendar";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "prettyPhoto";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "rateit";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap-datetimepicker.min";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "jquery.cleditor";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap-switch";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "widgets";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "admin/style";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "application/admin";

	$this->additionalCssFiles = array();
    }

    protected function initialiseJs()
    {
	$this->defaultJsFiles = array();
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "admin", "folder" => "application");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "ajax", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "utilities", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "jquery", "folder" => "");
	$this->defaultJsFiles[count($this->defaultJsFiles)] = array("file" => "jquery-ui-1.9.2.custom.min", "folder" => "");

	$this->additionalJsFiles = array();
	$this->externalJsFiles = array();

	$this->endJsFiles = array();
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "bootstrap", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "fullcalendar.min", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.rateit.min", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.prettyPhoto", "folder" => "");

	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "excanvas.min", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.flot", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.flot.resize", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.flot.pie", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery.flot.stack", "folder" => "");

	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "default", "folder" => "themes");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "bottom", "folder" => "layouts");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "topRight", "folder" => "layouts");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "top", "folder" => "layouts");

	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "custom", "folder" => "");
    }

    protected function getDataDisplay($data, $selectedNav = "")
    {
	$output = "";

	$output .= "<div class='content'>";
	$output .= BackendNavigation::getSideBarDisplay($selectedNav);

	$output .= "<div class='mainbar'>";
	$output .= $this->getPageHeading($this->title);

	$output .= "<div class='matter'>";
	$output .= "<div class='container'>";
	$output .= $data;
	$output .= "</div>";
	$output .= "</div>";

	$output .= "</div>";

	$output .= "</div>";

	return $output;
    }

    protected function getFooter()
    {
	$output = "";

	$output .= BootstrapModalGuiUtility::getModalContainer();

	$output .= $this->loadAllEndJavascript();

	$output .= "</body>";
	$output .= "</html>";

	return $output;
    }

    protected function getHeader()
    {
	$output = "";

	$output .= "<body>";
	$output .= "<div class='head'>";

	$output .= BackendNavigation::getDisplay();
	$output .= BackendHeaderGuiUtility::getDisplay();

	$output .= "</div>";

	return $output;
    }

    protected function getPageHeading($title)
    {
	$output = "";

	$output .= "<div class='page-head'>";
	$output .= "<h2 class='pull-left'>";
	$output .= "<i class='icon-home'></i>";
	$output .= " $title ";

	if(!empty($this->titleLinkText))
	{
	    $output .= "&nbsp;&nbsp;";
	    $output .= "<span class='hea1'>";
	    $output .= "(<a href='$this->titleLink'>$this->titleLinkText</a>)";
	    $output .= "</span>";
	}

	$output .= "</h2>";

//	$output .= "<!-- Breadcrumb -->";
//	$output .= "<div class='bread-crumb pull-right'>";
//	$output .= "<a href='index.html'><i class='icon-home'></i> Home</a>";
//	$output .= "<!-- Divider -->";
//	$output .= "<span class='divider'>/</span>";
//	$output .= "<a href='#' class='bread-current'>Dashboard</a>";
//	$output .= "</div>";

	$output .= "<div class='clearfix'></div>";

	$output .= "</div>";

	return $output;
    }
}

?>
