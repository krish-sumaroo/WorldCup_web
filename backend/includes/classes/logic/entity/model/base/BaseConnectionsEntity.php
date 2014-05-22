<?php

class BaseConnectionsEntity
{
    private $user1;
    private $user2;
    private $status;
    private $values;

    public function __construct($user1, $user2, $status, $values)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->status = $status;
        $this->values = $values;
    }

    public function getUser1()
    {
        return $this->user1;
    }

    public function getUser2()
    {
        return $this->user2;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setUser1($user1)
    {
        $this->user1 = $user1;
    }

    public function setUser2($user2)
    {
        $this->user2 = $user2;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


}

?>
