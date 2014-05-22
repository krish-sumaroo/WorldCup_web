<?php

class BaseTeamsEntity
{
    private $id;
    private $name;
    private $flag;
    private $group;
    private $values;

    public function __construct($id, $name, $flag, $group, $values)
    {
        $this->id = $id;
        $this->name = $name;
        $this->flag = $flag;
        $this->group = $group;
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

    public function getFlag()
    {
        return $this->flag;
    }

    public function getGroup()
    {
        return $this->group;
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

    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }


}

?>
