<?php
class BaseDao
{
    private $pdo;

    private $table_name;

    public function __construct($table_name)
    {
        $this->pdo = new PDO(Config::CONNECTION_STRING, Config::USERNAME, Config::PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->table_name = $table_name;
    }

    protected function executeQuerywithReturn($sql_query, $params)
    {
        $stmt = $this->pdo->prepare($sql_query);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    protected function executeQuerywithoutReturn($sql_query, $params)
    {
        $stmt = $this->pdo->prepare($sql_query);
        $stmt->execute($params);
    }

    protected function executeInsert($entity)
    {
        // entity is assiciative array storage of object - key/value storage
        $columns = "";
        $params = "";
        foreach ($entity as $key => $value) {
          $columns .= $key.",";
          $params .=":".$key.",";
        }
        $columns = rtrim($columns, ",");
        $params = rtrim($params, ",");
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table_name} ({$columns}) VALUES ({$params})");
        $stmt->execute($entity);
        $entity['id'] = $this->pdo->lastInsertId(); // get back id from DB
        return $entity;
    }

    public function add($entity)
    {
        return $this->executeInsert($entity);
    }

    public function getById($id)
    {
        return $this->executeQuerywithReturn("SELECT * FROM {$this->table_name} WHERE id = :id", ["id" => $id]);
    }

    public function getAll()
    {
        return $this->executeQuerywithReturn("SELECT * FROM {$this->table_name}", []);
    }

    public function execute($entity, $query)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            if ($entity){
                foreach($entity as $key => $value){
                    $stmt->bindValue($key, $value);
                }
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function update($entity, $query)
    {
        $this->execute($entity, $query);
    }
}