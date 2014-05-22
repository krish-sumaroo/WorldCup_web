<?php

class CountryManager
{
    public static function addCountry($name)
    {
        $countryValidator = new BaseCountryValidator();

        $error = $countryValidator->validateAddCountry($name);

        if(!$error->errorExists())
        {
            CountryLogicUtility::addCountry($name);
        }

        return $error;
    }

    public static function editCountry($id, $name)
    {
        $countryValidator = new BaseCountryValidator();

        $error = $countryValidator->validateEditCountry($id, $name);

        if(!$error->errorExists())
        {
            CountryLogicUtility::updateCountry($id, $name);
        }

        return $error;
    }

    public static function deleteCountry($id)
    {
        CountryLogicUtility::deleteCountry($id);
    }
}

?>
