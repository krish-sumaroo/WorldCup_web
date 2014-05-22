<?php

class BaseGamesdatesValidator extends Validator
{
    public function __construct()
    {
        $this->error = new Error();
    }

    public function validateAddGamesdates($gameDate)
    {
        $this->checkEmptyError($gameDate, "GameDate");

        return $this->error;
    }

    public function validateEditGamesdates($gameDate)
    {
        $this->checkEmptyError($gameDate, "GameDate");

        return $this->error;
    }
}

?>
