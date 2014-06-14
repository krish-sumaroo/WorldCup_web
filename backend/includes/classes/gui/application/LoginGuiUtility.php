<?php


class LoginGuiUtility
{

    public static function getDisplay($email = "", $error = "")
    {
	$output = "";

	$actionUrl = UrlConfiguration::getUrl("admin", "loginProcessor");

	if($error != "")
	{
	    $output .= "<div>";
	    $output .= ResultUpdateGuiUtility::getBootstrapErrorDisplay($error);
	    $output .= "</div>";
	}

	$output .= "<form class='form-horizontal' method='post' action=\"$actionUrl\">";

	$output .= "<!-- Email -->";
	$output .= "<div class='form-group'>";
	$output .= "<label class='control-label col-lg-3' for='txt_email'>Email</label>";
	$output .= "<div class='col-lg-9'>";
	$output .= "<input type='text' class='form-control' id='txt_email' name='txt_email' placeholder='Email' value=\"$email\">";
	$output .= "</div>";
	$output .= "</div>";

	$output .= "<!-- Password -->";
	$output .= "<div class='form-group'>";
	$output .= "<label class='control-label col-lg-3' for='txt_password'>Password</label>";
	$output .= "<div class='col-lg-9'>";
	$output .= "<input type='password' class='form-control' id='txt_password' name='txt_password' placeholder='Password'>";
	$output .= "</div>";
	$output .= "</div>";

	$output .= "<!-- sign in button -->";
	$output .= "<div class='form-group'>";
	$output .= "<div class='col-lg-9 col-lg-offset-3'>";
	$output .= "<div class='checkbox'>";
	$output .= "</div>";
	$output .= "</div>";
	$output .= "</div>";
	$output .= "<div class='col-lg-9 col-lg-offset-2'>";
	$output .= "<button type='submit' class='btn btn-danger'>Sign in</button>";
	$output .= "&nbsp;";
	$output .= "<button type='reset' class='btn btn-default'>Reset</button>";
	$output .= "</div>";
	$output .= "<br />";

	$output .= "</form>";

	$title = "<span class='glyphicon glyphicon-lock'></span> Login ";
//	$footer = "Problems logging in? <a href='#'> Contact us here</a>";

	$backendWidgetDisplayUtility = new BackendWidgetDisplayUtility(12, "", $output);
	$backendWidgetDisplayUtility->setWidgetHead($title);
//	$backendWidgetDisplayUtility->setFooter($footer);
	$backendWidgetDisplayUtility->setWidgetAdditionalClass("worange");

	return $backendWidgetDisplayUtility->getDisplay();
    }

    public static function login($email, $password)
    {
	$output = "";

	$userLoginValidator = new UserLoginValidator();

	$error = $userLoginValidator->validateLogin($email, $password);

	if($error->errorExists())
	{
	    $output .= LoginGuiUtility::getDisplay($email, $error->getErrorList());
	}
	else
	{
	    $adminEntity = $error->getObject();

	    SessionHelper::setUserSessionVariable($adminEntity->getAdminId(), $adminEntity->getTimeOffset(),
		    $adminEntity->getAdminRole());

	    $urlIndex = UrlConfiguration::getRootPagesUrl("index.php");

	    UrlConfiguration::redirect($urlIndex);
	}

	return $output;
    }
}

?>