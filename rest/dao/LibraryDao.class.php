<?php
require_once 'BaseDao.class.php';

class LibraryDao extends BaseDao{

  public $table = 'libraries';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function delete_library($id){
    $query = "DELETE FROM libraries WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

  public function update_library($library, $library_id){
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
?>
