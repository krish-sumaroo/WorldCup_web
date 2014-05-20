<?php

class BaseCountryEntity
{
    private $id;
    private $name;
    private $values;

    public function __construct($id, $name, $values)
    {
        $this->id = $id;
        $this->name = $name;
        $this->values = $values;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


}

?>
