<?php
require_once 'BaseDao.class.php';

class BorrowDao extends BaseDao
{
    public $table = 'borrows';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function getBorrowInfo()
    {
        $query = "SELECT br.*, CONCAT(c.name,' ', c.surname) customer_name, c.phone_number customer_phone_number,
            b.name book_name, b.author author, CONCAT(e.name,' ', e.surname) employee_name, e.phone_number employee_phone_number
            FROM borrows br
                JOIN customers c ON br.customer_id = c.id 
                JOIN books b ON br.book_id = b.id
                JOIN employees e ON br.employee_id = e.id";
        return $this->executeQuerywithReturn($query,[]);
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