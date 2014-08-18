<?php

//this file creates the tables needed in your database which allows the other
//files to use them.

require_once("connect.php");

function creator($table = 'news')
{
    $sql = "CREATE TABLE $table (title VARCHAR(200), content MEDIUMTEXT,
    date BIGINT, author VARCHAR(100), imagenames TEXT, islive TINYINT,
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY)";
    
    $mysql = connect();
    $query = $mysql->query($sql);
    print $sql; 
    if ($query) {
        $mysql->close();
        return true;
    } else {
        $error = $mysql->error;
        $mysql->close();
        die($error);
    }
}

