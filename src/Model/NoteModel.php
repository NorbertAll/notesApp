<?php
declare(strict_types=1);


namespace App\Model;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Exception\NotFoundException;
use PDO;
use Throwable;
use PDOException;
class NoteModel extends AbstractModel implements ModelInterface
{


    public function get(int $id):array
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
    public function count():int
    {
        try{


                
            $query= "SELECT count(*) AS il FROM notes";
            
            $result=$this->conect->query($query);
            $result= $result-> fetch(PDO::FETCH_ASSOC);
            if(!$result){
                throw new StorageException("Błąd pobierania ilości notatek", 400);
            }
            return (int) $result['il'];
            
            //foreach($result as $row){
            //  $notes[]=$row;  
            //}
            //dump($notes);
             
        }catch(Throwable $e){
            throw new StorageException("nie udało się pobrać iformacji o liczbie o notatkach", 400, $e);
        }
      
    }

    public function list(int $pageNumber, int $pageSize, string $sortBy, string $sortOrder):array
    {
        return $this->findBy(null, $pageNumber, $pageSize, $sortBy, $sortOrder);
      
    }

    public function search(string $phrase, int $pageNumber, int $pageSize, string $sortBy, string $sortOrder): array
    {
        return $this->findBy($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
    }
    public function SearchCount(string $phrase): int
    {
        try{
            $phrase=$this->conect->quote('%'.$phrase.'%', PDO::PARAM_STR); 
            $query= "SELECT count(*) AS il FROM notes WHERE title LIKE($phrase)";
            
            $result=$this->conect->query($query);
            $result= $result-> fetch(PDO::FETCH_ASSOC);
            if(!$result){
                throw new StorageException("Błąd pobierania ilości notatek", 400);
            }
            return (int) $result['il'];
            
            //foreach($result as $row){
            //  $notes[]=$row;  
            //}
            //dump($notes);
             
        }catch(Throwable $e){
            throw new StorageException("nie udało się pobrać iformacji o liczbie o notatkach", 400, $e);
        }
    }

    public function create(array $data):void
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


    public function edit(int $id, array $data):void
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

    public function delete(int $id):void
    {
        try{
            $query="DELETE FROM notes WHERE id=$id LIMIT 1";
            $this->conect->exec($query);
        }catch(Throwable $e){
            throw new StorageException("Nie udało sięusunąc notatki", 400, $e);
        }
    }
    private function findBy(?string $phrase, int $pageNumber, int $pageSize, string $sortBy, string $sortOrder): array
    {
        try{


            $limit=$pageSize;
            $offset=($pageNumber-1)* $pageSize;

            if(!in_array($sortBy, ['created', 'title'])){
                $sortBy = 'title';
            }
            if(!in_array($sortOrder, ['asc', 'desc'])){
                $sortBy = 'desc';
            }      
            $wherePart ='';
            if($phrase){
               $phrase=$this->conect->quote('%'.$phrase.'%', PDO::PARAM_STR);
               $wherePart ="WHERE title LIKE($phrase)";
            }
            
            
          
            $query= "SELECT id, title, created 
            FROM notes
            $wherePart
            ORDER BY $sortBy $sortOrder
            LIMIT $offset, $limit
            ";
            
            $result=$this->conect->query($query);
            return $result-> fetchAll(PDO::FETCH_ASSOC);
            //foreach($result as $row){
            //  $notes[]=$row;  
            //}
            //dump($notes);
             
        }catch(Throwable $e){
            throw new StorageException("nie udało sie wyszukać", 400, $e);
        }
    }
}

?>