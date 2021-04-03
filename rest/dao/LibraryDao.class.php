<?php
require_once 'BaseDao.class.php';

class LibraryDao extends BaseDao
{
    public $table = 'libraries';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function deleteLibrary($id)
    {
        $query = "DELETE FROM libraries WHERE id =:id";
        return $this->executeQuerywithoutReturn($query, ['id' => $id]);
    }

    public function updateLibrary($library, $library_id)
    {
        $entity[':id'] = $library_id;
        $query= 'UPDATE '.  $this->table . ' SET ';
        foreach ($library as $key => $value) {
            $query .= $key . '=:' . $key . ', ';
            $entity[':' . $key] = $value;
        }
        $query = rtrim($query,', ') . ' WHERE id=:id';
        return $this->update($entity, $query);
    }
}