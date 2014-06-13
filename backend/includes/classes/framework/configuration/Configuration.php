<?php


class Configuration
{

    //url
    public static $URL_MASTER_APPLICATION = "http://54.85.111.97/wc/master/application/";
    public static $URL = "http://54.85.111.97/wc/master/backend/";
    //database connection parameters
    public static $CONNECTION_PARAMETERS = array("host" => "54.85.111.97", "username" => "krish", "password" => "nokia555", "database" => "wc");
    public static $APPLICATION_NAME = "Wc 2014";
    public static $VERSION = 1;

    public static $ADMIN_EMAIL = "email@wc.com";
    //email settings
//    public static $EMAIL_SERVER = "smtpout.secureserver.net";
    public static $EMAIL_SERVER = "smtp.gmail.com";
    public static $EMAIL_SERVER_PORT = "465";
//    public static $EMAIL_SERVER_USERNAME = "admin@calopi.com";
    public static $EMAIL_SERVER_USERNAME = "mamoustore@gmail.com";
    public static $EMAIL_SERVER_PASSWORD = "mamoustore2305";
    public static $EMAIL_SERVER_SECURITY = "ssl";
    //encryption
    public static $ENCRYPTION_KEY = "krissumaroo";

}

?>
