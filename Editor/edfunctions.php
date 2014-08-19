<?php

//this file contains the functions used by the editor. They are used to sanitize
//inputs as well as open/close 'files' (call from db etc.).

function listAll($table='news')
{
    //this function lists all of the articles and prints them out in a nice
    //fashion.
    
    require_once("tablewhitelist.php");

    if (!inWhiteList($table)) {
        die("Error, not acceptable table name.");
    }

    $sqlt = "SELECT title FROM $table";
    $sqld = "SELECT date FROM $table";
    $sqli = "SELECT id FROM $table";
    
    require_once('../connect.php');
    $mysql = connect();
    $rawtitle = $mysql->query($sqlt);
    $rawdate = $mysql->query($sqld);
    $rawid = $mysql->query($sqli);
    $mysql->close();

    while ($titlearray = $rawtitle->fetch_array()) {
        $datearray = $rawdate->fetch_array();
        $idarray = $rawid->fetch_array();

        $title = $titlearray[0];
        $date = $datearray[0];
        $id = $idarray[0];

        echo "<a href = 'viewer.php?id=$id'>";
        echo "<div class = 'outeredit'>\n";
        echo "<div class = 'titleedit'>$title</div>\n";
        echo "<div ckass = 'dateeddit'>$date</div>\n";
        echo "</div></a>\n";
    }

    return true;
}
 
