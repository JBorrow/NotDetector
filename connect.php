<?php

//this file contains a function that is used to connect to the databasea and
//return a mysqli object
//use this file to contain all of your information about connecting to the db
//so that if you ever need to change usernames you only need to change in one
//place

function connect()
{
    $mysql = new mysqli("localhost", "root", "root", "test");
    return $mysqli;
}
