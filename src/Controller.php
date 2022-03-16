<?php

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;
require_once("src/Exception/ConfigurationException.php");
require_once("src/Database.php");
require_once("src/View.php");
class Controller
{
    const DEFAULT_ACTION='list';

    public static array $configuration=[];

    private Database $database;
    private array $request;
    private View $view;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }


    public function __construct(array $request)
    {
        if(empty(self::$configuration['db'])){
            throw new ConfigurationException('Configuration error');
        }
        $this->database = new Database(self::$configuration['db']);
        $this->request=$request;
        $this->view=new View();
        
    }


    public function run():void
    {
       


        
        switch($this->action()){
            case 'create':
                $page='create';
         
                $data=$this->getRequestPost();
                if(!empty($data)) 
                {
                   // $created=true;
                    
                    //$this->database->createNote($data);inny zapis
                    $this->database->createNote([
                      'title'=> $data['title'],
                      'description'=> $data['description']

                    ]);
                    header('Location: /notesApp/?before=created');
                //    $viewParams=[
                //        'title' =>  $data['title'],
                //        'description' =>  $data['description']
                //    ];
                
                }
             //   $viewParams['created']=$created;
        
                break;
            case 'show':
                $page = 'show';
                $viewParams=[
                    'title' => 'Moja notatka',
                    'description' => 'Opis'
                ];
                break;
            default:
                $page ='list';
                $data= $this->getRequestGet();
     
                //dump($notes);
                $viewParams=[
                    'notes'=>$this->database->getNotes(),
                    
                    'before'=>$data['before'] ??null
                ];
             
                break;
            }
            $this->view->render($page, $viewParams?? []);
    }    
    private function action(): string
    {
        $data=$this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    }
    private function getRequestPost(): array
    {
        return $this->request['post']??[];
    }
    private function getRequestGet(): array
    {
        return $this->request['get']??[];
    }
}