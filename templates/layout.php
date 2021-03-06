<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/style.css">
  
    <title>Notatki</title>





</head>
<body >
<br>
    <div class="main">
        <div class="container text-white">
            <div class="row justify-content-around">
                <div class="justify-content-around text-center border bg-secondary">
                    <div>
                        <h1>Moje Notatki</h1>
                    </div>
                    <br/><br/>
                    <div class="menu">
                        <a href="/notesApp/"><button class="btn btn-primary">Lista Notatek</button></a>
                        <a href="/notesApp/?action=create" ><button class="btn btn-success">Nowa Notatka</button></a>
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
    </div>   
   
    
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
  
</body>
</html>