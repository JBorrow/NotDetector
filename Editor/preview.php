<!DOCTYPE html>

<html>

    <head>
    </head>

    <body>

        <?php

        require_once("../article.php");

        //first we perform checks and get the values from POST

        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];

        //put items straight into an array b/c it is easier to unpack

        if (checkdate($month, $day, $year)) {
            //date okay so we can put them in array
            $date = strtotime("$day-$month-$year");
            $variables = array('title' => htmlspecialchars($_POST['title']),
                               'author' => htmlspecialchars($_POST['author']),
                               'content' => htmlspecialchars($_POST['content']),
                               'islive' => htmlspecialchars($_POST['islive']),
                               'date' => $date);
            
            $article = new Article('news');
            $article->unpackArray($variables);
            $article->nicePrinter();
            //we're gonna change page so store article
            session_start();
            $_SESSION['article'] = $article;

        } else {
            //send them back to the editor with a message - send via SESSION
            session_start();
            $_SESSION = $_POST;
            header("Location: editor.php");
        }
        
        ?>
        
        <br>

        <form action = 'submit.php'>
            <input type = 'submit' value = 'Submit to Database' />
        </form>

        <form action = 'editor.php'>
            <input type = 'submit' value = 'Back to Editor' />
        </form>

    </body>

</html>
