<!DOCTYPE html>

<html>

    <head>
        <style>
            .outeredit * {
                display:inline;
            }
        </style>
    </head>

    <body>

        <?php

        require_once("../article.php");

        session_start();
        
        $article = $_SESSION['article'];
        $article->create();

        echo "<h1>Submitted to Database</h1>";
        
        include_once("edfunctions.php");

        listAll('news');

        ?>
        
    </body>

</html>
