<?php

class BaseAdminEntity
{
    private $adminId;
    private $username;
    private $password;
    private $values;

    public function __construct($adminId, $username, $password, $values)
    {
        $this->adminId = $adminId;
        $this->username = $username;
        $this->password = $password;
        $this->values = $values;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


}

?>
