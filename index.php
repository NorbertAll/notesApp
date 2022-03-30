<?php
declare(strict_types=1);

spl_autoload_register(function(string $name){
   $path = str_replace(['\\', 'App/'], ['/', ''], $name);
   $path="src/$path.php";
  
  // require_once(__DIR__);
  // var_dump($path);
   require_once($path);
}
);





require_once("src/Utils/debug.php");

$configuration=require_once("config/config.php");

//require_once("src/Controller/NoteController.php");
//require_once("src/Request.php");
//require_once("src/Exception/AppException.php");
use App\Controller\AbstractController;
use App\Controller\NoteController;
use App\Request;
use App\Exception\AppException;

use App\Exception\ConfigurationException;





$request=new Request($_GET, $_POST, $_SERVER);

try{
   //$controller= new Controller($request);
   //$controller->run();
   //usuwanie redundancji kodu 
   AbstractController::initConfiguration($configuration);
   (new NoteController($request))->run();
}catch(ConfigurationException $e){
   echo "<h1>Wystąpił błąd w aplikacji</h1>";
   echo 'Proble z konfiguracją';
}catch(AppException $e){
   echo "<h1>Wystąpił błąd aplikacji</h1>";
   echo '<h3>'.$e->getMessage().'</h3>';
}catch(\Throwable $e){
   
   echo "<h1>Wystąpił błąd aplikacji</h1>";
}



