<?php

class BaseStadiumEntity
{
    private $id;
    private $name;
    private $image;
    private $values;

    public function __construct($id, $name, $image, $values)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
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

    public function getImage()
    {
        return $this->image;
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

    public function setImage($image)
    {
        $this->image = $image;
    }


}

?>
