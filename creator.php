<?php

//this file creates the tables needed in your database which allows the other
//files to use them.
//you should only need to open this file once.

require_once("connect.php");

function initialize($table = 'news')
{
    $sql = "CREATE TABLE $table (title VARCHAR(200), content MEDIUMTEXT,
    date BIGINT, author VARCHAR(100), imagenames TEXT, islive TINYINT,
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY)";
    
    $mysql = connect();
    $query = $mysql->query($sql);
    
    if ($query) {
        $mysql->close();
        return true;
    } else {
        $error = $mysql->error;
        $mysql->close();
        die($error);
    }
}

