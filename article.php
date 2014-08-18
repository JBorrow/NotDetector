<?php

require_once("connect.php");

//This class is used to interface with the database.

class Article {
    //set public values that are used to view information/set information
    //date should always be as a unix timestamp when passed to this class

    public $title;
    public $content;
    public $date;
    public $author;
    public $id;
    public $imagenames;
    public $table;

    //create constructor that grabs from db
    
    

    //input/output functions

    public function create()
    {   
        if (!isset($date)) {
            $date = time();
        }

        //creates an entry in the table from the info already present
        $sql = "INSERT INTO $table (title, content, date, author, imagenames)
        VALUES ('$title', '$content', '$date', '$author', '$imagenames')";
        $mysql = connect();
        $mysql->query($sql);
        $mysql->close();

        return true;
    }

    public function grab()
    {
        //grabs info from the db and stores them in the public variables

        $mysql = connect();
        
        $sql = "SELECT 'title' FROM $table WHERE id='$id'";
        $title = $mysql->query($sql);

        $sql = "SELECT 'content' FROM $table WHERE id='$id'";
        $content = $mysql->query($sql);

        $sql = "SELECT 'date' FROM $table WHERE id='$id'";
        $date = $mysql->query($sql);

        $sql = "SELECT 'author' FROM $table WHERE id='$id'";
        $author = $mysql->query($sql);

        $sql = "SELECT 'imagenames' FROM $table WHERE id='$id'";
        $imagenames = $mysql->query($sql);

        $mysql->close();

        return true;
    }

    public function update()
    {
        //updates a given id with the information in the table

        $sql = "UPDATE $table SET 'title'=$title, 'content'=$content,
        'date'=$date, 'author'=$author, 'imagenames'=$imagenames WHERE id=$id";

        $mysql = connect();
        $mysql->query($sql);
        $mysql->close();

        return true;
    }
}   
