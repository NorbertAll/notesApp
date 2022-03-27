<?php
declare(strict_types=1);

namespace App;

require_once("src/Utils/debug.php");
require_once("src/Controller.php");
require_once("src/Request.php");
require_once("src/Exception/AppException.php");

use App\Request;
use App\Exception\AppException;
use Throwable;
use App\Exception\ConfigurationException;


$configuration=require_once("config/config.php");


$request=new Request($_GET, $_POST);

try{
   //$controller= new Controller($request);
   //$controller->run();
   //usuwanie redundancji kodu 
   Controller::initConfiguration($configuration);
   (new Controller($request))->run();
}catch(ConfigurationException $e){
   echo "<h1>Wystąpił błąd w aplikacji</h1>";
   echo 'Proble z konfiguracją';
}catch(AppException $e){
   echo "<h1>Wystąpił błąd aplikacji</h1>";
   echo '<h3>'.$e->getMessage().'</h3>';
}catch(Throwable $e){
   
   echo "<h1>Wystąpił błąd aplikacji</h1>";
}



