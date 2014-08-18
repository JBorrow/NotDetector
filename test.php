<?php

require_once("Functions/connect.php");
require_once("Functions/creator.php");
require_once("Functions/article.php");

creator();

$article = new Article($news);

$article->title = "testing title";

$article->content = "testing content yo";

$article->date = 100020

$article->author = "josh";

$article->imagenames = "";

$article->create();

$article->grab();

$article->nicePrinter();

