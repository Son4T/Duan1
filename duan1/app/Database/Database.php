<?php
require_once "configs.php";
class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME,USERNAME,PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $error) {
            echo "<h1>Lỗi kết nối CSDL: " . $error->getMessage() . "</h1>";
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
 
    public function __destruct()
    {
        $this->pdo = null;
    }
}