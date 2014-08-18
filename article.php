<?php

require_once("connect.php");

//This class is used to interface with the database.

class Article
{
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
    
    public function __construct($table, $id=false)
    {
        $this->table = $table;
        if (!$id) {
            //We shouldn't do anything here because we need to populate first
            return 1;
        } else {
            $this->id = $id;
            $this->grab();

            return 2;
        }
    }

    //input/output functions

    private function create()
    {   
        if (!isset($date)) {
            $date = time();
        }

        //creates an entry in the table from the info already present
        $sql = "INSERT INTO $this->table (title, content, date, author,
        imagenames) VALUES ('$this->title', '$this->content', '$this->date',
        '$this->author', '$this->imagenames')";
        $mysql = connect();
        $mysql->query($sql);
        $mysql->close();

        return true;
    }

    private function grab()
    {
        //grabs info from the db and stores them in the public variables

        $mysql = connect();
        
        $data = $this->dataToArray();
        $used = array('title','content','date','author','imagenames');
        
        foreach ($used as $item) {
            $sql = "SELECT '$item' FROM $this->table WHERE id='$this->id'";
            $data[$item] = $mysql->query($sql);
        }

        //now place in variable names
        
        $this->unpackArray($data);

        $mysql->close();

        return true;
    }

    private function update()
    {
        //updates a given id with the information in the table

        $sql = "UPDATE $this->table SET 'title'=$this->title,
        'content'=$this->content, 'date'=$this->date, 'author'=$this->author,
        'imagenames'=$this->imagenames WHERE id=$this->id";

        $mysql = connect();
        $mysql->query($sql);
        $mysql->close();

        return true;
    }

    public function dataToArray()
    {
        //this returns an array we can use to give to people

        return array(
            'title' => $this->title,
            'content' => $this->content,
            'date' => $this->date,
            'author' => $this->author,
            'imagenames' => $this->imagenames,
            'id' => $this->id,
            'table' => $this->table,
        );
    }

    public function unpackArray($data)
    {
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->date = $data['date'];
        $this->author = $data['author'];
        $this->imagenames = $data['imagenames'];
        $this->id = $data['id'];
        $this->table = $data['table'];

        return true;
    }

    public function tableExists($table)
    {
        //checks if table exists. returns true or false.

        $sql = "IF EXISTS (SELECT * FROM $table)";

        $mysql = connect();
        $query = $mysql->query($sql);
        $mysql->close();

        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}   
