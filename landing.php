<?php

//the home login page
require_once("Editor/tablewhitelist.php");
$whiteList = getWhiteList();

?>
<!DOCTYPE html>

<html>

    <head>
    </head>

    <body>

        <form name = 'login' method = 'POST' action = 'authenticator.php'>
            
            Username: <input type = 'text' name = 'username' />

            Password: <input type = 'password' name = 'password' />

            Table: <select>
            <?php

            foreach ($whiteList as $table) {
                echo "<option value = '$table'>$table</option>";
            }

            ?>
            </select>

            <input type = 'submit' />

        </form>

    </body>

</head>
