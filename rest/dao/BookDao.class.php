<?php
require_once 'BaseDao.class.php';

class BookDao extends BaseDao{

  public $table = 'books';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function delete_book($id){
    $query = "DELETE FROM books WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

  public function update_book($book, $book_id){
    $entity[':id'] = $book_id;
    $query= 'UPDATE '.  $this->table . ' SET ';
    foreach ($book as $key => $value) {
      $query .= $key . '=:' . $key . ', ';
      $entity[':' . $key] = $value;
    }
    $query = rtrim($query,', ') . ' WHERE id=:id';
    return $this->update($entity, $query);
  }

  public function update_availability($id){
    $query = "UPDATE books SET availability='NO' WHERE id = :id";
    return @($this->execute_query1($query,["id" => $id]))[0];
  }

}
?>
