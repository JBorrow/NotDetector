<?php

require_once("../connect.php");

//a class that is used to identify users, see if they have logged in correctly
//and if they have allows them to have the session variable 'loggedin'=true

class User
{
    //set public and private values - lastloggedin is a unix timestamp

    public $username;
    private $password;
    public $lastLoggedIn;
    private $authString;
    public $validUser;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        //first see if user ok
        $this->validUser = $this->validUser();
        
        if (!$this->validUser) {
            die('Please enter a valid username/password combination 1');
        }

        //now see if password is okay

        $this->grabAuthString();
        
        $validUserPass = $this->hashCheck();
        
        if (!$validUserPass) {
            die('Please enter a valid username/password combination');
        }

        //woo they are a valid user, now we just need to grab lastLoggedIn

        $this->grabLastLoggedIn();
        
        return true;
    }

    private function customHash($tobehashed)
    {
        return hash('sha512', hash('whirlpool', $tobehashed));
    }

    private function setUserPass($username, $password)
    {
        //used to pass user and pass to the variables

        $this->username = $username;
        $this->password = $password;

        return true;
    }

    private function hashCheck()
    {
        //hashes user and pass and checks it against the db

        $unhashed = $this->authString . $this->password;
        $hash = $this->customHash($unhashed);

        //now we have to check against db

        $mysql = connect();

        $stmt = $mysql->prepare("SELECT hash FROM users WHERE user=?");
        $stmt->bind_param('s', $this->username);
        $stmt->execute();
        $raw = $stmt->get_result();
        $truehasharray = $raw->fetch_array();
        $truehash = $truehasharray[0];
        
        $mysql->close();

        if ($hash == $truehash) {
            return true;
        } else {
            return false;
        }
    }

    private function grabAuthString()
    {
        $mysql = connect();

        $stmt = $mysql->prepare("SELECT authstring FROM users WHERE user=?");
        $stmt->bind_param('s', $this->username);
        $stmt->execute();
        $raw = $stmt->get_result();
        $array = $raw->fetch_array();

        $mysql->close();

        //should be only one result
        $this->authString = $array[0];

        return true;
    }
    
    private function validUser()
    {
        $mysql = connect();
        
        $stmt = $mysql->prepare("SELECT user FROM users WHERE user=?");
        $stmt->bind_param('s', $this->username);
        $stmt->execute();
        $raw = $stmt->get_result();
        $array = $raw->fetch_array();
        
        $mysql->close();

        if ($array) {
            return true;
        } else {
            return false;
        }
    }

    private function grabLastLoggedIn()
    {
        $mysql = connect();

        $stmt = $mysql->prepare("SElECT lastlog FROM users WHERE user=?");
        $stmt->bind_param('s', $this->username);
        $stmt->execute();
        $raw = $stmt->get_result();
        $array = $raw->fetch_array();

        $this->lastLoggedIn = $array[0];

        $stmt = $mysql->prepare("UPDATE users SET lastlog=? WHERE user=?");
        $stmt->bind_param('is', time(), $this->username);
        $stmt->execute();
        
        $mysql->close();

        return true;
    }
}
