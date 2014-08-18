<?php

require_once("article.php");

$article = new Article('news', 1);

$article->content = 'I can\'t believe I was such a nob';
$article->nicePrinter();
$article->update();

$new = new Article('news', 1);

$new->nicePrinter();
