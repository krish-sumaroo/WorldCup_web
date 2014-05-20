<?php

class BasePlayersEntity
{
    private $id;
    private $teamId;
    private $name;
    private $position;
    private $number;
    private $values;

    public function __construct($id, $teamId, $name, $position, $number, $values)
    {
        $this->id = $id;
        $this->teamId = $teamId;
        $this->name = $name;
        $this->position = $position;
        $this->number = $number;
        $this->values = $values;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }


}

?>
