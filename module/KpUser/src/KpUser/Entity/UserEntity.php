<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午1:09
 */

namespace KpUser\Entity;

class UserEntity
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $regdate;
    protected $lastlogindate;
    protected $regip;
    protected $lastloginip;
    protected $type;
    protected $status;
    protected $errorcount;
    protected $errortime;

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $lastlogindate
     */
    public function setLastlogindate($lastlogindate)
    {
        $this->lastlogindate = $lastlogindate;
    }

    /**
     * @return mixed
     */
    public function getLastlogindate()
    {
        return $this->lastlogindate;
    }

    /**
     * @param mixed $lastloginip
     */
    public function setLastloginip($lastloginip)
    {
        $this->lastloginip = $lastloginip;
    }

    /**
     * @return mixed
     */
    public function getLastloginip()
    {
        return $this->lastloginip;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $regdate
     */
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;
    }

    /**
     * @return mixed
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * @param mixed $regip
     */
    public function setRegip($regip)
    {
        $this->regip = $regip;
    }

    /**
     * @return mixed
     */
    public function getRegip()
    {
        return $this->regip;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $errorcount
     */
    public function setErrorcount($errorcount)
    {
        $this->errorcount = $errorcount;
    }

    /**
     * @return mixed
     */
    public function getErrorcount()
    {
        return $this->errorcount;
    }

    /**
     * @param mixed $errortime
     */
    public function setErrortime($errortime)
    {
        $this->errortime = $errortime;
    }

    /**
     * @return mixed
     */
    public function getErrortime()
    {
        return $this->errortime;
    }

}