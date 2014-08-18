<?php

require_once("article.php");
require_once("creator.php");

creator();

$new = new Article('news', 1);

$new->nicePrinter();
