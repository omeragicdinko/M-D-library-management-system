<?php
require_once 'BaseDao.class.php';

class BorrowDao extends BaseDao{

  public $table = 'borrows';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function delete_borrow($id){
    $query = "DELETE FROM borrows WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

  public function update_borrow($borrow, $borrow_id){
    $entity[':id'] = $borrow_id;
    $query= 'UPDATE '.  $this->table . ' SET ';
    foreach ($borrow as $key => $value) {
      $query .= $key . '=:' . $key . ', ';
      $entity[':' . $key] = $value;
    }
    $query = rtrim($query,', ') . ' WHERE id=:id';
    return $this->update($entity, $query);
  }

}
?>
