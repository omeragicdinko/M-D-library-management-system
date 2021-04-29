<?php
require_once 'BaseDao.class.php';

class BookDao extends BaseDao
{
    public $table = 'books';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function getBookInfo()
    {
        $query = "SELECT b.*, l.name library_name, CONCAT(l.address,', ',l.city) library_location, 
            l.phone_number phone_number FROM books b JOIN libraries l ON b.library_id = l.id";
        return $this->executeQuerywithReturn($query,[]);
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

    public function updateAvailabilityToNo($id)
    {
      $query = "UPDATE books SET available='NO' WHERE id = :id";
      return @($this->executeQuerywithoutReturn($query,["id" => $id]))[0];
    }

    public function updateAvailabilityToYes($id)
    {
      $query = "UPDATE books SET available='YES' WHERE id = :id";
      return @($this->executeQuerywithoutReturn($query,["id" => $id]))[0];
    }
}