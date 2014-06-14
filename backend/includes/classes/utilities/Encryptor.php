<?php


/**
 * Description of Encryptor
 *
 * @author suyash
 */
class Encryptor
{

    public static function encrypt($string)
    {
	$key = Configuration::$ENCRYPTION_KEY;

	$encrypted = openssl_encrypt($string, "rc4", $key);

	return $encrypted;
    }

    public static function decrypt($string)
    {
	$key = Configuration::$ENCRYPTION_KEY;

	$decrypted = openssl_decrypt($string, "rc4", $key);

	return $decrypted;
    }

    public static function encryptPassword($password)
    {
	return md5($password);
    }

    public static function encryptLinkParameter($parameter)
    {
	$encryptedParameter = Encryptor::encrypt($parameter);
	$encodedParameter = urlencode($encryptedParameter);

	return $encodedParameter;
    }

    public static function decryptLinkParameter($encryptedParameter)
    {
	$parameter = Encryptor::decrypt(str_replace(" ", "+", urldecode($encryptedParameter)));

	return $parameter;
    }

    public static function encryptIdForContainer($id)
    {
	return md5($id);
    }

    public static function getUniqueContainerId()
    {
	return time().rand(0, 10000);
    }

    public static function generateRandomString($length = 10)
    {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';

	for($i = 0; $i < $length; $i++)
	{
	    $randomString .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $randomString;
    }
}

?>