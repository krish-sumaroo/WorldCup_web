<?php

class BaseGamesdatesEntity
{
    private $gameDate;
    private $values;

    public function __construct($gameDate, $values)
    {
        $this->gameDate = $gameDate;
        $this->values = $values;
    }

    public function getGameDate()
    {
        return $this->gameDate;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setGameDate($gameDate)
    {
        $this->gameDate = $gameDate;
    }


}

?>
