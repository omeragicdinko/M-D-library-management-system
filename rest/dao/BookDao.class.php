<?php
require_once 'BaseDao.class.php';

class BookDao extends BaseDao
{
    public $table = 'books';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function deleteBook($id)
    {
        $query = "DELETE FROM books WHERE id =:id";
        return $this->executeQuerywithoutReturn($query, ['id' => $id]);
    }

    public function updateBook($book, $book_id)
    {
        $entity[':id'] = $book_id;
        $query= 'UPDATE '.  $this->table . ' SET ';
        foreach ($book as $key => $value) {
            $query .= $key . '=:' . $key . ', ';
            $entity[':' . $key] = $value;
        }
        $query = rtrim($query,', ') . ' WHERE id=:id';
        return $this->update($entity, $query);
    }

    public function updateAvailability($id)
    {
      $query = "UPDATE books SET availability='NO' WHERE id = :id";
      return @($this->executeQuerywithoutReturn($query,["id" => $id]))[0];
    }
}