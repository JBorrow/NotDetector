<!DOCTYPE html>

<html>

    <head>
    </head>

    <body>

        <?php

        require_once("../article.php");

        session_start();

        $article = $_SESSION['article'];
       
        $article->create();

        echo "<h1>Submitted to Database</h1>";

        ?>
        
    </body>

</html>
