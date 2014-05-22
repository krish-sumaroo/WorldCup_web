<?php

class BaseUsersEntity
{
    private $id;
    private $uid;
    private $username;
    private $nickname;
    private $status;
    private $teamId;
    private $country;
    private $password;
    private $values;

    public function __construct($id, $uid, $username, $nickname, $status, $teamId, $country, $password, $values)
    {
        $this->id = $id;
        $this->uid = $uid;
        $this->username = $username;
        $this->nickname = $nickname;
        $this->status = $status;
        $this->teamId = $teamId;
        $this->country = $country;
        $this->password = $password;
        $this->values = $values;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


}

?>
