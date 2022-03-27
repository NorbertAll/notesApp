<?php

declare(strict_types=1);

namespace App;

require_once("src/Exception/ConfigurationException.php");
require_once("src/Database.php");
require_once("src/View.php");

use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;


class Controller
{
    const DEFAULT_ACTION='list';

    public static array $configuration=[];

    private Database $database;
    private Request $request;
    private View $view;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }


    public function __construct(Request $request)
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
         
                if($this->request->hasPost()) 
                {
                   // $created=true;
                    
                    $noteData=[
                        'title'=>$this->request->postParam('title'),
                        'description'=>$this->request->postParam('description')
                    ];

                    $this->database->createNote($noteData);
                   
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
                //$data= $this->getRequestGet();
                //$noteId=(int)$data['id'];
                $noteId=(int)$this->request->getParam('id');
            
                if(!$noteId){
                    header('Location: ./?error=missingNoteId');
                    exit;
                }
                try{
                    $note=$this->database->getNote($noteId);
                }catch(NotFoundException $e){
                    header('Location: ./?error=noteNotFound');
                    
                }
                
                $viewParams=[
                    'note'=>$note
                ];
                break;
            default:
                $page ='list';
               
     
                //dump($notes);
                $viewParams=[
                    'notes'=>$this->database->getNotes(),
                    
                    'before'=>$this->request->getParam('before'),
                    'error'=>$this->request->getParam('error')
                ];
             
                break;
            }
            $this->view->render($page, $viewParams?? []);
    }    
    private function action(): string
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }

}