<?php

require_once('../article.php');

//if set we (i.e. coming from viewer) we need to open session and extract
session_start();

if (isset($_SESSION['article'])) {
    
    $article = $_SESSION['article'];
    
    $vars = $article->dataToArray();
    
    $title = $vars['title'];
    $author = $vars['author'];
    $content = $vars['content'];
    $id = $vars['id'];
    $table = $vars['table'];

    $_SESSION['editid'] = $id;
    $_SESSION['edittable'] = $table;
}

?>

<!DOCTYPE html>

<html>
    
    <head>
    </head>

    <body>
        
        <form method = 'post' name = 'content' action = 'preview.php'> 
            
            <h3>Title:</h3>
            
                <input type = 'text' name = 'title' 
                value = '<?php echo $title; ?>'/>

            <h3>Date:</h3>            
    
                <?php
            
                require_once('date.php');

                ?>

            <h3>Author:</h3>

                <input type = 'text' name = 'author' 
                value = '<?php echo $author; ?>'/>

            <h3>Content:</h3>

                <textarea name = 'content' rows = '25' cols = '80'><?php echo $content; ?></textarea>
            
            <h3>Do you want this to be live?</h3>

                <input type = 'checkbox' name = 'islive'>Live<br />
           
            <h3>Submit:</h3> 
                <input type = 'submit' name = 'submit' />
        
        </form>

    </body>

</html>

