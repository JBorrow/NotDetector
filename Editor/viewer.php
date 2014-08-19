<!DOCTYPE html>

<html>
    
    <head>
    </head>

    <body>

        <?php
        
        require_once("../article.php"); 

        $id = $_GET['id'];
        
        $article = new Article('news', $id);
        
        $article->nicePrinter();
        
        //store article in session so we can open it later
        session_start();
        
        $_SESSION['article'] = $article;

        ?>

        <form name = 'edit' method = 'post' action = 'editor.php'>

            <input type = 'submit' value = 'Open in Editor'>

        </form>

    </body>

</html>
