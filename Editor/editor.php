<!DOCTYPE html>

<html>
    
    <head>
    </head>

    <body>
        
        <form method = 'post' name = 'content' action = 'preview.php'>
            
            <h3>Title:</h3>
            
                <input type = 'text' name = 'title' />

            <h3>Date:</h3>            
    
                <?php
            
                require_once('date.php');

                ?>

            <h3>Author:</h3>

                <input type = 'text' name = 'author' />

            <h3>Content:</h3>

                <textarea name = 'content' rows = '25' cols = '80'></textarea>
            
            <h3>Do you want this to be live?</h3>

                <input type = 'checkbox' name = 'islive'>Live<br />
           
            <h3>Submit:</h3> 
                <input type = 'submit' name = 'submit' />
        
        </form>

    </body>

</html>

