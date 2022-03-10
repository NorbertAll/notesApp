<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <h1>Moje Notatki</h1>
    </div>

    <div class="container">
        <div class="menu">
            <ul>
                <li>
                    <a href="/notesApp/">Lista Notatek</a>
                </li>
                <li>
                    <a href="/notesApp/?action=create">Nowa Notatka</a>
                </li>
            </ul>
        </div>

        <div>
            
            <?php

       
                require_once("templates/pages/$page.php");
                
            ?>

        </div>


    </div>

    <div class="footer">
        Stopka
    </div>

</body>
</html>