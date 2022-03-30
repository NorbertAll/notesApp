<?php
declare(strict_types=1);


namespace App;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Exception\NotFoundException;
use PDO;
use Throwable;

class Database
{

    private PDO $conect;

    public function __construct(array $config)
    {
        try{
        
            $this->validateConfig($config);
            $this->createConnection($config);
         
            }catch(\PDOException $e){
                throw new StorageException('Connection error');
                exit('e');
            }
    }
    public function getNote(int $id):array
    {
        try{
            
            $query= "SELECT * FROM notes WHERE id= $id";
            
            $result=$this->conect->query($query);
            $note=$result-> fetch(PDO::FETCH_ASSOC);
           
            
        }catch(Throwable $e){
            throw new StorageException("nie udało sie dostać do danych o notatki", 400, $e);
        }
        if(!$note){
            throw new NotFoundException("Notataka o id: $id nie istnieje");
            exit("Nie ma takiej Notatki");
        }
        return $note;

      
    }
    public function getNotes():array
    {
        try{
            
            $query= "SELECT id, title, created FROM notes";
            
            $result=$this->conect->query($query);
            return $result-> fetchAll(PDO::FETCH_ASSOC);
            //foreach($result as $row){
            //  $notes[]=$row;  
            //}
            //dump($notes);
             
        }catch(Throwable $e){
            throw new StorageException("nie udało sie dostać do danych o notatkach", 400, $e);
        }
      
    }
    public function createNote(array $data):void
    {
        try{
            
            $title=$this->conect->quote($data['title']);
            $description=$this->conect->quote($data['description']);
            $created=$this->conect->quote(date('Y-m-d H:i:s'));
            $query="INSERT INTO notes(title, description, created) VALUES($title, $description, $created)";
            $result=$this->conect->exec($query);

        }catch(Throwable $e){
            throw new StorageException('Nie udało się stworzyć notatki');
        }
        echo "Tworzymy";
    }


    public function editNote(int $id, array $data):void
    {
        try{
            
            $title=$this->conect->quote($data['title']);
            $description=$this->conect->quote($data['description']);
            
            $query="UPDATE notes SET title=$title, description=$description WHERE id=$id";
            $this->conect->exec($query);

        }catch(Throwable $e){
            throw new StorageException('Nie udało się edytować notatki');
        }
    }

    private function createConnection(array $config):void
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
            $this->conect=new PDO(
                $dsn,
                $config['user'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                ]
            );
    }

    private function validateConfig(array $config):void
    {
        if(
            empty($config['database'])||
            empty($config['host'])||
            empty($config['user'])||
            empty($config['password'])
        ){
            throw new ConfigurationException("Storage configuration error");
        }
    }
}

?>