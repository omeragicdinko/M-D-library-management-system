<?php
require_once 'BaseDao.class.php';

class BorrowDao extends BaseDao
{
    public $table = 'borrows';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function deleteBorrow($id)
    {
        $query = "DELETE FROM borrows WHERE id =:id";
        return $this->executeQuerywithoutReturn($query, ['id' => $id]);
    }

    public function updateBorrow($borrow, $borrow_id)
    {
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