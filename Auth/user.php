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

    function customHash($tobehashed)
    {
        return hash('sha512', hash('whirlpool', $tobehashed));
    }

    function setUserPass($username, $password)
    {
        //used to pass user and pass to the variables

        $this->username = $username;
        $this->password = $password;

        return true;
    }

    function hashCheck()
    {
        //hashes user and pass and checks it against the db

        $unhashed = $this->authString . $this->password;
        $hash = customHash($unhashed);

        //now we have to check against db

        $mysql = connect();

        $stmt = $mysql->prepare("SELECT hash FROM users WHERE user=?");
        $stmt->bind_params('s', $this->username);
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

    function grabAuthString()
    {
        $mysql = connect();

        $stmt = $mysql->prepare("SELECT authstring FROM users WHERE user=?");
        $stmt->bind_params('s', $this->username);
        $stmt->execute();
        $raw = $stmt->get_result();
        $array = $raw->fetch_array();

        $mysql->close();

        //should be only one result
        return $array[0];
    }
}
