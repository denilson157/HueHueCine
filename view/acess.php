<?php

session_start();

class ACESS
{
    protected $_path;

    public function __construct($path)
    {
        $this->_path = $path;
    }

    public function isConnected()
    {
        return isset($_SESSION['user']);
    }

    public function getUser()
    {
        $user = $_SESSION['user'];

        $user = $user[0];

        return $user;
    }

    public function redirectUser()
    {
        Header("Location: " . $this->_path);
    }

    public function checkCredentials()
    {
        if ($this->isConnected())
            $this->redirectUser();
    }

    public function retirectIfExist()
    {
        if ($this->isConnected())
            $this->redirectUser();
    }

    public function retirectIfDoesntExist()
    {
        if (!$this->isConnected())
            $this->redirectUser();
    }
}
