<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="/notesApp/public/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <div class="glow">
        <div class="row">
            <div class="header">
                <h1>Moje Notatki</h1><br>
            </div>

            <div class="container">
                <div class="menu">
                  <button>
                            <a href="/notesApp/">Lista Notatek</a>
                       </button>
                       <button>
                            <a href="/notesApp/?action=create">Nowa Notatka</a>
                            </button>
                </div>
<br>
                <div>

                    <?php


                        require_once("templates/pages/$page.php");

                    ?>

                </div>


            </div>
        </div>
    </div>
    

</body>
</html>