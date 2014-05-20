<?php


class BackendLoginTemplate extends TemplateGuiUtility
{

    protected function initialiseCss()
    {
	$this->defaultCssFiles = array();

	$this->defaultCssFiles[count($this->defaultCssFiles)] = "bootstrap";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "font-awesome";
	$this->defaultCssFiles[count($this->defaultCssFiles)] = "admin/style";

	$this->additionalCssFiles = array();
    }

    protected function initialiseJs()
    {
	$this->defaultJsFiles = array();

	$this->additionalJsFiles = array();
	$this->externalJsFiles = array();

	$this->endJsFiles = array();
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "jquery", "folder" => "");
	$this->endJsFiles[count($this->endJsFiles)] = array("file" => "bootstrap", "folder" => "");
    }

    protected function getDataDisplay($data, $selectedNav = "")
    {
	$output = "";

	$output .= "<div class='admin-form'>";
	$output .= "<div class='container'>";
	$output .= $data;
	$output .= "</div>";
	$output .= "</div>";

	return $output;
    }
}

?>