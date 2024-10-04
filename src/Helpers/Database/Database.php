<?php
namespace Regivaldo\Videos\Helpers\Database;

use PDO;

class Database
{
    public function execute()
    {   
        try {
            $envPath = realpath(dirname(__FILE__) . '../../../../env.ini');
           
            $env = parse_ini_file($envPath);

            $hostname = $env['host'];
            $username = $env['username'];
            $password = $env['password'];
            $database = $env['database'];

            $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        
            return $pdo;
        } catch (\PDOException $th) {
            return false;
        }
    }
}