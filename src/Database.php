<?php
declare(strict_types=1);


namespace App;
require_once("Exception/StorageException.php");

use App\Exception\ConfigurationException;
use App\Exception\StorageException;

use Throwable;

class Database
{
    public function __construct(array $config)
    {
        try{
        
           $this->validateConfig($config);

            $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
            $connection=new \PDO(
                $dsn,
                $config['user'],
                $config['password'],
            );
            
        }catch(\PDOException $e){
            throw new StorageException('Connection error');
            exit('e');
        }


       
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