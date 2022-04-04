<?php

declare(strict_types=1);

namespace App\Controller;


use App\Exception\NotFoundException;


class NoteController extends AbstractController
{
    private const PAGE_SIZE=10;
    public function createAction():void
    {
       
        
        if($this->request->hasPost()) 
        {
           // $created=true;
            
            $noteData=[
                'title'=>$this->request->postParam('title'),
                'description'=>$this->request->postParam('description')
            ];
            $this->database->createNote($noteData);
            $this-> redirect('/notesApp/', ['before'=> 'created']);
           
        //    $viewParams=[
        //        'title' =>  $data['title'],
        //        'description' =>  $data['description']
        //    ];
        
        }
            //   $viewParams['created']=$created;
        $this->view->render('create');
    }

    public function showAction():void
    {
        
        //$data= $this->getRequestGet();
        //$noteId=(int)$data['id'];
        $note=$this->getNote();
        
        $this->view->render('show',['note'=>$note]);
    }

    public function listAction():void
    {
        $phrase =$this->request->getParam('phrase');
        $pageNumber=(int)$this->request->getParam('page', 1);
        $pageSize=(int)$this->request->getParam('pagesize', self::PAGE_SIZE);   
        $sortBy=$this->request->getParam('sortby','title');
        $sortOrder=$this->request->getParam('sortorder','desc');
        if(!in_array($pageSize, [1, 5, 10, 25])){
            $pageSize=self::PAGE_SIZE;
        }

        if($phrase){
            $noteList=$this->database->searchNotes($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
            $notes=$this->database->getSearchCount($phrase);
        }
        else{
            $noteList=$this->database->getNotes($pageNumber, $pageSize, $sortBy, $sortOrder);
            $notes=$this->database->getCount();
        }

        $this->view->render('list', 
        [
        
        'page'=>['number'=> $pageNumber, 
        'size'=>$pageSize,
        'pages'=> (int)ceil($notes/$pageSize)
    ],
        'phrase'=>$phrase,
        'sort'=>['by'=>$sortBy, 'order'=>$sortOrder,],
        'notes'=>$noteList,
        'before'=>$this->request->getParam('before'),
        'error'=>$this->request->getParam('error')
    ]);
    }    
    public function editAction():void
    {

        if($this->request->isPost()){
           $noteId=(int)$this->request->postParam('id');

           $noteData=[
            'title'=>$this->request->postParam('title'),
            'description'=>$this->request->postParam('description')
        ];
            $this->database->editNote($noteId, $noteData);
            $this-> redirect('/notesApp/', ['before'=> 'edited']);

        }
        $note=$this->getNote();

        $this->view->render(
            'edit',
            ['note'=>$note]
    );
    }
    public function deleteAction():void
    {
        
        if($this->request->isPost()){
            $id=(int)$this->request->postParam('id');
            $this->database->deleteNote($id);
            $this-> redirect('/notesApp/', ['before'=> 'deleted']); 
         }
        $note=$this->getNote();
        $this->view->render(
            'delete',
            ['note'=>$note]
    );
        
    }
    private function getNote(): array
    {
        $noteId=(int)$this->request->getParam('id');
        if(!$noteId){
            $this-> redirect('/notesApp/', ['error'=> 'missingNoteId']);
         
        } 
   

        try{
            $note=$this->database->getNote($noteId);
        }catch(NotFoundException $e){
            $this-> redirect('/notesApp/', ['error'=> 'noteNotFound']); 
        }
        return $note;
    }
}