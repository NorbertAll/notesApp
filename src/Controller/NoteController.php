<?php

declare(strict_types=1);

namespace App\Controller;


use App\Exception\NotFoundException;


class NoteController extends AbstractController
{
    
    public function createAction()
    {
       
        
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
        $this->view->render('create');
    }
    public function showAction()
    {
        
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
        
        $this->view->render('show',['note'=>$note]);
    }
    public function listAction()
    {
               
     
      $this->view->render('list', [
        'notes'=>$this->database->getNotes(),
        'before'=>$this->request->getParam('before'),
        'error'=>$this->request->getParam('error')
    ]);
    }    


}